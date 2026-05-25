<?php
namespace PHPMaker2020\projectCoKhi;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(18, "mi_ck_chungloai_thietbi", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "ck_chungloai_thietbilist.php", -1, "", AllowListMenu('{5DCEF576-624A-4686-A415-DE69CC04A397}ck_chungloai_thietbi'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(17, "mi_ck_danhmuc_thietbi", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "ck_danhmuc_thietbilist.php?cmd=resetall", -1, "", AllowListMenu('{5DCEF576-624A-4686-A415-DE69CC04A397}ck_danhmuc_thietbi'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(45, "mi_ck_don_hang", $MenuLanguage->MenuPhrase("45", "MenuText"), $MenuRelativePath . "ck_don_hanglist.php", -1, "", AllowListMenu('{5DCEF576-624A-4686-A415-DE69CC04A397}ck_don_hang'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(19, "mi_ck_danhmuc_suachua", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "ck_danhmuc_suachualist.php?cmd=resetall", -1, "", AllowListMenu('{5DCEF576-624A-4686-A415-DE69CC04A397}ck_danhmuc_suachua'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(24, "mi_nhan_vien", $MenuLanguage->MenuPhrase("24", "MenuText"), $MenuRelativePath . "nhan_vienlist.php", -1, "", AllowListMenu('{5DCEF576-624A-4686-A415-DE69CC04A397}nhan_vien'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(97, "mci_Tra_cứu/In", $MenuLanguage->MenuPhrase("97", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(98, "mci_Báo_cáo_thiết_bị", $MenuLanguage->MenuPhrase("98", "MenuText"), $MenuRelativePath . "in_bao_cao.php", 97, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(99, "mci_In_chấm_công", $MenuLanguage->MenuPhrase("99", "MenuText"), $MenuRelativePath . "in_bao_cao_nv2.php", 97, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(136, "mci_Tra_cứu_nhân_viên_sửa_chữa", $MenuLanguage->MenuPhrase("136", "MenuText"), $MenuRelativePath . "http://diavatly.com/mPdf/export_ck_chitiet_suachua_pdf.php?preview=1", 97, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(22, "mi_userlevels", $MenuLanguage->MenuPhrase("22", "MenuText"), $MenuRelativePath . "userlevelslist.php", -1, "", AllowListMenu('{5DCEF576-624A-4686-A415-DE69CC04A397}userlevels'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(200, "mci_Quan_ly_file", $MenuLanguage->MenuPhrase("200", "MenuText"), "https://diavatly.cloud/gdrive-cokhi", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
$sideMenu->addMenuItem(43, "mci_Hướng_dẫn_sử_dụng", $MenuLanguage->MenuPhrase("43", "MenuText"), $MenuRelativePath . "huongdan.php", -1, "", TRUE, FALSE, TRUE, "", "", FALSE);
echo $sideMenu->toScript();
?>