<?php
error_reporting(E_ERROR | E_PARSE);
require_once "db.php";
session_start();

if (version_compare(PHP_VERSION, '5.1.0') >= 0) {
    if (ini_get('date.timezone') == '') {
        date_default_timezone_set('UTC');
    }
}

$check = isset($_GET['baoduong']) ? $_GET['baoduong'] : '0';
$thang = isset($_GET['thang']) && preg_match('/^\d{4}-\d{2}$/', $_GET['thang'])
         ? $_GET['thang'] : '';

// Tính ngày đầu/cuối tháng từ YYYY-MM
$tungay  = $thang ? $thang . '-01' : '';
$denngay = $thang ? date('Y-m-t', strtotime($tungay)) : '';
$thang_display = $thang
    ? 'Tháng ' . ltrim(substr($thang, 5, 2), '0') . '/' . substr($thang, 0, 4)
    : '';

// Chuyển YYYY-MM-DD → DD-MM-YYYY để hiển thị
function fmt_date($ymd) {
    if (!$ymd) return '';
    $p = explode('-', $ymd);
    return count($p) === 3 ? $p[2] . '/' . $p[1] . '/' . $p[0] : $ymd;
}

// --- Queries ---
$tungay_safe  = mysqli_real_escape_string($conn, $tungay);
$denngay_safe = mysqli_real_escape_string($conn, $denngay);
$baoduong_cond = ($check == 1) ? " AND baoduong_dinhky = 1" : "";

$main = array();
$stt  = 0;
$so_dv = 1;

