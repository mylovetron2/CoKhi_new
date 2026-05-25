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

// Filter params — mặc định từ đầu tháng đến hôm nay
$from         = (isset($_GET['from']) && $_GET['from'] !== '') ? $_GET['from'] : date('Y-m-01');
$to           = (isset($_GET['to'])   && $_GET['to']   !== '') ? $_GET['to']   : date('Y-m-d');
$nhan_vien_id = isset($_GET['nhan_vien_id']) ? $_GET['nhan_vien_id'] : '-1';

$where = [];
if ($from) $where[] = "ngay_sua_chua >= '" . $conn->real_escape_string($from) . "'";
if ($to)   $where[] = "ngay_sua_chua <= '" . $conn->real_escape_string($to) . "'";
if ($nhan_vien_id !== '' && $nhan_vien_id !== '-1')
    $where[] = "nhan_vien_id = '" . $conn->real_escape_string($nhan_vien_id) . "'";
$where_sql = count($where) ? (' WHERE ' . implode(' AND ', $where)) : '';

$sql = "SELECT ten_nhan_vien, ngay_sua_chua, thoi_gian,
               REPLACE(REPLACE(noi_dung, '<p>', ''), '</p>', '') AS noi_dung
        FROM ck_view_nhanvien_suachua" . $where_sql . "
        ORDER BY ngay_sua_chua DESC";
$result = $conn->query($sql);

// Danh sách nhân viên cho dropdown
$nhanvien_options = '<option value="-1">-- Tất cả nhân viên --</option>';
$sql_nv = "SELECT DISTINCT nhan_vien_id, ten_nhan_vien FROM ck_view_nhanvien_suachua ORDER BY ten_nhan_vien ASC";
$result_nv = $conn->query($sql_nv);
if ($result_nv && $result_nv->num_rows > 0) {
    while ($row_nv = $result_nv->fetch_assoc()) {
        $selected = ($row_nv['nhan_vien_id'] == $nhan_vien_id) ? ' selected' : '';
        $nhanvien_options .= '<option value="' . htmlspecialchars($row_nv['nhan_vien_id']) . '"' . $selected . '>'
                           . htmlspecialchars($row_nv['ten_nhan_vien']) . '</option>';
    }
}

$tong_thoi_gian = 0;
$rows = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
        if (is_numeric($row['thoi_gian'])) $tong_thoi_gian += (float)$row['thoi_gian'];
    }
}

