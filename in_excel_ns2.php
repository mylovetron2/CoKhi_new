<?php
error_reporting(E_ERROR | E_PARSE);
require_once "db.php";
session_start();

if (version_compare(PHP_VERSION, '5.1.0') >= 0) {
    if (ini_get('date.timezone') == '') {
        date_default_timezone_set('UTC');
    }
}

// --- Validate tham số ---
$thang = isset($_GET['thang']) && preg_match('/^\d{4}-\d{2}$/', $_GET['thang'])
         ? $_GET['thang'] : '';

if (!$thang) {
    die('<p style="color:red;font-family:sans-serif">Vui lòng chọn tháng trước khi in báo cáo.</p>');
}

list($year, $month) = explode('-', $thang);
$year  = (int)$year;
$month = (int)$month;

$days_in_month = (int)date('t', mktime(0, 0, 0, $month, 1, $year));
$month_mm      = str_pad($month, 2, '0', STR_PAD_LEFT);
$month_str_db  = $month_mm . '-' . $year; // MM-YYYY dùng cho DATE_FORMAT

// --- Lấy danh sách nhân viên có giờ công trong tháng ---
$month_str_safe = mysqli_real_escape_string($conn, $month_str_db);

$sql_emp = "SELECT DISTINCT nv.danh_so, nv.ten_nhan_vien
            FROM ck_chitiet_suachua ct
            INNER JOIN view_nhan_vien nv ON ct.nhan_vien_id = nv.nhan_vien_id
            WHERE DATE_FORMAT(ct.ngay_sua_chua, '%m-%Y') = '$month_str_safe'
            ORDER BY nv.danh_so";

$employees = [];
if ($res = $conn->query($sql_emp)) {
    while ($row = mysqli_fetch_assoc($res)) {
        $employees[] = $row;
    }
}

// --- Xác định ngày Thứ 6 (N=5) và Thứ 7 (N=6) trong tháng = ngày "Làm thêm" ---
$lam_them_days = [];
for ($d = 1; $d <= $days_in_month; $d++) {
    $dow = (int)date('N', mktime(0, 0, 0, $month, $d, $year)); // 1=Thứ2 ... 7=CN
    if ($dow == 5 || $dow == 6) {
        $lam_them_days[$d] = true; // Thứ 6 hoặc Thứ 7
    }
}

// --- Lấy giờ công từng ngày cho từng nhân viên ---
$data              = [];
$grand_total       = 0; // tổng giờ tất cả NV
$grand_lam_them    = 0; // tổng làm thêm tất cả NV
$day_total_gio     = array_fill(1, $days_in_month, 0);   // tổng giờ mỗi ngày
$day_total_cbcnv   = array_fill(1, $days_in_month, 0);   // số NV có mặt mỗi ngày

foreach ($employees as $emp) {
    $ds_safe = mysqli_real_escape_string($conn, $emp['danh_so']);
    $row_data = [
        'danh_so'      => $emp['danh_so'],
        'ten_nhan_vien'=> $emp['ten_nhan_vien'],
    ];
    $total    = 0;
    $lam_them = 0;

    for ($d = 1; $d <= $days_in_month; $d++) {
        $dd      = str_pad($d, 2, '0', STR_PAD_LEFT);
        $day_db  = $month_mm . '-' . $dd . '-' . $year; // MM-DD-YYYY

        $sub_sql = "SELECT SUM(ct.thoi_gian) AS gio
                    FROM ck_chitiet_suachua ct
                    INNER JOIN view_nhan_vien nv ON ct.nhan_vien_id = nv.nhan_vien_id
                    WHERE DATE_FORMAT(ct.ngay_sua_chua, '%m-%d-%Y') = '$day_db'
                      AND nv.danh_so = '$ds_safe'";

        $subres = $conn->query($sub_sql);
        $gio    = ($subres && ($subrow = mysqli_fetch_assoc($subres)) && $subrow['gio'])
                  ? (float)$subrow['gio'] : 0;

        $row_data['d' . $d]   = $gio > 0 ? $gio : '';
        $total               += $gio;
        $day_total_gio[$d]   += $gio;
        if ($gio > 0) {
            $day_total_cbcnv[$d]++;
        }
        // Làm thêm = giờ làm vào Thứ 6 hoặc Thứ 7
        if (isset($lam_them_days[$d]) && $gio > 0) {
            $lam_them += $gio;
        }
    }

    $row_data['lam_them'] = $lam_them > 0 ? $lam_them : '';
    $row_data['tong']     = $total    > 0 ? $total    : '';
    $grand_total         += $total;
    $grand_lam_them      += $lam_them;
    $data[] = $row_data;
}
// Đếm số NV có làm thêm (PHP 5 compatible)
$cbcnv_with_lam_them = 0;
foreach ($data as $r) {
    if ($r['lam_them'] !== '') $cbcnv_with_lam_them++;
}

