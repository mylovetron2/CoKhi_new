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


$main3=array();
$main1=array();
$main2=array();
$stt=0;
$temp=array();
$sub=array();
$so_dv=1;

//--------------------------------------------------------------BAO CAO 2 ----------------------------------

//---------------------thang 1 -------------------------------------------------------------------------
$sql_main="SELECT view_nhan_vien.danh_so as danh_so, view_nhan_vien.ten_nhan_vien as ten_nhan_vien
            FROM ck_chitiet_suachua
            INNER JOIN view_nhan_vien ON ck_chitiet_suachua.nhan_vien_id =view_nhan_vien.nhan_vien_id
            Where Date_Format(ck_chitiet_suachua.ngay_sua_chua, '%m-%Y') = '01-2025'
            GRoup by view_nhan_vien.danh_so";
$stt=0;
$test="test";

if ($result = $conn -> query($sql_main)) {
	while ($row = mysqli_fetch_array($result)) {
		$main1[$stt] = array('stt'=>$stt+1,
						    'danh_so'=>$row['danh_so'],
							'ten_nhan_vien'=>$row['ten_nhan_vien']							
						   );
    
        for($i=1;$i<=31;$i++){  
            if($i<10)
                $temp="0".$i;
            else    
                $temp=$i;
            $sub_sql="SELECT view_nhan_vien.danh_so AS danh_so, view_nhan_vien.ten_nhan_vien,
                        ck_chitiet_suachua.noi_dung, ck_chitiet_suachua.ngay_sua_chua,
                        SUM(ck_chitiet_suachua.thoi_gian) as `".$i."` 
                        FROM ck_chitiet_suachua INNER JOIN
                        view_nhan_vien ON ck_chitiet_suachua.nhan_vien_id =
                        view_nhan_vien.nhan_vien_id
                        WHERE Date_Format(ck_chitiet_suachua.ngay_sua_chua, '%m-%d-%Y') = '01-".$temp."-2025' and view_nhan_vien.danh_so='".$row['danh_so']."'
                    ";
            if ($resultsub = $conn -> query($sub_sql)){
                while($subrow=mysqli_fetch_array($resultsub)){
                        $main1[$stt]+=[$i=>$subrow[$i]];					
                            

                }
            }
        }    
		$stt++;
	}

}
// ------------------------------------------------------------------------------------------------------------------




//---------------------thang 2 -------------------------------------------------------------------------
$sql_main="SELECT view_nhan_vien.danh_so as danh_so, view_nhan_vien.ten_nhan_vien as ten_nhan_vien
            FROM ck_chitiet_suachua
            INNER JOIN view_nhan_vien ON ck_chitiet_suachua.nhan_vien_id =view_nhan_vien.nhan_vien_id
            Where Date_Format(ck_chitiet_suachua.ngay_sua_chua, '%m-%Y') = '02-2025'
            GRoup by view_nhan_vien.danh_so";
$stt=0;
$test="test";

if ($result = $conn -> query($sql_main)) {
	while ($row = mysqli_fetch_array($result)) {
		$main2[$stt] = array('stt'=>$stt+1,
						    'danh_so'=>$row['danh_so'],
							'ten_nhan_vien'=>$row['ten_nhan_vien']							
						   );
    
        for($i=1;$i<=28;$i++){  
            if($i<10)
                $temp="0".$i;
            else    
                $temp=$i;
            $sub_sql="SELECT view_nhan_vien.danh_so AS danh_so, view_nhan_vien.ten_nhan_vien,
                        ck_chitiet_suachua.noi_dung, ck_chitiet_suachua.ngay_sua_chua,
                        SUM(ck_chitiet_suachua.thoi_gian) as `".$i."` 
                        FROM ck_chitiet_suachua INNER JOIN
                        view_nhan_vien ON ck_chitiet_suachua.nhan_vien_id =
                        view_nhan_vien.nhan_vien_id
                        WHERE Date_Format(ck_chitiet_suachua.ngay_sua_chua, '%m-%d-%Y') = '02-".$temp."-2025' and view_nhan_vien.danh_so='".$row['danh_so']."'
                    ";
            if ($resultsub = $conn -> query($sub_sql)){
                while($subrow=mysqli_fetch_array($resultsub)){
                        $main2[$stt]+=[$i=>$subrow[$i]];					
                            

                }
            }
        }    
		$stt++;
	}

}
// ------------------------------------------------------------------------------------------------------------------
//---------------------thang 3 -------------------------------------------------------------------------
$sql_main="SELECT view_nhan_vien.danh_so as danh_so, view_nhan_vien.ten_nhan_vien as ten_nhan_vien
            FROM ck_chitiet_suachua
            INNER JOIN view_nhan_vien ON ck_chitiet_suachua.nhan_vien_id =view_nhan_vien.nhan_vien_id
            Where Date_Format(ck_chitiet_suachua.ngay_sua_chua, '%m-%Y') = '03-2025'
            GRoup by view_nhan_vien.danh_so";
