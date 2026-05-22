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
$ck_danhmuc_suachua_delete = new ck_danhmuc_suachua_delete();

// Run the page
$ck_danhmuc_suachua_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_danhmuc_suachua_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fck_danhmuc_suachuadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fck_danhmuc_suachuadelete = currentForm = new ew.Form("fck_danhmuc_suachuadelete", "delete");
	loadjs.done("fck_danhmuc_suachuadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ck_danhmuc_suachua_delete->showPageHeader(); ?>
<?php
$ck_danhmuc_suachua_delete->showMessage();
?>
<form name="fck_danhmuc_suachuadelete" id="fck_danhmuc_suachuadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_danhmuc_suachua">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ck_danhmuc_suachua_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ck_danhmuc_suachua_delete->chuanloai_id->Visible) { // chuanloai_id ?>
		<th class="<?php echo $ck_danhmuc_suachua_delete->chuanloai_id->headerCellClass() ?>"><span id="elh_ck_danhmuc_suachua_chuanloai_id" class="ck_danhmuc_suachua_chuanloai_id"><?php echo $ck_danhmuc_suachua_delete->chuanloai_id->caption() ?></span></th>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->thiet_bi_id->Visible) { // thiet_bi_id ?>
		<th class="<?php echo $ck_danhmuc_suachua_delete->thiet_bi_id->headerCellClass() ?>"><span id="elh_ck_danhmuc_suachua_thiet_bi_id" class="ck_danhmuc_suachua_thiet_bi_id"><?php echo $ck_danhmuc_suachua_delete->thiet_bi_id->caption() ?></span></th>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<th class="<?php echo $ck_danhmuc_suachua_delete->ngay_sua_chua->headerCellClass() ?>"><span id="elh_ck_danhmuc_suachua_ngay_sua_chua" class="ck_danhmuc_suachua_ngay_sua_chua"><?php echo $ck_danhmuc_suachua_delete->ngay_sua_chua->caption() ?></span></th>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
		<th class="<?php echo $ck_danhmuc_suachua_delete->noi_dung_sua_chua->headerCellClass() ?>"><span id="elh_ck_danhmuc_suachua_noi_dung_sua_chua" class="ck_danhmuc_suachua_noi_dung_sua_chua"><?php echo $ck_danhmuc_suachua_delete->noi_dung_sua_chua->caption() ?></span></th>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->thoi_gian_sua_chua->Visible) { // thoi_gian_sua_chua ?>
		<th class="<?php echo $ck_danhmuc_suachua_delete->thoi_gian_sua_chua->headerCellClass() ?>"><span id="elh_ck_danhmuc_suachua_thoi_gian_sua_chua" class="ck_danhmuc_suachua_thoi_gian_sua_chua"><?php echo $ck_danhmuc_suachua_delete->thoi_gian_sua_chua->caption() ?></span></th>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->nguoi_nhap_lieu->Visible) { // nguoi_nhap_lieu ?>
		<th class="<?php echo $ck_danhmuc_suachua_delete->nguoi_nhap_lieu->headerCellClass() ?>"><span id="elh_ck_danhmuc_suachua_nguoi_nhap_lieu" class="ck_danhmuc_suachua_nguoi_nhap_lieu"><?php echo $ck_danhmuc_suachua_delete->nguoi_nhap_lieu->caption() ?></span></th>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->dich_vu->Visible) { // dich_vu ?>
		<th class="<?php echo $ck_danhmuc_suachua_delete->dich_vu->headerCellClass() ?>"><span id="elh_ck_danhmuc_suachua_dich_vu" class="ck_danhmuc_suachua_dich_vu"><?php echo $ck_danhmuc_suachua_delete->dich_vu->caption() ?></span></th>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->hoan_thanh->Visible) { // hoan_thanh ?>
		<th class="<?php echo $ck_danhmuc_suachua_delete->hoan_thanh->headerCellClass() ?>"><span id="elh_ck_danhmuc_suachua_hoan_thanh" class="ck_danhmuc_suachua_hoan_thanh"><?php echo $ck_danhmuc_suachua_delete->hoan_thanh->caption() ?></span></th>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->id_don_hang->Visible) { // id_don_hang ?>
		<th class="<?php echo $ck_danhmuc_suachua_delete->id_don_hang->headerCellClass() ?>"><span id="elh_ck_danhmuc_suachua_id_don_hang" class="ck_danhmuc_suachua_id_don_hang"><?php echo $ck_danhmuc_suachua_delete->id_don_hang->caption() ?></span></th>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->ngay_hoan_thanh->Visible) { // ngay_hoan_thanh ?>
		<th class="<?php echo $ck_danhmuc_suachua_delete->ngay_hoan_thanh->headerCellClass() ?>"><span id="elh_ck_danhmuc_suachua_ngay_hoan_thanh" class="ck_danhmuc_suachua_ngay_hoan_thanh"><?php echo $ck_danhmuc_suachua_delete->ngay_hoan_thanh->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ck_danhmuc_suachua_delete->RecordCount = 0;
$i = 0;
while (!$ck_danhmuc_suachua_delete->Recordset->EOF) {
	$ck_danhmuc_suachua_delete->RecordCount++;
	$ck_danhmuc_suachua_delete->RowCount++;

	// Set row properties
	$ck_danhmuc_suachua->resetAttributes();
	$ck_danhmuc_suachua->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ck_danhmuc_suachua_delete->loadRowValues($ck_danhmuc_suachua_delete->Recordset);

	// Render row
	$ck_danhmuc_suachua_delete->renderRow();
?>
	<tr <?php echo $ck_danhmuc_suachua->rowAttributes() ?>>
<?php if ($ck_danhmuc_suachua_delete->chuanloai_id->Visible) { // chuanloai_id ?>
		<td <?php echo $ck_danhmuc_suachua_delete->chuanloai_id->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_delete->RowCount ?>_ck_danhmuc_suachua_chuanloai_id" class="ck_danhmuc_suachua_chuanloai_id">
<span<?php echo $ck_danhmuc_suachua_delete->chuanloai_id->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_delete->chuanloai_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->thiet_bi_id->Visible) { // thiet_bi_id ?>
		<td <?php echo $ck_danhmuc_suachua_delete->thiet_bi_id->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_delete->RowCount ?>_ck_danhmuc_suachua_thiet_bi_id" class="ck_danhmuc_suachua_thiet_bi_id">
<span<?php echo $ck_danhmuc_suachua_delete->thiet_bi_id->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_delete->thiet_bi_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td <?php echo $ck_danhmuc_suachua_delete->ngay_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_delete->RowCount ?>_ck_danhmuc_suachua_ngay_sua_chua" class="ck_danhmuc_suachua_ngay_sua_chua">
<span<?php echo $ck_danhmuc_suachua_delete->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_delete->ngay_sua_chua->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
		<td <?php echo $ck_danhmuc_suachua_delete->noi_dung_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_delete->RowCount ?>_ck_danhmuc_suachua_noi_dung_sua_chua" class="ck_danhmuc_suachua_noi_dung_sua_chua">
<span<?php echo $ck_danhmuc_suachua_delete->noi_dung_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_delete->noi_dung_sua_chua->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->thoi_gian_sua_chua->Visible) { // thoi_gian_sua_chua ?>
		<td <?php echo $ck_danhmuc_suachua_delete->thoi_gian_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_delete->RowCount ?>_ck_danhmuc_suachua_thoi_gian_sua_chua" class="ck_danhmuc_suachua_thoi_gian_sua_chua">
<span<?php echo $ck_danhmuc_suachua_delete->thoi_gian_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_delete->thoi_gian_sua_chua->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->nguoi_nhap_lieu->Visible) { // nguoi_nhap_lieu ?>
		<td <?php echo $ck_danhmuc_suachua_delete->nguoi_nhap_lieu->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_delete->RowCount ?>_ck_danhmuc_suachua_nguoi_nhap_lieu" class="ck_danhmuc_suachua_nguoi_nhap_lieu">
<span<?php echo $ck_danhmuc_suachua_delete->nguoi_nhap_lieu->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_delete->nguoi_nhap_lieu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->dich_vu->Visible) { // dich_vu ?>
		<td <?php echo $ck_danhmuc_suachua_delete->dich_vu->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_delete->RowCount ?>_ck_danhmuc_suachua_dich_vu" class="ck_danhmuc_suachua_dich_vu">
<span<?php echo $ck_danhmuc_suachua_delete->dich_vu->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_dich_vu" class="custom-control-input" value="<?php echo $ck_danhmuc_suachua_delete->dich_vu->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_danhmuc_suachua_delete->dich_vu->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_dich_vu"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->hoan_thanh->Visible) { // hoan_thanh ?>
		<td <?php echo $ck_danhmuc_suachua_delete->hoan_thanh->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_delete->RowCount ?>_ck_danhmuc_suachua_hoan_thanh" class="ck_danhmuc_suachua_hoan_thanh">
<span<?php echo $ck_danhmuc_suachua_delete->hoan_thanh->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_hoan_thanh" class="custom-control-input" value="<?php echo $ck_danhmuc_suachua_delete->hoan_thanh->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_danhmuc_suachua_delete->hoan_thanh->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_hoan_thanh"></label></div></span>
</span>
</td>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->id_don_hang->Visible) { // id_don_hang ?>
		<td <?php echo $ck_danhmuc_suachua_delete->id_don_hang->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_delete->RowCount ?>_ck_danhmuc_suachua_id_don_hang" class="ck_danhmuc_suachua_id_don_hang">
<span<?php echo $ck_danhmuc_suachua_delete->id_don_hang->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_delete->id_don_hang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_danhmuc_suachua_delete->ngay_hoan_thanh->Visible) { // ngay_hoan_thanh ?>
		<td <?php echo $ck_danhmuc_suachua_delete->ngay_hoan_thanh->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_delete->RowCount ?>_ck_danhmuc_suachua_ngay_hoan_thanh" class="ck_danhmuc_suachua_ngay_hoan_thanh">
<span<?php echo $ck_danhmuc_suachua_delete->ngay_hoan_thanh->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_delete->ngay_hoan_thanh->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ck_danhmuc_suachua_delete->Recordset->moveNext();
}
$ck_danhmuc_suachua_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ck_danhmuc_suachua_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ck_danhmuc_suachua_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$ck_danhmuc_suachua_delete->terminate();
?>