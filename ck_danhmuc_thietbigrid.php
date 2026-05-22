<?php
namespace PHPMaker2020\projectCoKhi;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($ck_danhmuc_thietbi_grid))
	$ck_danhmuc_thietbi_grid = new ck_danhmuc_thietbi_grid();

// Run the page
$ck_danhmuc_thietbi_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_danhmuc_thietbi_grid->Page_Render();
?>
<?php if (!$ck_danhmuc_thietbi_grid->isExport()) { ?>
<script>
var fck_danhmuc_thietbigrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fck_danhmuc_thietbigrid = new ew.Form("fck_danhmuc_thietbigrid", "grid");
	fck_danhmuc_thietbigrid.formKeyCountName = '<?php echo $ck_danhmuc_thietbi_grid->FormKeyCountName ?>';

	// Validate form
	fck_danhmuc_thietbigrid.validate = function() {
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
			<?php if ($ck_danhmuc_thietbi_grid->chung_loai_id->Required) { ?>
				elm = this.getElements("x" + infix + "_chung_loai_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_grid->chung_loai_id->caption(), $ck_danhmuc_thietbi_grid->chung_loai_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_thietbi_grid->ky_ma_hieu->Required) { ?>
				elm = this.getElements("x" + infix + "_ky_ma_hieu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_grid->ky_ma_hieu->caption(), $ck_danhmuc_thietbi_grid->ky_ma_hieu->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_thietbi_grid->bo_phan->Required) { ?>
				elm = this.getElements("x" + infix + "_bo_phan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_grid->bo_phan->caption(), $ck_danhmuc_thietbi_grid->bo_phan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_thietbi_grid->namsx->Required) { ?>
				elm = this.getElements("x" + infix + "_namsx");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_grid->namsx->caption(), $ck_danhmuc_thietbi_grid->namsx->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_thietbi_grid->ghi_chu->Required) { ?>
				elm = this.getElements("x" + infix + "_ghi_chu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_grid->ghi_chu->caption(), $ck_danhmuc_thietbi_grid->ghi_chu->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fck_danhmuc_thietbigrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "chung_loai_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "ky_ma_hieu", false)) return false;
		if (ew.valueChanged(fobj, infix, "bo_phan", false)) return false;
		if (ew.valueChanged(fobj, infix, "namsx", false)) return false;
		if (ew.valueChanged(fobj, infix, "ghi_chu", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fck_danhmuc_thietbigrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fck_danhmuc_thietbigrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fck_danhmuc_thietbigrid.lists["x_chung_loai_id"] = <?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->Lookup->toClientList($ck_danhmuc_thietbi_grid) ?>;
	fck_danhmuc_thietbigrid.lists["x_chung_loai_id"].options = <?php echo JsonEncode($ck_danhmuc_thietbi_grid->chung_loai_id->lookupOptions()) ?>;
	loadjs.done("fck_danhmuc_thietbigrid");
});
</script>
<?php } ?>
<?php
$ck_danhmuc_thietbi_grid->renderOtherOptions();
?>
<?php if ($ck_danhmuc_thietbi_grid->TotalRecords > 0 || $ck_danhmuc_thietbi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ck_danhmuc_thietbi_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ck_danhmuc_thietbi">
<?php if ($ck_danhmuc_thietbi_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $ck_danhmuc_thietbi_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fck_danhmuc_thietbigrid" class="ew-form ew-list-form form-inline">
<div id="gmp_ck_danhmuc_thietbi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_ck_danhmuc_thietbigrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ck_danhmuc_thietbi->RowType = ROWTYPE_HEADER;

// Render list options
$ck_danhmuc_thietbi_grid->renderListOptions();

// Render list options (header, left)
$ck_danhmuc_thietbi_grid->ListOptions->render("header", "left");
?>
<?php if ($ck_danhmuc_thietbi_grid->chung_loai_id->Visible) { // chung_loai_id ?>
	<?php if ($ck_danhmuc_thietbi_grid->SortUrl($ck_danhmuc_thietbi_grid->chung_loai_id) == "") { ?>
		<th data-name="chung_loai_id" class="<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->headerCellClass() ?>"><div id="elh_ck_danhmuc_thietbi_chung_loai_id" class="ck_danhmuc_thietbi_chung_loai_id"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="chung_loai_id" class="<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_thietbi_chung_loai_id" class="ck_danhmuc_thietbi_chung_loai_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_thietbi_grid->chung_loai_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_thietbi_grid->chung_loai_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_grid->ky_ma_hieu->Visible) { // ky_ma_hieu ?>
	<?php if ($ck_danhmuc_thietbi_grid->SortUrl($ck_danhmuc_thietbi_grid->ky_ma_hieu) == "") { ?>
		<th data-name="ky_ma_hieu" class="<?php echo $ck_danhmuc_thietbi_grid->ky_ma_hieu->headerCellClass() ?>"><div id="elh_ck_danhmuc_thietbi_ky_ma_hieu" class="ck_danhmuc_thietbi_ky_ma_hieu"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_grid->ky_ma_hieu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ky_ma_hieu" class="<?php echo $ck_danhmuc_thietbi_grid->ky_ma_hieu->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_thietbi_ky_ma_hieu" class="ck_danhmuc_thietbi_ky_ma_hieu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_grid->ky_ma_hieu->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_thietbi_grid->ky_ma_hieu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_thietbi_grid->ky_ma_hieu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_grid->bo_phan->Visible) { // bo_phan ?>
	<?php if ($ck_danhmuc_thietbi_grid->SortUrl($ck_danhmuc_thietbi_grid->bo_phan) == "") { ?>
		<th data-name="bo_phan" class="<?php echo $ck_danhmuc_thietbi_grid->bo_phan->headerCellClass() ?>"><div id="elh_ck_danhmuc_thietbi_bo_phan" class="ck_danhmuc_thietbi_bo_phan"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_grid->bo_phan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bo_phan" class="<?php echo $ck_danhmuc_thietbi_grid->bo_phan->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_thietbi_bo_phan" class="ck_danhmuc_thietbi_bo_phan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_grid->bo_phan->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_thietbi_grid->bo_phan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_thietbi_grid->bo_phan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_grid->namsx->Visible) { // namsx ?>
	<?php if ($ck_danhmuc_thietbi_grid->SortUrl($ck_danhmuc_thietbi_grid->namsx) == "") { ?>
		<th data-name="namsx" class="<?php echo $ck_danhmuc_thietbi_grid->namsx->headerCellClass() ?>"><div id="elh_ck_danhmuc_thietbi_namsx" class="ck_danhmuc_thietbi_namsx"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_grid->namsx->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="namsx" class="<?php echo $ck_danhmuc_thietbi_grid->namsx->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_thietbi_namsx" class="ck_danhmuc_thietbi_namsx">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_grid->namsx->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_thietbi_grid->namsx->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_thietbi_grid->namsx->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_grid->ghi_chu->Visible) { // ghi_chu ?>
	<?php if ($ck_danhmuc_thietbi_grid->SortUrl($ck_danhmuc_thietbi_grid->ghi_chu) == "") { ?>
		<th data-name="ghi_chu" class="<?php echo $ck_danhmuc_thietbi_grid->ghi_chu->headerCellClass() ?>"><div id="elh_ck_danhmuc_thietbi_ghi_chu" class="ck_danhmuc_thietbi_ghi_chu"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_grid->ghi_chu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ghi_chu" class="<?php echo $ck_danhmuc_thietbi_grid->ghi_chu->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_thietbi_ghi_chu" class="ck_danhmuc_thietbi_ghi_chu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_grid->ghi_chu->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_thietbi_grid->ghi_chu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_thietbi_grid->ghi_chu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ck_danhmuc_thietbi_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$ck_danhmuc_thietbi_grid->StartRecord = 1;
$ck_danhmuc_thietbi_grid->StopRecord = $ck_danhmuc_thietbi_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($ck_danhmuc_thietbi->isConfirm() || $ck_danhmuc_thietbi_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($ck_danhmuc_thietbi_grid->FormKeyCountName) && ($ck_danhmuc_thietbi_grid->isGridAdd() || $ck_danhmuc_thietbi_grid->isGridEdit() || $ck_danhmuc_thietbi->isConfirm())) {
		$ck_danhmuc_thietbi_grid->KeyCount = $CurrentForm->getValue($ck_danhmuc_thietbi_grid->FormKeyCountName);
		$ck_danhmuc_thietbi_grid->StopRecord = $ck_danhmuc_thietbi_grid->StartRecord + $ck_danhmuc_thietbi_grid->KeyCount - 1;
	}
}
$ck_danhmuc_thietbi_grid->RecordCount = $ck_danhmuc_thietbi_grid->StartRecord - 1;
if ($ck_danhmuc_thietbi_grid->Recordset && !$ck_danhmuc_thietbi_grid->Recordset->EOF) {
	$ck_danhmuc_thietbi_grid->Recordset->moveFirst();
	$selectLimit = $ck_danhmuc_thietbi_grid->UseSelectLimit;
	if (!$selectLimit && $ck_danhmuc_thietbi_grid->StartRecord > 1)
		$ck_danhmuc_thietbi_grid->Recordset->move($ck_danhmuc_thietbi_grid->StartRecord - 1);
} elseif (!$ck_danhmuc_thietbi->AllowAddDeleteRow && $ck_danhmuc_thietbi_grid->StopRecord == 0) {
	$ck_danhmuc_thietbi_grid->StopRecord = $ck_danhmuc_thietbi->GridAddRowCount;
}

// Initialize aggregate
$ck_danhmuc_thietbi->RowType = ROWTYPE_AGGREGATEINIT;
$ck_danhmuc_thietbi->resetAttributes();
$ck_danhmuc_thietbi_grid->renderRow();
if ($ck_danhmuc_thietbi_grid->isGridAdd())
	$ck_danhmuc_thietbi_grid->RowIndex = 0;
if ($ck_danhmuc_thietbi_grid->isGridEdit())
	$ck_danhmuc_thietbi_grid->RowIndex = 0;
while ($ck_danhmuc_thietbi_grid->RecordCount < $ck_danhmuc_thietbi_grid->StopRecord) {
	$ck_danhmuc_thietbi_grid->RecordCount++;
	if ($ck_danhmuc_thietbi_grid->RecordCount >= $ck_danhmuc_thietbi_grid->StartRecord) {
		$ck_danhmuc_thietbi_grid->RowCount++;
		if ($ck_danhmuc_thietbi_grid->isGridAdd() || $ck_danhmuc_thietbi_grid->isGridEdit() || $ck_danhmuc_thietbi->isConfirm()) {
			$ck_danhmuc_thietbi_grid->RowIndex++;
			$CurrentForm->Index = $ck_danhmuc_thietbi_grid->RowIndex;
			if ($CurrentForm->hasValue($ck_danhmuc_thietbi_grid->FormActionName) && ($ck_danhmuc_thietbi->isConfirm() || $ck_danhmuc_thietbi_grid->EventCancelled))
				$ck_danhmuc_thietbi_grid->RowAction = strval($CurrentForm->getValue($ck_danhmuc_thietbi_grid->FormActionName));
			elseif ($ck_danhmuc_thietbi_grid->isGridAdd())
				$ck_danhmuc_thietbi_grid->RowAction = "insert";
			else
				$ck_danhmuc_thietbi_grid->RowAction = "";
		}

		// Set up key count
		$ck_danhmuc_thietbi_grid->KeyCount = $ck_danhmuc_thietbi_grid->RowIndex;

		// Init row class and style
		$ck_danhmuc_thietbi->resetAttributes();
		$ck_danhmuc_thietbi->CssClass = "";
		if ($ck_danhmuc_thietbi_grid->isGridAdd()) {
			if ($ck_danhmuc_thietbi->CurrentMode == "copy") {
				$ck_danhmuc_thietbi_grid->loadRowValues($ck_danhmuc_thietbi_grid->Recordset); // Load row values
				$ck_danhmuc_thietbi_grid->setRecordKey($ck_danhmuc_thietbi_grid->RowOldKey, $ck_danhmuc_thietbi_grid->Recordset); // Set old record key
			} else {
				$ck_danhmuc_thietbi_grid->loadRowValues(); // Load default values
				$ck_danhmuc_thietbi_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$ck_danhmuc_thietbi_grid->loadRowValues($ck_danhmuc_thietbi_grid->Recordset); // Load row values
		}
		$ck_danhmuc_thietbi->RowType = ROWTYPE_VIEW; // Render view
		if ($ck_danhmuc_thietbi_grid->isGridAdd()) // Grid add
			$ck_danhmuc_thietbi->RowType = ROWTYPE_ADD; // Render add
		if ($ck_danhmuc_thietbi_grid->isGridAdd() && $ck_danhmuc_thietbi->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$ck_danhmuc_thietbi_grid->restoreCurrentRowFormValues($ck_danhmuc_thietbi_grid->RowIndex); // Restore form values
		if ($ck_danhmuc_thietbi_grid->isGridEdit()) { // Grid edit
			if ($ck_danhmuc_thietbi->EventCancelled)
				$ck_danhmuc_thietbi_grid->restoreCurrentRowFormValues($ck_danhmuc_thietbi_grid->RowIndex); // Restore form values
			if ($ck_danhmuc_thietbi_grid->RowAction == "insert")
				$ck_danhmuc_thietbi->RowType = ROWTYPE_ADD; // Render add
			else
				$ck_danhmuc_thietbi->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($ck_danhmuc_thietbi_grid->isGridEdit() && ($ck_danhmuc_thietbi->RowType == ROWTYPE_EDIT || $ck_danhmuc_thietbi->RowType == ROWTYPE_ADD) && $ck_danhmuc_thietbi->EventCancelled) // Update failed
			$ck_danhmuc_thietbi_grid->restoreCurrentRowFormValues($ck_danhmuc_thietbi_grid->RowIndex); // Restore form values
		if ($ck_danhmuc_thietbi->RowType == ROWTYPE_EDIT) // Edit row
			$ck_danhmuc_thietbi_grid->EditRowCount++;
		if ($ck_danhmuc_thietbi->isConfirm()) // Confirm row
			$ck_danhmuc_thietbi_grid->restoreCurrentRowFormValues($ck_danhmuc_thietbi_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$ck_danhmuc_thietbi->RowAttrs->merge(["data-rowindex" => $ck_danhmuc_thietbi_grid->RowCount, "id" => "r" . $ck_danhmuc_thietbi_grid->RowCount . "_ck_danhmuc_thietbi", "data-rowtype" => $ck_danhmuc_thietbi->RowType]);

		// Render row
		$ck_danhmuc_thietbi_grid->renderRow();

		// Render list options
		$ck_danhmuc_thietbi_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($ck_danhmuc_thietbi_grid->RowAction != "delete" && $ck_danhmuc_thietbi_grid->RowAction != "insertdelete" && !($ck_danhmuc_thietbi_grid->RowAction == "insert" && $ck_danhmuc_thietbi->isConfirm() && $ck_danhmuc_thietbi_grid->emptyRow())) {
?>
	<tr <?php echo $ck_danhmuc_thietbi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_danhmuc_thietbi_grid->ListOptions->render("body", "left", $ck_danhmuc_thietbi_grid->RowCount);
?>
	<?php if ($ck_danhmuc_thietbi_grid->chung_loai_id->Visible) { // chung_loai_id ?>
		<td data-name="chung_loai_id" <?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->cellAttributes() ?>>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($ck_danhmuc_thietbi_grid->chung_loai_id->getSessionValue() != "") { ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_chung_loai_id" class="form-group">
<span<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_thietbi_grid->chung_loai_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->chung_loai_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_chung_loai_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_thietbi" data-field="x_chung_loai_id" data-value-separator="<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id"<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->selectOptionListHtml("x{$ck_danhmuc_thietbi_grid->RowIndex}_chung_loai_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->Lookup->getParamTag($ck_danhmuc_thietbi_grid, "p_x" . $ck_danhmuc_thietbi_grid->RowIndex . "_chung_loai_id") ?>
</span>
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_chung_loai_id" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->chung_loai_id->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($ck_danhmuc_thietbi_grid->chung_loai_id->getSessionValue() != "") { ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_chung_loai_id" class="form-group">
<span<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_thietbi_grid->chung_loai_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->chung_loai_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_chung_loai_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_thietbi" data-field="x_chung_loai_id" data-value-separator="<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id"<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->selectOptionListHtml("x{$ck_danhmuc_thietbi_grid->RowIndex}_chung_loai_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->Lookup->getParamTag($ck_danhmuc_thietbi_grid, "p_x" . $ck_danhmuc_thietbi_grid->RowIndex . "_chung_loai_id") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_chung_loai_id">
<span<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->getViewValue() ?></span>
</span>
<?php if (!$ck_danhmuc_thietbi->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_chung_loai_id" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->chung_loai_id->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_chung_loai_id" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->chung_loai_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_chung_loai_id" name="fck_danhmuc_thietbigrid$x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" id="fck_danhmuc_thietbigrid$x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->chung_loai_id->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_chung_loai_id" name="fck_danhmuc_thietbigrid$o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" id="fck_danhmuc_thietbigrid$o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->chung_loai_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_thiet_bi_id" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_thiet_bi_id" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_thiet_bi_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->thiet_bi_id->CurrentValue) ?>">
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_thiet_bi_id" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_thiet_bi_id" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_thiet_bi_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->thiet_bi_id->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_EDIT || $ck_danhmuc_thietbi->CurrentMode == "edit") { ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_thiet_bi_id" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_thiet_bi_id" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_thiet_bi_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->thiet_bi_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($ck_danhmuc_thietbi_grid->ky_ma_hieu->Visible) { // ky_ma_hieu ?>
		<td data-name="ky_ma_hieu" <?php echo $ck_danhmuc_thietbi_grid->ky_ma_hieu->cellAttributes() ?>>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_ky_ma_hieu" class="form-group">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_ky_ma_hieu" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ky_ma_hieu->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_grid->ky_ma_hieu->EditValue ?>"<?php echo $ck_danhmuc_thietbi_grid->ky_ma_hieu->editAttributes() ?>>
</span>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_ky_ma_hieu" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ky_ma_hieu->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_ky_ma_hieu" class="form-group">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_ky_ma_hieu" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ky_ma_hieu->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_grid->ky_ma_hieu->EditValue ?>"<?php echo $ck_danhmuc_thietbi_grid->ky_ma_hieu->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_ky_ma_hieu">
<span<?php echo $ck_danhmuc_thietbi_grid->ky_ma_hieu->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_grid->ky_ma_hieu->getViewValue() ?></span>
</span>
<?php if (!$ck_danhmuc_thietbi->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_ky_ma_hieu" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ky_ma_hieu->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_ky_ma_hieu" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ky_ma_hieu->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_ky_ma_hieu" name="fck_danhmuc_thietbigrid$x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" id="fck_danhmuc_thietbigrid$x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ky_ma_hieu->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_ky_ma_hieu" name="fck_danhmuc_thietbigrid$o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" id="fck_danhmuc_thietbigrid$o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ky_ma_hieu->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_thietbi_grid->bo_phan->Visible) { // bo_phan ?>
		<td data-name="bo_phan" <?php echo $ck_danhmuc_thietbi_grid->bo_phan->cellAttributes() ?>>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_bo_phan" class="form-group">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_bo_phan" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->bo_phan->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_grid->bo_phan->EditValue ?>"<?php echo $ck_danhmuc_thietbi_grid->bo_phan->editAttributes() ?>>
</span>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_bo_phan" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->bo_phan->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_bo_phan" class="form-group">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_bo_phan" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->bo_phan->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_grid->bo_phan->EditValue ?>"<?php echo $ck_danhmuc_thietbi_grid->bo_phan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_bo_phan">
<span<?php echo $ck_danhmuc_thietbi_grid->bo_phan->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_grid->bo_phan->getViewValue() ?></span>
</span>
<?php if (!$ck_danhmuc_thietbi->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_bo_phan" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->bo_phan->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_bo_phan" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->bo_phan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_bo_phan" name="fck_danhmuc_thietbigrid$x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" id="fck_danhmuc_thietbigrid$x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->bo_phan->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_bo_phan" name="fck_danhmuc_thietbigrid$o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" id="fck_danhmuc_thietbigrid$o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->bo_phan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_thietbi_grid->namsx->Visible) { // namsx ?>
		<td data-name="namsx" <?php echo $ck_danhmuc_thietbi_grid->namsx->cellAttributes() ?>>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_namsx" class="form-group">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_namsx" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->namsx->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_grid->namsx->EditValue ?>"<?php echo $ck_danhmuc_thietbi_grid->namsx->editAttributes() ?>>
</span>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_namsx" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->namsx->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_namsx" class="form-group">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_namsx" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->namsx->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_grid->namsx->EditValue ?>"<?php echo $ck_danhmuc_thietbi_grid->namsx->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_namsx">
<span<?php echo $ck_danhmuc_thietbi_grid->namsx->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_grid->namsx->getViewValue() ?></span>
</span>
<?php if (!$ck_danhmuc_thietbi->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_namsx" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->namsx->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_namsx" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->namsx->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_namsx" name="fck_danhmuc_thietbigrid$x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" id="fck_danhmuc_thietbigrid$x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->namsx->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_namsx" name="fck_danhmuc_thietbigrid$o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" id="fck_danhmuc_thietbigrid$o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->namsx->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_thietbi_grid->ghi_chu->Visible) { // ghi_chu ?>
		<td data-name="ghi_chu" <?php echo $ck_danhmuc_thietbi_grid->ghi_chu->cellAttributes() ?>>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_ghi_chu" class="form-group">
<textarea data-table="ck_danhmuc_thietbi" data-field="x_ghi_chu" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ghi_chu->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_thietbi_grid->ghi_chu->editAttributes() ?>><?php echo $ck_danhmuc_thietbi_grid->ghi_chu->EditValue ?></textarea>
</span>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_ghi_chu" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ghi_chu->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_ghi_chu" class="form-group">
<textarea data-table="ck_danhmuc_thietbi" data-field="x_ghi_chu" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ghi_chu->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_thietbi_grid->ghi_chu->editAttributes() ?>><?php echo $ck_danhmuc_thietbi_grid->ghi_chu->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_thietbi_grid->RowCount ?>_ck_danhmuc_thietbi_ghi_chu">
<span<?php echo $ck_danhmuc_thietbi_grid->ghi_chu->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_grid->ghi_chu->getViewValue() ?></span>
</span>
<?php if (!$ck_danhmuc_thietbi->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_ghi_chu" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ghi_chu->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_ghi_chu" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ghi_chu->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_ghi_chu" name="fck_danhmuc_thietbigrid$x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" id="fck_danhmuc_thietbigrid$x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ghi_chu->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_ghi_chu" name="fck_danhmuc_thietbigrid$o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" id="fck_danhmuc_thietbigrid$o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ghi_chu->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_danhmuc_thietbi_grid->ListOptions->render("body", "right", $ck_danhmuc_thietbi_grid->RowCount);
?>
	</tr>
<?php if ($ck_danhmuc_thietbi->RowType == ROWTYPE_ADD || $ck_danhmuc_thietbi->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fck_danhmuc_thietbigrid", "load"], function() {
	fck_danhmuc_thietbigrid.updateLists(<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$ck_danhmuc_thietbi_grid->isGridAdd() || $ck_danhmuc_thietbi->CurrentMode == "copy")
		if (!$ck_danhmuc_thietbi_grid->Recordset->EOF)
			$ck_danhmuc_thietbi_grid->Recordset->moveNext();
}
?>
<?php
	if ($ck_danhmuc_thietbi->CurrentMode == "add" || $ck_danhmuc_thietbi->CurrentMode == "copy" || $ck_danhmuc_thietbi->CurrentMode == "edit") {
		$ck_danhmuc_thietbi_grid->RowIndex = '$rowindex$';
		$ck_danhmuc_thietbi_grid->loadRowValues();

		// Set row properties
		$ck_danhmuc_thietbi->resetAttributes();
		$ck_danhmuc_thietbi->RowAttrs->merge(["data-rowindex" => $ck_danhmuc_thietbi_grid->RowIndex, "id" => "r0_ck_danhmuc_thietbi", "data-rowtype" => ROWTYPE_ADD]);
		$ck_danhmuc_thietbi->RowAttrs->appendClass("ew-template");
		$ck_danhmuc_thietbi->RowType = ROWTYPE_ADD;

		// Render row
		$ck_danhmuc_thietbi_grid->renderRow();

		// Render list options
		$ck_danhmuc_thietbi_grid->renderListOptions();
		$ck_danhmuc_thietbi_grid->StartRowCount = 0;
?>
	<tr <?php echo $ck_danhmuc_thietbi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_danhmuc_thietbi_grid->ListOptions->render("body", "left", $ck_danhmuc_thietbi_grid->RowIndex);
?>
	<?php if ($ck_danhmuc_thietbi_grid->chung_loai_id->Visible) { // chung_loai_id ?>
		<td data-name="chung_loai_id">
<?php if (!$ck_danhmuc_thietbi->isConfirm()) { ?>
<?php if ($ck_danhmuc_thietbi_grid->chung_loai_id->getSessionValue() != "") { ?>
<span id="el$rowindex$_ck_danhmuc_thietbi_chung_loai_id" class="form-group ck_danhmuc_thietbi_chung_loai_id">
<span<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_thietbi_grid->chung_loai_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->chung_loai_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_thietbi_chung_loai_id" class="form-group ck_danhmuc_thietbi_chung_loai_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_thietbi" data-field="x_chung_loai_id" data-value-separator="<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id"<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->selectOptionListHtml("x{$ck_danhmuc_thietbi_grid->RowIndex}_chung_loai_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->Lookup->getParamTag($ck_danhmuc_thietbi_grid, "p_x" . $ck_danhmuc_thietbi_grid->RowIndex . "_chung_loai_id") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_thietbi_chung_loai_id" class="form-group ck_danhmuc_thietbi_chung_loai_id">
<span<?php echo $ck_danhmuc_thietbi_grid->chung_loai_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_thietbi_grid->chung_loai_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_chung_loai_id" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->chung_loai_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_chung_loai_id" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_chung_loai_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->chung_loai_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_thietbi_grid->ky_ma_hieu->Visible) { // ky_ma_hieu ?>
		<td data-name="ky_ma_hieu">
<?php if (!$ck_danhmuc_thietbi->isConfirm()) { ?>
<span id="el$rowindex$_ck_danhmuc_thietbi_ky_ma_hieu" class="form-group ck_danhmuc_thietbi_ky_ma_hieu">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_ky_ma_hieu" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ky_ma_hieu->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_grid->ky_ma_hieu->EditValue ?>"<?php echo $ck_danhmuc_thietbi_grid->ky_ma_hieu->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_thietbi_ky_ma_hieu" class="form-group ck_danhmuc_thietbi_ky_ma_hieu">
<span<?php echo $ck_danhmuc_thietbi_grid->ky_ma_hieu->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_thietbi_grid->ky_ma_hieu->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_ky_ma_hieu" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ky_ma_hieu->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_ky_ma_hieu" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ky_ma_hieu" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ky_ma_hieu->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_thietbi_grid->bo_phan->Visible) { // bo_phan ?>
		<td data-name="bo_phan">
<?php if (!$ck_danhmuc_thietbi->isConfirm()) { ?>
<span id="el$rowindex$_ck_danhmuc_thietbi_bo_phan" class="form-group ck_danhmuc_thietbi_bo_phan">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_bo_phan" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->bo_phan->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_grid->bo_phan->EditValue ?>"<?php echo $ck_danhmuc_thietbi_grid->bo_phan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_thietbi_bo_phan" class="form-group ck_danhmuc_thietbi_bo_phan">
<span<?php echo $ck_danhmuc_thietbi_grid->bo_phan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_thietbi_grid->bo_phan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_bo_phan" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->bo_phan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_bo_phan" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_bo_phan" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->bo_phan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_thietbi_grid->namsx->Visible) { // namsx ?>
		<td data-name="namsx">
<?php if (!$ck_danhmuc_thietbi->isConfirm()) { ?>
<span id="el$rowindex$_ck_danhmuc_thietbi_namsx" class="form-group ck_danhmuc_thietbi_namsx">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_namsx" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->namsx->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_grid->namsx->EditValue ?>"<?php echo $ck_danhmuc_thietbi_grid->namsx->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_thietbi_namsx" class="form-group ck_danhmuc_thietbi_namsx">
<span<?php echo $ck_danhmuc_thietbi_grid->namsx->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_thietbi_grid->namsx->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_namsx" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->namsx->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_namsx" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_namsx" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->namsx->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_thietbi_grid->ghi_chu->Visible) { // ghi_chu ?>
		<td data-name="ghi_chu">
<?php if (!$ck_danhmuc_thietbi->isConfirm()) { ?>
<span id="el$rowindex$_ck_danhmuc_thietbi_ghi_chu" class="form-group ck_danhmuc_thietbi_ghi_chu">
<textarea data-table="ck_danhmuc_thietbi" data-field="x_ghi_chu" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ghi_chu->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_thietbi_grid->ghi_chu->editAttributes() ?>><?php echo $ck_danhmuc_thietbi_grid->ghi_chu->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_thietbi_ghi_chu" class="form-group ck_danhmuc_thietbi_ghi_chu">
<span<?php echo $ck_danhmuc_thietbi_grid->ghi_chu->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_grid->ghi_chu->ViewValue ?></span>
</span>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_ghi_chu" name="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" id="x<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ghi_chu->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_ghi_chu" name="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" id="o<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>_ghi_chu" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_grid->ghi_chu->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_danhmuc_thietbi_grid->ListOptions->render("body", "right", $ck_danhmuc_thietbi_grid->RowIndex);
?>
<script>
loadjs.ready(["fck_danhmuc_thietbigrid", "load"], function() {
	fck_danhmuc_thietbigrid.updateLists(<?php echo $ck_danhmuc_thietbi_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($ck_danhmuc_thietbi->CurrentMode == "add" || $ck_danhmuc_thietbi->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $ck_danhmuc_thietbi_grid->FormKeyCountName ?>" id="<?php echo $ck_danhmuc_thietbi_grid->FormKeyCountName ?>" value="<?php echo $ck_danhmuc_thietbi_grid->KeyCount ?>">
<?php echo $ck_danhmuc_thietbi_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $ck_danhmuc_thietbi_grid->FormKeyCountName ?>" id="<?php echo $ck_danhmuc_thietbi_grid->FormKeyCountName ?>" value="<?php echo $ck_danhmuc_thietbi_grid->KeyCount ?>">
<?php echo $ck_danhmuc_thietbi_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fck_danhmuc_thietbigrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ck_danhmuc_thietbi_grid->Recordset)
	$ck_danhmuc_thietbi_grid->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ck_danhmuc_thietbi_grid->TotalRecords == 0 && !$ck_danhmuc_thietbi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ck_danhmuc_thietbi_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$ck_danhmuc_thietbi_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$ck_danhmuc_thietbi_grid->terminate();
?>