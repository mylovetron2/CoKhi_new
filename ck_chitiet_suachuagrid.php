<?php
namespace PHPMaker2020\projectCoKhi;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($ck_chitiet_suachua_grid))
	$ck_chitiet_suachua_grid = new ck_chitiet_suachua_grid();

// Run the page
$ck_chitiet_suachua_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_chitiet_suachua_grid->Page_Render();
?>
<?php if (!$ck_chitiet_suachua_grid->isExport()) { ?>
<script>
var fck_chitiet_suachuagrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fck_chitiet_suachuagrid = new ew.Form("fck_chitiet_suachuagrid", "grid");
	fck_chitiet_suachuagrid.formKeyCountName = '<?php echo $ck_chitiet_suachua_grid->FormKeyCountName ?>';

	// Validate form
	fck_chitiet_suachuagrid.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($ck_chitiet_suachua_grid->tennhanvien->Required) { ?>
				elm = this.getElements("x" + infix + "_tennhanvien");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_chitiet_suachua_grid->tennhanvien->caption(), $ck_chitiet_suachua_grid->tennhanvien->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tennhanvien");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_chitiet_suachua_grid->tennhanvien->errorMessage()) ?>");
			<?php if ($ck_chitiet_suachua_grid->nhan_vien_id->Required) { ?>
				elm = this.getElements("x" + infix + "_nhan_vien_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_chitiet_suachua_grid->nhan_vien_id->caption(), $ck_chitiet_suachua_grid->nhan_vien_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nhan_vien_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_chitiet_suachua_grid->nhan_vien_id->errorMessage()) ?>");
			<?php if ($ck_chitiet_suachua_grid->chuc_danh->Required) { ?>
				elm = this.getElements("x" + infix + "_chuc_danh");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_chitiet_suachua_grid->chuc_danh->caption(), $ck_chitiet_suachua_grid->chuc_danh->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_chitiet_suachua_grid->ngay_sua_chua->Required) { ?>
				elm = this.getElements("x" + infix + "_ngay_sua_chua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_chitiet_suachua_grid->ngay_sua_chua->caption(), $ck_chitiet_suachua_grid->ngay_sua_chua->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ngay_sua_chua");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_chitiet_suachua_grid->ngay_sua_chua->errorMessage()) ?>");
			<?php if ($ck_chitiet_suachua_grid->thoi_gian->Required) { ?>
				elm = this.getElements("x" + infix + "_thoi_gian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_chitiet_suachua_grid->thoi_gian->caption(), $ck_chitiet_suachua_grid->thoi_gian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_thoi_gian");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_chitiet_suachua_grid->thoi_gian->errorMessage()) ?>");
			<?php if ($ck_chitiet_suachua_grid->noi_dung->Required) { ?>
				elm = this.getElements("x" + infix + "_noi_dung");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_chitiet_suachua_grid->noi_dung->caption(), $ck_chitiet_suachua_grid->noi_dung->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fck_chitiet_suachuagrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "tennhanvien", false)) return false;
		if (ew.valueChanged(fobj, infix, "nhan_vien_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "chuc_danh", false)) return false;
		if (ew.valueChanged(fobj, infix, "ngay_sua_chua", false)) return false;
		if (ew.valueChanged(fobj, infix, "thoi_gian", false)) return false;
		if (ew.valueChanged(fobj, infix, "noi_dung", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fck_chitiet_suachuagrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fck_chitiet_suachuagrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fck_chitiet_suachuagrid.lists["x_tennhanvien"] = <?php echo $ck_chitiet_suachua_grid->tennhanvien->Lookup->toClientList($ck_chitiet_suachua_grid) ?>;
	fck_chitiet_suachuagrid.lists["x_tennhanvien"].options = <?php echo JsonEncode($ck_chitiet_suachua_grid->tennhanvien->lookupOptions()) ?>;
	fck_chitiet_suachuagrid.autoSuggests["x_tennhanvien"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fck_chitiet_suachuagrid.lists["x_nhan_vien_id"] = <?php echo $ck_chitiet_suachua_grid->nhan_vien_id->Lookup->toClientList($ck_chitiet_suachua_grid) ?>;
	fck_chitiet_suachuagrid.lists["x_nhan_vien_id"].options = <?php echo JsonEncode($ck_chitiet_suachua_grid->nhan_vien_id->lookupOptions()) ?>;
	fck_chitiet_suachuagrid.autoSuggests["x_nhan_vien_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fck_chitiet_suachuagrid.lists["x_chuc_danh"] = <?php echo $ck_chitiet_suachua_grid->chuc_danh->Lookup->toClientList($ck_chitiet_suachua_grid) ?>;
	fck_chitiet_suachuagrid.lists["x_chuc_danh"].options = <?php echo JsonEncode($ck_chitiet_suachua_grid->chuc_danh->lookupOptions()) ?>;
	fck_chitiet_suachuagrid.autoSuggests["x_chuc_danh"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fck_chitiet_suachuagrid");
});
</script>
<?php } ?>
<?php
$ck_chitiet_suachua_grid->renderOtherOptions();
?>
<?php if ($ck_chitiet_suachua_grid->TotalRecords > 0 || $ck_chitiet_suachua->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ck_chitiet_suachua_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ck_chitiet_suachua">
<?php if ($ck_chitiet_suachua_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $ck_chitiet_suachua_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fck_chitiet_suachuagrid" class="ew-form ew-list-form form-inline">
<div id="gmp_ck_chitiet_suachua" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_ck_chitiet_suachuagrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ck_chitiet_suachua->RowType = ROWTYPE_HEADER;

// Render list options
$ck_chitiet_suachua_grid->renderListOptions();

// Render list options (header, left)
$ck_chitiet_suachua_grid->ListOptions->render("header", "left");
?>
<?php if ($ck_chitiet_suachua_grid->tennhanvien->Visible) { // tennhanvien ?>
	<?php if ($ck_chitiet_suachua_grid->SortUrl($ck_chitiet_suachua_grid->tennhanvien) == "") { ?>
		<th data-name="tennhanvien" class="<?php echo $ck_chitiet_suachua_grid->tennhanvien->headerCellClass() ?>"><div id="elh_ck_chitiet_suachua_tennhanvien" class="ck_chitiet_suachua_tennhanvien"><div class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_grid->tennhanvien->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tennhanvien" class="<?php echo $ck_chitiet_suachua_grid->tennhanvien->headerCellClass() ?>"><div><div id="elh_ck_chitiet_suachua_tennhanvien" class="ck_chitiet_suachua_tennhanvien">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_grid->tennhanvien->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_chitiet_suachua_grid->tennhanvien->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_chitiet_suachua_grid->tennhanvien->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_chitiet_suachua_grid->nhan_vien_id->Visible) { // nhan_vien_id ?>
	<?php if ($ck_chitiet_suachua_grid->SortUrl($ck_chitiet_suachua_grid->nhan_vien_id) == "") { ?>
		<th data-name="nhan_vien_id" class="<?php echo $ck_chitiet_suachua_grid->nhan_vien_id->headerCellClass() ?>"><div id="elh_ck_chitiet_suachua_nhan_vien_id" class="ck_chitiet_suachua_nhan_vien_id"><div class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_grid->nhan_vien_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nhan_vien_id" class="<?php echo $ck_chitiet_suachua_grid->nhan_vien_id->headerCellClass() ?>"><div><div id="elh_ck_chitiet_suachua_nhan_vien_id" class="ck_chitiet_suachua_nhan_vien_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_grid->nhan_vien_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_chitiet_suachua_grid->nhan_vien_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_chitiet_suachua_grid->nhan_vien_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_chitiet_suachua_grid->chuc_danh->Visible) { // chuc_danh ?>
	<?php if ($ck_chitiet_suachua_grid->SortUrl($ck_chitiet_suachua_grid->chuc_danh) == "") { ?>
		<th data-name="chuc_danh" class="<?php echo $ck_chitiet_suachua_grid->chuc_danh->headerCellClass() ?>"><div id="elh_ck_chitiet_suachua_chuc_danh" class="ck_chitiet_suachua_chuc_danh"><div class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_grid->chuc_danh->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="chuc_danh" class="<?php echo $ck_chitiet_suachua_grid->chuc_danh->headerCellClass() ?>"><div><div id="elh_ck_chitiet_suachua_chuc_danh" class="ck_chitiet_suachua_chuc_danh">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_grid->chuc_danh->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_chitiet_suachua_grid->chuc_danh->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_chitiet_suachua_grid->chuc_danh->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_chitiet_suachua_grid->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<?php if ($ck_chitiet_suachua_grid->SortUrl($ck_chitiet_suachua_grid->ngay_sua_chua) == "") { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_chitiet_suachua_grid->ngay_sua_chua->headerCellClass() ?>"><div id="elh_ck_chitiet_suachua_ngay_sua_chua" class="ck_chitiet_suachua_ngay_sua_chua"><div class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_grid->ngay_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_chitiet_suachua_grid->ngay_sua_chua->headerCellClass() ?>"><div><div id="elh_ck_chitiet_suachua_ngay_sua_chua" class="ck_chitiet_suachua_ngay_sua_chua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_grid->ngay_sua_chua->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_chitiet_suachua_grid->ngay_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_chitiet_suachua_grid->ngay_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_chitiet_suachua_grid->thoi_gian->Visible) { // thoi_gian ?>
	<?php if ($ck_chitiet_suachua_grid->SortUrl($ck_chitiet_suachua_grid->thoi_gian) == "") { ?>
		<th data-name="thoi_gian" class="<?php echo $ck_chitiet_suachua_grid->thoi_gian->headerCellClass() ?>"><div id="elh_ck_chitiet_suachua_thoi_gian" class="ck_chitiet_suachua_thoi_gian"><div class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_grid->thoi_gian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="thoi_gian" class="<?php echo $ck_chitiet_suachua_grid->thoi_gian->headerCellClass() ?>"><div><div id="elh_ck_chitiet_suachua_thoi_gian" class="ck_chitiet_suachua_thoi_gian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_grid->thoi_gian->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_chitiet_suachua_grid->thoi_gian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_chitiet_suachua_grid->thoi_gian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_chitiet_suachua_grid->noi_dung->Visible) { // noi_dung ?>
	<?php if ($ck_chitiet_suachua_grid->SortUrl($ck_chitiet_suachua_grid->noi_dung) == "") { ?>
		<th data-name="noi_dung" class="<?php echo $ck_chitiet_suachua_grid->noi_dung->headerCellClass() ?>"><div id="elh_ck_chitiet_suachua_noi_dung" class="ck_chitiet_suachua_noi_dung"><div class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_grid->noi_dung->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="noi_dung" class="<?php echo $ck_chitiet_suachua_grid->noi_dung->headerCellClass() ?>"><div><div id="elh_ck_chitiet_suachua_noi_dung" class="ck_chitiet_suachua_noi_dung">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_grid->noi_dung->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_chitiet_suachua_grid->noi_dung->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_chitiet_suachua_grid->noi_dung->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ck_chitiet_suachua_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$ck_chitiet_suachua_grid->StartRecord = 1;
$ck_chitiet_suachua_grid->StopRecord = $ck_chitiet_suachua_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($ck_chitiet_suachua->isConfirm() || $ck_chitiet_suachua_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($ck_chitiet_suachua_grid->FormKeyCountName) && ($ck_chitiet_suachua_grid->isGridAdd() || $ck_chitiet_suachua_grid->isGridEdit() || $ck_chitiet_suachua->isConfirm())) {
		$ck_chitiet_suachua_grid->KeyCount = $CurrentForm->getValue($ck_chitiet_suachua_grid->FormKeyCountName);
		$ck_chitiet_suachua_grid->StopRecord = $ck_chitiet_suachua_grid->StartRecord + $ck_chitiet_suachua_grid->KeyCount - 1;
	}
}
$ck_chitiet_suachua_grid->RecordCount = $ck_chitiet_suachua_grid->StartRecord - 1;
if ($ck_chitiet_suachua_grid->Recordset && !$ck_chitiet_suachua_grid->Recordset->EOF) {
	$ck_chitiet_suachua_grid->Recordset->moveFirst();
	$selectLimit = $ck_chitiet_suachua_grid->UseSelectLimit;
	if (!$selectLimit && $ck_chitiet_suachua_grid->StartRecord > 1)
		$ck_chitiet_suachua_grid->Recordset->move($ck_chitiet_suachua_grid->StartRecord - 1);
} elseif (!$ck_chitiet_suachua->AllowAddDeleteRow && $ck_chitiet_suachua_grid->StopRecord == 0) {
	$ck_chitiet_suachua_grid->StopRecord = $ck_chitiet_suachua->GridAddRowCount;
}

// Initialize aggregate
$ck_chitiet_suachua->RowType = ROWTYPE_AGGREGATEINIT;
$ck_chitiet_suachua->resetAttributes();
$ck_chitiet_suachua_grid->renderRow();
if ($ck_chitiet_suachua_grid->isGridAdd())
	$ck_chitiet_suachua_grid->RowIndex = 0;
if ($ck_chitiet_suachua_grid->isGridEdit())
	$ck_chitiet_suachua_grid->RowIndex = 0;
while ($ck_chitiet_suachua_grid->RecordCount < $ck_chitiet_suachua_grid->StopRecord) {
	$ck_chitiet_suachua_grid->RecordCount++;
	if ($ck_chitiet_suachua_grid->RecordCount >= $ck_chitiet_suachua_grid->StartRecord) {
		$ck_chitiet_suachua_grid->RowCount++;
		if ($ck_chitiet_suachua_grid->isGridAdd() || $ck_chitiet_suachua_grid->isGridEdit() || $ck_chitiet_suachua->isConfirm()) {
			$ck_chitiet_suachua_grid->RowIndex++;
			$CurrentForm->Index = $ck_chitiet_suachua_grid->RowIndex;
			if ($CurrentForm->hasValue($ck_chitiet_suachua_grid->FormActionName) && ($ck_chitiet_suachua->isConfirm() || $ck_chitiet_suachua_grid->EventCancelled))
				$ck_chitiet_suachua_grid->RowAction = strval($CurrentForm->getValue($ck_chitiet_suachua_grid->FormActionName));
			elseif ($ck_chitiet_suachua_grid->isGridAdd())
				$ck_chitiet_suachua_grid->RowAction = "insert";
			else
				$ck_chitiet_suachua_grid->RowAction = "";
		}

		// Set up key count
		$ck_chitiet_suachua_grid->KeyCount = $ck_chitiet_suachua_grid->RowIndex;

		// Init row class and style
		$ck_chitiet_suachua->resetAttributes();
		$ck_chitiet_suachua->CssClass = "";
		if ($ck_chitiet_suachua_grid->isGridAdd()) {
			if ($ck_chitiet_suachua->CurrentMode == "copy") {
				$ck_chitiet_suachua_grid->loadRowValues($ck_chitiet_suachua_grid->Recordset); // Load row values
				$ck_chitiet_suachua_grid->setRecordKey($ck_chitiet_suachua_grid->RowOldKey, $ck_chitiet_suachua_grid->Recordset); // Set old record key
			} else {
				$ck_chitiet_suachua_grid->loadRowValues(); // Load default values
				$ck_chitiet_suachua_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$ck_chitiet_suachua_grid->loadRowValues($ck_chitiet_suachua_grid->Recordset); // Load row values
		}
		$ck_chitiet_suachua->RowType = ROWTYPE_VIEW; // Render view
		if ($ck_chitiet_suachua_grid->isGridAdd()) // Grid add
			$ck_chitiet_suachua->RowType = ROWTYPE_ADD; // Render add
		if ($ck_chitiet_suachua_grid->isGridAdd() && $ck_chitiet_suachua->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$ck_chitiet_suachua_grid->restoreCurrentRowFormValues($ck_chitiet_suachua_grid->RowIndex); // Restore form values
		if ($ck_chitiet_suachua_grid->isGridEdit()) { // Grid edit
			if ($ck_chitiet_suachua->EventCancelled)
				$ck_chitiet_suachua_grid->restoreCurrentRowFormValues($ck_chitiet_suachua_grid->RowIndex); // Restore form values
			if ($ck_chitiet_suachua_grid->RowAction == "insert")
				$ck_chitiet_suachua->RowType = ROWTYPE_ADD; // Render add
			else
				$ck_chitiet_suachua->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($ck_chitiet_suachua_grid->isGridEdit() && ($ck_chitiet_suachua->RowType == ROWTYPE_EDIT || $ck_chitiet_suachua->RowType == ROWTYPE_ADD) && $ck_chitiet_suachua->EventCancelled) // Update failed
			$ck_chitiet_suachua_grid->restoreCurrentRowFormValues($ck_chitiet_suachua_grid->RowIndex); // Restore form values
		if ($ck_chitiet_suachua->RowType == ROWTYPE_EDIT) // Edit row
			$ck_chitiet_suachua_grid->EditRowCount++;
		if ($ck_chitiet_suachua->isConfirm()) // Confirm row
			$ck_chitiet_suachua_grid->restoreCurrentRowFormValues($ck_chitiet_suachua_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$ck_chitiet_suachua->RowAttrs->merge(["data-rowindex" => $ck_chitiet_suachua_grid->RowCount, "id" => "r" . $ck_chitiet_suachua_grid->RowCount . "_ck_chitiet_suachua", "data-rowtype" => $ck_chitiet_suachua->RowType]);

		// Render row
		$ck_chitiet_suachua_grid->renderRow();

		// Render list options
		$ck_chitiet_suachua_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($ck_chitiet_suachua_grid->RowAction != "delete" && $ck_chitiet_suachua_grid->RowAction != "insertdelete" && !($ck_chitiet_suachua_grid->RowAction == "insert" && $ck_chitiet_suachua->isConfirm() && $ck_chitiet_suachua_grid->emptyRow())) {
?>
	<tr <?php echo $ck_chitiet_suachua->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_chitiet_suachua_grid->ListOptions->render("body", "left", $ck_chitiet_suachua_grid->RowCount);
?>
	<?php if ($ck_chitiet_suachua_grid->tennhanvien->Visible) { // tennhanvien ?>
		<td data-name="tennhanvien" <?php echo $ck_chitiet_suachua_grid->tennhanvien->cellAttributes() ?>>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_tennhanvien" class="form-group">
<?php
$onchange = $ck_chitiet_suachua_grid->tennhanvien->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_chitiet_suachua_grid->tennhanvien->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" id="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" value="<?php echo RemoveHtml($ck_chitiet_suachua_grid->tennhanvien->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->getPlaceHolder()) ?>"<?php echo $ck_chitiet_suachua_grid->tennhanvien->editAttributes() ?>>
		<?php if (AllowAdd(CurrentProjectID() . "nhan_vien") && !$ck_chitiet_suachua_grid->tennhanvien->ReadOnly) { ?>
		<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $ck_chitiet_suachua_grid->tennhanvien->caption() ?>" data-title="<?php echo $ck_chitiet_suachua_grid->tennhanvien->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien',url:'nhan_vienaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
		<?php } ?>
	</div>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_tennhanvien" data-value-separator="<?php echo $ck_chitiet_suachua_grid->tennhanvien->displayValueSeparatorAttribute() ?>" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_chitiet_suachuagrid"], function() {
	fck_chitiet_suachuagrid.createAutoSuggest({"id":"x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien","forceSelect":false});
});
</script>
<?php echo $ck_chitiet_suachua_grid->tennhanvien->Lookup->getParamTag($ck_chitiet_suachua_grid, "p_x" . $ck_chitiet_suachua_grid->RowIndex . "_tennhanvien") ?>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_tennhanvien" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->OldValue) ?>">
<?php } ?>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_tennhanvien" class="form-group">
<?php
$onchange = $ck_chitiet_suachua_grid->tennhanvien->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_chitiet_suachua_grid->tennhanvien->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" id="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" value="<?php echo RemoveHtml($ck_chitiet_suachua_grid->tennhanvien->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->getPlaceHolder()) ?>"<?php echo $ck_chitiet_suachua_grid->tennhanvien->editAttributes() ?>>
		<?php if (AllowAdd(CurrentProjectID() . "nhan_vien") && !$ck_chitiet_suachua_grid->tennhanvien->ReadOnly) { ?>
		<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $ck_chitiet_suachua_grid->tennhanvien->caption() ?>" data-title="<?php echo $ck_chitiet_suachua_grid->tennhanvien->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien',url:'nhan_vienaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
		<?php } ?>
	</div>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_tennhanvien" data-value-separator="<?php echo $ck_chitiet_suachua_grid->tennhanvien->displayValueSeparatorAttribute() ?>" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_chitiet_suachuagrid"], function() {
	fck_chitiet_suachuagrid.createAutoSuggest({"id":"x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien","forceSelect":false});
});
</script>
<?php echo $ck_chitiet_suachua_grid->tennhanvien->Lookup->getParamTag($ck_chitiet_suachua_grid, "p_x" . $ck_chitiet_suachua_grid->RowIndex . "_tennhanvien") ?>
</span>
<?php } ?>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_tennhanvien">
<span<?php echo $ck_chitiet_suachua_grid->tennhanvien->viewAttributes() ?>><?php echo $ck_chitiet_suachua_grid->tennhanvien->getViewValue() ?></span>
</span>
<?php if (!$ck_chitiet_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_tennhanvien" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->FormValue) ?>">
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_tennhanvien" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_tennhanvien" name="fck_chitiet_suachuagrid$x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" id="fck_chitiet_suachuagrid$x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->FormValue) ?>">
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_tennhanvien" name="fck_chitiet_suachuagrid$o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" id="fck_chitiet_suachuagrid$o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_id" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_id" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_id" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_id" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_EDIT || $ck_chitiet_suachua->CurrentMode == "edit") { ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_id" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_id" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($ck_chitiet_suachua_grid->nhan_vien_id->Visible) { // nhan_vien_id ?>
		<td data-name="nhan_vien_id" <?php echo $ck_chitiet_suachua_grid->nhan_vien_id->cellAttributes() ?>>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_nhan_vien_id" class="form-group">
<?php
$onchange = $ck_chitiet_suachua_grid->nhan_vien_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_chitiet_suachua_grid->nhan_vien_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id">
	<input type="text" class="form-control" name="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" id="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" value="<?php echo RemoveHtml($ck_chitiet_suachua_grid->nhan_vien_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->getPlaceHolder()) ?>"<?php echo $ck_chitiet_suachua_grid->nhan_vien_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_nhan_vien_id" data-value-separator="<?php echo $ck_chitiet_suachua_grid->nhan_vien_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_chitiet_suachuagrid"], function() {
	fck_chitiet_suachuagrid.createAutoSuggest({"id":"x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id","forceSelect":false});
});
</script>
<?php echo $ck_chitiet_suachua_grid->nhan_vien_id->Lookup->getParamTag($ck_chitiet_suachua_grid, "p_x" . $ck_chitiet_suachua_grid->RowIndex . "_nhan_vien_id") ?>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_nhan_vien_id" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->OldValue) ?>">
<?php } ?>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_nhan_vien_id" class="form-group">
<?php
$onchange = $ck_chitiet_suachua_grid->nhan_vien_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_chitiet_suachua_grid->nhan_vien_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id">
	<input type="text" class="form-control" name="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" id="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" value="<?php echo RemoveHtml($ck_chitiet_suachua_grid->nhan_vien_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->getPlaceHolder()) ?>"<?php echo $ck_chitiet_suachua_grid->nhan_vien_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_nhan_vien_id" data-value-separator="<?php echo $ck_chitiet_suachua_grid->nhan_vien_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_chitiet_suachuagrid"], function() {
	fck_chitiet_suachuagrid.createAutoSuggest({"id":"x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id","forceSelect":false});
});
</script>
<?php echo $ck_chitiet_suachua_grid->nhan_vien_id->Lookup->getParamTag($ck_chitiet_suachua_grid, "p_x" . $ck_chitiet_suachua_grid->RowIndex . "_nhan_vien_id") ?>
</span>
<?php } ?>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_nhan_vien_id">
<span<?php echo $ck_chitiet_suachua_grid->nhan_vien_id->viewAttributes() ?>><?php echo $ck_chitiet_suachua_grid->nhan_vien_id->getViewValue() ?></span>
</span>
<?php if (!$ck_chitiet_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_nhan_vien_id" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->FormValue) ?>">
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_nhan_vien_id" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_nhan_vien_id" name="fck_chitiet_suachuagrid$x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" id="fck_chitiet_suachuagrid$x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->FormValue) ?>">
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_nhan_vien_id" name="fck_chitiet_suachuagrid$o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" id="fck_chitiet_suachuagrid$o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_chitiet_suachua_grid->chuc_danh->Visible) { // chuc_danh ?>
		<td data-name="chuc_danh" <?php echo $ck_chitiet_suachua_grid->chuc_danh->cellAttributes() ?>>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_chuc_danh" class="form-group">
<?php
$onchange = $ck_chitiet_suachua_grid->chuc_danh->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_chitiet_suachua_grid->chuc_danh->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh">
	<input type="text" class="form-control" name="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" id="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" value="<?php echo RemoveHtml($ck_chitiet_suachua_grid->chuc_danh->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->chuc_danh->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->chuc_danh->getPlaceHolder()) ?>"<?php echo $ck_chitiet_suachua_grid->chuc_danh->editAttributes() ?>>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_chuc_danh" data-value-separator="<?php echo $ck_chitiet_suachua_grid->chuc_danh->displayValueSeparatorAttribute() ?>" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->chuc_danh->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_chitiet_suachuagrid"], function() {
	fck_chitiet_suachuagrid.createAutoSuggest({"id":"x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh","forceSelect":false});
});
</script>
<?php echo $ck_chitiet_suachua_grid->chuc_danh->Lookup->getParamTag($ck_chitiet_suachua_grid, "p_x" . $ck_chitiet_suachua_grid->RowIndex . "_chuc_danh") ?>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_chuc_danh" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->chuc_danh->OldValue) ?>">
<?php } ?>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_chuc_danh" class="form-group">
<span<?php echo $ck_chitiet_suachua_grid->chuc_danh->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_chitiet_suachua_grid->chuc_danh->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_chuc_danh" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->chuc_danh->CurrentValue) ?>">
<?php } ?>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_chuc_danh">
<span<?php echo $ck_chitiet_suachua_grid->chuc_danh->viewAttributes() ?>><?php echo $ck_chitiet_suachua_grid->chuc_danh->getViewValue() ?></span>
</span>
<?php if (!$ck_chitiet_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_chuc_danh" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->chuc_danh->FormValue) ?>">
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_chuc_danh" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->chuc_danh->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_chuc_danh" name="fck_chitiet_suachuagrid$x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" id="fck_chitiet_suachuagrid$x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->chuc_danh->FormValue) ?>">
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_chuc_danh" name="fck_chitiet_suachuagrid$o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" id="fck_chitiet_suachuagrid$o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->chuc_danh->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_chitiet_suachua_grid->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td data-name="ngay_sua_chua" <?php echo $ck_chitiet_suachua_grid->ngay_sua_chua->cellAttributes() ?>>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_ngay_sua_chua" class="form-group">
<input type="text" data-table="ck_chitiet_suachua" data-field="x_ngay_sua_chua" data-format="7" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_chitiet_suachua_grid->ngay_sua_chua->EditValue ?>"<?php echo $ck_chitiet_suachua_grid->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_chitiet_suachua_grid->ngay_sua_chua->ReadOnly && !$ck_chitiet_suachua_grid->ngay_sua_chua->Disabled && !isset($ck_chitiet_suachua_grid->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_chitiet_suachua_grid->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_chitiet_suachuagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_chitiet_suachuagrid", "x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_ngay_sua_chua" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->ngay_sua_chua->OldValue) ?>">
<?php } ?>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_ngay_sua_chua" class="form-group">
<input type="text" data-table="ck_chitiet_suachua" data-field="x_ngay_sua_chua" data-format="7" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_chitiet_suachua_grid->ngay_sua_chua->EditValue ?>"<?php echo $ck_chitiet_suachua_grid->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_chitiet_suachua_grid->ngay_sua_chua->ReadOnly && !$ck_chitiet_suachua_grid->ngay_sua_chua->Disabled && !isset($ck_chitiet_suachua_grid->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_chitiet_suachua_grid->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_chitiet_suachuagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_chitiet_suachuagrid", "x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_ngay_sua_chua">
<span<?php echo $ck_chitiet_suachua_grid->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_chitiet_suachua_grid->ngay_sua_chua->getViewValue() ?></span>
</span>
<?php if (!$ck_chitiet_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_ngay_sua_chua" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->ngay_sua_chua->FormValue) ?>">
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_ngay_sua_chua" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->ngay_sua_chua->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_ngay_sua_chua" name="fck_chitiet_suachuagrid$x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" id="fck_chitiet_suachuagrid$x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->ngay_sua_chua->FormValue) ?>">
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_ngay_sua_chua" name="fck_chitiet_suachuagrid$o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" id="fck_chitiet_suachuagrid$o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->ngay_sua_chua->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_chitiet_suachua_grid->thoi_gian->Visible) { // thoi_gian ?>
		<td data-name="thoi_gian" <?php echo $ck_chitiet_suachua_grid->thoi_gian->cellAttributes() ?>>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_thoi_gian" class="form-group">
<input type="text" data-table="ck_chitiet_suachua" data-field="x_thoi_gian" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->thoi_gian->getPlaceHolder()) ?>" value="<?php echo $ck_chitiet_suachua_grid->thoi_gian->EditValue ?>"<?php echo $ck_chitiet_suachua_grid->thoi_gian->editAttributes() ?>>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_thoi_gian" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->thoi_gian->OldValue) ?>">
<?php } ?>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_thoi_gian" class="form-group">
<input type="text" data-table="ck_chitiet_suachua" data-field="x_thoi_gian" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->thoi_gian->getPlaceHolder()) ?>" value="<?php echo $ck_chitiet_suachua_grid->thoi_gian->EditValue ?>"<?php echo $ck_chitiet_suachua_grid->thoi_gian->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_thoi_gian">
<span<?php echo $ck_chitiet_suachua_grid->thoi_gian->viewAttributes() ?>><?php echo $ck_chitiet_suachua_grid->thoi_gian->getViewValue() ?></span>
</span>
<?php if (!$ck_chitiet_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_thoi_gian" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->thoi_gian->FormValue) ?>">
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_thoi_gian" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->thoi_gian->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_thoi_gian" name="fck_chitiet_suachuagrid$x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" id="fck_chitiet_suachuagrid$x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->thoi_gian->FormValue) ?>">
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_thoi_gian" name="fck_chitiet_suachuagrid$o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" id="fck_chitiet_suachuagrid$o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->thoi_gian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_chitiet_suachua_grid->noi_dung->Visible) { // noi_dung ?>
		<td data-name="noi_dung" <?php echo $ck_chitiet_suachua_grid->noi_dung->cellAttributes() ?>>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_noi_dung" class="form-group">
<?php $ck_chitiet_suachua_grid->noi_dung->EditAttrs->appendClass("editor"); ?>
<textarea data-table="ck_chitiet_suachua" data-field="x_noi_dung" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->noi_dung->getPlaceHolder()) ?>"<?php echo $ck_chitiet_suachua_grid->noi_dung->editAttributes() ?>><?php echo $ck_chitiet_suachua_grid->noi_dung->EditValue ?></textarea>
<script>
loadjs.ready(["fck_chitiet_suachuagrid", "editor"], function() {
	ew.createEditor("fck_chitiet_suachuagrid", "x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung", 35, 4, <?php echo $ck_chitiet_suachua_grid->noi_dung->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_noi_dung" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->noi_dung->OldValue) ?>">
<?php } ?>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_noi_dung" class="form-group">
<?php $ck_chitiet_suachua_grid->noi_dung->EditAttrs->appendClass("editor"); ?>
<textarea data-table="ck_chitiet_suachua" data-field="x_noi_dung" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->noi_dung->getPlaceHolder()) ?>"<?php echo $ck_chitiet_suachua_grid->noi_dung->editAttributes() ?>><?php echo $ck_chitiet_suachua_grid->noi_dung->EditValue ?></textarea>
<script>
loadjs.ready(["fck_chitiet_suachuagrid", "editor"], function() {
	ew.createEditor("fck_chitiet_suachuagrid", "x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung", 35, 4, <?php echo $ck_chitiet_suachua_grid->noi_dung->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php } ?>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_chitiet_suachua_grid->RowCount ?>_ck_chitiet_suachua_noi_dung">
<span<?php echo $ck_chitiet_suachua_grid->noi_dung->viewAttributes() ?>><?php echo $ck_chitiet_suachua_grid->noi_dung->getViewValue() ?></span>
</span>
<?php if (!$ck_chitiet_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_noi_dung" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->noi_dung->FormValue) ?>">
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_noi_dung" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->noi_dung->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_noi_dung" name="fck_chitiet_suachuagrid$x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" id="fck_chitiet_suachuagrid$x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->noi_dung->FormValue) ?>">
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_noi_dung" name="fck_chitiet_suachuagrid$o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" id="fck_chitiet_suachuagrid$o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->noi_dung->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_chitiet_suachua_grid->ListOptions->render("body", "right", $ck_chitiet_suachua_grid->RowCount);
?>
	</tr>
<?php if ($ck_chitiet_suachua->RowType == ROWTYPE_ADD || $ck_chitiet_suachua->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fck_chitiet_suachuagrid", "load"], function() {
	fck_chitiet_suachuagrid.updateLists(<?php echo $ck_chitiet_suachua_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$ck_chitiet_suachua_grid->isGridAdd() || $ck_chitiet_suachua->CurrentMode == "copy")
		if (!$ck_chitiet_suachua_grid->Recordset->EOF)
			$ck_chitiet_suachua_grid->Recordset->moveNext();
}
?>
<?php
	if ($ck_chitiet_suachua->CurrentMode == "add" || $ck_chitiet_suachua->CurrentMode == "copy" || $ck_chitiet_suachua->CurrentMode == "edit") {
		$ck_chitiet_suachua_grid->RowIndex = '$rowindex$';
		$ck_chitiet_suachua_grid->loadRowValues();

		// Set row properties
		$ck_chitiet_suachua->resetAttributes();
		$ck_chitiet_suachua->RowAttrs->merge(["data-rowindex" => $ck_chitiet_suachua_grid->RowIndex, "id" => "r0_ck_chitiet_suachua", "data-rowtype" => ROWTYPE_ADD]);
		$ck_chitiet_suachua->RowAttrs->appendClass("ew-template");
		$ck_chitiet_suachua->RowType = ROWTYPE_ADD;

		// Render row
		$ck_chitiet_suachua_grid->renderRow();

		// Render list options
		$ck_chitiet_suachua_grid->renderListOptions();
		$ck_chitiet_suachua_grid->StartRowCount = 0;
?>
	<tr <?php echo $ck_chitiet_suachua->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_chitiet_suachua_grid->ListOptions->render("body", "left", $ck_chitiet_suachua_grid->RowIndex);
?>
	<?php if ($ck_chitiet_suachua_grid->tennhanvien->Visible) { // tennhanvien ?>
		<td data-name="tennhanvien">
<?php if (!$ck_chitiet_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_chitiet_suachua_tennhanvien" class="form-group ck_chitiet_suachua_tennhanvien">
<?php
$onchange = $ck_chitiet_suachua_grid->tennhanvien->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_chitiet_suachua_grid->tennhanvien->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" id="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" value="<?php echo RemoveHtml($ck_chitiet_suachua_grid->tennhanvien->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->getPlaceHolder()) ?>"<?php echo $ck_chitiet_suachua_grid->tennhanvien->editAttributes() ?>>
		<?php if (AllowAdd(CurrentProjectID() . "nhan_vien") && !$ck_chitiet_suachua_grid->tennhanvien->ReadOnly) { ?>
		<div class="input-group-append"><button type="button" class="btn btn-default ew-add-opt-btn" id="aol_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" title="<?php echo HtmlTitle($Language->phrase("AddLink")) . "&nbsp;" . $ck_chitiet_suachua_grid->tennhanvien->caption() ?>" data-title="<?php echo $ck_chitiet_suachua_grid->tennhanvien->caption() ?>" onclick="ew.addOptionDialogShow({lnk:this,el:'x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien',url:'nhan_vienaddopt.php'});"><i class="fas fa-plus ew-icon"></i></button></div>
		<?php } ?>
	</div>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_tennhanvien" data-value-separator="<?php echo $ck_chitiet_suachua_grid->tennhanvien->displayValueSeparatorAttribute() ?>" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_chitiet_suachuagrid"], function() {
	fck_chitiet_suachuagrid.createAutoSuggest({"id":"x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien","forceSelect":false});
});
</script>
<?php echo $ck_chitiet_suachua_grid->tennhanvien->Lookup->getParamTag($ck_chitiet_suachua_grid, "p_x" . $ck_chitiet_suachua_grid->RowIndex . "_tennhanvien") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_chitiet_suachua_tennhanvien" class="form-group ck_chitiet_suachua_tennhanvien">
<span<?php echo $ck_chitiet_suachua_grid->tennhanvien->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_chitiet_suachua_grid->tennhanvien->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_tennhanvien" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_tennhanvien" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_tennhanvien" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->tennhanvien->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_chitiet_suachua_grid->nhan_vien_id->Visible) { // nhan_vien_id ?>
		<td data-name="nhan_vien_id">
<?php if (!$ck_chitiet_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_chitiet_suachua_nhan_vien_id" class="form-group ck_chitiet_suachua_nhan_vien_id">
<?php
$onchange = $ck_chitiet_suachua_grid->nhan_vien_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_chitiet_suachua_grid->nhan_vien_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id">
	<input type="text" class="form-control" name="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" id="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" value="<?php echo RemoveHtml($ck_chitiet_suachua_grid->nhan_vien_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->getPlaceHolder()) ?>"<?php echo $ck_chitiet_suachua_grid->nhan_vien_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_nhan_vien_id" data-value-separator="<?php echo $ck_chitiet_suachua_grid->nhan_vien_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_chitiet_suachuagrid"], function() {
	fck_chitiet_suachuagrid.createAutoSuggest({"id":"x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id","forceSelect":false});
});
</script>
<?php echo $ck_chitiet_suachua_grid->nhan_vien_id->Lookup->getParamTag($ck_chitiet_suachua_grid, "p_x" . $ck_chitiet_suachua_grid->RowIndex . "_nhan_vien_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_chitiet_suachua_nhan_vien_id" class="form-group ck_chitiet_suachua_nhan_vien_id">
<span<?php echo $ck_chitiet_suachua_grid->nhan_vien_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_chitiet_suachua_grid->nhan_vien_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_nhan_vien_id" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_nhan_vien_id" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->nhan_vien_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_chitiet_suachua_grid->chuc_danh->Visible) { // chuc_danh ?>
		<td data-name="chuc_danh">
<?php if (!$ck_chitiet_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_chitiet_suachua_chuc_danh" class="form-group ck_chitiet_suachua_chuc_danh">
<?php
$onchange = $ck_chitiet_suachua_grid->chuc_danh->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_chitiet_suachua_grid->chuc_danh->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh">
	<input type="text" class="form-control" name="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" id="sv_x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" value="<?php echo RemoveHtml($ck_chitiet_suachua_grid->chuc_danh->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->chuc_danh->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->chuc_danh->getPlaceHolder()) ?>"<?php echo $ck_chitiet_suachua_grid->chuc_danh->editAttributes() ?>>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_chuc_danh" data-value-separator="<?php echo $ck_chitiet_suachua_grid->chuc_danh->displayValueSeparatorAttribute() ?>" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->chuc_danh->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_chitiet_suachuagrid"], function() {
	fck_chitiet_suachuagrid.createAutoSuggest({"id":"x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh","forceSelect":false});
});
</script>
<?php echo $ck_chitiet_suachua_grid->chuc_danh->Lookup->getParamTag($ck_chitiet_suachua_grid, "p_x" . $ck_chitiet_suachua_grid->RowIndex . "_chuc_danh") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_chitiet_suachua_chuc_danh" class="form-group ck_chitiet_suachua_chuc_danh">
<span<?php echo $ck_chitiet_suachua_grid->chuc_danh->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_chitiet_suachua_grid->chuc_danh->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_chuc_danh" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->chuc_danh->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_chuc_danh" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_chuc_danh" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->chuc_danh->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_chitiet_suachua_grid->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td data-name="ngay_sua_chua">
<?php if (!$ck_chitiet_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_chitiet_suachua_ngay_sua_chua" class="form-group ck_chitiet_suachua_ngay_sua_chua">
<input type="text" data-table="ck_chitiet_suachua" data-field="x_ngay_sua_chua" data-format="7" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_chitiet_suachua_grid->ngay_sua_chua->EditValue ?>"<?php echo $ck_chitiet_suachua_grid->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_chitiet_suachua_grid->ngay_sua_chua->ReadOnly && !$ck_chitiet_suachua_grid->ngay_sua_chua->Disabled && !isset($ck_chitiet_suachua_grid->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_chitiet_suachua_grid->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_chitiet_suachuagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_chitiet_suachuagrid", "x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_chitiet_suachua_ngay_sua_chua" class="form-group ck_chitiet_suachua_ngay_sua_chua">
<span<?php echo $ck_chitiet_suachua_grid->ngay_sua_chua->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_chitiet_suachua_grid->ngay_sua_chua->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_ngay_sua_chua" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->ngay_sua_chua->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_ngay_sua_chua" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->ngay_sua_chua->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_chitiet_suachua_grid->thoi_gian->Visible) { // thoi_gian ?>
		<td data-name="thoi_gian">
<?php if (!$ck_chitiet_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_chitiet_suachua_thoi_gian" class="form-group ck_chitiet_suachua_thoi_gian">
<input type="text" data-table="ck_chitiet_suachua" data-field="x_thoi_gian" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->thoi_gian->getPlaceHolder()) ?>" value="<?php echo $ck_chitiet_suachua_grid->thoi_gian->EditValue ?>"<?php echo $ck_chitiet_suachua_grid->thoi_gian->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_chitiet_suachua_thoi_gian" class="form-group ck_chitiet_suachua_thoi_gian">
<span<?php echo $ck_chitiet_suachua_grid->thoi_gian->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_chitiet_suachua_grid->thoi_gian->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_thoi_gian" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->thoi_gian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_thoi_gian" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_thoi_gian" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->thoi_gian->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_chitiet_suachua_grid->noi_dung->Visible) { // noi_dung ?>
		<td data-name="noi_dung">
<?php if (!$ck_chitiet_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_chitiet_suachua_noi_dung" class="form-group ck_chitiet_suachua_noi_dung">
<?php $ck_chitiet_suachua_grid->noi_dung->EditAttrs->appendClass("editor"); ?>
<textarea data-table="ck_chitiet_suachua" data-field="x_noi_dung" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_grid->noi_dung->getPlaceHolder()) ?>"<?php echo $ck_chitiet_suachua_grid->noi_dung->editAttributes() ?>><?php echo $ck_chitiet_suachua_grid->noi_dung->EditValue ?></textarea>
<script>
loadjs.ready(["fck_chitiet_suachuagrid", "editor"], function() {
	ew.createEditor("fck_chitiet_suachuagrid", "x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung", 35, 4, <?php echo $ck_chitiet_suachua_grid->noi_dung->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_chitiet_suachua_noi_dung" class="form-group ck_chitiet_suachua_noi_dung">
<span<?php echo $ck_chitiet_suachua_grid->noi_dung->viewAttributes() ?>><?php echo $ck_chitiet_suachua_grid->noi_dung->ViewValue ?></span>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_noi_dung" name="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" id="x<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->noi_dung->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_noi_dung" name="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" id="o<?php echo $ck_chitiet_suachua_grid->RowIndex ?>_noi_dung" value="<?php echo HtmlEncode($ck_chitiet_suachua_grid->noi_dung->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_chitiet_suachua_grid->ListOptions->render("body", "right", $ck_chitiet_suachua_grid->RowIndex);
?>
<script>
loadjs.ready(["fck_chitiet_suachuagrid", "load"], function() {
	fck_chitiet_suachuagrid.updateLists(<?php echo $ck_chitiet_suachua_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($ck_chitiet_suachua->CurrentMode == "add" || $ck_chitiet_suachua->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $ck_chitiet_suachua_grid->FormKeyCountName ?>" id="<?php echo $ck_chitiet_suachua_grid->FormKeyCountName ?>" value="<?php echo $ck_chitiet_suachua_grid->KeyCount ?>">
<?php echo $ck_chitiet_suachua_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ck_chitiet_suachua->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $ck_chitiet_suachua_grid->FormKeyCountName ?>" id="<?php echo $ck_chitiet_suachua_grid->FormKeyCountName ?>" value="<?php echo $ck_chitiet_suachua_grid->KeyCount ?>">
<?php echo $ck_chitiet_suachua_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ck_chitiet_suachua->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fck_chitiet_suachuagrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ck_chitiet_suachua_grid->Recordset)
	$ck_chitiet_suachua_grid->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ck_chitiet_suachua_grid->TotalRecords == 0 && !$ck_chitiet_suachua->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ck_chitiet_suachua_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$ck_chitiet_suachua_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$ck_chitiet_suachua_grid->terminate();
?>