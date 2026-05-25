<?php
namespace PHPMaker2020\projectCoKhi;
error_reporting(E_ERROR | E_PARSE);
include_once "autoload.php";
require_once "db.php";
if (session_status() !== PHP_SESSION_ACTIVE)
    \Delight\Cookie\Session::start(Config("COOKIE_SAMESITE"));
ob_start();
WriteHeader(FALSE);
$Language = new Language();
$GLOBALS["Breadcrumb"] = new Breadcrumb();
SetupLoginStatus();
SetClientVar("login", LoginStatus());

if (version_compare(PHP_VERSION, '5.1.0') >= 0) {
    if (ini_get('date.timezone') == '') date_default_timezone_set('UTC');
}

$thang = isset($_GET['thang']) && preg_match('/^\d{4}-\d{2}$/', $_GET['thang'])
         ? $_GET['thang'] : '';

$year  = 0; $month = 0; $days_in_month = 0; $month_mm = '';
$employees = $data = $day_color = $lam_them_days = $holiday_days = [];
$day_total_gio = $day_total_cbcnv = [];
$grand_total = $grand_lam_them = $cbcnv_with_lam_them = 0;

if ($thang) {
    list($year, $month) = explode('-', $thang);
    $year  = (int)$year;
    $month = (int)$month;
    $days_in_month = (int)date('t', mktime(0, 0, 0, $month, 1, $year));
    $month_mm      = str_pad($month, 2, '0', STR_PAD_LEFT);
    $month_str_db  = $month_mm . '-' . $year;
    $month_str_safe = mysqli_real_escape_string($conn, $month_str_db);

    // --- Lấy danh sách nhân viên ---
    $sql_emp = "SELECT DISTINCT nv.danh_so, nv.ten_nhan_vien
                FROM ck_chitiet_suachua ct
                INNER JOIN view_nhan_vien nv ON ct.nhan_vien_id = nv.nhan_vien_id
                WHERE DATE_FORMAT(ct.ngay_sua_chua, '%m-%Y') = '$month_str_safe'
                ORDER BY nv.danh_so";
    if ($res = $conn->query($sql_emp)) {
        while ($row = mysqli_fetch_assoc($res)) $employees[] = $row;
    }

    // --- Ngày lễ ---
    $fixed_holidays = ['01-01', '04-30', '05-01', '09-02', '11-24'];
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
    $gio_to_holidays = [
        2024 => ['04-18'], 2025 => ['04-07'], 2026 => ['04-26'],
        2027 => ['04-15'], 2028 => ['04-03'], 2029 => ['04-22'],
        2030 => ['04-12'], 2031 => ['04-02'],
    ];
    foreach ($fixed_holidays as $md) {
        list($hm, $hd) = explode('-', $md);
        if ((int)$hm == $month) $holiday_days[(int)$hd] = true;
    }
    foreach ([$tet_holidays, $gio_to_holidays] as $arr) {
        if (isset($arr[$year])) {
            foreach ($arr[$year] as $md) {
                list($hm, $hd) = explode('-', $md);
                if ((int)$hm == $month) $holiday_days[(int)$hd] = true;
            }
        }
    }

    // --- Màu ngày & Làm thêm ---
    for ($d = 1; $d <= $days_in_month; $d++) {
        $dow_c = (int)date('N', mktime(0, 0, 0, $month, $d, $year));
        if (isset($holiday_days[$d]))  $day_color[$d] = '#ADD8E6';
        elseif ($dow_c == 7)           $day_color[$d] = '#FFFF00';
        elseif ($dow_c == 6)           $day_color[$d] = '#FFA500';
        else                           $day_color[$d] = '';
        if ($dow_c == 6 || $dow_c == 7 || isset($holiday_days[$d]))
            $lam_them_days[$d] = true;
    }

    // --- Dữ liệu giờ công ---
    $day_total_gio   = array_fill(1, $days_in_month, 0);
    $day_total_cbcnv = array_fill(1, $days_in_month, 0);
    foreach ($employees as $emp) {
        $ds_safe  = mysqli_real_escape_string($conn, $emp['danh_so']);
        $row_data = ['danh_so' => $emp['danh_so'], 'ten_nhan_vien' => $emp['ten_nhan_vien']];
        $total = $lam_them = 0;
        for ($d = 1; $d <= $days_in_month; $d++) {
            $dd     = str_pad($d, 2, '0', STR_PAD_LEFT);
            $day_db = $month_mm . '-' . $dd . '-' . $year;
            $sub_sql = "SELECT SUM(ct.thoi_gian) AS gio
                        FROM ck_chitiet_suachua ct
                        INNER JOIN view_nhan_vien nv ON ct.nhan_vien_id = nv.nhan_vien_id
                        WHERE DATE_FORMAT(ct.ngay_sua_chua, '%m-%d-%Y') = '$day_db'
                          AND nv.danh_so = '$ds_safe'";
            $subres = $conn->query($sub_sql);
            $gio = ($subres && ($subrow = mysqli_fetch_assoc($subres)) && $subrow['gio'])
                   ? (float)$subrow['gio'] : 0;
            $row_data['d'.$d]   = $gio > 0 ? $gio : '';
            $total             += $gio;
            $day_total_gio[$d] += $gio;
            if ($gio > 0) $day_total_cbcnv[$d]++;
            if (isset($lam_them_days[$d]) && $gio > 0) $lam_them += $gio;
        }
        $row_data['lam_them'] = $lam_them > 0 ? $lam_them : '';
        $row_data['tong']     = $total    > 0 ? $total    : '';
        $grand_total         += $total;
        $grand_lam_them      += $lam_them;
        $data[] = $row_data;
    }
    foreach ($data as $r) {
        if ($r['lam_them'] !== '') $cbcnv_with_lam_them++;
    }
}
?>
<?php include_once "header.php"; ?>
<style>
    .bcc-table { border-collapse: collapse; font-size: 12px; }
    .bcc-table th, .bcc-table td {
        border: 1px solid #555;
        padding: 3px 5px;
        white-space: nowrap;
    }
    .bcc-table th { background-color: #3eafdb; text-align: center; }
    .bcc-table td.num { text-align: center; }
    .bcc-table tr.footer-row td { font-weight: bold; background-color: #f5f5f5; }
    .day-sat  { background-color: #FFA500; }
    .day-sun  { background-color: #FFFF00; }
    .day-hol  { background-color: #ADD8E6; }
    .lam-them-val { color: #c00; font-weight: bold; }
    .legend-box { display:inline-block; width:22px; height:16px; border:1px solid #999; vertical-align:middle; margin-right:4px; }
    @media print {
        .no-print { display: none !important; }
        .main-sidebar, .main-header, .main-footer { display: none !important; }
        .content-wrapper { margin-left: 0 !important; }
    }
</style>
<h5 class="mb-3">Bảng Chấm Công Tháng</h5>

    <form action="in_bao_cao_nv2.php" method="GET" class="no-print mb-3">
        <div class="form-row align-items-end">
            <div class="col-auto">
                <label class="mb-1">Chọn tháng</label>
                <select class="form-control" name="thang">
                    <option value="">-- Chọn tháng --</option>
                    <?php
                    $now_y = (int)date('Y'); $now_m = (int)date('m');
                    for ($y = $now_y; $y >= $now_y - 2; $y--) {
                        for ($m = 12; $m >= 1; $m--) {
                            if ($y == $now_y && $m > $now_m) continue;
                            $val = $y . '-' . str_pad($m, 2, '0', STR_PAD_LEFT);
                            $lbl = 'Tháng ' . $m . '/' . $y;
                            $sel = ($val === $thang) ? 'selected' : '';
                            echo "<option value=\"$val\" $sel>$lbl</option>\n";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Xem</button>
                <?php if ($thang): ?>
                <button type="submit" class="btn btn-success" formaction="in_excel_ns2.php">
                    Xuất Excel
                </button>
                <?php endif; ?>
            </div>
        </div>
    </form>

    <?php if ($thang && $year): ?>

    <h6 class="text-center font-weight-bold mb-3" style="font-size:15px;">
        BẢNG CHẤM CÔNG THÁNG <?php echo $month . '/' . $year; ?>
    </h6>

    <?php if (empty($data)): ?>
        <div class="alert alert-warning">Không có dữ liệu tháng <?php echo $month.'/'.$year; ?>.</div>
    <?php else: ?>

    <div style="overflow-x:auto;">
    <table class="bcc-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Danh số</th>
                <th style="min-width:120px;">Tên nhân viên</th>
                <?php for ($d = 1; $d <= $days_in_month; $d++):
                    $cls = $day_color[$d] == '#FFA500' ? 'day-sat'
                         : ($day_color[$d] == '#FFFF00' ? 'day-sun'
                         : ($day_color[$d] == '#ADD8E6' ? 'day-hol' : ''));
                ?>
                <th class="<?php echo $cls; ?>"><?php echo $d; ?></th>
                <?php endfor; ?>
                <th>Làm thêm</th>
                <th>Tổng giờ</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $i => $r): ?>
        <tr>
            <td class="num"><?php echo $i + 1; ?></td>
            <td><?php echo htmlspecialchars($r['danh_so']); ?></td>
            <td><?php echo htmlspecialchars($r['ten_nhan_vien']); ?></td>
            <?php for ($d = 1; $d <= $days_in_month; $d++):
                $cls = $day_color[$d] == '#FFA500' ? 'day-sat'
                     : ($day_color[$d] == '#FFFF00' ? 'day-sun'
                     : ($day_color[$d] == '#ADD8E6' ? 'day-hol' : ''));
            ?>
            <td class="num <?php echo $cls; ?>"><?php echo $r['d'.$d]; ?></td>
            <?php endfor; ?>
            <td class="num lam-them-val"><?php echo $r['lam_them']; ?></td>
            <td class="num" style="font-weight:bold;"><?php echo $r['tong']; ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="footer-row">
                <td colspan="3" style="text-align:right;">Tổng số CBCNV:</td>
                <?php for ($d = 1; $d <= $days_in_month; $d++):
                    $cls = $day_color[$d] == '#FFA500' ? 'day-sat'
                         : ($day_color[$d] == '#FFFF00' ? 'day-sun'
                         : ($day_color[$d] == '#ADD8E6' ? 'day-hol' : ''));
                ?>
                <td class="num <?php echo $cls; ?>"><?php echo $day_total_cbcnv[$d] > 0 ? $day_total_cbcnv[$d] : 0; ?></td>
                <?php endfor; ?>
                <td class="num"><?php echo $cbcnv_with_lam_them; ?></td>
                <td class="num"><?php echo count($data); ?></td>
            </tr>
            <tr class="footer-row">
                <td colspan="3" style="text-align:right;">Tổng số giờ:</td>
                <?php for ($d = 1; $d <= $days_in_month; $d++):
                    $cls = $day_color[$d] == '#FFA500' ? 'day-sat'
                         : ($day_color[$d] == '#FFFF00' ? 'day-sun'
                         : ($day_color[$d] == '#ADD8E6' ? 'day-hol' : ''));
                ?>
                <td class="num <?php echo $cls; ?>"><?php echo $day_total_gio[$d] > 0 ? $day_total_gio[$d] : 0; ?></td>
                <?php endfor; ?>
                <td class="num lam-them-val"><?php echo $grand_lam_them > 0 ? $grand_lam_them : 0; ?></td>
                <td class="num" style="font-weight:bold;"><?php echo $grand_total > 0 ? $grand_total : 0; ?></td>
            </tr>
        </tfoot>
    </table>
    </div>

    <div class="mt-3 no-print">
        <span class="legend-box day-sat"></span> Thứ 7 &nbsp;
        <span class="legend-box day-sun"></span> Chủ nhật &nbsp;
        <span class="legend-box day-hol"></span> Ngày lễ
    </div>

    <button onclick="window.print()" class="btn btn-secondary btn-sm no-print mt-2">In trang</button>

    <?php endif; ?>
    <?php endif; ?>
<?php include_once "footer.php"; ?>