$stt=0;
$test="test";

if ($result = $conn -> query($sql_main)) {
	while ($row = mysqli_fetch_array($result)) {
		$main3[$stt] = array('stt'=>$stt+1,
						    'danh_so'=>$row['danh_so'],
							'ten_nhan_vien'=>$row['ten_nhan_vien']							
						   );
    
        for($i=1;$i<=31;$i++){  
            if($i<10)
                $temp="0".$i;
            else    
                $temp=$i;
            $sub_sql="SELECT view_nhan_vien.danh_so AS danh_so, view_nhan_vien.ten_nhan_vien,
                        ck_chitiet_suachua.noi_dung, ck_chitiet_suachua.ngay_sua_chua,
                        SUM(ck_chitiet_suachua.thoi_gian) as `".$i."` 
                        FROM ck_chitiet_suachua INNER JOIN
                        view_nhan_vien ON ck_chitiet_suachua.nhan_vien_id =
                        view_nhan_vien.nhan_vien_id
                        WHERE Date_Format(ck_chitiet_suachua.ngay_sua_chua, '%m-%d-%Y') = '03-".$temp."-2025' and view_nhan_vien.danh_so='".$row['danh_so']."'
                    ";
            if ($resultsub = $conn -> query($sub_sql)){
                while($subrow=mysqli_fetch_array($resultsub)){
                        $main3[$stt]+=[$i=>$subrow[$i]];					
                            

                }
            }
        }    
		$stt++;
	}

}
// ------------------------------------------------------------------------------------------------------------------
//---------------------thang 10 -------------------------------------------------------------------------
$sql_main="SELECT view_nhan_vien.danh_so as danh_so, view_nhan_vien.ten_nhan_vien as ten_nhan_vien
            FROM ck_chitiet_suachua
            INNER JOIN view_nhan_vien ON ck_chitiet_suachua.nhan_vien_id =view_nhan_vien.nhan_vien_id
            Where Date_Format(ck_chitiet_suachua.ngay_sua_chua, '%m-%Y') = '10-2024'
            GRoup by view_nhan_vien.danh_so";
$stt=0;
$test="test";

if ($result = $conn -> query($sql_main)) {
	while ($row = mysqli_fetch_array($result)) {
		$main[$stt] = array('stt'=>$stt+1,
						    'danh_so'=>$row['danh_so'],
							'ten_nhan_vien'=>$row['ten_nhan_vien']							
						   );
    
        for($i=1;$i<=31;$i++){  
            if($i<10)
                $temp="0".$i;
            else    
                $temp=$i;
            $sub_sql="SELECT view_nhan_vien.danh_so AS danh_so, view_nhan_vien.ten_nhan_vien,
                        ck_chitiet_suachua.noi_dung, ck_chitiet_suachua.ngay_sua_chua,
                        SUM(ck_chitiet_suachua.thoi_gian) as `".$i."` 
                        FROM ck_chitiet_suachua INNER JOIN
                        view_nhan_vien ON ck_chitiet_suachua.nhan_vien_id =
                        view_nhan_vien.nhan_vien_id
                        WHERE Date_Format(ck_chitiet_suachua.ngay_sua_chua, '%m-%d-%Y') = '10-".$temp."-2024' and view_nhan_vien.danh_so='".$row['danh_so']."'
                    ";
            if ($resultsub = $conn -> query($sub_sql)){
                while($subrow=mysqli_fetch_array($resultsub)){
                        $main[$stt]+=[$i=>$subrow[$i]];					
                            

                }
            }
        }    
		$stt++;
	}

}
// ------------------------------------------------------------------------------------------------------------------
// thang 11 --------------------------------------------------------------------------------------------------
$sql_main="SELECT view_nhan_vien.danh_so as danh_so, view_nhan_vien.ten_nhan_vien as ten_nhan_vien
            FROM ck_chitiet_suachua
            INNER JOIN view_nhan_vien ON ck_chitiet_suachua.nhan_vien_id =view_nhan_vien.nhan_vien_id
            Where Date_Format(ck_chitiet_suachua.ngay_sua_chua, '%m-%Y') = '11-2024'
            GRoup by view_nhan_vien.danh_so";
