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
$ck_chungloai_thietbi_delete = new ck_chungloai_thietbi_delete();

// Run the page
$ck_chungloai_thietbi_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_chungloai_thietbi_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fck_chungloai_thietbidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fck_chungloai_thietbidelete = currentForm = new ew.Form("fck_chungloai_thietbidelete", "delete");
	loadjs.done("fck_chungloai_thietbidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ck_chungloai_thietbi_delete->showPageHeader(); ?>
<?php
$ck_chungloai_thietbi_delete->showMessage();
?>
<form name="fck_chungloai_thietbidelete" id="fck_chungloai_thietbidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_chungloai_thietbi">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ck_chungloai_thietbi_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ck_chungloai_thietbi_delete->chungloai_id->Visible) { // chungloai_id ?>
		<th class="<?php echo $ck_chungloai_thietbi_delete->chungloai_id->headerCellClass() ?>"><span id="elh_ck_chungloai_thietbi_chungloai_id" class="ck_chungloai_thietbi_chungloai_id"><?php echo $ck_chungloai_thietbi_delete->chungloai_id->caption() ?></span></th>
<?php } ?>
<?php if ($ck_chungloai_thietbi_delete->ten_chungloai->Visible) { // ten_chungloai ?>
		<th class="<?php echo $ck_chungloai_thietbi_delete->ten_chungloai->headerCellClass() ?>"><span id="elh_ck_chungloai_thietbi_ten_chungloai" class="ck_chungloai_thietbi_ten_chungloai"><?php echo $ck_chungloai_thietbi_delete->ten_chungloai->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ck_chungloai_thietbi_delete->RecordCount = 0;
$i = 0;
while (!$ck_chungloai_thietbi_delete->Recordset->EOF) {
	$ck_chungloai_thietbi_delete->RecordCount++;
	$ck_chungloai_thietbi_delete->RowCount++;

	// Set row properties
	$ck_chungloai_thietbi->resetAttributes();
	$ck_chungloai_thietbi->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ck_chungloai_thietbi_delete->loadRowValues($ck_chungloai_thietbi_delete->Recordset);

	// Render row
	$ck_chungloai_thietbi_delete->renderRow();
?>
	<tr <?php echo $ck_chungloai_thietbi->rowAttributes() ?>>
<?php if ($ck_chungloai_thietbi_delete->chungloai_id->Visible) { // chungloai_id ?>
		<td <?php echo $ck_chungloai_thietbi_delete->chungloai_id->cellAttributes() ?>>
<span id="el<?php echo $ck_chungloai_thietbi_delete->RowCount ?>_ck_chungloai_thietbi_chungloai_id" class="ck_chungloai_thietbi_chungloai_id">
<span<?php echo $ck_chungloai_thietbi_delete->chungloai_id->viewAttributes() ?>><?php echo $ck_chungloai_thietbi_delete->chungloai_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ck_chungloai_thietbi_delete->ten_chungloai->Visible) { // ten_chungloai ?>
		<td <?php echo $ck_chungloai_thietbi_delete->ten_chungloai->cellAttributes() ?>>
<span id="el<?php echo $ck_chungloai_thietbi_delete->RowCount ?>_ck_chungloai_thietbi_ten_chungloai" class="ck_chungloai_thietbi_ten_chungloai">
<span<?php echo $ck_chungloai_thietbi_delete->ten_chungloai->viewAttributes() ?>><?php echo $ck_chungloai_thietbi_delete->ten_chungloai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ck_chungloai_thietbi_delete->Recordset->moveNext();
}
$ck_chungloai_thietbi_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ck_chungloai_thietbi_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ck_chungloai_thietbi_delete->showPageFooter();
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
$ck_chungloai_thietbi_delete->terminate();
?>