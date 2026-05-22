<?php
/**
 * Helper class: Upload file lên gdrive-cokhi qua API
 */
class GDriveCoKhiUpload
{
    private $apiUrl;
    private $apiKey;

    public function __construct()
    {
        if (!defined('GDRIVE_COKHI_API_URL')) {
            require_once dirname(__DIR__) . '/config_gdrive.php';
        }
        $this->apiUrl = GDRIVE_COKHI_API_URL;
        $this->apiKey = GDRIVE_COKHI_API_KEY;
    }

    /**
     * Upload file lên Google Drive qua gdrive-cokhi API
     *
     * @param array  $file         Phần tử trong $_FILES (vd: $_FILES['file'])
     * @param int|null $folderId   ID thư mục trong gdrive-cokhi (null = mặc định)
     * @param string $description  Mô tả file
     * @param string $uploaderRef  Tên người dùng bên CoKhi (ghi log)
     * @return array ['success'=>bool, 'web_link'=>string, 'download_link'=>string, 'message'=>string, ...]
     */
    public function upload(array $file, $folderId = null, $description = '', $uploaderRef = '')
    {
        if (!function_exists('curl_init')) {
            return ['success' => false, 'message' => 'cURL không khả dụng trên server này'];
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'message' => 'File upload error: ' . $file['error']];
        }

        $postFields = [
            'file'         => new CURLFile($file['tmp_name'], $file['type'], $file['name']),
            'description'  => $description,
            'uploader_ref' => $uploaderRef ?: 'cokhi-project',
        ];

        if ($folderId !== null) {
            $postFields['folder_id'] = (int)$folderId;
        } elseif (defined('GDRIVE_COKHI_DEFAULT_FOLDER') && GDRIVE_COKHI_DEFAULT_FOLDER !== null) {
            $postFields['folder_id'] = (int)GDRIVE_COKHI_DEFAULT_FOLDER;
        }

        $ch = curl_init($this->apiUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => [
                'Authorization: Bearer ' . $this->apiKey,
                'Expect: ',         // tránh 100-Continue delay
            ],
            CURLOPT_POSTFIELDS     => $postFields,
            CURLOPT_TIMEOUT        => 120,
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false, // tắt do server-to-server nội bộ
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSLVERSION     => CURL_SSLVERSION_TLSv1_2,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 3,
            CURLOPT_USERAGENT      => 'CoKhi-Project/1.0',
            CURLOPT_ENCODING       => '',   // chấp nhận gzip/deflate
        ]);

        $raw      = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlErr  = curl_error($ch);
        $curlErrNo = curl_errno($ch);
        curl_close($ch);

        if ($curlErr) {
            return ['success' => false, 'message' => 'cURL error [' . $curlErrNo . ']: ' . $curlErr];
        }

        if ($httpCode === 0) {
            return ['success' => false, 'message' => 'Không kết nối được đến gdrive server (HTTP 0)'];
        }

        $response = json_decode($raw, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $preview = substr(strip_tags($raw), 0, 200);
            return ['success' => false, 'message' => 'API response không hợp lệ (HTTP ' . $httpCode . '): ' . $preview];
        }

        return $response;
    }

    /**
     * Lưu thông tin file vào bảng ck_tai_lieu
     *
     * @param mysqli $conn       Kết nối DB hiện tại
     * @param string $tenBang    Tên bảng gốc (vd: 'ck_don_hang')
     * @param int    $banGhiId   ID bản ghi gốc
     * @param string $tenFile    Tên file gốc
     * @param string $mota       Mô tả
     * @param string $webLink    Link xem Google Drive
     * @param string $dlLink     Link tải Google Drive
     * @param string $gdriveId   Google Drive file ID
     * @param string $nguoiUpload Tên người upload
     * @return int|false Insert ID hoặc false nếu lỗi
     */
    public function saveToDb($conn, $tenBang, $banGhiId, $tenFile, $mota, $webLink, $dlLink, $gdriveId, $nguoiUpload = '')
    {
        $sql = "INSERT INTO ck_tai_lieu
                    (ten_bang, ban_ghi_id, ten_file, mo_ta, web_link, download_link, gdrive_file_id, nguoi_upload)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) {
            return false;
        }
        mysqli_stmt_bind_param($stmt, 'sissssss',
            $tenBang, $banGhiId, $tenFile, $mota, $webLink, $dlLink, $gdriveId, $nguoiUpload
        );
        mysqli_stmt_execute($stmt);
        $insertId = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);
        return $insertId ?: false;
    }

    /**
     * Lấy danh sách file theo bảng và bản ghi
     *
     * @param mysqli $conn
     * @param string $tenBang
     * @param int    $banGhiId
     * @return array
     */
    public function getFiles($conn, $tenBang, $banGhiId)
    {
        $sql  = "SELECT * FROM ck_tai_lieu WHERE ten_bang = ? AND ban_ghi_id = ? ORDER BY ngay_upload DESC";
        $stmt = mysqli_prepare($conn, $sql);
        if (!$stmt) return [];
        mysqli_stmt_bind_param($stmt, 'si', $tenBang, $banGhiId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows   = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        mysqli_stmt_close($stmt);
        return $rows;
    }
}
