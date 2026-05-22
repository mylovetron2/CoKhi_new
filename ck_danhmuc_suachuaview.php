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
$ck_danhmuc_suachua_view = new ck_danhmuc_suachua_view();

// Run the page
$ck_danhmuc_suachua_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_danhmuc_suachua_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ck_danhmuc_suachua_view->isExport()) { ?>
<script>
var fck_danhmuc_suachuaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fck_danhmuc_suachuaview = currentForm = new ew.Form("fck_danhmuc_suachuaview", "view");
	loadjs.done("fck_danhmuc_suachuaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ck_danhmuc_suachua_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ck_danhmuc_suachua_view->ExportOptions->render("body") ?>
<?php $ck_danhmuc_suachua_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ck_danhmuc_suachua_view->showPageHeader(); ?>
<?php
$ck_danhmuc_suachua_view->showMessage();
?>
<form name="fck_danhmuc_suachuaview" id="fck_danhmuc_suachuaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_danhmuc_suachua">
<input type="hidden" name="modal" value="<?php echo (int)$ck_danhmuc_suachua_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ck_danhmuc_suachua_view->chuanloai_id->Visible) { // chuanloai_id ?>
	<tr id="r_chuanloai_id">
		<td class="<?php echo $ck_danhmuc_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_danhmuc_suachua_chuanloai_id"><?php echo $ck_danhmuc_suachua_view->chuanloai_id->caption() ?></span></td>
		<td data-name="chuanloai_id" <?php echo $ck_danhmuc_suachua_view->chuanloai_id->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_chuanloai_id">
<span<?php echo $ck_danhmuc_suachua_view->chuanloai_id->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_view->chuanloai_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua_view->thiet_bi_id->Visible) { // thiet_bi_id ?>
	<tr id="r_thiet_bi_id">
		<td class="<?php echo $ck_danhmuc_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_danhmuc_suachua_thiet_bi_id"><?php echo $ck_danhmuc_suachua_view->thiet_bi_id->caption() ?></span></td>
		<td data-name="thiet_bi_id" <?php echo $ck_danhmuc_suachua_view->thiet_bi_id->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_thiet_bi_id">
<span<?php echo $ck_danhmuc_suachua_view->thiet_bi_id->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_view->thiet_bi_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua_view->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<tr id="r_ngay_sua_chua">
		<td class="<?php echo $ck_danhmuc_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_danhmuc_suachua_ngay_sua_chua"><?php echo $ck_danhmuc_suachua_view->ngay_sua_chua->caption() ?></span></td>
		<td data-name="ngay_sua_chua" <?php echo $ck_danhmuc_suachua_view->ngay_sua_chua->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_ngay_sua_chua">
<span<?php echo $ck_danhmuc_suachua_view->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_view->ngay_sua_chua->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua_view->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
	<tr id="r_noi_dung_sua_chua">
		<td class="<?php echo $ck_danhmuc_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_danhmuc_suachua_noi_dung_sua_chua"><?php echo $ck_danhmuc_suachua_view->noi_dung_sua_chua->caption() ?></span></td>
		<td data-name="noi_dung_sua_chua" <?php echo $ck_danhmuc_suachua_view->noi_dung_sua_chua->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_noi_dung_sua_chua">
<span<?php echo $ck_danhmuc_suachua_view->noi_dung_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_view->noi_dung_sua_chua->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua_view->thoi_gian_sua_chua->Visible) { // thoi_gian_sua_chua ?>
	<tr id="r_thoi_gian_sua_chua">
		<td class="<?php echo $ck_danhmuc_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_danhmuc_suachua_thoi_gian_sua_chua"><?php echo $ck_danhmuc_suachua_view->thoi_gian_sua_chua->caption() ?></span></td>
		<td data-name="thoi_gian_sua_chua" <?php echo $ck_danhmuc_suachua_view->thoi_gian_sua_chua->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_thoi_gian_sua_chua">
<span<?php echo $ck_danhmuc_suachua_view->thoi_gian_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_view->thoi_gian_sua_chua->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua_view->nguoi_nhap_lieu->Visible) { // nguoi_nhap_lieu ?>
	<tr id="r_nguoi_nhap_lieu">
		<td class="<?php echo $ck_danhmuc_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_danhmuc_suachua_nguoi_nhap_lieu"><?php echo $ck_danhmuc_suachua_view->nguoi_nhap_lieu->caption() ?></span></td>
		<td data-name="nguoi_nhap_lieu" <?php echo $ck_danhmuc_suachua_view->nguoi_nhap_lieu->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_nguoi_nhap_lieu">
<span<?php echo $ck_danhmuc_suachua_view->nguoi_nhap_lieu->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_view->nguoi_nhap_lieu->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua_view->dich_vu->Visible) { // dich_vu ?>
	<tr id="r_dich_vu">
		<td class="<?php echo $ck_danhmuc_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_danhmuc_suachua_dich_vu"><?php echo $ck_danhmuc_suachua_view->dich_vu->caption() ?></span></td>
		<td data-name="dich_vu" <?php echo $ck_danhmuc_suachua_view->dich_vu->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_dich_vu">
<span<?php echo $ck_danhmuc_suachua_view->dich_vu->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_dich_vu" class="custom-control-input" value="<?php echo $ck_danhmuc_suachua_view->dich_vu->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_danhmuc_suachua_view->dich_vu->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_dich_vu"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua_view->hoan_thanh->Visible) { // hoan_thanh ?>
	<tr id="r_hoan_thanh">
		<td class="<?php echo $ck_danhmuc_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_danhmuc_suachua_hoan_thanh"><?php echo $ck_danhmuc_suachua_view->hoan_thanh->caption() ?></span></td>
		<td data-name="hoan_thanh" <?php echo $ck_danhmuc_suachua_view->hoan_thanh->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_hoan_thanh">
<span<?php echo $ck_danhmuc_suachua_view->hoan_thanh->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_hoan_thanh" class="custom-control-input" value="<?php echo $ck_danhmuc_suachua_view->hoan_thanh->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_danhmuc_suachua_view->hoan_thanh->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_hoan_thanh"></label></div></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua_view->ghi_chu->Visible) { // ghi_chu ?>
	<tr id="r_ghi_chu">
		<td class="<?php echo $ck_danhmuc_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_danhmuc_suachua_ghi_chu"><?php echo $ck_danhmuc_suachua_view->ghi_chu->caption() ?></span></td>
		<td data-name="ghi_chu" <?php echo $ck_danhmuc_suachua_view->ghi_chu->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_ghi_chu">
<span<?php echo $ck_danhmuc_suachua_view->ghi_chu->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_view->ghi_chu->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua_view->id_don_hang->Visible) { // id_don_hang ?>
	<tr id="r_id_don_hang">
		<td class="<?php echo $ck_danhmuc_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_danhmuc_suachua_id_don_hang"><?php echo $ck_danhmuc_suachua_view->id_don_hang->caption() ?></span></td>
		<td data-name="id_don_hang" <?php echo $ck_danhmuc_suachua_view->id_don_hang->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_id_don_hang">
<span<?php echo $ck_danhmuc_suachua_view->id_don_hang->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_view->id_don_hang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua_view->ngay_hoan_thanh->Visible) { // ngay_hoan_thanh ?>
	<tr id="r_ngay_hoan_thanh">
		<td class="<?php echo $ck_danhmuc_suachua_view->TableLeftColumnClass ?>"><span id="elh_ck_danhmuc_suachua_ngay_hoan_thanh"><?php echo $ck_danhmuc_suachua_view->ngay_hoan_thanh->caption() ?></span></td>
		<td data-name="ngay_hoan_thanh" <?php echo $ck_danhmuc_suachua_view->ngay_hoan_thanh->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_ngay_hoan_thanh">
<span<?php echo $ck_danhmuc_suachua_view->ngay_hoan_thanh->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_view->ngay_hoan_thanh->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("ck_chitiet_suachua", explode(",", $ck_danhmuc_suachua->getCurrentDetailTable())) && $ck_chitiet_suachua->DetailView) {
?>
<?php if ($ck_danhmuc_suachua->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("ck_chitiet_suachua", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ck_chitiet_suachuagrid.php" ?>
<?php } ?>
</form>
<?php
$ck_danhmuc_suachua_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ck_danhmuc_suachua_view->isExport()) { ?>
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
$ck_danhmuc_suachua_view->terminate();
?>