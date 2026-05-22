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
$ck_chitiet_suachua_view = new ck_chitiet_suachua_view();

// Run the page
$ck_chitiet_suachua_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_chitiet_suachua_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ck_chitiet_suachua_view->isExport()) { ?>
<script>
var fck_chitiet_suachuaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fck_chitiet_suachuaview = currentForm = new ew.Form("fck_chitiet_suachuaview", "view");
	loadjs.done("fck_chitiet_suachuaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ck_chitiet_suachua_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ck_chitiet_suachua_view->ExportOptions->render("body") ?>
<?php $ck_chitiet_suachua_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ck_chitiet_suachua_view->showPageHeader(); ?>
<?php
$ck_chitiet_suachua_view->showMessage();
?>
<form name="fck_chitiet_suachuaview" id="fck_chitiet_suachuaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_chitiet_suachua">
<input type="hidden" name="modal" value="<?php echo (int)$ck_chitiet_suachua_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ck_chitiet_suachua_view->nhan_vien_id->Visible) { // nhan_vien_id ?>
	<tr id="r_nhan_vien_id">
		<td class="<?php echo $ck_chitiet_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_chitiet_suachua_nhan_vien_id"><?php echo $ck_chitiet_suachua_view->nhan_vien_id->caption() ?></span></td>
		<td data-name="nhan_vien_id" <?php echo $ck_chitiet_suachua_view->nhan_vien_id->cellAttributes() ?>>
<span id="el_ck_chitiet_suachua_nhan_vien_id">
<span<?php echo $ck_chitiet_suachua_view->nhan_vien_id->viewAttributes() ?>><?php echo $ck_chitiet_suachua_view->nhan_vien_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_chitiet_suachua_view->chuc_danh->Visible) { // chuc_danh ?>
	<tr id="r_chuc_danh">
		<td class="<?php echo $ck_chitiet_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_chitiet_suachua_chuc_danh"><?php echo $ck_chitiet_suachua_view->chuc_danh->caption() ?></span></td>
		<td data-name="chuc_danh" <?php echo $ck_chitiet_suachua_view->chuc_danh->cellAttributes() ?>>
<span id="el_ck_chitiet_suachua_chuc_danh">
<span<?php echo $ck_chitiet_suachua_view->chuc_danh->viewAttributes() ?>><?php echo $ck_chitiet_suachua_view->chuc_danh->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_chitiet_suachua_view->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<tr id="r_ngay_sua_chua">
		<td class="<?php echo $ck_chitiet_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_chitiet_suachua_ngay_sua_chua"><?php echo $ck_chitiet_suachua_view->ngay_sua_chua->caption() ?></span></td>
		<td data-name="ngay_sua_chua" <?php echo $ck_chitiet_suachua_view->ngay_sua_chua->cellAttributes() ?>>
<span id="el_ck_chitiet_suachua_ngay_sua_chua">
<span<?php echo $ck_chitiet_suachua_view->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_chitiet_suachua_view->ngay_sua_chua->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_chitiet_suachua_view->thoi_gian->Visible) { // thoi_gian ?>
	<tr id="r_thoi_gian">
		<td class="<?php echo $ck_chitiet_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_chitiet_suachua_thoi_gian"><?php echo $ck_chitiet_suachua_view->thoi_gian->caption() ?></span></td>
		<td data-name="thoi_gian" <?php echo $ck_chitiet_suachua_view->thoi_gian->cellAttributes() ?>>
<span id="el_ck_chitiet_suachua_thoi_gian">
<span<?php echo $ck_chitiet_suachua_view->thoi_gian->viewAttributes() ?>><?php echo $ck_chitiet_suachua_view->thoi_gian->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_chitiet_suachua_view->noi_dung->Visible) { // noi_dung ?>
	<tr id="r_noi_dung">
		<td class="<?php echo $ck_chitiet_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_chitiet_suachua_noi_dung"><?php echo $ck_chitiet_suachua_view->noi_dung->caption() ?></span></td>
		<td data-name="noi_dung" <?php echo $ck_chitiet_suachua_view->noi_dung->cellAttributes() ?>>
<span id="el_ck_chitiet_suachua_noi_dung">
<span<?php echo $ck_chitiet_suachua_view->noi_dung->viewAttributes() ?>><?php echo $ck_chitiet_suachua_view->noi_dung->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$ck_chitiet_suachua_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ck_chitiet_suachua_view->isExport()) { ?>
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
$ck_chitiet_suachua_view->terminate();
?>