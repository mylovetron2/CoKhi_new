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

// --- Ngày lễ Việt Nam (cố định MM-DD) ---
// Ngày 1/1, 30/4, 1/5, 2/9, 24/11 (Ngày Văn hóa VN)
$fixed_holidays = ['01-01', '04-30', '05-01', '09-02', '11-24'];
// Tết âm lịch theo năm
$tet_holidays = [
    2024 => ['02-08','02-09','02-10','02-11','02-12','02-13','02-14'],
    2025 => ['01-26','01-27','01-28','01-29','01-30','01-31','02-01'],
    2026 => ['02-16','02-17','02-18','02-19','02-20','02-21','02-22'],
    2027 => ['02-04','02-05','02-06','02-07','02-08','02-09','02-10'],
    2028 => ['01-24','01-25','01-26','01-27','01-28','01-29','01-30'],
    2029 => ['02-11','02-12','02-13','02-14','02-15','02-16','02-17'],
    2030 => ['02-01','02-02','02-03','02-04','02-05','02-06','02-07'],
    2031 => ['01-21','01-22','01-23','01-24','01-25','01-26','01-27'],
];
// Giỗ Tổ Hùng Vương (10/3 Âm lịch) - đã quy đổi sang Dương lịch từng năm
$gio_to_holidays = [
    2024 => ['04-18'],
    2025 => ['04-07'],
    2026 => ['04-26'],
    2027 => ['04-15'],
    2028 => ['04-03'],
    2029 => ['04-22'],
    2030 => ['04-12'],
    2031 => ['04-02'],
];
$holiday_days = [];
foreach ($fixed_holidays as $md) {
    list($hm, $hd) = explode('-', $md);
    if ((int)$hm == $month) $holiday_days[(int)$hd] = true;
}
if (isset($tet_holidays[$year])) {
    foreach ($tet_holidays[$year] as $md) {
        list($hm, $hd) = explode('-', $md);
        if ((int)$hm == $month) $holiday_days[(int)$hd] = true;
    }
}
if (isset($gio_to_holidays[$year])) {
    foreach ($gio_to_holidays[$year] as $md) {
        list($hm, $hd) = explode('-', $md);
        if ((int)$hm == $month) $holiday_days[(int)$hd] = true;
    }
}

// --- Màu nền từng ngày ---
// Thứ 7 = cam, Chủ nhật = vàng, Ngày lễ = xanh nhạt
$day_color = [];
for ($d = 1; $d <= $days_in_month; $d++) {
    $dow_c = (int)date('N', mktime(0, 0, 0, $month, $d, $year));
    if (isset($holiday_days[$d]))   $day_color[$d] = '#ADD8E6'; // Ngày lễ
    elseif ($dow_c == 7)            $day_color[$d] = '#FFFF00'; // Chủ nhật
    elseif ($dow_c == 6)            $day_color[$d] = '#FFA500'; // Thứ 7
    else                            $day_color[$d] = '';
}

// --- Xác định ngày Làm thêm: Thứ 7 + Chủ nhật + Ngày lễ ---
$lam_them_days = [];
for ($d = 1; $d <= $days_in_month; $d++) {
    $dow = (int)date('N', mktime(0, 0, 0, $month, $d, $year)); // 1=Thứ2 ... 7=CN
    if ($dow == 6 || $dow == 7 || isset($holiday_days[$d])) {
        $lam_them_days[$d] = true; // Thứ 7, Chủ nhật hoặc Ngày lễ
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
<body style="font-family:'Times New Roman',Times,serif;font-size:11pt;">
<table border="1" cellspacing="0" cellpadding="3" style="font-family:'Times New Roman',Times,serif;font-size:11pt;">
    <!-- Tiêu đề merge toàn bộ cột, không có border trên/trái/phải -->
    <tr>
        <td colspan="<?php echo 3 + $days_in_month + 2; ?>"
            align="center"
            style="font-weight:bold;font-size:14pt;border-left:none;border-right:none;border-top:none;border-bottom:none;">
            BẢNG CHẤM CÔNG THÁNG <?php echo $month . '/' . $year; ?>
        </td>
    </tr>
    <tr>
        <td colspan="<?php echo 3 + $days_in_month + 2; ?>" style="border:none;"></td>
    </tr>
    <tr style="font-weight:bold;text-align:center;">
        <td style="background-color:#3eafdb;">STT</td>
        <td style="background-color:#3eafdb;">Danh số</td>
        <td style="background-color:#3eafdb;">Tên nhân viên</td>
        <?php for ($d = 1; $d <= $days_in_month; $d++):
            $hdr_bg = $day_color[$d] ? $day_color[$d] : '#3eafdb';
        ?>
        <td style="background-color:<?php echo $hdr_bg; ?>"><?php echo $d; ?></td>
        <?php endfor; ?>
        <td style="background-color:#3eafdb;">Làm thêm</td>
        <td style="background-color:#3eafdb;">Tổng giờ</td>
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
        <td align="center"<?php if ($day_color[$d]) echo ' style="background-color:' . $day_color[$d] . '"'; ?>><?php echo $r['d' . $d]; ?></td>
        <?php endfor; ?>
        <td align="center" style="font-weight:bold;color:#c00;"><?php echo $r['lam_them']; ?></td>
        <td align="center" style="font-weight:bold;"><?php echo $r['tong']; ?></td>
    </tr>
    <?php endforeach; ?>
    <!-- Dòng cuối 1: Tổng số CBCNV (số NV theo từng ngày + tổng + NV có làm thêm) -->
    <tr style="font-weight:bold;">
        <td colspan="3" align="right">Tổng số CBCNV:</td>
        <?php for ($d = 1; $d <= $days_in_month; $d++): ?>
        <td align="center"<?php if ($day_color[$d]) echo ' style="background-color:' . $day_color[$d] . '"'; ?>><?php echo $day_total_cbcnv[$d] > 0 ? $day_total_cbcnv[$d] : 0; ?></td>
        <?php endfor; ?>
        <td align="center"><?php echo $cbcnv_with_lam_them > 0 ? $cbcnv_with_lam_them : 0; ?></td>
        <td align="center"><?php echo count($data); ?></td>
    </tr>
    <!-- Dòng cuối 2: Tổng số giờ (giờ theo từng ngày + tổng làm thêm + tổng giờ) -->
    <tr style="font-weight:bold;">
        <td colspan="3" align="right">Tổng số giờ:</td>
        <?php for ($d = 1; $d <= $days_in_month; $d++): ?>
        <td align="center"<?php if ($day_color[$d]) echo ' style="background-color:' . $day_color[$d] . '"'; ?>><?php echo $day_total_gio[$d] > 0 ? $day_total_gio[$d] : 0; ?></td>
        <?php endfor; ?>
        <td align="center"><?php echo $grand_lam_them > 0 ? $grand_lam_them : 0; ?></td>
        <td align="center"><?php echo $grand_total > 0 ? $grand_total : 0; ?></td>
    </tr>
    <?php endif; ?>
</table>

<br>
<table border="1" cellspacing="0" cellpadding="4" style="font-family:'Times New Roman',Times,serif;font-size:11pt;">
    <tr>
        <td style="background-color:#FFA500;width:40px;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>Thứ 7</td>
    </tr>
    <tr>
        <td style="background-color:#FFFF00;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>Chủ nhật</td>
    </tr>
    <tr>
        <td style="background-color:#ADD8E6;">&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>Ngày lễ</td>
    </tr>
</table>
</body>
</html>