if ($tungay && $denngay) {
    $sql = "SELECT ck_don_hang.*, ck_chitiet_suachua.nhan_vien_id
            FROM ck_don_hang
            INNER JOIN ck_danhmuc_suachua ON ck_don_hang.id = ck_danhmuc_suachua.id_don_hang
            INNER JOIN ck_chitiet_suachua  ON ck_danhmuc_suachua.sua_chua_id = ck_chitiet_suachua.sua_chua_id
            WHERE ck_don_hang.ngay_sua_chua BETWEEN '$tungay_safe' AND '$denngay_safe'
            $baoduong_cond
            GROUP BY ck_don_hang.so_don_hang_id
            ORDER BY ck_don_hang.ngay_sua_chua, ck_don_hang.so_don_hang_id";

    if ($result = $conn->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $stt++;
            $so_dv_ct = 1;
            $order = array(
                'stt'            => $stt,
                'so_don_hang_id' => $row['so_don_hang_id'],
                'noi_dung'       => $row['noi_dung_sua_chua'],
                'ngay_sua_chua'  => $row['ngay_sua_chua'],
                'so_dv'          => $so_dv,
                'devices'        => array(),
            );

            $sub_sql = "SELECT ck_danhmuc_thietbi.bo_phan,
                               ck_danhmuc_thietbi.ky_ma_hieu,
                               ck_chungloai_thietbi.ten_chungloai,
                               GROUP_CONCAT(DISTINCT view_nhan_vien.ten_nhan_vien) AS nhan_vien,
                               SUM(ck_view_nhatky.thoi_gian) AS tong_gio,
                               ck_danhmuc_thietbi.thiet_bi_id,
                               ck_view_nhatky.ngay_hoan_thanh,
                               ck_view_nhatky.noi_dung AS noi_dung_thiet_bi
                        FROM ck_view_nhatky
                        INNER JOIN ck_danhmuc_thietbi   ON ck_view_nhatky.thiet_bi_id    = ck_danhmuc_thietbi.thiet_bi_id
                        INNER JOIN ck_chungloai_thietbi ON ck_chungloai_thietbi.chungloai_id = ck_danhmuc_thietbi.chung_loai_id
                        INNER JOIN view_nhan_vien       ON ck_view_nhatky.nhan_vien_id   = view_nhan_vien.nhan_vien_id
                        WHERE ck_view_nhatky.so_don_hang_id = " . (int)$row['so_don_hang_id'] . "
                        GROUP BY ck_view_nhatky.thiet_bi_id, ck_danhmuc_thietbi.thiet_bi_id";

            if ($resultsub = $conn->query($sub_sql)) {
                while ($subrow = mysqli_fetch_assoc($resultsub)) {
                    $order['devices'][] = array(
                        'so_dv_ct'       => $so_dv . '.' . $so_dv_ct,
                        'ten_chungloai'  => $subrow['ten_chungloai'],
                        'ky_ma_hieu'     => $subrow['ky_ma_hieu'],
                        'bo_phan'        => $subrow['bo_phan'],
                        'nhan_vien'      => $subrow['nhan_vien'],
                        'tong_gio'       => $subrow['tong_gio'],
                        'ngay_hoan_thanh'=> $subrow['ngay_hoan_thanh'],
                        'noi_dung'       => $subrow['noi_dung_thiet_bi'],
                    );
                    $so_dv_ct++;
                }
            }
            $so_dv++;
            $main[] = $order;
        }
    }

    // Thống kê
    $sql_stats = "SELECT
                    COUNT(DISTINCT ck_don_hang.so_don_hang_id) AS so_don_hang,
                    COUNT(DISTINCT ck_danhmuc_suachua.thiet_bi_id) AS tong_thiet_bi
                  FROM ck_don_hang
                  INNER JOIN ck_danhmuc_suachua ON ck_don_hang.id = ck_danhmuc_suachua.id_don_hang
                  INNER JOIN ck_chitiet_suachua  ON ck_danhmuc_suachua.sua_chua_id = ck_chitiet_suachua.sua_chua_id
                  WHERE ck_danhmuc_suachua.thoi_gian_sua_chua != ''
                  AND ck_don_hang.ngay_sua_chua BETWEEN '$tungay_safe' AND '$denngay_safe'
                  $baoduong_cond";
    $stats         = mysqli_fetch_assoc(mysqli_query($conn, $sql_stats));
    $so_don_hang   = $stats['so_don_hang'];
    $tong_thiet_bi = $stats['tong_thiet_bi'];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Báo Cáo Nhân Viên – Cơ Khí</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<style>
    .topnav { overflow:hidden; background-color:#28A745; }
    .topnav a { float:left; color:#fff; padding:14px 16px; text-decoration:none; font-size:17px; }
    .topnav a:hover { background-color:#ddd; color:#000; }
    table { font-size:13px; }
    th { background-color:#3eafdb; color:#000; white-space:nowrap; }
    td.no-devices { color:#888; font-style:italic; }
    tr.order-row td { background-color:#f0f8ff; font-weight:600; }
    @media print {
        .no-print { display:none !important; }
        body { margin:5mm; font-size:12px; }
    }
</style>
</head>
<body>

<div class="topnav no-print">
    <a href="/CoKhi/">Home</a>
</div>

<div class="container-fluid" style="padding:20px;">
    <h4>Tra cứu báo cáo nhân viên</h4>

    <form action="in_bao_cao_nv2.php" method="GET" class="no-print mb-3">
        <div class="form-row align-items-end">
            <div class="col-auto">
                <label>Tháng</label>
                <select class="form-control" name="thang">
                    <option value="">-- Chọn tháng --</option>
                    <?php
                    $now_y = (int)date('Y');
                    $now_m = (int)date('m');
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
            </div>
            <div class="col-auto">
                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="baoduong"
                           name="baoduong" value="1"
                           <?php echo ($check == 1) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="baoduong">Bảo dưỡng định kỳ</label>
                </div>
            </div>
            <div class="col-auto mt-4">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                <button type="submit" class="btn btn-success" formaction="in_excel_ns2.php">In Báo Cáo (Excel)</button>
            </div>
        </div>
    </form>

    <?php if ($thang): ?>

    <h5 class="text-center">LIỆT KÊ CÔNG TÁC BẢO DƯỠNG, SỬA CHỮA, CHUẨN CHỈNH THIẾT BỊ</h5>
    <p class="text-center mb-2">
        <strong><?php echo htmlspecialchars($thang_display); ?></strong>
        &nbsp;(<?php echo fmt_date($tungay); ?> &mdash; <?php echo fmt_date($denngay); ?>)
    </p>

    <?php if (empty($main)): ?>
        <div class="alert alert-warning">Không có dữ liệu trong khoảng thời gian đã chọn.</div>
    <?php else: ?>

    <div class="table-responsive">
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Số DV</th>
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
        <?php foreach ($main as $order):
            $device_count = count($order['devices']);
            if ($device_count === 0): ?>
            <tr>
                <td class="text-center"><?php echo $order['stt']; ?></td>
                <td class="text-center"><?php echo $order['so_dv']; ?></td>
                <td class="text-center"><?php echo htmlspecialchars($order['so_don_hang_id']); ?></td>
                <td colspan="7" class="no-devices">— Chưa có thiết bị —</td>
                <td><?php echo htmlspecialchars($order['noi_dung']); ?></td>
                <td class="text-center"><?php echo fmt_date($order['ngay_sua_chua']); ?></td>
            </tr>
            <?php else:
                foreach ($order['devices'] as $i => $dev): ?>
            <tr>
                <?php if ($i === 0): ?>
                <td class="text-center align-middle" rowspan="<?php echo $device_count; ?>"><?php echo $order['stt']; ?></td>
                <td class="text-center align-middle" rowspan="<?php echo $device_count; ?>"><?php echo $order['so_dv']; ?></td>
                <td class="text-center align-middle" rowspan="<?php echo $device_count; ?>"><?php echo htmlspecialchars($order['so_don_hang_id']); ?></td>
                <?php endif; ?>
                <td><?php echo htmlspecialchars($dev['ten_chungloai']); ?></td>
                <td><?php echo htmlspecialchars($dev['ky_ma_hieu']); ?></td>
                <td><?php echo htmlspecialchars($dev['noi_dung'] ?: $order['noi_dung']); ?></td>
                <td class="text-center"><?php echo fmt_date($order['ngay_sua_chua']); ?></td>
                <td class="text-center"><?php echo fmt_date($dev['ngay_hoan_thanh']); ?></td>
                <td><?php echo htmlspecialchars($dev['nhan_vien']); ?></td>
                <td class="text-center"><?php echo $dev['tong_gio']; ?></td>
                <td><?php echo htmlspecialchars($dev['bo_phan']); ?></td>
            </tr>
                <?php endforeach;
            endif;
        endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="table-secondary">
                <td colspan="2"><strong>Tổng đơn hàng: <?php echo $so_don_hang; ?></strong></td>
                <td colspan="9"><strong>Tổng thiết bị: <?php echo $tong_thiet_bi; ?></strong></td>
            </tr>
        </tfoot>
    </table>
    </div>

    <button onclick="window.print()" class="btn btn-secondary btn-sm no-print">In trang</button>

    <?php endif; // empty($main) ?>
    <?php endif; // $thang ?>

</div>
</body>
</html>
