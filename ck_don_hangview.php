<?php
namespace PHPMaker2020\projectCoKhi;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$ck_don_hang_view = new ck_don_hang_view();

// Run the page
$ck_don_hang_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_don_hang_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ck_don_hang_view->isExport()) { ?>
<script>
var fck_don_hangview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fck_don_hangview = currentForm = new ew.Form("fck_don_hangview", "view");
	loadjs.done("fck_don_hangview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ck_don_hang_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ck_don_hang_view->ExportOptions->render("body") ?>
<?php $ck_don_hang_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ck_don_hang_view->showPageHeader(); ?>
<?php
$ck_don_hang_view->showMessage();
?>
<form name="fck_don_hangview" id="fck_don_hangview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_don_hang">
<input type="hidden" name="modal" value="<?php echo (int)$ck_don_hang_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ck_don_hang_view->so_don_hang_id->Visible) { // so_don_hang_id ?>
	<tr id="r_so_don_hang_id">
		<td class="<?php echo $ck_don_hang_view->TableLeftColumnClass ?>"><span id="elh_ck_don_hang_so_don_hang_id"><?php echo $ck_don_hang_view->so_don_hang_id->caption() ?></span></td>
		<td data-name="so_don_hang_id" <?php echo $ck_don_hang_view->so_don_hang_id->cellAttributes() ?>>
<span id="el_ck_don_hang_so_don_hang_id">
<span<?php echo $ck_don_hang_view->so_don_hang_id->viewAttributes() ?>><?php echo $ck_don_hang_view->so_don_hang_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_don_hang_view->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<tr id="r_ngay_sua_chua">
		<td class="<?php echo $ck_don_hang_view->TableLeftColumnClass ?>"><span id="elh_ck_don_hang_ngay_sua_chua"><?php echo $ck_don_hang_view->ngay_sua_chua->caption() ?></span></td>
		<td data-name="ngay_sua_chua" <?php echo $ck_don_hang_view->ngay_sua_chua->cellAttributes() ?>>
<span id="el_ck_don_hang_ngay_sua_chua">
<span<?php echo $ck_don_hang_view->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_don_hang_view->ngay_sua_chua->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_don_hang_view->chung_loai->Visible) { // chung_loai ?>
	<tr id="r_chung_loai">
		<td class="<?php echo $ck_don_hang_view->TableLeftColumnClass ?>"><span id="elh_ck_don_hang_chung_loai"><?php echo $ck_don_hang_view->chung_loai->caption() ?></span></td>
		<td data-name="chung_loai" <?php echo $ck_don_hang_view->chung_loai->cellAttributes() ?>>
<span id="el_ck_don_hang_chung_loai">
<span<?php echo $ck_don_hang_view->chung_loai->viewAttributes() ?>><?php echo $ck_don_hang_view->chung_loai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_don_hang_view->ten_thiet_bi->Visible) { // ten_thiet_bi ?>
	<tr id="r_ten_thiet_bi">
		<td class="<?php echo $ck_don_hang_view->TableLeftColumnClass ?>"><span id="elh_ck_don_hang_ten_thiet_bi"><?php echo $ck_don_hang_view->ten_thiet_bi->caption() ?></span></td>
		<td data-name="ten_thiet_bi" <?php echo $ck_don_hang_view->ten_thiet_bi->cellAttributes() ?>>
<span id="el_ck_don_hang_ten_thiet_bi">
<span<?php echo $ck_don_hang_view->ten_thiet_bi->viewAttributes() ?>><?php echo $ck_don_hang_view->ten_thiet_bi->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_don_hang_view->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
	<tr id="r_noi_dung_sua_chua">
		<td class="<?php echo $ck_don_hang_view->TableLeftColumnClass ?>"><span id="elh_ck_don_hang_noi_dung_sua_chua"><?php echo $ck_don_hang_view->noi_dung_sua_chua->caption() ?></span></td>
		<td data-name="noi_dung_sua_chua" <?php echo $ck_don_hang_view->noi_dung_sua_chua->cellAttributes() ?>>
<span id="el_ck_don_hang_noi_dung_sua_chua">
<span<?php echo $ck_don_hang_view->noi_dung_sua_chua->viewAttributes() ?>><?php echo $ck_don_hang_view->noi_dung_sua_chua->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_don_hang_view->thoi_gian_sua_chua->Visible) { // thoi_gian_sua_chua ?>
	<tr id="r_thoi_gian_sua_chua">
		<td class="<?php echo $ck_don_hang_view->TableLeftColumnClass ?>"><span id="elh_ck_don_hang_thoi_gian_sua_chua"><?php echo $ck_don_hang_view->thoi_gian_sua_chua->caption() ?></span></td>
		<td data-name="thoi_gian_sua_chua" <?php echo $ck_don_hang_view->thoi_gian_sua_chua->cellAttributes() ?>>
<span id="el_ck_don_hang_thoi_gian_sua_chua">
<span<?php echo $ck_don_hang_view->thoi_gian_sua_chua->viewAttributes() ?>><?php echo $ck_don_hang_view->thoi_gian_sua_chua->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_don_hang_view->nguoi_nhap_lieu->Visible) { // nguoi_nhap_lieu ?>
	<tr id="r_nguoi_nhap_lieu">
		<td class="<?php echo $ck_don_hang_view->TableLeftColumnClass ?>"><span id="elh_ck_don_hang_nguoi_nhap_lieu"><?php echo $ck_don_hang_view->nguoi_nhap_lieu->caption() ?></span></td>
		<td data-name="nguoi_nhap_lieu" <?php echo $ck_don_hang_view->nguoi_nhap_lieu->cellAttributes() ?>>
<span id="el_ck_don_hang_nguoi_nhap_lieu">
<span<?php echo $ck_don_hang_view->nguoi_nhap_lieu->viewAttributes() ?>><?php echo $ck_don_hang_view->nguoi_nhap_lieu->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_don_hang_view->baoduong_dinhky->Visible) { // baoduong_dinhky ?>
	<tr id="r_baoduong_dinhky">
		<td class="<?php echo $ck_don_hang_view->TableLeftColumnClass ?>"><span id="elh_ck_don_hang_baoduong_dinhky"><?php echo $ck_don_hang_view->baoduong_dinhky->caption() ?></span></td>
		<td data-name="baoduong_dinhky" <?php echo $ck_don_hang_view->baoduong_dinhky->cellAttributes() ?>>
<span id="el_ck_don_hang_baoduong_dinhky">
<span<?php echo $ck_don_hang_view->baoduong_dinhky->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_baoduong_dinhky" class="custom-control-input" value="<?php echo $ck_don_hang_view->baoduong_dinhky->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_don_hang_view->baoduong_dinhky->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_baoduong_dinhky"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_don_hang_view->ghi_chu->Visible) { // ghi_chu ?>
	<tr id="r_ghi_chu">
		<td class="<?php echo $ck_don_hang_view->TableLeftColumnClass ?>"><span id="elh_ck_don_hang_ghi_chu"><?php echo $ck_don_hang_view->ghi_chu->caption() ?></span></td>
		<td data-name="ghi_chu" <?php echo $ck_don_hang_view->ghi_chu->cellAttributes() ?>>
<span id="el_ck_don_hang_ghi_chu">
<span<?php echo $ck_don_hang_view->ghi_chu->viewAttributes() ?>><?php echo $ck_don_hang_view->ghi_chu->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("ck_danhmuc_suachua", explode(",", $ck_don_hang->getCurrentDetailTable())) && $ck_danhmuc_suachua->DetailView) {
?>
<?php if ($ck_don_hang->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("ck_danhmuc_suachua", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ck_danhmuc_suachuagrid.php" ?>
<?php } ?>
</form>
<?php
$ck_don_hang_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ck_don_hang_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$ck_don_hang_view->terminate();
?>