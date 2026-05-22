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
</head>
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

<body>
<div class="topnav">
  <a class="active" href="/CoKhi6/">Home</a>
  
</div>

<div style="padding:20px">
  <h2>Tra cứu</h2>
  
</div>
<!-- MY CODE   ---------------------------------------------------------------   -->
<?php $check = (isset($_GET['baoduong'])) ? $_GET['baoduong'] : ''; ?>

<div class="container">  
    <form action="in_bao_cao_nv.php"> 
        <div class="row">
            
                <div class="input-group mb-3 w-25">
                    <label>Từ ngày</label>
                    <input type="date" class="form-control" name="tungay">
                </div>
           
            
        </div>
       
        <div class="row">
                <div class="input-group mb-3 w-25">
                    <label>Đến ngày</label>
                    <input type="date" class="form-control" name="denngay" >
                </div>
            </div>
            <div class="row">
            <div class="checkbox">
                <label><input type="checkbox" id="baoduong" name="baoduong" value="1" <?php if($check==1)  echo "checked"; else echo ""; ?>>Bảo dưỡng định kỳ</label>
            
            </div>
            
        </div>
        <div class="row">
            <button type="submit" class="btn btn-primary" formaction="in_excel_ns.php">In Báo Cáo</button>
        </div>    
    </form>

