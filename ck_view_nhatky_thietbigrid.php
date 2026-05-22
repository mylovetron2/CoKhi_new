<?php
namespace PHPMaker2020\projectCoKhi;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($ck_view_nhatky_thietbi_grid))
	$ck_view_nhatky_thietbi_grid = new ck_view_nhatky_thietbi_grid();

// Run the page
$ck_view_nhatky_thietbi_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_view_nhatky_thietbi_grid->Page_Render();
?>
<?php if (!$ck_view_nhatky_thietbi_grid->isExport()) { ?>
<script>
var fck_view_nhatky_thietbigrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fck_view_nhatky_thietbigrid = new ew.Form("fck_view_nhatky_thietbigrid", "grid");
	fck_view_nhatky_thietbigrid.formKeyCountName = '<?php echo $ck_view_nhatky_thietbi_grid->FormKeyCountName ?>';

	// Validate form
	fck_view_nhatky_thietbigrid.validate = function() {
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
			<?php if ($ck_view_nhatky_thietbi_grid->nhan_vien_id->Required) { ?>
				elm = this.getElements("x" + infix + "_nhan_vien_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_view_nhatky_thietbi_grid->nhan_vien_id->caption(), $ck_view_nhatky_thietbi_grid->nhan_vien_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_view_nhatky_thietbi_grid->ngay_sua_chua->Required) { ?>
				elm = this.getElements("x" + infix + "_ngay_sua_chua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_view_nhatky_thietbi_grid->ngay_sua_chua->caption(), $ck_view_nhatky_thietbi_grid->ngay_sua_chua->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ngay_sua_chua");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_view_nhatky_thietbi_grid->ngay_sua_chua->errorMessage()) ?>");
			<?php if ($ck_view_nhatky_thietbi_grid->noi_dung->Required) { ?>
				elm = this.getElements("x" + infix + "_noi_dung");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_view_nhatky_thietbi_grid->noi_dung->caption(), $ck_view_nhatky_thietbi_grid->noi_dung->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fck_view_nhatky_thietbigrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "nhan_vien_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "ngay_sua_chua", false)) return false;
		if (ew.valueChanged(fobj, infix, "noi_dung", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fck_view_nhatky_thietbigrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fck_view_nhatky_thietbigrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fck_view_nhatky_thietbigrid.lists["x_nhan_vien_id"] = <?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->Lookup->toClientList($ck_view_nhatky_thietbi_grid) ?>;
	fck_view_nhatky_thietbigrid.lists["x_nhan_vien_id"].options = <?php echo JsonEncode($ck_view_nhatky_thietbi_grid->nhan_vien_id->lookupOptions()) ?>;
	loadjs.done("fck_view_nhatky_thietbigrid");
});
</script>
<?php } ?>
<?php
$ck_view_nhatky_thietbi_grid->renderOtherOptions();
?>
<?php if ($ck_view_nhatky_thietbi_grid->TotalRecords > 0 || $ck_view_nhatky_thietbi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ck_view_nhatky_thietbi_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ck_view_nhatky_thietbi">
<?php if ($ck_view_nhatky_thietbi_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $ck_view_nhatky_thietbi_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fck_view_nhatky_thietbigrid" class="ew-form ew-list-form form-inline">
<div id="gmp_ck_view_nhatky_thietbi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_ck_view_nhatky_thietbigrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ck_view_nhatky_thietbi->RowType = ROWTYPE_HEADER;

// Render list options
$ck_view_nhatky_thietbi_grid->renderListOptions();

// Render list options (header, left)
$ck_view_nhatky_thietbi_grid->ListOptions->render("header", "left");
?>
<?php if ($ck_view_nhatky_thietbi_grid->nhan_vien_id->Visible) { // nhan_vien_id ?>
	<?php if ($ck_view_nhatky_thietbi_grid->SortUrl($ck_view_nhatky_thietbi_grid->nhan_vien_id) == "") { ?>
		<th data-name="nhan_vien_id" class="<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->headerCellClass() ?>"><div id="elh_ck_view_nhatky_thietbi_nhan_vien_id" class="ck_view_nhatky_thietbi_nhan_vien_id"><div class="ew-table-header-caption"><?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nhan_vien_id" class="<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->headerCellClass() ?>"><div><div id="elh_ck_view_nhatky_thietbi_nhan_vien_id" class="ck_view_nhatky_thietbi_nhan_vien_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhatky_thietbi_grid->nhan_vien_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhatky_thietbi_grid->nhan_vien_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_thietbi_grid->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<?php if ($ck_view_nhatky_thietbi_grid->SortUrl($ck_view_nhatky_thietbi_grid->ngay_sua_chua) == "") { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_view_nhatky_thietbi_grid->ngay_sua_chua->headerCellClass() ?>"><div id="elh_ck_view_nhatky_thietbi_ngay_sua_chua" class="ck_view_nhatky_thietbi_ngay_sua_chua"><div class="ew-table-header-caption"><?php echo $ck_view_nhatky_thietbi_grid->ngay_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_view_nhatky_thietbi_grid->ngay_sua_chua->headerCellClass() ?>"><div><div id="elh_ck_view_nhatky_thietbi_ngay_sua_chua" class="ck_view_nhatky_thietbi_ngay_sua_chua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhatky_thietbi_grid->ngay_sua_chua->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhatky_thietbi_grid->ngay_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhatky_thietbi_grid->ngay_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_thietbi_grid->noi_dung->Visible) { // noi_dung ?>
	<?php if ($ck_view_nhatky_thietbi_grid->SortUrl($ck_view_nhatky_thietbi_grid->noi_dung) == "") { ?>
		<th data-name="noi_dung" class="<?php echo $ck_view_nhatky_thietbi_grid->noi_dung->headerCellClass() ?>"><div id="elh_ck_view_nhatky_thietbi_noi_dung" class="ck_view_nhatky_thietbi_noi_dung"><div class="ew-table-header-caption"><?php echo $ck_view_nhatky_thietbi_grid->noi_dung->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="noi_dung" class="<?php echo $ck_view_nhatky_thietbi_grid->noi_dung->headerCellClass() ?>"><div><div id="elh_ck_view_nhatky_thietbi_noi_dung" class="ck_view_nhatky_thietbi_noi_dung">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhatky_thietbi_grid->noi_dung->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhatky_thietbi_grid->noi_dung->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhatky_thietbi_grid->noi_dung->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ck_view_nhatky_thietbi_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$ck_view_nhatky_thietbi_grid->StartRecord = 1;
$ck_view_nhatky_thietbi_grid->StopRecord = $ck_view_nhatky_thietbi_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($ck_view_nhatky_thietbi->isConfirm() || $ck_view_nhatky_thietbi_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($ck_view_nhatky_thietbi_grid->FormKeyCountName) && ($ck_view_nhatky_thietbi_grid->isGridAdd() || $ck_view_nhatky_thietbi_grid->isGridEdit() || $ck_view_nhatky_thietbi->isConfirm())) {
		$ck_view_nhatky_thietbi_grid->KeyCount = $CurrentForm->getValue($ck_view_nhatky_thietbi_grid->FormKeyCountName);
		$ck_view_nhatky_thietbi_grid->StopRecord = $ck_view_nhatky_thietbi_grid->StartRecord + $ck_view_nhatky_thietbi_grid->KeyCount - 1;
	}
}
$ck_view_nhatky_thietbi_grid->RecordCount = $ck_view_nhatky_thietbi_grid->StartRecord - 1;
if ($ck_view_nhatky_thietbi_grid->Recordset && !$ck_view_nhatky_thietbi_grid->Recordset->EOF) {
	$ck_view_nhatky_thietbi_grid->Recordset->moveFirst();
	$selectLimit = $ck_view_nhatky_thietbi_grid->UseSelectLimit;
	if (!$selectLimit && $ck_view_nhatky_thietbi_grid->StartRecord > 1)
		$ck_view_nhatky_thietbi_grid->Recordset->move($ck_view_nhatky_thietbi_grid->StartRecord - 1);
} elseif (!$ck_view_nhatky_thietbi->AllowAddDeleteRow && $ck_view_nhatky_thietbi_grid->StopRecord == 0) {
	$ck_view_nhatky_thietbi_grid->StopRecord = $ck_view_nhatky_thietbi->GridAddRowCount;
}

// Initialize aggregate
$ck_view_nhatky_thietbi->RowType = ROWTYPE_AGGREGATEINIT;
$ck_view_nhatky_thietbi->resetAttributes();
$ck_view_nhatky_thietbi_grid->renderRow();
if ($ck_view_nhatky_thietbi_grid->isGridAdd())
	$ck_view_nhatky_thietbi_grid->RowIndex = 0;
if ($ck_view_nhatky_thietbi_grid->isGridEdit())
	$ck_view_nhatky_thietbi_grid->RowIndex = 0;
while ($ck_view_nhatky_thietbi_grid->RecordCount < $ck_view_nhatky_thietbi_grid->StopRecord) {
	$ck_view_nhatky_thietbi_grid->RecordCount++;
	if ($ck_view_nhatky_thietbi_grid->RecordCount >= $ck_view_nhatky_thietbi_grid->StartRecord) {
		$ck_view_nhatky_thietbi_grid->RowCount++;
		if ($ck_view_nhatky_thietbi_grid->isGridAdd() || $ck_view_nhatky_thietbi_grid->isGridEdit() || $ck_view_nhatky_thietbi->isConfirm()) {
			$ck_view_nhatky_thietbi_grid->RowIndex++;
			$CurrentForm->Index = $ck_view_nhatky_thietbi_grid->RowIndex;
			if ($CurrentForm->hasValue($ck_view_nhatky_thietbi_grid->FormActionName) && ($ck_view_nhatky_thietbi->isConfirm() || $ck_view_nhatky_thietbi_grid->EventCancelled))
				$ck_view_nhatky_thietbi_grid->RowAction = strval($CurrentForm->getValue($ck_view_nhatky_thietbi_grid->FormActionName));
			elseif ($ck_view_nhatky_thietbi_grid->isGridAdd())
				$ck_view_nhatky_thietbi_grid->RowAction = "insert";
			else
				$ck_view_nhatky_thietbi_grid->RowAction = "";
		}

		// Set up key count
		$ck_view_nhatky_thietbi_grid->KeyCount = $ck_view_nhatky_thietbi_grid->RowIndex;

		// Init row class and style
		$ck_view_nhatky_thietbi->resetAttributes();
		$ck_view_nhatky_thietbi->CssClass = "";
		if ($ck_view_nhatky_thietbi_grid->isGridAdd()) {
			if ($ck_view_nhatky_thietbi->CurrentMode == "copy") {
				$ck_view_nhatky_thietbi_grid->loadRowValues($ck_view_nhatky_thietbi_grid->Recordset); // Load row values
				$ck_view_nhatky_thietbi_grid->setRecordKey($ck_view_nhatky_thietbi_grid->RowOldKey, $ck_view_nhatky_thietbi_grid->Recordset); // Set old record key
			} else {
				$ck_view_nhatky_thietbi_grid->loadRowValues(); // Load default values
				$ck_view_nhatky_thietbi_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$ck_view_nhatky_thietbi_grid->loadRowValues($ck_view_nhatky_thietbi_grid->Recordset); // Load row values
		}
		$ck_view_nhatky_thietbi->RowType = ROWTYPE_VIEW; // Render view
		if ($ck_view_nhatky_thietbi_grid->isGridAdd()) // Grid add
			$ck_view_nhatky_thietbi->RowType = ROWTYPE_ADD; // Render add
		if ($ck_view_nhatky_thietbi_grid->isGridAdd() && $ck_view_nhatky_thietbi->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$ck_view_nhatky_thietbi_grid->restoreCurrentRowFormValues($ck_view_nhatky_thietbi_grid->RowIndex); // Restore form values
		if ($ck_view_nhatky_thietbi_grid->isGridEdit()) { // Grid edit
			if ($ck_view_nhatky_thietbi->EventCancelled)
				$ck_view_nhatky_thietbi_grid->restoreCurrentRowFormValues($ck_view_nhatky_thietbi_grid->RowIndex); // Restore form values
			if ($ck_view_nhatky_thietbi_grid->RowAction == "insert")
				$ck_view_nhatky_thietbi->RowType = ROWTYPE_ADD; // Render add
			else
				$ck_view_nhatky_thietbi->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($ck_view_nhatky_thietbi_grid->isGridEdit() && ($ck_view_nhatky_thietbi->RowType == ROWTYPE_EDIT || $ck_view_nhatky_thietbi->RowType == ROWTYPE_ADD) && $ck_view_nhatky_thietbi->EventCancelled) // Update failed
			$ck_view_nhatky_thietbi_grid->restoreCurrentRowFormValues($ck_view_nhatky_thietbi_grid->RowIndex); // Restore form values
		if ($ck_view_nhatky_thietbi->RowType == ROWTYPE_EDIT) // Edit row
			$ck_view_nhatky_thietbi_grid->EditRowCount++;
		if ($ck_view_nhatky_thietbi->isConfirm()) // Confirm row
			$ck_view_nhatky_thietbi_grid->restoreCurrentRowFormValues($ck_view_nhatky_thietbi_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$ck_view_nhatky_thietbi->RowAttrs->merge(["data-rowindex" => $ck_view_nhatky_thietbi_grid->RowCount, "id" => "r" . $ck_view_nhatky_thietbi_grid->RowCount . "_ck_view_nhatky_thietbi", "data-rowtype" => $ck_view_nhatky_thietbi->RowType]);

		// Render row
		$ck_view_nhatky_thietbi_grid->renderRow();

		// Render list options
		$ck_view_nhatky_thietbi_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($ck_view_nhatky_thietbi_grid->RowAction != "delete" && $ck_view_nhatky_thietbi_grid->RowAction != "insertdelete" && !($ck_view_nhatky_thietbi_grid->RowAction == "insert" && $ck_view_nhatky_thietbi->isConfirm() && $ck_view_nhatky_thietbi_grid->emptyRow())) {
?>
	<tr <?php echo $ck_view_nhatky_thietbi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_view_nhatky_thietbi_grid->ListOptions->render("body", "left", $ck_view_nhatky_thietbi_grid->RowCount);
?>
	<?php if ($ck_view_nhatky_thietbi_grid->nhan_vien_id->Visible) { // nhan_vien_id ?>
		<td data-name="nhan_vien_id" <?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->cellAttributes() ?>>
<?php if ($ck_view_nhatky_thietbi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_view_nhatky_thietbi_grid->RowCount ?>_ck_view_nhatky_thietbi_nhan_vien_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_view_nhatky_thietbi" data-field="x_nhan_vien_id" data-value-separator="<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id"<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->editAttributes() ?>>
			<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->selectOptionListHtml("x{$ck_view_nhatky_thietbi_grid->RowIndex}_nhan_vien_id") ?>
		</select>
</div>
<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->Lookup->getParamTag($ck_view_nhatky_thietbi_grid, "p_x" . $ck_view_nhatky_thietbi_grid->RowIndex . "_nhan_vien_id") ?>
</span>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_nhan_vien_id" name="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" id="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->nhan_vien_id->OldValue) ?>">
<?php } ?>
<?php if ($ck_view_nhatky_thietbi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_view_nhatky_thietbi_grid->RowCount ?>_ck_view_nhatky_thietbi_nhan_vien_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_view_nhatky_thietbi" data-field="x_nhan_vien_id" data-value-separator="<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id"<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->editAttributes() ?>>
			<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->selectOptionListHtml("x{$ck_view_nhatky_thietbi_grid->RowIndex}_nhan_vien_id") ?>
		</select>
</div>
<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->Lookup->getParamTag($ck_view_nhatky_thietbi_grid, "p_x" . $ck_view_nhatky_thietbi_grid->RowIndex . "_nhan_vien_id") ?>
</span>
<?php } ?>
<?php if ($ck_view_nhatky_thietbi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_view_nhatky_thietbi_grid->RowCount ?>_ck_view_nhatky_thietbi_nhan_vien_id">
<span<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->viewAttributes() ?>><?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->getViewValue() ?></span>
</span>
<?php if (!$ck_view_nhatky_thietbi->isConfirm()) { ?>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_nhan_vien_id" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->nhan_vien_id->FormValue) ?>">
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_nhan_vien_id" name="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" id="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->nhan_vien_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_nhan_vien_id" name="fck_view_nhatky_thietbigrid$x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" id="fck_view_nhatky_thietbigrid$x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->nhan_vien_id->FormValue) ?>">
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_nhan_vien_id" name="fck_view_nhatky_thietbigrid$o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" id="fck_view_nhatky_thietbigrid$o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->nhan_vien_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($ck_view_nhatky_thietbi->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_thiet_bi_id" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_thiet_bi_id" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_thiet_bi_id" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->thiet_bi_id->CurrentValue) ?>">
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_thiet_bi_id" name="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_thiet_bi_id" id="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_thiet_bi_id" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->thiet_bi_id->OldValue) ?>">
<?php } ?>
<?php if ($ck_view_nhatky_thietbi->RowType == ROWTYPE_EDIT || $ck_view_nhatky_thietbi->CurrentMode == "edit") { ?>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_thiet_bi_id" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_thiet_bi_id" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_thiet_bi_id" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->thiet_bi_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($ck_view_nhatky_thietbi_grid->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td data-name="ngay_sua_chua" <?php echo $ck_view_nhatky_thietbi_grid->ngay_sua_chua->cellAttributes() ?>>
<?php if ($ck_view_nhatky_thietbi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_view_nhatky_thietbi_grid->RowCount ?>_ck_view_nhatky_thietbi_ngay_sua_chua" class="form-group">
<input type="text" data-table="ck_view_nhatky_thietbi" data-field="x_ngay_sua_chua" data-format="7" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_view_nhatky_thietbi_grid->ngay_sua_chua->EditValue ?>"<?php echo $ck_view_nhatky_thietbi_grid->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_view_nhatky_thietbi_grid->ngay_sua_chua->ReadOnly && !$ck_view_nhatky_thietbi_grid->ngay_sua_chua->Disabled && !isset($ck_view_nhatky_thietbi_grid->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_view_nhatky_thietbi_grid->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_view_nhatky_thietbigrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_view_nhatky_thietbigrid", "x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_ngay_sua_chua" name="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" id="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->ngay_sua_chua->OldValue) ?>">
<?php } ?>
<?php if ($ck_view_nhatky_thietbi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_view_nhatky_thietbi_grid->RowCount ?>_ck_view_nhatky_thietbi_ngay_sua_chua" class="form-group">
<input type="text" data-table="ck_view_nhatky_thietbi" data-field="x_ngay_sua_chua" data-format="7" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_view_nhatky_thietbi_grid->ngay_sua_chua->EditValue ?>"<?php echo $ck_view_nhatky_thietbi_grid->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_view_nhatky_thietbi_grid->ngay_sua_chua->ReadOnly && !$ck_view_nhatky_thietbi_grid->ngay_sua_chua->Disabled && !isset($ck_view_nhatky_thietbi_grid->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_view_nhatky_thietbi_grid->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_view_nhatky_thietbigrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_view_nhatky_thietbigrid", "x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($ck_view_nhatky_thietbi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_view_nhatky_thietbi_grid->RowCount ?>_ck_view_nhatky_thietbi_ngay_sua_chua">
<span<?php echo $ck_view_nhatky_thietbi_grid->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_view_nhatky_thietbi_grid->ngay_sua_chua->getViewValue() ?></span>
</span>
<?php if (!$ck_view_nhatky_thietbi->isConfirm()) { ?>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_ngay_sua_chua" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->ngay_sua_chua->FormValue) ?>">
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_ngay_sua_chua" name="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" id="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->ngay_sua_chua->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_ngay_sua_chua" name="fck_view_nhatky_thietbigrid$x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" id="fck_view_nhatky_thietbigrid$x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->ngay_sua_chua->FormValue) ?>">
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_ngay_sua_chua" name="fck_view_nhatky_thietbigrid$o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" id="fck_view_nhatky_thietbigrid$o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->ngay_sua_chua->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_view_nhatky_thietbi_grid->noi_dung->Visible) { // noi_dung ?>
		<td data-name="noi_dung" <?php echo $ck_view_nhatky_thietbi_grid->noi_dung->cellAttributes() ?>>
<?php if ($ck_view_nhatky_thietbi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_view_nhatky_thietbi_grid->RowCount ?>_ck_view_nhatky_thietbi_noi_dung" class="form-group">
<textarea data-table="ck_view_nhatky_thietbi" data-field="x_noi_dung" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->noi_dung->getPlaceHolder()) ?>"<?php echo $ck_view_nhatky_thietbi_grid->noi_dung->editAttributes() ?>><?php echo $ck_view_nhatky_thietbi_grid->noi_dung->EditValue ?></textarea>
</span>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_noi_dung" name="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" id="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->noi_dung->OldValue) ?>">
<?php } ?>
<?php if ($ck_view_nhatky_thietbi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_view_nhatky_thietbi_grid->RowCount ?>_ck_view_nhatky_thietbi_noi_dung" class="form-group">
<textarea data-table="ck_view_nhatky_thietbi" data-field="x_noi_dung" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->noi_dung->getPlaceHolder()) ?>"<?php echo $ck_view_nhatky_thietbi_grid->noi_dung->editAttributes() ?>><?php echo $ck_view_nhatky_thietbi_grid->noi_dung->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($ck_view_nhatky_thietbi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_view_nhatky_thietbi_grid->RowCount ?>_ck_view_nhatky_thietbi_noi_dung">
<span<?php echo $ck_view_nhatky_thietbi_grid->noi_dung->viewAttributes() ?>><?php echo $ck_view_nhatky_thietbi_grid->noi_dung->getViewValue() ?></span>
</span>
<?php if (!$ck_view_nhatky_thietbi->isConfirm()) { ?>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_noi_dung" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->noi_dung->FormValue) ?>">
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_noi_dung" name="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" id="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->noi_dung->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_noi_dung" name="fck_view_nhatky_thietbigrid$x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" id="fck_view_nhatky_thietbigrid$x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->noi_dung->FormValue) ?>">
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_noi_dung" name="fck_view_nhatky_thietbigrid$o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" id="fck_view_nhatky_thietbigrid$o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->noi_dung->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_view_nhatky_thietbi_grid->ListOptions->render("body", "right", $ck_view_nhatky_thietbi_grid->RowCount);
?>
	</tr>
<?php if ($ck_view_nhatky_thietbi->RowType == ROWTYPE_ADD || $ck_view_nhatky_thietbi->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fck_view_nhatky_thietbigrid", "load"], function() {
	fck_view_nhatky_thietbigrid.updateLists(<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$ck_view_nhatky_thietbi_grid->isGridAdd() || $ck_view_nhatky_thietbi->CurrentMode == "copy")
		if (!$ck_view_nhatky_thietbi_grid->Recordset->EOF)
			$ck_view_nhatky_thietbi_grid->Recordset->moveNext();
}
?>
<?php
	if ($ck_view_nhatky_thietbi->CurrentMode == "add" || $ck_view_nhatky_thietbi->CurrentMode == "copy" || $ck_view_nhatky_thietbi->CurrentMode == "edit") {
		$ck_view_nhatky_thietbi_grid->RowIndex = '$rowindex$';
		$ck_view_nhatky_thietbi_grid->loadRowValues();

		// Set row properties
		$ck_view_nhatky_thietbi->resetAttributes();
		$ck_view_nhatky_thietbi->RowAttrs->merge(["data-rowindex" => $ck_view_nhatky_thietbi_grid->RowIndex, "id" => "r0_ck_view_nhatky_thietbi", "data-rowtype" => ROWTYPE_ADD]);
		$ck_view_nhatky_thietbi->RowAttrs->appendClass("ew-template");
		$ck_view_nhatky_thietbi->RowType = ROWTYPE_ADD;

		// Render row
		$ck_view_nhatky_thietbi_grid->renderRow();

		// Render list options
		$ck_view_nhatky_thietbi_grid->renderListOptions();
		$ck_view_nhatky_thietbi_grid->StartRowCount = 0;
?>
	<tr <?php echo $ck_view_nhatky_thietbi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_view_nhatky_thietbi_grid->ListOptions->render("body", "left", $ck_view_nhatky_thietbi_grid->RowIndex);
?>
	<?php if ($ck_view_nhatky_thietbi_grid->nhan_vien_id->Visible) { // nhan_vien_id ?>
		<td data-name="nhan_vien_id">
<?php if (!$ck_view_nhatky_thietbi->isConfirm()) { ?>
<span id="el$rowindex$_ck_view_nhatky_thietbi_nhan_vien_id" class="form-group ck_view_nhatky_thietbi_nhan_vien_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_view_nhatky_thietbi" data-field="x_nhan_vien_id" data-value-separator="<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id"<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->editAttributes() ?>>
			<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->selectOptionListHtml("x{$ck_view_nhatky_thietbi_grid->RowIndex}_nhan_vien_id") ?>
		</select>
</div>
<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->Lookup->getParamTag($ck_view_nhatky_thietbi_grid, "p_x" . $ck_view_nhatky_thietbi_grid->RowIndex . "_nhan_vien_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_view_nhatky_thietbi_nhan_vien_id" class="form-group ck_view_nhatky_thietbi_nhan_vien_id">
<span<?php echo $ck_view_nhatky_thietbi_grid->nhan_vien_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_view_nhatky_thietbi_grid->nhan_vien_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_nhan_vien_id" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->nhan_vien_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_nhan_vien_id" name="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" id="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_nhan_vien_id" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->nhan_vien_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_view_nhatky_thietbi_grid->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td data-name="ngay_sua_chua">
<?php if (!$ck_view_nhatky_thietbi->isConfirm()) { ?>
<span id="el$rowindex$_ck_view_nhatky_thietbi_ngay_sua_chua" class="form-group ck_view_nhatky_thietbi_ngay_sua_chua">
<input type="text" data-table="ck_view_nhatky_thietbi" data-field="x_ngay_sua_chua" data-format="7" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_view_nhatky_thietbi_grid->ngay_sua_chua->EditValue ?>"<?php echo $ck_view_nhatky_thietbi_grid->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_view_nhatky_thietbi_grid->ngay_sua_chua->ReadOnly && !$ck_view_nhatky_thietbi_grid->ngay_sua_chua->Disabled && !isset($ck_view_nhatky_thietbi_grid->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_view_nhatky_thietbi_grid->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_view_nhatky_thietbigrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_view_nhatky_thietbigrid", "x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_view_nhatky_thietbi_ngay_sua_chua" class="form-group ck_view_nhatky_thietbi_ngay_sua_chua">
<span<?php echo $ck_view_nhatky_thietbi_grid->ngay_sua_chua->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_view_nhatky_thietbi_grid->ngay_sua_chua->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_ngay_sua_chua" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->ngay_sua_chua->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_ngay_sua_chua" name="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" id="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->ngay_sua_chua->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_view_nhatky_thietbi_grid->noi_dung->Visible) { // noi_dung ?>
		<td data-name="noi_dung">
<?php if (!$ck_view_nhatky_thietbi->isConfirm()) { ?>
<span id="el$rowindex$_ck_view_nhatky_thietbi_noi_dung" class="form-group ck_view_nhatky_thietbi_noi_dung">
<textarea data-table="ck_view_nhatky_thietbi" data-field="x_noi_dung" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->noi_dung->getPlaceHolder()) ?>"<?php echo $ck_view_nhatky_thietbi_grid->noi_dung->editAttributes() ?>><?php echo $ck_view_nhatky_thietbi_grid->noi_dung->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_view_nhatky_thietbi_noi_dung" class="form-group ck_view_nhatky_thietbi_noi_dung">
<span<?php echo $ck_view_nhatky_thietbi_grid->noi_dung->viewAttributes() ?>><?php echo $ck_view_nhatky_thietbi_grid->noi_dung->ViewValue ?></span>
</span>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_noi_dung" name="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" id="x<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->noi_dung->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_view_nhatky_thietbi" data-field="x_noi_dung" name="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" id="o<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>_noi_dung" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_grid->noi_dung->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_view_nhatky_thietbi_grid->ListOptions->render("body", "right", $ck_view_nhatky_thietbi_grid->RowIndex);
?>
<script>
loadjs.ready(["fck_view_nhatky_thietbigrid", "load"], function() {
	fck_view_nhatky_thietbigrid.updateLists(<?php echo $ck_view_nhatky_thietbi_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($ck_view_nhatky_thietbi->CurrentMode == "add" || $ck_view_nhatky_thietbi->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $ck_view_nhatky_thietbi_grid->FormKeyCountName ?>" id="<?php echo $ck_view_nhatky_thietbi_grid->FormKeyCountName ?>" value="<?php echo $ck_view_nhatky_thietbi_grid->KeyCount ?>">
<?php echo $ck_view_nhatky_thietbi_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ck_view_nhatky_thietbi->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $ck_view_nhatky_thietbi_grid->FormKeyCountName ?>" id="<?php echo $ck_view_nhatky_thietbi_grid->FormKeyCountName ?>" value="<?php echo $ck_view_nhatky_thietbi_grid->KeyCount ?>">
<?php echo $ck_view_nhatky_thietbi_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ck_view_nhatky_thietbi->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fck_view_nhatky_thietbigrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ck_view_nhatky_thietbi_grid->Recordset)
	$ck_view_nhatky_thietbi_grid->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ck_view_nhatky_thietbi_grid->TotalRecords == 0 && !$ck_view_nhatky_thietbi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ck_view_nhatky_thietbi_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$ck_view_nhatky_thietbi_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$ck_view_nhatky_thietbi_grid->terminate();
?>