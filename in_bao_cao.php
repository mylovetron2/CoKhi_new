<?php

error_reporting (E_ERROR | E_PARSE);
?>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cơ Khí</title>
<meta charset="utf-8">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>




<style>   
	.search {
			float: left;
			margin:30px;
			
	}
    .topnav {
        overflow: hidden;
        background-color: #28A745;
    }

    .topnav a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .topnav a:hover {
        background-color: #ddd;
        color: black;
    }

    .topnav a.active {
       
        color: white;
    }
</style>


</head>

<body>

<!-- MY CODE   ---------------------------------------------------------------   -->
<?php $check = (isset($_GET['baoduong'])) ? $_GET['baoduong'] : '0';

$tungay = (isset($_GET['tungay'])) ? $_GET['tungay'] : '';
$tungay = trim(''.$tungay);

$denngay = (isset($_GET['denngay'])) ? $_GET['denngay'] : '';
$denngay = trim(''.$denngay);

$old_date=explode('-',$tungay);
$new_date=$old_date[2].'-'.$old_date[1].'-'.$old_date[0];

$old_date=explode('-',$denngay);
$new_date2=$old_date[2].'-'.$old_date[1].'-'.$old_date[0];

?>
<div class="topnav">
  <a class="active" href="/CoKhi/">Home</a>
  
</div>

<div style="padding:20px">
  <h2>Tra cứu</h2>
  
</div>

<div class="container">  
    
    <form action="in_bao_cao.php"> 
        <div class="row">
            <div class="col">
                
                    <label>Từ ngày</label>
                    <input type="date" class="form-control" name="tungay" value=<?php echo $tungay ?>>           
            </div>
            <div class="col">
                
                    <label>Đến ngày</label>
                    <input type="date" class="form-control" name="denngay" value=<?php echo $denngay ?> >
            </div>
                   
            <div class="col">
                
                <label>Bảo dưỡng định kỳ</label><br>
                
                <input type="checkbox" id="baoduong" name="baoduong" value="1" <?php if($check==1)  echo "checked"; else echo ""; ?>>
            
               
            
            </div>
        </div>
        <div class="row">
            <br>
        </div>
        <div class="row">
            <button type="submit" class="col-md-1  btn btn-primary" style="margin: 5px" >Search</button>
            <button type="submit" class="col-md-1  btn btn-primary" style="margin: 5px" formaction="in_excel.php">In Báo Cáo</button>
        </div>    
    </form>

<?php
    require_once "db.php";
    session_start();
    include_once('tbs_class.php');

    if (version_compare(PHP_VERSION,'5.1.0')>=0) {
        if (ini_get('date.timezone')=='') {
            date_default_timezone_set('UTC');
        }
    }

    $tungay_safe  = mysqli_real_escape_string($conn, $tungay);
    $denngay_safe = mysqli_real_escape_string($conn, $denngay);
    $baoduong_cond = ($check == 1) ? " AND baoduong_dinhky = 1" : "";

    // Query lấy danh sách đơn hàng (giữ nguyên logic gốc đã hoạt động)
    $sql = "SELECT ck_don_hang.*, ck_chitiet_suachua.nhan_vien_id
            FROM ck_don_hang
            INNER JOIN ck_danhmuc_suachua ON ck_don_hang.id = ck_danhmuc_suachua.id_don_hang
            INNER JOIN ck_chitiet_suachua  ON ck_danhmuc_suachua.sua_chua_id = ck_chitiet_suachua.sua_chua_id
            WHERE ck_don_hang.ngay_sua_chua BETWEEN '$tungay_safe' AND '$denngay_safe'
            $baoduong_cond
            GROUP BY ck_don_hang.so_don_hang_id
            ORDER BY ck_don_hang.ngay_sua_chua, ck_don_hang.so_don_hang_id";

    $main = array();
    $stt  = 0;

    if ($result = $conn->query($sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $dh_id = $row['so_don_hang_id'];

            // Dùng đúng query như in_excel.php (ck_view_nhatky + view_nhan_vien hoạt động)
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
                    $main[] = array(
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
                    );
                    $sub_count++;
                }
            }
            // Fallback: sub-query lỗi hoặc không có thiết bị → vẫn hiện đơn hàng
            if ($sub_count == 0) {
                $stt++;
                $main[] = array(
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
                );
            }
        }
    }

    // Thống kê tổng đơn hàng và tổng thiết bị
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
?>

<h3 class="text-center" style="margin-top:20px;">LIỆT KÊ CÔNG TÁC BẢO DƯỠNG, SỬA CHỮA, CHUẨN CHỈNH THIẾT BỊ</h3>
<p class="text-center">
    Từ ngày: <strong><?php echo $new_date; ?></strong>
    &nbsp;&mdash;&nbsp;
    Đến ngày: <strong><?php echo $new_date2; ?></strong>
</p>

<?php if (empty($main)): ?>
    <div class="alert alert-warning">Không có dữ liệu trong khoảng thời gian đã chọn.</div>
<?php else: ?>
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
<?php endif; ?>

<br>
<button onclick="window.print()" class="btn btn-secondary btn-sm">In trang</button>

</div>

</body>
</html>