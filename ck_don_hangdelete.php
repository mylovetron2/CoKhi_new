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
$ck_don_hang_delete = new ck_don_hang_delete();

// Run the page
$ck_don_hang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_don_hang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fck_don_hangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fck_don_hangdelete = currentForm = new ew.Form("fck_don_hangdelete", "delete");
	loadjs.done("fck_don_hangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ck_don_hang_delete->showPageHeader(); ?>
<?php
$ck_don_hang_delete->showMessage();
?>
<form name="fck_don_hangdelete" id="fck_don_hangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_don_hang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ck_don_hang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ck_don_hang_delete->so_don_hang_id->Visible) { // so_don_hang_id ?>
		<th class="<?php echo $ck_don_hang_delete->so_don_hang_id->headerCellClass() ?>"><span id="elh_ck_don_hang_so_don_hang_id" class="ck_don_hang_so_don_hang_id"><?php echo $ck_don_hang_delete->so_don_hang_id->caption() ?></span></th>
<?php } ?>
<?php if ($ck_don_hang_delete->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<th class="<?php echo $ck_don_hang_delete->ngay_sua_chua->headerCellClass() ?>"><span id="elh_ck_don_hang_ngay_sua_chua" class="ck_don_hang_ngay_sua_chua"><?php echo $ck_don_hang_delete->ngay_sua_chua->caption() ?></span></th>
<?php } ?>
<?php if ($ck_don_hang_delete->chung_loai->Visible) { // chung_loai ?>
		<th class="<?php echo $ck_don_hang_delete->chung_loai->headerCellClass() ?>"><span id="elh_ck_don_hang_chung_loai" class="ck_don_hang_chung_loai"><?php echo $ck_don_hang_delete->chung_loai->caption() ?></span></th>
<?php } ?>
<?php if ($ck_don_hang_delete->ten_thiet_bi->Visible) { // ten_thiet_bi ?>
		<th class="<?php echo $ck_don_hang_delete->ten_thiet_bi->headerCellClass() ?>"><span id="elh_ck_don_hang_ten_thiet_bi" class="ck_don_hang_ten_thiet_bi"><?php echo $ck_don_hang_delete->ten_thiet_bi->caption() ?></span></th>
<?php } ?>
<?php if ($ck_don_hang_delete->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
		<th class="<?php echo $ck_don_hang_delete->noi_dung_sua_chua->headerCellClass() ?>"><span id="elh_ck_don_hang_noi_dung_sua_chua" class="ck_don_hang_noi_dung_sua_chua"><?php echo $ck_don_hang_delete->noi_dung_sua_chua->caption() ?></span></th>
<?php } ?>
<?php if ($ck_don_hang_delete->baoduong_dinhky->Visible) { // baoduong_dinhky ?>
		<th class="<?php echo $ck_don_hang_delete->baoduong_dinhky->headerCellClass() ?>"><span id="elh_ck_don_hang_baoduong_dinhky" class="ck_don_hang_baoduong_dinhky"><?php echo $ck_don_hang_delete->baoduong_dinhky->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ck_don_hang_delete->RecordCount = 0;
$i = 0;
while (!$ck_don_hang_delete->Recordset->EOF) {
	$ck_don_hang_delete->RecordCount++;
	$ck_don_hang_delete->RowCount++;

	// Set row properties
	$ck_don_hang->resetAttributes();
	$ck_don_hang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ck_don_hang_delete->loadRowValues($ck_don_hang_delete->Recordset);

	// Render row
	$ck_don_hang_delete->renderRow();
?>
	<tr <?php echo $ck_don_hang->rowAttributes() ?>>
<?php if ($ck_don_hang_delete->so_don_hang_id->Visible) { // so_don_hang_id ?>
		<td <?php echo $ck_don_hang_delete->so_don_hang_id->cellAttributes() ?>>
<span id="el<?php echo $ck_don_hang_delete->RowCount ?>_ck_don_hang_so_don_hang_id" class="ck_don_hang_so_don_hang_id">
<span<?php echo $ck_don_hang_delete->so_don_hang_id->viewAttributes() ?>><?php echo $ck_don_hang_delete->so_don_hang_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_don_hang_delete->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td <?php echo $ck_don_hang_delete->ngay_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $ck_don_hang_delete->RowCount ?>_ck_don_hang_ngay_sua_chua" class="ck_don_hang_ngay_sua_chua">
<span<?php echo $ck_don_hang_delete->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_don_hang_delete->ngay_sua_chua->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_don_hang_delete->chung_loai->Visible) { // chung_loai ?>
		<td <?php echo $ck_don_hang_delete->chung_loai->cellAttributes() ?>>
<span id="el<?php echo $ck_don_hang_delete->RowCount ?>_ck_don_hang_chung_loai" class="ck_don_hang_chung_loai">
<span<?php echo $ck_don_hang_delete->chung_loai->viewAttributes() ?>><?php echo $ck_don_hang_delete->chung_loai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_don_hang_delete->ten_thiet_bi->Visible) { // ten_thiet_bi ?>
		<td <?php echo $ck_don_hang_delete->ten_thiet_bi->cellAttributes() ?>>
<span id="el<?php echo $ck_don_hang_delete->RowCount ?>_ck_don_hang_ten_thiet_bi" class="ck_don_hang_ten_thiet_bi">
<span<?php echo $ck_don_hang_delete->ten_thiet_bi->viewAttributes() ?>><?php echo $ck_don_hang_delete->ten_thiet_bi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_don_hang_delete->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
		<td <?php echo $ck_don_hang_delete->noi_dung_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $ck_don_hang_delete->RowCount ?>_ck_don_hang_noi_dung_sua_chua" class="ck_don_hang_noi_dung_sua_chua">
<span<?php echo $ck_don_hang_delete->noi_dung_sua_chua->viewAttributes() ?>><?php echo $ck_don_hang_delete->noi_dung_sua_chua->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_don_hang_delete->baoduong_dinhky->Visible) { // baoduong_dinhky ?>
		<td <?php echo $ck_don_hang_delete->baoduong_dinhky->cellAttributes() ?>>
<span id="el<?php echo $ck_don_hang_delete->RowCount ?>_ck_don_hang_baoduong_dinhky" class="ck_don_hang_baoduong_dinhky">
<span<?php echo $ck_don_hang_delete->baoduong_dinhky->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_baoduong_dinhky" class="custom-control-input" value="<?php echo $ck_don_hang_delete->baoduong_dinhky->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_don_hang_delete->baoduong_dinhky->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_baoduong_dinhky"></label></div></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ck_don_hang_delete->Recordset->moveNext();
}
$ck_don_hang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ck_don_hang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ck_don_hang_delete->showPageFooter();
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
$ck_don_hang_delete->terminate();
?>