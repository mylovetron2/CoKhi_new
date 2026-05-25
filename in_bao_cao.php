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

$check = isset($_GET['baoduong']) ? $_GET['baoduong'] : '0';

$tungay = (isset($_GET['tungay']) && $_GET['tungay'] !== '') ? trim($_GET['tungay']) : date('Y-m-01');
$denngay = (isset($_GET['denngay']) && $_GET['denngay'] !== '') ? trim($_GET['denngay']) : date('Y-m-d');

$old_date = explode('-', $tungay);
$new_date = (count($old_date) == 3) ? $old_date[2] . '-' . $old_date[1] . '-' . $old_date[0] : '';

$old_date = explode('-', $denngay);
$new_date2 = (count($old_date) == 3) ? $old_date[2] . '-' . $old_date[1] . '-' . $old_date[0] : '';

$tungay_safe  = mysqli_real_escape_string($conn, $tungay);
$denngay_safe = mysqli_real_escape_string($conn, $denngay);
$baoduong_cond = ($check == 1) ? " AND baoduong_dinhky = 1" : "";

$sql = "SELECT ck_don_hang.*, ck_chitiet_suachua.nhan_vien_id
        FROM ck_don_hang
        INNER JOIN ck_danhmuc_suachua ON ck_don_hang.id = ck_danhmuc_suachua.id_don_hang
        INNER JOIN ck_chitiet_suachua  ON ck_danhmuc_suachua.sua_chua_id = ck_chitiet_suachua.sua_chua_id
        WHERE ck_don_hang.ngay_sua_chua BETWEEN '$tungay_safe' AND '$denngay_safe'
        $baoduong_cond
        GROUP BY ck_don_hang.so_don_hang_id
        ORDER BY ck_don_hang.ngay_sua_chua, ck_don_hang.so_don_hang_id";

$main = [];
$stt  = 0;

if ($result = $conn->query($sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $dh_id = $row['so_don_hang_id'];

        $sub_sql = "SELECT ck_danhmuc_thietbi.bo_phan,
                           ck_danhmuc_thietbi.ky_ma_hieu,
                           ck_chungloai_thietbi.ten_chungloai,
                           GROUP_CONCAT(DISTINCT view_nhan_vien.ten_nhan_vien) AS nhan_vien,
                           SUM(ck_view_nhatky.thoi_gian) AS tong_gio,
                           ck_danhmuc_thietbi.thiet_bi_id,
                           ck_view_nhatky.ngay_hoan_thanh
                    FROM ck_view_nhatky
                    INNER JOIN ck_danhmuc_thietbi   ON ck_view_nhatky.thiet_bi_id    = ck_danhmuc_thietbi.thiet_bi_id
                    INNER JOIN ck_chungloai_thietbi ON ck_chungloai_thietbi.chungloai_id = ck_danhmuc_thietbi.chung_loai_id
                    INNER JOIN view_nhan_vien       ON ck_view_nhatky.nhan_vien_id   = view_nhan_vien.nhan_vien_id
                    WHERE ck_view_nhatky.so_don_hang_id = $dh_id
                    GROUP BY ck_view_nhatky.thiet_bi_id, ck_danhmuc_thietbi.thiet_bi_id";

        $sub_count = 0;
        if ($resultsub = $conn->query($sub_sql)) {
            while ($subrow = mysqli_fetch_assoc($resultsub)) {
                $stt++;
                $main[] = [
                    'stt'             => $stt,
                    'so_don_hang_id'  => $row['so_don_hang_id'],
                    'noi_dung'        => $row['noi_dung_sua_chua'],
                    'ngay_sua_chua'   => $row['ngay_sua_chua'],
                    'ten_chungloai'   => $subrow['ten_chungloai'],
                    'ky_ma_hieu'      => $subrow['ky_ma_hieu'],
                    'bo_phan'         => $subrow['bo_phan'],
                    'nhan_vien'       => $subrow['nhan_vien'],
                    'tong_gio'        => $subrow['tong_gio'],
                    'ngay_hoan_thanh' => $subrow['ngay_hoan_thanh'],
                ];
                $sub_count++;
            }
        }
        if ($sub_count == 0) {
            $stt++;
            $main[] = [
                'stt'             => $stt,
                'so_don_hang_id'  => $row['so_don_hang_id'],
                'noi_dung'        => $row['noi_dung_sua_chua'],
                'ngay_sua_chua'   => $row['ngay_sua_chua'],
                'ten_chungloai'   => '',
                'ky_ma_hieu'      => '',
                'bo_phan'         => '',
                'nhan_vien'       => '',
                'tong_gio'        => '',
                'ngay_hoan_thanh' => '',
            ];
        }
    }
}