$stt=0;
$test="test";

if ($result = $conn -> query($sql_main)) {
	while ($row = mysqli_fetch_array($result)) {
		$main11[$stt] = array('stt'=>$stt+1,
						    'danh_so'=>$row['danh_so'],
							'ten_nhan_vien'=>$row['ten_nhan_vien']							
						   );
    
        for($i=1;$i<=31;$i++){  
            if($i<10)
                $temp="0".$i;
            else    
                $temp=$i;
            $sub_sql="SELECT view_nhan_vien.danh_so AS danh_so, view_nhan_vien.ten_nhan_vien,
                        ck_chitiet_suachua.noi_dung, ck_chitiet_suachua.ngay_sua_chua,
                        SUM(ck_chitiet_suachua.thoi_gian) as `".$i."` 
                        FROM ck_chitiet_suachua INNER JOIN
                        view_nhan_vien ON ck_chitiet_suachua.nhan_vien_id =
                        view_nhan_vien.nhan_vien_id
                        WHERE Date_Format(ck_chitiet_suachua.ngay_sua_chua, '%m-%d-%Y') = '11-".$temp."-2024' and view_nhan_vien.danh_so='".$row['danh_so']."'
                    ";
            if ($resultsub = $conn -> query($sub_sql)){
                while($subrow=mysqli_fetch_array($resultsub)){
                        $main11[$stt]+=[$i=>$subrow[$i]];					
                            

                }
            }
        }    
		$stt++;
	}

}
// ------------------------------------------------------------------------------------------------------------------
//---------------------thang 12 -------------------------------------------------------------------------
$sql_main="SELECT view_nhan_vien.danh_so as danh_so, view_nhan_vien.ten_nhan_vien as ten_nhan_vien
            FROM ck_chitiet_suachua
            INNER JOIN view_nhan_vien ON ck_chitiet_suachua.nhan_vien_id =view_nhan_vien.nhan_vien_id
            Where Date_Format(ck_chitiet_suachua.ngay_sua_chua, '%m-%Y') = '12-2024'
            GRoup by view_nhan_vien.danh_so";
$stt=0;
$test="test";

if ($result = $conn -> query($sql_main)) {
	while ($row = mysqli_fetch_array($result)) {
		$main12[$stt] = array('stt'=>$stt+1,
						    'danh_so'=>$row['danh_so'],
							'ten_nhan_vien'=>$row['ten_nhan_vien']							
						   );
    
        for($i=1;$i<=31;$i++){  
            if($i<10)
                $temp="0".$i;
            else    
                $temp=$i;
            $sub_sql="SELECT view_nhan_vien.danh_so AS danh_so, view_nhan_vien.ten_nhan_vien,
                        ck_chitiet_suachua.noi_dung, ck_chitiet_suachua.ngay_sua_chua,
                        SUM(ck_chitiet_suachua.thoi_gian) as `".$i."` 
                        FROM ck_chitiet_suachua INNER JOIN
                        view_nhan_vien ON ck_chitiet_suachua.nhan_vien_id =
                        view_nhan_vien.nhan_vien_id
                        WHERE Date_Format(ck_chitiet_suachua.ngay_sua_chua, '%m-%d-%Y') = '12-".$temp."-2024' and view_nhan_vien.danh_so='".$row['danh_so']."'
                    ";
            if ($resultsub = $conn -> query($sub_sql)){
                while($subrow=mysqli_fetch_array($resultsub)){
                        $main12[$stt]+=[$i=>$subrow[$i]];					
                            

                }
            }
        }    
		$stt++;
	}

}
// ------------------------------------------------------------------------------------------------------------------








// -----------------
// Load the template
// -----------------

$template = 'BaoCaoNCK-NS.xlsx';
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

if($main3!=null){
    $TBS->PlugIn(OPENTBS_SELECT_SHEET, "Thang3");
    $TBS->MergeBlock('main3',$main3);
}

if($main2!=null)
{
    $TBS->PlugIn(OPENTBS_SELECT_SHEET, "Thang2");
    $TBS->MergeBlock('main2',$main2);
}
if($main1!=null)
{
    $TBS->PlugIn(OPENTBS_SELECT_SHEET, "Thang1");
    $TBS->MergeBlock('main1',$main1);
}

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
