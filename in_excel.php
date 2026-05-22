<?php

 require_once "db.php";
 session_start();
// Include classes
include_once('tbs_class.php'); // Load the TinyButStrong template engine
include_once('tbs_plugin_opentbs.php'); // Load the OpenTBS plugin

// prevent from a PHP configuration problem when using mktime() and date()
if (version_compare(PHP_VERSION,'5.1.0')>=0) {
	if (ini_get('date.timezone')=='') {
		date_default_timezone_set('UTC');
	}
}

// Initialize the TBS instance
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

// ------------------------------
// Prepare some data for the demo
// ------------------------------

//------------------------------------------------BAO CAO 1 ----------------------------------------
$check = (isset($_GET['baoduong'])) ? $_GET['baoduong'] : '0';

$tungay = (isset($_GET['tungay'])) ? $_GET['tungay'] : '';
$tungay = trim(''.$tungay);

$denngay = (isset($_GET['denngay'])) ? $_GET['denngay'] : '';
$denngay = trim(''.$denngay);


if($check==0)
    {
        $sql="	SELECT ck_don_hang.*, ck_chitiet_suachua.nhan_vien_id
		FROM ck_don_hang INNER JOIN
  		ck_danhmuc_suachua ON ck_don_hang.id = ck_danhmuc_suachua.id_don_hang
  		INNER JOIN
  		ck_chitiet_suachua ON ck_danhmuc_suachua.sua_chua_id =
    	ck_chitiet_suachua.sua_chua_id
		where ck_don_hang.ngay_sua_chua between '".$tungay."' and '".$denngay."'
		Group by ck_don_hang.so_don_hang_id
	    ";
    }
    else{
        $sql="	SELECT ck_don_hang.*, ck_chitiet_suachua.nhan_vien_id
		FROM ck_don_hang INNER JOIN
  		ck_danhmuc_suachua ON ck_don_hang.id = ck_danhmuc_suachua.id_don_hang
  		INNER JOIN
  		ck_chitiet_suachua ON ck_danhmuc_suachua.sua_chua_id =
    	ck_chitiet_suachua.sua_chua_id
		where baoduong_dinhky=".$check." and ck_don_hang.ngay_sua_chua between '".$tungay."' and '".$denngay."'
		Group by ck_don_hang.so_don_hang_id
	    ";
    }


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

if($check==0){
	$sql_so_don_hang="SELECT count(DISTINCT ck_don_hang.so_don_hang_id)
						FROM ck_don_hang INNER JOIN
						ck_danhmuc_suachua ON ck_don_hang.id = ck_danhmuc_suachua.id_don_hang
						INNER JOIN
						ck_chitiet_suachua ON ck_danhmuc_suachua.sua_chua_id =
							ck_chitiet_suachua.sua_chua_id
						where ck_don_hang.ngay_sua_chua between '".$tungay."' and '".$denngay."'
							";
}
else{
	$sql_so_don_hang="SELECT count(DISTINCT ck_don_hang.so_don_hang_id)
						FROM ck_don_hang INNER JOIN
						ck_danhmuc_suachua ON ck_don_hang.id = ck_danhmuc_suachua.id_don_hang
						INNER JOIN
						ck_chitiet_suachua ON ck_danhmuc_suachua.sua_chua_id =
							ck_chitiet_suachua.sua_chua_id
						where baoduong_dinhky=".$check." and ck_don_hang.ngay_sua_chua between '".$tungay."' and '".$denngay."'
							";
}




$row = mysqli_fetch_row( mysqli_query($conn,$sql_so_don_hang));
$so_don_hang=$row[0];

if($check==0){
	$sql_tong_thiet_bi=	"SELECT Count(DISTINCT thiet_bi_id)
								FROM ck_danhmuc_suachua INNER JOIN
								ck_don_hang ON ck_don_hang.id = ck_danhmuc_suachua.id_don_hang
								WHERE ck_danhmuc_suachua.thoi_gian_sua_chua!=''
								and ck_don_hang.ngay_sua_chua between '".$tungay."' and '".$denngay."' 
							";
}
else{
	$sql_tong_thiet_bi=	"SELECT Count(DISTINCT thiet_bi_id)
								FROM ck_danhmuc_suachua INNER JOIN
								ck_don_hang ON ck_don_hang.id = ck_danhmuc_suachua.id_don_hang
								WHERE baoduong_dinhky=".$check." and ck_danhmuc_suachua.thoi_gian_sua_chua!=''
								and ck_don_hang.ngay_sua_chua between '".$tungay."' and '".$denngay."' 
							";
}

$row = mysqli_fetch_row( mysqli_query($conn,$sql_tong_thiet_bi));
$tong_thiet_bi=$row[0];

// -----------------
// Load the template
// -----------------

$template = 'BaoCaoNCK-CV.xlsx';

//$template='in_word4.docx';
$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).

// ----------------------
// Debug mode of the demo
// ----------------------
if (isset($_POST['debug']) && ($_POST['debug']=='current')) $TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT, true); // Display the intented XML of the current sub-file, and exit.
if (isset($_POST['debug']) && ($_POST['debug']=='info'))    $TBS->Plugin(OPENTBS_DEBUG_INFO, true); // Display information about the document, and exit.
if (isset($_POST['debug']) && ($_POST['debug']=='show'))    $TBS->Plugin(OPENTBS_DEBUG_XML_SHOW); // Tells TBS to display information when the document is merged. No exit.

// --------------------------------------------
// Merging and other operations on the template
// --------------------------------------------

$TBS->PlugIn(OPENTBS_SELECT_SHEET, "Sheet2");
$TBS->MergeBlock('main',$main);




// -----------------
// Output the result
// -----------------

// Define the name of the output file
$save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
$output_file_name = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $template);
if ($save_as==='') {
	// Output the result as a downloadable file (only streaming, no data saved in the server)
	$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
	exit();
} else {
	// Output the result as a file on the server.
	$TBS->Show(OPENTBS_FILE, $output_file_name); // Also merges all [onshow] automatic fields.
	// The script can continue.
	exit("File [$output_file_name] has been created.");
}