// --- Xuất Word ---
if (isset($_GET['word']) && $_GET['word'] == '1') {
    $from_fmt  = $from  ? \DateTime::createFromFormat('Y-m-d', $from)->format('d/m/Y')  : '';
    $to_fmt    = $to    ? \DateTime::createFromFormat('Y-m-d', $to)->format('d/m/Y')    : '';
    header('Content-Type: application/vnd.ms-word; charset=utf-8');
    header('Content-Disposition: attachment; filename="chitiet_suachua.doc"');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    echo '<!DOCTYPE html><html><head><meta charset="utf-8">
<style>
body { font-family: "Times New Roman", serif; font-size: 13pt; }
h3   { text-align: center; font-size: 14pt; }
p.sub { text-align: center; font-size: 12pt; }
table { border-collapse: collapse; width: 100%; font-size: 12pt; }
th, td { border: 1px solid #000; padding: 5px 8px; }
th { background: #c6efce; text-align: center; }
td.center { text-align: center; }
tfoot td { font-weight: bold; background: #f2f2f2; }
</style></head><body>';
    echo '<h3>CHI TIẾT SỬA CHỮA NHÂN VIÊN</h3>';
    echo '<p class="sub">Từ ngày: <strong>' . $from_fmt . '</strong> &mdash; Đến ngày: <strong>' . $to_fmt . '</strong></p>';
    echo '<table><thead><tr>
        <th>STT</th><th>Nhân viên</th><th>Ngày sửa chữa</th><th>Thời gian</th><th>Nội dung</th>
    </tr></thead><tbody>';
    foreach ($rows as $i => $r) {
        $noi_dung_clean = preg_replace('/\s*<\/?(table|tbody|tr|td)[^>]*>\s*/i', ' ', $r['noi_dung']);
        $noi_dung_clean = strip_tags(trim($noi_dung_clean));
        $ngay_fmt = '';
        if (!empty($r['ngay_sua_chua']) && $r['ngay_sua_chua'] !== '0000-00-00') {
            $d = \DateTime::createFromFormat('Y-m-d', $r['ngay_sua_chua']);
            $ngay_fmt = $d ? $d->format('d/m/Y') : $r['ngay_sua_chua'];
        }
        echo '<tr>
            <td class="center">' . ($i + 1) . '</td>
            <td>' . htmlspecialchars($r['ten_nhan_vien']) . '</td>
            <td class="center">' . $ngay_fmt . '</td>
            <td class="center">' . htmlspecialchars($r['thoi_gian']) . '</td>
            <td>' . nl2br(htmlspecialchars($noi_dung_clean)) . '</td>
        </tr>';
    }
    echo '</tbody><tfoot><tr>
        <td colspan="3" style="text-align:right;">Tổng thời gian:</td>
        <td class="center">' . $tong_thoi_gian . '</td>
        <td></td>
    </tr></tfoot></table>';
    echo '</body></html>';
    exit;
}
?>
<?php include_once "header.php"; ?>
<style>
    @media print {
        .no-print { display: none !important; }
        .main-sidebar, .main-header, .main-footer { display: none !important; }
        .content-wrapper { margin-left: 0 !important; }
    }
</style>
<h5 class="mb-3">Chi Tiết Sửa Chữa Nhân Viên</h5>
<form action="bao_cao_chitiet_suachua.php" class="no-print mb-3">
    <div class="form-row align-items-end">
        <div class="col-auto">
            <label>Nhân viên</label>
            <select class="form-control form-control-sm" name="nhan_vien_id">
                <?php echo $nhanvien_options; ?>
            </select>
        </div>
        <div class="col-auto">
            <label>Từ ngày</label>
            <input type="date" class="form-control form-control-sm" name="from" value="<?php echo htmlspecialchars($from); ?>">
        </div>
        <div class="col-auto">
            <label>Đến ngày</label>
            <input type="date" class="form-control form-control-sm" name="to" value="<?php echo htmlspecialchars($to); ?>">
        </div>
        <div class="col-auto mt-4">
            <button type="submit" class="btn btn-primary btn-sm">Xem</button>
            <a href="export_ck_chitiet_suachua_pdf.php?from=<?php echo urlencode($from); ?>&to=<?php echo urlencode($to); ?>&nhan_vien_id=<?php echo urlencode($nhan_vien_id); ?>"
               class="btn btn-danger btn-sm no-print">Xuất PDF</a>
            <a href="bao_cao_chitiet_suachua.php?from=<?php echo urlencode($from); ?>&to=<?php echo urlencode($to); ?>&nhan_vien_id=<?php echo urlencode($nhan_vien_id); ?>&word=1"
               class="btn btn-info btn-sm no-print">Xuất Word</a>
            <button type="button" class="btn btn-secondary btn-sm no-print" onclick="window.print()">In trang</button>
        </div>
    </div>
</form>
<?php if (!empty($rows)): ?>
<div style="overflow-x:auto;">
<table class="table table-bordered table-sm" style="font-size:13px;">
    <thead class="thead-dark">
        <tr>
            <th class="text-center" style="width:40px;">STT</th>
            <th>Nhân viên</th>
            <th class="text-center">Ngày sửa chữa</th>
            <th class="text-center">Thời gian</th>
            <th>Nội dung</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($rows as $i => $r):
        $noi_dung_clean = preg_replace('/\s*<\/?(table|tbody|tr|td)[^>]*>\s*/i', ' ', $r['noi_dung']);
        $noi_dung_clean = strip_tags(trim($noi_dung_clean));
        $ngay_fmt = '';
        if (!empty($r['ngay_sua_chua']) && $r['ngay_sua_chua'] !== '0000-00-00') {
            $d = \DateTime::createFromFormat('Y-m-d', $r['ngay_sua_chua']);
            $ngay_fmt = $d ? $d->format('d/m/Y') : $r['ngay_sua_chua'];
        }
    ?>
        <tr>
            <td class="text-center"><?php echo $i + 1; ?></td>
            <td><?php echo htmlspecialchars($r['ten_nhan_vien']); ?></td>
            <td class="text-center"><?php echo $ngay_fmt; ?></td>
            <td class="text-center"><?php echo htmlspecialchars($r['thoi_gian']); ?></td>
            <td><?php echo nl2br(htmlspecialchars($noi_dung_clean)); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr class="table-secondary">
            <td colspan="3" class="text-right"><strong>Tổng thời gian:</strong></td>
            <td class="text-center"><strong><?php echo $tong_thoi_gian; ?></strong></td>
            <td></td>
        </tr>
    </tfoot>
</table>
</div>
<?php else: ?>
<div class="alert alert-warning">Không có dữ liệu trong khoảng thời gian đã chọn.</div>
<?php endif; ?>
<?php include_once "footer.php"; ?>
