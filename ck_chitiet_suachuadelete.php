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
$ck_chitiet_suachua_delete = new ck_chitiet_suachua_delete();

// Run the page
$ck_chitiet_suachua_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_chitiet_suachua_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fck_chitiet_suachuadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fck_chitiet_suachuadelete = currentForm = new ew.Form("fck_chitiet_suachuadelete", "delete");
	loadjs.done("fck_chitiet_suachuadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ck_chitiet_suachua_delete->showPageHeader(); ?>
<?php
$ck_chitiet_suachua_delete->showMessage();
?>
<form name="fck_chitiet_suachuadelete" id="fck_chitiet_suachuadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_chitiet_suachua">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ck_chitiet_suachua_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ck_chitiet_suachua_delete->tennhanvien->Visible) { // tennhanvien ?>
		<th class="<?php echo $ck_chitiet_suachua_delete->tennhanvien->headerCellClass() ?>"><span id="elh_ck_chitiet_suachua_tennhanvien" class="ck_chitiet_suachua_tennhanvien"><?php echo $ck_chitiet_suachua_delete->tennhanvien->caption() ?></span></th>
<?php } ?>
<?php if ($ck_chitiet_suachua_delete->nhan_vien_id->Visible) { // nhan_vien_id ?>
		<th class="<?php echo $ck_chitiet_suachua_delete->nhan_vien_id->headerCellClass() ?>"><span id="elh_ck_chitiet_suachua_nhan_vien_id" class="ck_chitiet_suachua_nhan_vien_id"><?php echo $ck_chitiet_suachua_delete->nhan_vien_id->caption() ?></span></th>
<?php } ?>
<?php if ($ck_chitiet_suachua_delete->chuc_danh->Visible) { // chuc_danh ?>
		<th class="<?php echo $ck_chitiet_suachua_delete->chuc_danh->headerCellClass() ?>"><span id="elh_ck_chitiet_suachua_chuc_danh" class="ck_chitiet_suachua_chuc_danh"><?php echo $ck_chitiet_suachua_delete->chuc_danh->caption() ?></span></th>
<?php } ?>
<?php if ($ck_chitiet_suachua_delete->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<th class="<?php echo $ck_chitiet_suachua_delete->ngay_sua_chua->headerCellClass() ?>"><span id="elh_ck_chitiet_suachua_ngay_sua_chua" class="ck_chitiet_suachua_ngay_sua_chua"><?php echo $ck_chitiet_suachua_delete->ngay_sua_chua->caption() ?></span></th>
<?php } ?>
<?php if ($ck_chitiet_suachua_delete->thoi_gian->Visible) { // thoi_gian ?>
		<th class="<?php echo $ck_chitiet_suachua_delete->thoi_gian->headerCellClass() ?>"><span id="elh_ck_chitiet_suachua_thoi_gian" class="ck_chitiet_suachua_thoi_gian"><?php echo $ck_chitiet_suachua_delete->thoi_gian->caption() ?></span></th>
<?php } ?>
<?php if ($ck_chitiet_suachua_delete->noi_dung->Visible) { // noi_dung ?>
		<th class="<?php echo $ck_chitiet_suachua_delete->noi_dung->headerCellClass() ?>"><span id="elh_ck_chitiet_suachua_noi_dung" class="ck_chitiet_suachua_noi_dung"><?php echo $ck_chitiet_suachua_delete->noi_dung->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ck_chitiet_suachua_delete->RecordCount = 0;
$i = 0;
while (!$ck_chitiet_suachua_delete->Recordset->EOF) {
	$ck_chitiet_suachua_delete->RecordCount++;
	$ck_chitiet_suachua_delete->RowCount++;

	// Set row properties
	$ck_chitiet_suachua->resetAttributes();
	$ck_chitiet_suachua->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ck_chitiet_suachua_delete->loadRowValues($ck_chitiet_suachua_delete->Recordset);

	// Render row
	$ck_chitiet_suachua_delete->renderRow();
?>
	<tr <?php echo $ck_chitiet_suachua->rowAttributes() ?>>
<?php if ($ck_chitiet_suachua_delete->tennhanvien->Visible) { // tennhanvien ?>
		<td <?php echo $ck_chitiet_suachua_delete->tennhanvien->cellAttributes() ?>>
<span id="el<?php echo $ck_chitiet_suachua_delete->RowCount ?>_ck_chitiet_suachua_tennhanvien" class="ck_chitiet_suachua_tennhanvien">
<span<?php echo $ck_chitiet_suachua_delete->tennhanvien->viewAttributes() ?>><?php echo $ck_chitiet_suachua_delete->tennhanvien->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_chitiet_suachua_delete->nhan_vien_id->Visible) { // nhan_vien_id ?>
		<td <?php echo $ck_chitiet_suachua_delete->nhan_vien_id->cellAttributes() ?>>
<span id="el<?php echo $ck_chitiet_suachua_delete->RowCount ?>_ck_chitiet_suachua_nhan_vien_id" class="ck_chitiet_suachua_nhan_vien_id">
<span<?php echo $ck_chitiet_suachua_delete->nhan_vien_id->viewAttributes() ?>><?php echo $ck_chitiet_suachua_delete->nhan_vien_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_chitiet_suachua_delete->chuc_danh->Visible) { // chuc_danh ?>
		<td <?php echo $ck_chitiet_suachua_delete->chuc_danh->cellAttributes() ?>>
<span id="el<?php echo $ck_chitiet_suachua_delete->RowCount ?>_ck_chitiet_suachua_chuc_danh" class="ck_chitiet_suachua_chuc_danh">
<span<?php echo $ck_chitiet_suachua_delete->chuc_danh->viewAttributes() ?>><?php echo $ck_chitiet_suachua_delete->chuc_danh->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_chitiet_suachua_delete->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td <?php echo $ck_chitiet_suachua_delete->ngay_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $ck_chitiet_suachua_delete->RowCount ?>_ck_chitiet_suachua_ngay_sua_chua" class="ck_chitiet_suachua_ngay_sua_chua">
<span<?php echo $ck_chitiet_suachua_delete->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_chitiet_suachua_delete->ngay_sua_chua->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_chitiet_suachua_delete->thoi_gian->Visible) { // thoi_gian ?>
		<td <?php echo $ck_chitiet_suachua_delete->thoi_gian->cellAttributes() ?>>
<span id="el<?php echo $ck_chitiet_suachua_delete->RowCount ?>_ck_chitiet_suachua_thoi_gian" class="ck_chitiet_suachua_thoi_gian">
<span<?php echo $ck_chitiet_suachua_delete->thoi_gian->viewAttributes() ?>><?php echo $ck_chitiet_suachua_delete->thoi_gian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_chitiet_suachua_delete->noi_dung->Visible) { // noi_dung ?>
		<td <?php echo $ck_chitiet_suachua_delete->noi_dung->cellAttributes() ?>>
<span id="el<?php echo $ck_chitiet_suachua_delete->RowCount ?>_ck_chitiet_suachua_noi_dung" class="ck_chitiet_suachua_noi_dung">
<span<?php echo $ck_chitiet_suachua_delete->noi_dung->viewAttributes() ?>><?php echo $ck_chitiet_suachua_delete->noi_dung->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ck_chitiet_suachua_delete->Recordset->moveNext();
}
$ck_chitiet_suachua_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ck_chitiet_suachua_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ck_chitiet_suachua_delete->showPageFooter();
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
$ck_chitiet_suachua_delete->terminate();
?>