<?php
   
    require_once "db.php";
    session_start();
	// Include classes
	include_once('tbs_class.php');

	// prevent from a PHP configuration problem when using mktime() and date()
	if (version_compare(PHP_VERSION,'5.1.0')>=0) {
		if (ini_get('date.timezone')=='') {
			date_default_timezone_set('UTC');
		}
	}
    
    $check = (isset($_GET['baoduong'])) ? $_GET['baoduong'] : '0';

    $tungay = (isset($_GET['tungay'])) ? $_GET['tungay'] : '';
    $tungay = trim(''.$tungay);
	
    $denngay = (isset($_GET['denngay'])) ? $_GET['denngay'] : '';
    $denngay = trim(''.$denngay);

    $old_date=explode('-',$tungay);
    $new_date=$old_date[2].'-'.$old_date[1].'-'.$old_date[0];
	
    $old_date=explode('-',$denngay);
    $new_date2=$old_date[2].'-'.$old_date[1].'-'.$old_date[0];

    $sql="	SELECT ck_don_hang.*, ck_chitiet_suachua.nhan_vien_id
		FROM ck_don_hang INNER JOIN
  		ck_danhmuc_suachua ON ck_don_hang.id = ck_danhmuc_suachua.id_don_hang
  		INNER JOIN
  		ck_chitiet_suachua ON ck_danhmuc_suachua.sua_chua_id =
    	ck_chitiet_suachua.sua_chua_id
		where baoduong_dinhky=".$check." and ck_don_hang.ngay_sua_chua between '".$tungay."' and '".$denngay."'
		Group by ck_don_hang.so_don_hang_id
	";

    $main=array();
    $stt=0;
    $temp=array();
    $sub=array();
    $so_dv=1;

    if ($result = $conn -> query($sql)) {
        while ($row = mysqli_fetch_array($result)) {
            $so_dv_ct=1;
            $main[$stt] = array('stt'=>$stt+1,
                                'noi_dung'=>$row['noi_dung_sua_chua'],
                                'ngay_sua_chua'=>$row['ngay_sua_chua'],
                                'so_don_hang_id'=>$row['so_don_hang_id'],
                                
                                'so_dv'=>$so_dv
                            );
	
            //$sub_sql="SELECT *,SUM(thoi_gian) as tong_gio FROM ck_view_nhatky  WHERE so_don_hang_id=".$row['so_don_hang_id']." Group by thiet_bi_id";
            $sub_sql="SELECT ck_danhmuc_thietbi.bo_phan, ck_danhmuc_thietbi.ky_ma_hieu,
                        ck_chungloai_thietbi.ten_chungloai,
                        Group_Concat(DISTINCT view_nhan_vien.ten_nhan_vien) as nhan_vien, Sum(ck_view_nhatky.thoi_gian) AS
                        tong_gio, ck_view_nhatky.so_don_hang_id, ck_view_nhatky.thoi_gian,
                        ck_view_nhatky.noi_dung, ck_danhmuc_thietbi.thiet_bi_id,
                        ck_view_nhatky.ngay_hoan_thanh
                        FROM ck_view_nhatky INNER JOIN
                        ck_danhmuc_thietbi ON ck_view_nhatky.thiet_bi_id =
                            ck_danhmuc_thietbi.thiet_bi_id INNER JOIN
                        ck_chungloai_thietbi ON ck_chungloai_thietbi.chungloai_id =
                            ck_danhmuc_thietbi.chung_loai_id INNER JOIN
                        view_nhan_vien ON ck_view_nhatky.nhan_vien_id = view_nhan_vien.nhan_vien_id
                        WHERE ck_view_nhatky.so_don_hang_id = ".$row['so_don_hang_id']." 
                        GROUP BY ck_view_nhatky.thiet_bi_id, ck_danhmuc_thietbi.thiet_bi_id";
	  	 
            if ($resultsub = $conn -> query($sub_sql)){
                while($subrow=mysqli_fetch_array($resultsub)){
                    $sub[]=array(//'ngay_sua_chua'=>$subrow['ngay_sua_chua'],
                                'noi_dung'=>$subrow['noi_dung'],
                                'thiet_bi_id'=>$subrow['thiet_bi_id'],
                                'tong_gio'=>$subrow['tong_gio'],
                                'so_dv_ct'=>$so_dv.".".$so_dv_ct,
                                'nhan_vien'=>$subrow['nhan_vien'],
                                'ten_chungloai'=>$subrow['ten_chungloai'],
                                'ky_ma_hieu'=>$subrow['ky_ma_hieu'],
                                'bo_phan'=>$subrow['bo_phan'],
                                'ngay_hoan_thanh'=>$subrow['ngay_hoan_thanh'],
                                'stt'=>$stt+1
                            );
                    $so_dv_ct++;
                }
            }
            $so_dv++;
            $main[$stt]['sub']=$sub;
            $sub=null;
            $stt++;
	    }
    }

    //$sql_so_don_hang="SELECT COUNT(ngay_sua_chua) as `tong`  FROM `ck_don_hang` where ck_don_hang.ngay_sua_chua between '".$new_date."' and '".$new_date2."' ";

    $sql_so_don_hang="SELECT count(DISTINCT ck_don_hang.so_don_hang_id)
    FROM ck_don_hang INNER JOIN
    ck_danhmuc_suachua ON ck_don_hang.id = ck_danhmuc_suachua.id_don_hang
    INNER JOIN
    ck_chitiet_suachua ON ck_danhmuc_suachua.sua_chua_id =
        ck_chitiet_suachua.sua_chua_id
       where baoduong_dinhky=".$check." and ck_don_hang.ngay_sua_chua between '".$tungay."' and '".$denngay."'
        ";
 
    $row = mysqli_fetch_row( mysqli_query($conn,$sql_so_don_hang));
    $so_don_hang=$row[0];

    //$sql_tong_thiet_bi="SELECT COUNT(DISTINCT(thiet_bi_id)) FROM `ck_danhmuc_suachua` WHERE thoi_gian_sua_chua!=''";
    $sql_tong_thiet_bi=	"SELECT Count(DISTINCT thiet_bi_id)
                            FROM ck_danhmuc_suachua INNER JOIN
                            ck_don_hang ON ck_don_hang.id = ck_danhmuc_suachua.id_don_hang
                            WHERE baoduong_dinhky=".$check." and ck_danhmuc_suachua.thoi_gian_sua_chua!=''
                            and ck_don_hang.ngay_sua_chua between '".$tungay."' and '".$denngay."' 
                        ";
         
    $row = mysqli_fetch_row( mysqli_query($conn,$sql_tong_thiet_bi));
    $tong_thiet_bi=$row[0];
    
	$TBS = new clsTinyButStrong; // new instance of TBS
	$TBS->LoadTemplate('in_bao_cao_nv.html');
    $TBS->MergeBlock('main',$main);
    //$TBS->Show();
    ?>
<!-- MY CODE   ---------------------------------------------------------------   -->

   
</div>
	
</body>




	