$so_don_hang = 0; $tong_thiet_bi = 0;
if ($tungay) {
    $sql_stats = "SELECT
                    COUNT(DISTINCT ck_don_hang.so_don_hang_id) AS so_don_hang,
                    COUNT(DISTINCT ck_danhmuc_suachua.thiet_bi_id) AS tong_thiet_bi
                FROM ck_don_hang
                INNER JOIN ck_danhmuc_suachua ON ck_don_hang.id = ck_danhmuc_suachua.id_don_hang
                INNER JOIN ck_chitiet_suachua  ON ck_danhmuc_suachua.sua_chua_id = ck_chitiet_suachua.sua_chua_id
                WHERE ck_danhmuc_suachua.thoi_gian_sua_chua != ''
                AND ck_don_hang.ngay_sua_chua BETWEEN '$tungay_safe' AND '$denngay_safe'
                $baoduong_cond";
    $row_stats     = mysqli_fetch_assoc(mysqli_query($conn, $sql_stats));
    $so_don_hang   = $row_stats['so_don_hang'];
    $tong_thiet_bi = $row_stats['tong_thiet_bi'];
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
<h5 class="mb-3">Liệt Kê Công Tác Bảo Dưỡng, Sửa Chữa, Chuẩn Chỉnh Thiết Bị</h5>
<form action="in_bao_cao.php" class="no-print mb-3">
    <div class="form-row align-items-end">
        <div class="col-auto">
            <label>Từ ngày</label>
            <input type="date" class="form-control form-control-sm" name="tungay" value="<?php echo htmlspecialchars($tungay); ?>">
        </div>
        <div class="col-auto">
            <label>Đến ngày</label>
            <input type="date" class="form-control form-control-sm" name="denngay" value="<?php echo htmlspecialchars($denngay); ?>">
        </div>
        <div class="col-auto">
            <div class="form-check mt-4">
                <input type="checkbox" class="form-check-input" id="baoduong" name="baoduong" value="1" <?php if ($check == 1) echo 'checked'; ?>>
                <label class="form-check-label" for="baoduong">Bảo dưỡng định kỳ</label>
            </div>
        </div>
        <div class="col-auto mt-4">
            <button type="submit" class="btn btn-primary btn-sm">Xem</button>
            <button type="submit" class="btn btn-success btn-sm" formaction="in_excel.php">Xuất Excel</button>
        </div>
    </div>
</form>
<?php if ($tungay && !empty($main)): ?>
<p class="text-center">
    Từ ngày: <strong><?php echo $new_date; ?></strong>
    &mdash;
    Đến ngày: <strong><?php echo $new_date2; ?></strong>
</p>
<div style="overflow-x:auto;">
<table class="table table-bordered table-sm" style="font-size:13px;">
    <thead class="thead-light">
        <tr>
            <th class="text-center">STT</th>
            <th class="text-center">Số đơn hàng</th>
            <th>Chủng loại</th>
            <th>Thiết bị</th>
            <th>Nội dung</th>
            <th class="text-center">Ngày sửa chữa</th>
            <th class="text-center">Ngày hoàn thành</th>
            <th>Nhân viên</th>
            <th class="text-center">Tổng giờ</th>
            <th>Bộ phận</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($main as $r): ?>
        <tr>
            <td class="text-center"><?php echo $r['stt']; ?></td>
            <td class="text-center"><?php echo htmlspecialchars($r['so_don_hang_id']); ?></td>
            <td><?php echo htmlspecialchars($r['ten_chungloai']); ?></td>
            <td><?php echo htmlspecialchars($r['ky_ma_hieu']); ?></td>
            <td><?php echo htmlspecialchars($r['noi_dung']); ?></td>
            <td class="text-center"><?php echo $r['ngay_sua_chua'] ? date('d/m/Y', strtotime($r['ngay_sua_chua'])) : ''; ?></td>
            <td class="text-center"><?php echo $r['ngay_hoan_thanh'] ? date('d/m/Y', strtotime($r['ngay_hoan_thanh'])) : ''; ?></td>
            <td><?php echo htmlspecialchars($r['nhan_vien']); ?></td>
            <td class="text-center"><?php echo $r['tong_gio']; ?></td>
            <td><?php echo htmlspecialchars($r['bo_phan']); ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr class="table-secondary">
            <td colspan="2"><strong>Tổng đơn hàng: <?php echo $so_don_hang; ?></strong></td>
            <td colspan="8"><strong>Tổng thiết bị: <?php echo $tong_thiet_bi; ?></strong></td>
        </tr>
    </tfoot>
</table>
</div>
<div class="no-print mt-2">
    <button onclick="window.print()" class="btn btn-secondary btn-sm">In trang</button>
</div>
<?php elseif ($tungay): ?>
<div class="alert alert-warning">Không có dữ liệu trong khoảng thời gian đã chọn.</div>
<?php endif; ?>
<?php include_once "footer.php"; ?>