// --- Xuất file Excel (HTML-table → .xls) ---
$filename = 'BaoCaoNS_Thang' . $month . '_' . $year . '.xls';
header('Content-Type: application/vnd.ms-excel; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Pragma: no-cache');
header('Expires: 0');
?>
<html>
<head><meta charset="UTF-8"></head>
<body>
<table border="1" cellspacing="0" cellpadding="3">
    <tr>
        <td colspan="<?php echo 3 + $days_in_month + 2; ?>"
            align="center"
            style="font-weight:bold;font-size:14pt;">
            BẢNG CHẤM CÔNG THÁNG <?php echo $month . '/' . $year; ?>
        </td>
    </tr>
    <tr style="background-color:#3eafdb;font-weight:bold;text-align:center;">
        <td>STT</td>
        <td>Danh số</td>
        <td>Tên nhân viên</td>
        <?php for ($d = 1; $d <= $days_in_month; $d++): ?>
        <td><?php echo $d; ?></td>
        <?php endfor; ?>
        <td>Làm thêm</td>
        <td>Tổng giờ</td>
    </tr>
    <?php if (empty($data)): ?>
    <tr>
        <td colspan="<?php echo 3 + $days_in_month + 2; ?>" align="center">
            Không có dữ liệu trong tháng <?php echo $month . '/' . $year; ?>
        </td>
    </tr>
    <?php else: ?>
    <?php foreach ($data as $i => $r): ?>
    <tr>
        <td align="center"><?php echo $i + 1; ?></td>
        <td><?php echo htmlspecialchars($r['danh_so']); ?></td>
        <td><?php echo htmlspecialchars($r['ten_nhan_vien']); ?></td>
        <?php for ($d = 1; $d <= $days_in_month; $d++): ?>
        <td align="center"><?php echo $r['d' . $d]; ?></td>
        <?php endfor; ?>
        <td align="center" style="font-weight:bold;color:#c00;"><?php echo $r['lam_them']; ?></td>
        <td align="center" style="font-weight:bold;"><?php echo $r['tong']; ?></td>
    </tr>
    <?php endforeach; ?>
    <!-- Dòng cuối 1: Tổng số CBCNV (số NV theo từng ngày + tổng + NV có làm thêm) -->
    <tr style="font-weight:bold;">
        <td colspan="3" align="right">Tổng số CBCNV:</td>
        <?php for ($d = 1; $d <= $days_in_month; $d++): ?>
        <td align="center"><?php echo $day_total_cbcnv[$d] > 0 ? $day_total_cbcnv[$d] : 0; ?></td>
        <?php endfor; ?>
        <td align="center"><?php echo $cbcnv_with_lam_them > 0 ? $cbcnv_with_lam_them : 0; ?></td>
        <td align="center"><?php echo count($data); ?></td>
    </tr>
    <!-- Dòng cuối 2: Tổng số giờ (giờ theo từng ngày + tổng làm thêm + tổng giờ) -->
    <tr style="font-weight:bold;">
        <td colspan="3" align="right">Tổng số giờ:</td>
        <?php for ($d = 1; $d <= $days_in_month; $d++): ?>
        <td align="center"><?php echo $day_total_gio[$d] > 0 ? $day_total_gio[$d] : 0; ?></td>
        <?php endfor; ?>
        <td align="center"><?php echo $grand_lam_them > 0 ? $grand_lam_them : 0; ?></td>
        <td align="center"><?php echo $grand_total > 0 ? $grand_total : 0; ?></td>
    </tr>
    <?php endif; ?>
</table>
</body>
</html>
