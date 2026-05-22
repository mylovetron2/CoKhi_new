<?php
/**
 * AJAX endpoint: Upload / list / delete tài liệu
 * POST upload: bang, ban_ghi_id, file (multipart), description, nguoi_upload
 * GET  list:   ?action=list&bang=...&id=...
 * POST delete: action=delete&tai_lieu_id=...
 */

if (ob_get_level()) ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

require_once dirname(__DIR__) . '/db.php';
require_once dirname(__DIR__) . '/config_gdrive.php';
require_once dirname(__DIR__) . '/classes/GDriveCoKhiUpload.php';

$bangChoPhep = ['ck_danhmuc_thietbi', 'ck_don_hang', 'ck_chitiet_suachua', 'ck_danhmuc_suachua'];
$action = isset($_GET['action']) ? $_GET['action'] : (isset($_POST['action']) ? $_POST['action'] : '');

// ---- Lấy danh sách file ----
if ($action === 'list') {
    $bang = trim(isset($_GET['bang']) ? $_GET['bang'] : '');
    $id   = (int)(isset($_GET['id']) ? $_GET['id'] : 0);
    if (!$bang || !$id || !in_array($bang, $bangChoPhep, true)) {
        echo json_encode(['files' => []]);
        exit;
    }
    $gdrive = new GDriveCoKhiUpload();
    $files  = $gdrive->getFiles($conn, $bang, $id);
    echo json_encode(['files' => $files]);
    exit;
}

// ---- Xóa file ----
if ($action === 'delete') {
    $id = (int)(isset($_POST['tai_lieu_id']) ? $_POST['tai_lieu_id'] : 0);
    if ($id) {
        $stmt = mysqli_prepare($conn, "DELETE FROM ck_tai_lieu WHERE id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    echo json_encode(['success' => true]);
    exit;
}

// ---- Upload file ----
$tenBang  = trim(isset($_POST['bang']) ? $_POST['bang'] : '');
$banGhiId = (int)(isset($_POST['ban_ghi_id']) ? $_POST['ban_ghi_id'] : 0);

if (!$tenBang || !$banGhiId || !in_array($tenBang, $bangChoPhep, true)) {
    echo json_encode(['success' => false, 'message' => 'Thiếu hoặc sai tham số (bang, ban_ghi_id)']);
    exit;
}

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    $errMsg = [
        UPLOAD_ERR_INI_SIZE  => 'File vượt quá giới hạn server',
        UPLOAD_ERR_FORM_SIZE => 'File quá lớn',
        UPLOAD_ERR_PARTIAL   => 'Upload không hoàn chỉnh',
        UPLOAD_ERR_NO_FILE   => 'Chưa chọn file',
    ];
    $code = isset($_FILES['file']['error']) ? $_FILES['file']['error'] : UPLOAD_ERR_NO_FILE;
    echo json_encode(['success' => false, 'message' => isset($errMsg[$code]) ? $errMsg[$code] : ('Upload error ' . $code)]);
    exit;
}

try {
    $gdrive      = new GDriveCoKhiUpload();
    $description = trim(isset($_POST['description']) ? $_POST['description'] : '');
    $nguoiUpload = trim(isset($_POST['nguoi_upload']) ? $_POST['nguoi_upload'] : 'user');

    $result = $gdrive->upload($_FILES['file'], null, $description, $nguoiUpload);

    if ($result['success']) {
        $gdrive->saveToDb(
            $conn, $tenBang, $banGhiId,
            $_FILES['file']['name'], $description,
            isset($result['web_link']) ? $result['web_link'] : '',
            isset($result['download_link']) ? $result['download_link'] : '',
            isset($result['gdrive_file_id']) ? $result['gdrive_file_id'] : '',
            $nguoiUpload
        );
        echo json_encode([
            'success'  => true,
            'message'  => 'Upload thành công: ' . $_FILES['file']['name'],
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => isset($result['message']) ? $result['message'] : 'Lỗi không xác định']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
}
