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
$ck_danhmuc_thietbi_delete = new ck_danhmuc_thietbi_delete();

// Run the page
$ck_danhmuc_thietbi_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_danhmuc_thietbi_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fck_danhmuc_thietbidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fck_danhmuc_thietbidelete = currentForm = new ew.Form("fck_danhmuc_thietbidelete", "delete");
	loadjs.done("fck_danhmuc_thietbidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ck_danhmuc_thietbi_delete->showPageHeader(); ?>
<?php
$ck_danhmuc_thietbi_delete->showMessage();
?>
<form name="fck_danhmuc_thietbidelete" id="fck_danhmuc_thietbidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_danhmuc_thietbi">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ck_danhmuc_thietbi_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ck_danhmuc_thietbi_delete->chung_loai_id->Visible) { // chung_loai_id ?>
		<th class="<?php echo $ck_danhmuc_thietbi_delete->chung_loai_id->headerCellClass() ?>"><span id="elh_ck_danhmuc_thietbi_chung_loai_id" class="ck_danhmuc_thietbi_chung_loai_id"><?php echo $ck_danhmuc_thietbi_delete->chung_loai_id->caption() ?></span></th>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_delete->ky_ma_hieu->Visible) { // ky_ma_hieu ?>
		<th class="<?php echo $ck_danhmuc_thietbi_delete->ky_ma_hieu->headerCellClass() ?>"><span id="elh_ck_danhmuc_thietbi_ky_ma_hieu" class="ck_danhmuc_thietbi_ky_ma_hieu"><?php echo $ck_danhmuc_thietbi_delete->ky_ma_hieu->caption() ?></span></th>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_delete->bo_phan->Visible) { // bo_phan ?>
		<th class="<?php echo $ck_danhmuc_thietbi_delete->bo_phan->headerCellClass() ?>"><span id="elh_ck_danhmuc_thietbi_bo_phan" class="ck_danhmuc_thietbi_bo_phan"><?php echo $ck_danhmuc_thietbi_delete->bo_phan->caption() ?></span></th>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_delete->namsx->Visible) { // namsx ?>
		<th class="<?php echo $ck_danhmuc_thietbi_delete->namsx->headerCellClass() ?>"><span id="elh_ck_danhmuc_thietbi_namsx" class="ck_danhmuc_thietbi_namsx"><?php echo $ck_danhmuc_thietbi_delete->namsx->caption() ?></span></th>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_delete->ghi_chu->Visible) { // ghi_chu ?>
		<th class="<?php echo $ck_danhmuc_thietbi_delete->ghi_chu->headerCellClass() ?>"><span id="elh_ck_danhmuc_thietbi_ghi_chu" class="ck_danhmuc_thietbi_ghi_chu"><?php echo $ck_danhmuc_thietbi_delete->ghi_chu->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ck_danhmuc_thietbi_delete->RecordCount = 0;
$i = 0;
while (!$ck_danhmuc_thietbi_delete->Recordset->EOF) {
	$ck_danhmuc_thietbi_delete->RecordCount++;
	$ck_danhmuc_thietbi_delete->RowCount++;

	// Set row properties
	$ck_danhmuc_thietbi->resetAttributes();
	$ck_danhmuc_thietbi->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ck_danhmuc_thietbi_delete->loadRowValues($ck_danhmuc_thietbi_delete->Recordset);

	// Render row
	$ck_danhmuc_thietbi_delete->renderRow();
?>
	<tr <?php echo $ck_danhmuc_thietbi->rowAttributes() ?>>
<?php if ($ck_danhmuc_thietbi_delete->chung_loai_id->Visible) { // chung_loai_id ?>
		<td <?php echo $ck_danhmuc_thietbi_delete->chung_loai_id->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_thietbi_delete->RowCount ?>_ck_danhmuc_thietbi_chung_loai_id" class="ck_danhmuc_thietbi_chung_loai_id">
<span<?php echo $ck_danhmuc_thietbi_delete->chung_loai_id->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_delete->chung_loai_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_delete->ky_ma_hieu->Visible) { // ky_ma_hieu ?>
		<td <?php echo $ck_danhmuc_thietbi_delete->ky_ma_hieu->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_thietbi_delete->RowCount ?>_ck_danhmuc_thietbi_ky_ma_hieu" class="ck_danhmuc_thietbi_ky_ma_hieu">
<span<?php echo $ck_danhmuc_thietbi_delete->ky_ma_hieu->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_delete->ky_ma_hieu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_delete->bo_phan->Visible) { // bo_phan ?>
		<td <?php echo $ck_danhmuc_thietbi_delete->bo_phan->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_thietbi_delete->RowCount ?>_ck_danhmuc_thietbi_bo_phan" class="ck_danhmuc_thietbi_bo_phan">
<span<?php echo $ck_danhmuc_thietbi_delete->bo_phan->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_delete->bo_phan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_delete->namsx->Visible) { // namsx ?>
		<td <?php echo $ck_danhmuc_thietbi_delete->namsx->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_thietbi_delete->RowCount ?>_ck_danhmuc_thietbi_namsx" class="ck_danhmuc_thietbi_namsx">
<span<?php echo $ck_danhmuc_thietbi_delete->namsx->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_delete->namsx->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_delete->ghi_chu->Visible) { // ghi_chu ?>
		<td <?php echo $ck_danhmuc_thietbi_delete->ghi_chu->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_thietbi_delete->RowCount ?>_ck_danhmuc_thietbi_ghi_chu" class="ck_danhmuc_thietbi_ghi_chu">
<span<?php echo $ck_danhmuc_thietbi_delete->ghi_chu->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_delete->ghi_chu->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ck_danhmuc_thietbi_delete->Recordset->moveNext();
}
$ck_danhmuc_thietbi_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ck_danhmuc_thietbi_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ck_danhmuc_thietbi_delete->showPageFooter();
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
$ck_danhmuc_thietbi_delete->terminate();
?>