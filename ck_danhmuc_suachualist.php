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
$ck_danhmuc_suachua_list = new ck_danhmuc_suachua_list();

// Run the page
$ck_danhmuc_suachua_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_danhmuc_suachua_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ck_danhmuc_suachua_list->isExport()) { ?>
<script>
var fck_danhmuc_suachualist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fck_danhmuc_suachualist = currentForm = new ew.Form("fck_danhmuc_suachualist", "list");
	fck_danhmuc_suachualist.formKeyCountName = '<?php echo $ck_danhmuc_suachua_list->FormKeyCountName ?>';
	loadjs.done("fck_danhmuc_suachualist");
});
var fck_danhmuc_suachualistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fck_danhmuc_suachualistsrch = currentSearchForm = new ew.Form("fck_danhmuc_suachualistsrch");

	// Validate function for search
	fck_danhmuc_suachualistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ngay_sua_chua");
		if (elm && !ew.checkShortEuroDate(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ck_danhmuc_suachua_list->ngay_sua_chua->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fck_danhmuc_suachualistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fck_danhmuc_suachualistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fck_danhmuc_suachualistsrch.lists["x_chuanloai_id"] = <?php echo $ck_danhmuc_suachua_list->chuanloai_id->Lookup->toClientList($ck_danhmuc_suachua_list) ?>;
	fck_danhmuc_suachualistsrch.lists["x_chuanloai_id"].options = <?php echo JsonEncode($ck_danhmuc_suachua_list->chuanloai_id->lookupOptions()) ?>;
	fck_danhmuc_suachualistsrch.lists["x_thiet_bi_id"] = <?php echo $ck_danhmuc_suachua_list->thiet_bi_id->Lookup->toClientList($ck_danhmuc_suachua_list) ?>;
	fck_danhmuc_suachualistsrch.lists["x_thiet_bi_id"].options = <?php echo JsonEncode($ck_danhmuc_suachua_list->thiet_bi_id->lookupOptions()) ?>;
	fck_danhmuc_suachualistsrch.lists["x_dich_vu[]"] = <?php echo $ck_danhmuc_suachua_list->dich_vu->Lookup->toClientList($ck_danhmuc_suachua_list) ?>;
	fck_danhmuc_suachualistsrch.lists["x_dich_vu[]"].options = <?php echo JsonEncode($ck_danhmuc_suachua_list->dich_vu->options(FALSE, TRUE)) ?>;
	fck_danhmuc_suachualistsrch.lists["x_hoan_thanh[]"] = <?php echo $ck_danhmuc_suachua_list->hoan_thanh->Lookup->toClientList($ck_danhmuc_suachua_list) ?>;
	fck_danhmuc_suachualistsrch.lists["x_hoan_thanh[]"].options = <?php echo JsonEncode($ck_danhmuc_suachua_list->hoan_thanh->options(FALSE, TRUE)) ?>;
	fck_danhmuc_suachualistsrch.lists["x_id_don_hang"] = <?php echo $ck_danhmuc_suachua_list->id_don_hang->Lookup->toClientList($ck_danhmuc_suachua_list) ?>;
	fck_danhmuc_suachualistsrch.lists["x_id_don_hang"].options = <?php echo JsonEncode($ck_danhmuc_suachua_list->id_don_hang->lookupOptions()) ?>;
	fck_danhmuc_suachualistsrch.autoSuggests["x_id_don_hang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	fck_danhmuc_suachualistsrch.filterList = <?php echo $ck_danhmuc_suachua_list->getFilterList() ?>;
	loadjs.done("fck_danhmuc_suachualistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ck_danhmuc_suachua_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ck_danhmuc_suachua_list->TotalRecords > 0 && $ck_danhmuc_suachua_list->ExportOptions->visible()) { ?>
<?php $ck_danhmuc_suachua_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->ImportOptions->visible()) { ?>
<?php $ck_danhmuc_suachua_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->SearchOptions->visible()) { ?>
<?php $ck_danhmuc_suachua_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->FilterOptions->visible()) { ?>
<?php $ck_danhmuc_suachua_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$ck_danhmuc_suachua_list->isExport() || Config("EXPORT_MASTER_RECORD") && $ck_danhmuc_suachua_list->isExport("print")) { ?>
<?php
if ($ck_danhmuc_suachua_list->DbMasterFilter != "" && $ck_danhmuc_suachua->getCurrentMasterTable() == "ck_don_hang") {
	if ($ck_danhmuc_suachua_list->MasterRecordExists) {
		include_once "ck_don_hangmaster.php";
	}
}
?>
<?php } ?>
<?php
$ck_danhmuc_suachua_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ck_danhmuc_suachua_list->isExport() && !$ck_danhmuc_suachua->CurrentAction) { ?>
<form name="fck_danhmuc_suachualistsrch" id="fck_danhmuc_suachualistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fck_danhmuc_suachualistsrch-search-panel" class="<?php echo $ck_danhmuc_suachua_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ck_danhmuc_suachua">
	<div class="ew-extended-search">
<?php

// Render search row
$ck_danhmuc_suachua->RowType = ROWTYPE_SEARCH;
$ck_danhmuc_suachua->resetAttributes();
$ck_danhmuc_suachua_list->renderRow();
?>
<?php if ($ck_danhmuc_suachua_list->chuanloai_id->Visible) { // chuanloai_id ?>
	<?php
		$ck_danhmuc_suachua_list->SearchColumnCount++;
		if (($ck_danhmuc_suachua_list->SearchColumnCount - 1) % $ck_danhmuc_suachua_list->SearchFieldsPerRow == 0) {
			$ck_danhmuc_suachua_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $ck_danhmuc_suachua_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_chuanloai_id" class="ew-cell form-group">
		<label for="x_chuanloai_id" class="ew-search-caption ew-label"><?php echo $ck_danhmuc_suachua_list->chuanloai_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_chuanloai_id" id="z_chuanloai_id" value="=">
</span>
		<span id="el_ck_danhmuc_suachua_chuanloai_id" class="ew-search-field">
<?php $ck_danhmuc_suachua_list->chuanloai_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_suachua" data-field="x_chuanloai_id" data-value-separator="<?php echo $ck_danhmuc_suachua_list->chuanloai_id->displayValueSeparatorAttribute() ?>" id="x_chuanloai_id" name="x_chuanloai_id"<?php echo $ck_danhmuc_suachua_list->chuanloai_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_suachua_list->chuanloai_id->selectOptionListHtml("x_chuanloai_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_suachua_list->chuanloai_id->Lookup->getParamTag($ck_danhmuc_suachua_list, "p_x_chuanloai_id") ?>
</span>
	</div>
	<?php if ($ck_danhmuc_suachua_list->SearchColumnCount % $ck_danhmuc_suachua_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->thiet_bi_id->Visible) { // thiet_bi_id ?>
	<?php
		$ck_danhmuc_suachua_list->SearchColumnCount++;
		if (($ck_danhmuc_suachua_list->SearchColumnCount - 1) % $ck_danhmuc_suachua_list->SearchFieldsPerRow == 0) {
			$ck_danhmuc_suachua_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $ck_danhmuc_suachua_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_thiet_bi_id" class="ew-cell form-group">
		<label for="x_thiet_bi_id" class="ew-search-caption ew-label"><?php echo $ck_danhmuc_suachua_list->thiet_bi_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_thiet_bi_id" id="z_thiet_bi_id" value="=">
</span>
		<span id="el_ck_danhmuc_suachua_thiet_bi_id" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_suachua" data-field="x_thiet_bi_id" data-value-separator="<?php echo $ck_danhmuc_suachua_list->thiet_bi_id->displayValueSeparatorAttribute() ?>" id="x_thiet_bi_id" name="x_thiet_bi_id"<?php echo $ck_danhmuc_suachua_list->thiet_bi_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_suachua_list->thiet_bi_id->selectOptionListHtml("x_thiet_bi_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_suachua_list->thiet_bi_id->Lookup->getParamTag($ck_danhmuc_suachua_list, "p_x_thiet_bi_id") ?>
</span>
	</div>
	<?php if ($ck_danhmuc_suachua_list->SearchColumnCount % $ck_danhmuc_suachua_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<?php
		$ck_danhmuc_suachua_list->SearchColumnCount++;
		if (($ck_danhmuc_suachua_list->SearchColumnCount - 1) % $ck_danhmuc_suachua_list->SearchFieldsPerRow == 0) {
			$ck_danhmuc_suachua_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $ck_danhmuc_suachua_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ngay_sua_chua" class="ew-cell form-group">
		<label for="x_ngay_sua_chua" class="ew-search-caption ew-label"><?php echo $ck_danhmuc_suachua_list->ngay_sua_chua->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_ngay_sua_chua" id="z_ngay_sua_chua" value="BETWEEN">
</span>
		<span id="el_ck_danhmuc_suachua_ngay_sua_chua" class="ew-search-field">
<input type="text" data-table="ck_danhmuc_suachua" data-field="x_ngay_sua_chua" data-format="14" name="x_ngay_sua_chua" id="x_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_list->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_suachua_list->ngay_sua_chua->EditValue ?>"<?php echo $ck_danhmuc_suachua_list->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_danhmuc_suachua_list->ngay_sua_chua->ReadOnly && !$ck_danhmuc_suachua_list->ngay_sua_chua->Disabled && !isset($ck_danhmuc_suachua_list->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_danhmuc_suachua_list->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_danhmuc_suachualistsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_danhmuc_suachualistsrch", "x_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":14});
});
</script>
<?php } ?>
</span>
		<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
		<span id="el2_ck_danhmuc_suachua_ngay_sua_chua" class="ew-search-field2">
<input type="text" data-table="ck_danhmuc_suachua" data-field="x_ngay_sua_chua" data-format="14" name="y_ngay_sua_chua" id="y_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_list->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_suachua_list->ngay_sua_chua->EditValue2 ?>"<?php echo $ck_danhmuc_suachua_list->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_danhmuc_suachua_list->ngay_sua_chua->ReadOnly && !$ck_danhmuc_suachua_list->ngay_sua_chua->Disabled && !isset($ck_danhmuc_suachua_list->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_danhmuc_suachua_list->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_danhmuc_suachualistsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_danhmuc_suachualistsrch", "y_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":14});
});
</script>
<?php } ?>
</span>
	</div>
	<?php if ($ck_danhmuc_suachua_list->SearchColumnCount % $ck_danhmuc_suachua_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->dich_vu->Visible) { // dich_vu ?>
	<?php
		$ck_danhmuc_suachua_list->SearchColumnCount++;
		if (($ck_danhmuc_suachua_list->SearchColumnCount - 1) % $ck_danhmuc_suachua_list->SearchFieldsPerRow == 0) {
			$ck_danhmuc_suachua_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $ck_danhmuc_suachua_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_dich_vu" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $ck_danhmuc_suachua_list->dich_vu->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_dich_vu" id="z_dich_vu" value="=">
</span>
		<span id="el_ck_danhmuc_suachua_dich_vu" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ck_danhmuc_suachua_list->dich_vu->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ck_danhmuc_suachua" data-field="x_dich_vu" name="x_dich_vu[]" id="x_dich_vu[]_494638" value="1"<?php echo $selwrk ?><?php echo $ck_danhmuc_suachua_list->dich_vu->editAttributes() ?>>
	<label class="custom-control-label" for="x_dich_vu[]_494638"></label>
</div>
</span>
	</div>
	<?php if ($ck_danhmuc_suachua_list->SearchColumnCount % $ck_danhmuc_suachua_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->hoan_thanh->Visible) { // hoan_thanh ?>
	<?php
		$ck_danhmuc_suachua_list->SearchColumnCount++;
		if (($ck_danhmuc_suachua_list->SearchColumnCount - 1) % $ck_danhmuc_suachua_list->SearchFieldsPerRow == 0) {
			$ck_danhmuc_suachua_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $ck_danhmuc_suachua_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_hoan_thanh" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $ck_danhmuc_suachua_list->hoan_thanh->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_hoan_thanh" id="z_hoan_thanh" value="=">
</span>
		<span id="el_ck_danhmuc_suachua_hoan_thanh" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ck_danhmuc_suachua_list->hoan_thanh->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ck_danhmuc_suachua" data-field="x_hoan_thanh" name="x_hoan_thanh[]" id="x_hoan_thanh[]_751885" value="1"<?php echo $selwrk ?><?php echo $ck_danhmuc_suachua_list->hoan_thanh->editAttributes() ?>>
	<label class="custom-control-label" for="x_hoan_thanh[]_751885"></label>
</div>
</span>
	</div>
	<?php if ($ck_danhmuc_suachua_list->SearchColumnCount % $ck_danhmuc_suachua_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->id_don_hang->Visible) { // id_don_hang ?>
	<?php
		$ck_danhmuc_suachua_list->SearchColumnCount++;
		if (($ck_danhmuc_suachua_list->SearchColumnCount - 1) % $ck_danhmuc_suachua_list->SearchFieldsPerRow == 0) {
			$ck_danhmuc_suachua_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $ck_danhmuc_suachua_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_id_don_hang" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $ck_danhmuc_suachua_list->id_don_hang->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_id_don_hang" id="z_id_don_hang" value="=">
</span>
		<span id="el_ck_danhmuc_suachua_id_don_hang" class="ew-search-field">
<?php
$onchange = $ck_danhmuc_suachua_list->id_don_hang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_danhmuc_suachua_list->id_don_hang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_don_hang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_don_hang" id="sv_x_id_don_hang" value="<?php echo RemoveHtml($ck_danhmuc_suachua_list->id_don_hang->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_list->id_don_hang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_list->id_don_hang->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_suachua_list->id_don_hang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ck_danhmuc_suachua_list->id_don_hang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_don_hang',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($ck_danhmuc_suachua_list->id_don_hang->ReadOnly || $ck_danhmuc_suachua_list->id_don_hang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_id_don_hang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ck_danhmuc_suachua_list->id_don_hang->displayValueSeparatorAttribute() ?>" name="x_id_don_hang" id="x_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_list->id_don_hang->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_danhmuc_suachualistsrch"], function() {
	fck_danhmuc_suachualistsrch.createAutoSuggest({"id":"x_id_don_hang","forceSelect":false});
});
</script>
<?php echo $ck_danhmuc_suachua_list->id_don_hang->Lookup->getParamTag($ck_danhmuc_suachua_list, "p_x_id_don_hang") ?>
</span>
	</div>
	<?php if ($ck_danhmuc_suachua_list->SearchColumnCount % $ck_danhmuc_suachua_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($ck_danhmuc_suachua_list->SearchColumnCount % $ck_danhmuc_suachua_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $ck_danhmuc_suachua_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ck_danhmuc_suachua_list->showPageHeader(); ?>
<?php
$ck_danhmuc_suachua_list->showMessage();
?>
<?php if ($ck_danhmuc_suachua_list->TotalRecords > 0 || $ck_danhmuc_suachua->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ck_danhmuc_suachua_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ck_danhmuc_suachua">
<?php if (!$ck_danhmuc_suachua_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ck_danhmuc_suachua_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ck_danhmuc_suachua_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ck_danhmuc_suachua_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fck_danhmuc_suachualist" id="fck_danhmuc_suachualist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_danhmuc_suachua">
<?php if ($ck_danhmuc_suachua->getCurrentMasterTable() == "ck_don_hang" && $ck_danhmuc_suachua->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="ck_don_hang">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_list->id_don_hang->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_ck_danhmuc_suachua" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ck_danhmuc_suachua_list->TotalRecords > 0 || $ck_danhmuc_suachua_list->isGridEdit()) { ?>
<table id="tbl_ck_danhmuc_suachualist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ck_danhmuc_suachua->RowType = ROWTYPE_HEADER;

// Render list options
$ck_danhmuc_suachua_list->renderListOptions();

// Render list options (header, left)
$ck_danhmuc_suachua_list->ListOptions->render("header", "left");
?>
<?php if ($ck_danhmuc_suachua_list->chuanloai_id->Visible) { // chuanloai_id ?>
	<?php if ($ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->chuanloai_id) == "") { ?>
		<th data-name="chuanloai_id" class="<?php echo $ck_danhmuc_suachua_list->chuanloai_id->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_chuanloai_id" class="ck_danhmuc_suachua_chuanloai_id"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->chuanloai_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="chuanloai_id" class="<?php echo $ck_danhmuc_suachua_list->chuanloai_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->chuanloai_id) ?>', 1);"><div id="elh_ck_danhmuc_suachua_chuanloai_id" class="ck_danhmuc_suachua_chuanloai_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->chuanloai_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_list->chuanloai_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_list->chuanloai_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->thiet_bi_id->Visible) { // thiet_bi_id ?>
	<?php if ($ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->thiet_bi_id) == "") { ?>
		<th data-name="thiet_bi_id" class="<?php echo $ck_danhmuc_suachua_list->thiet_bi_id->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_thiet_bi_id" class="ck_danhmuc_suachua_thiet_bi_id"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->thiet_bi_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="thiet_bi_id" class="<?php echo $ck_danhmuc_suachua_list->thiet_bi_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->thiet_bi_id) ?>', 1);"><div id="elh_ck_danhmuc_suachua_thiet_bi_id" class="ck_danhmuc_suachua_thiet_bi_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->thiet_bi_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_list->thiet_bi_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_list->thiet_bi_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<?php if ($ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->ngay_sua_chua) == "") { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_danhmuc_suachua_list->ngay_sua_chua->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_ngay_sua_chua" class="ck_danhmuc_suachua_ngay_sua_chua"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->ngay_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_danhmuc_suachua_list->ngay_sua_chua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->ngay_sua_chua) ?>', 1);"><div id="elh_ck_danhmuc_suachua_ngay_sua_chua" class="ck_danhmuc_suachua_ngay_sua_chua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->ngay_sua_chua->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_list->ngay_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_list->ngay_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
	<?php if ($ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->noi_dung_sua_chua) == "") { ?>
		<th data-name="noi_dung_sua_chua" class="<?php echo $ck_danhmuc_suachua_list->noi_dung_sua_chua->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_noi_dung_sua_chua" class="ck_danhmuc_suachua_noi_dung_sua_chua"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->noi_dung_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="noi_dung_sua_chua" class="<?php echo $ck_danhmuc_suachua_list->noi_dung_sua_chua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->noi_dung_sua_chua) ?>', 1);"><div id="elh_ck_danhmuc_suachua_noi_dung_sua_chua" class="ck_danhmuc_suachua_noi_dung_sua_chua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->noi_dung_sua_chua->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_list->noi_dung_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_list->noi_dung_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->thoi_gian_sua_chua->Visible) { // thoi_gian_sua_chua ?>
	<?php if ($ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->thoi_gian_sua_chua) == "") { ?>
		<th data-name="thoi_gian_sua_chua" class="<?php echo $ck_danhmuc_suachua_list->thoi_gian_sua_chua->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_thoi_gian_sua_chua" class="ck_danhmuc_suachua_thoi_gian_sua_chua"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->thoi_gian_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="thoi_gian_sua_chua" class="<?php echo $ck_danhmuc_suachua_list->thoi_gian_sua_chua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->thoi_gian_sua_chua) ?>', 1);"><div id="elh_ck_danhmuc_suachua_thoi_gian_sua_chua" class="ck_danhmuc_suachua_thoi_gian_sua_chua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->thoi_gian_sua_chua->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_list->thoi_gian_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_list->thoi_gian_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->nguoi_nhap_lieu->Visible) { // nguoi_nhap_lieu ?>
	<?php if ($ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->nguoi_nhap_lieu) == "") { ?>
		<th data-name="nguoi_nhap_lieu" class="<?php echo $ck_danhmuc_suachua_list->nguoi_nhap_lieu->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_nguoi_nhap_lieu" class="ck_danhmuc_suachua_nguoi_nhap_lieu"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->nguoi_nhap_lieu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nguoi_nhap_lieu" class="<?php echo $ck_danhmuc_suachua_list->nguoi_nhap_lieu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->nguoi_nhap_lieu) ?>', 1);"><div id="elh_ck_danhmuc_suachua_nguoi_nhap_lieu" class="ck_danhmuc_suachua_nguoi_nhap_lieu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->nguoi_nhap_lieu->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_list->nguoi_nhap_lieu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_list->nguoi_nhap_lieu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->dich_vu->Visible) { // dich_vu ?>
	<?php if ($ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->dich_vu) == "") { ?>
		<th data-name="dich_vu" class="<?php echo $ck_danhmuc_suachua_list->dich_vu->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_dich_vu" class="ck_danhmuc_suachua_dich_vu"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->dich_vu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dich_vu" class="<?php echo $ck_danhmuc_suachua_list->dich_vu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->dich_vu) ?>', 1);"><div id="elh_ck_danhmuc_suachua_dich_vu" class="ck_danhmuc_suachua_dich_vu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->dich_vu->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_list->dich_vu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_list->dich_vu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->hoan_thanh->Visible) { // hoan_thanh ?>
	<?php if ($ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->hoan_thanh) == "") { ?>
		<th data-name="hoan_thanh" class="<?php echo $ck_danhmuc_suachua_list->hoan_thanh->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_hoan_thanh" class="ck_danhmuc_suachua_hoan_thanh"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->hoan_thanh->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hoan_thanh" class="<?php echo $ck_danhmuc_suachua_list->hoan_thanh->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->hoan_thanh) ?>', 1);"><div id="elh_ck_danhmuc_suachua_hoan_thanh" class="ck_danhmuc_suachua_hoan_thanh">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->hoan_thanh->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_list->hoan_thanh->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_list->hoan_thanh->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->id_don_hang->Visible) { // id_don_hang ?>
	<?php if ($ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->id_don_hang) == "") { ?>
		<th data-name="id_don_hang" class="<?php echo $ck_danhmuc_suachua_list->id_don_hang->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_id_don_hang" class="ck_danhmuc_suachua_id_don_hang"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->id_don_hang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_don_hang" class="<?php echo $ck_danhmuc_suachua_list->id_don_hang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->id_don_hang) ?>', 1);"><div id="elh_ck_danhmuc_suachua_id_don_hang" class="ck_danhmuc_suachua_id_don_hang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->id_don_hang->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_list->id_don_hang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_list->id_don_hang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->ngay_hoan_thanh->Visible) { // ngay_hoan_thanh ?>
	<?php if ($ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->ngay_hoan_thanh) == "") { ?>
		<th data-name="ngay_hoan_thanh" class="<?php echo $ck_danhmuc_suachua_list->ngay_hoan_thanh->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_ngay_hoan_thanh" class="ck_danhmuc_suachua_ngay_hoan_thanh"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->ngay_hoan_thanh->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ngay_hoan_thanh" class="<?php echo $ck_danhmuc_suachua_list->ngay_hoan_thanh->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_suachua_list->SortUrl($ck_danhmuc_suachua_list->ngay_hoan_thanh) ?>', 1);"><div id="elh_ck_danhmuc_suachua_ngay_hoan_thanh" class="ck_danhmuc_suachua_ngay_hoan_thanh">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_list->ngay_hoan_thanh->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_list->ngay_hoan_thanh->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_list->ngay_hoan_thanh->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ck_danhmuc_suachua_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ck_danhmuc_suachua_list->ExportAll && $ck_danhmuc_suachua_list->isExport()) {
	$ck_danhmuc_suachua_list->StopRecord = $ck_danhmuc_suachua_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ck_danhmuc_suachua_list->TotalRecords > $ck_danhmuc_suachua_list->StartRecord + $ck_danhmuc_suachua_list->DisplayRecords - 1)
		$ck_danhmuc_suachua_list->StopRecord = $ck_danhmuc_suachua_list->StartRecord + $ck_danhmuc_suachua_list->DisplayRecords - 1;
	else
		$ck_danhmuc_suachua_list->StopRecord = $ck_danhmuc_suachua_list->TotalRecords;
}
$ck_danhmuc_suachua_list->RecordCount = $ck_danhmuc_suachua_list->StartRecord - 1;
if ($ck_danhmuc_suachua_list->Recordset && !$ck_danhmuc_suachua_list->Recordset->EOF) {
	$ck_danhmuc_suachua_list->Recordset->moveFirst();
	$selectLimit = $ck_danhmuc_suachua_list->UseSelectLimit;
	if (!$selectLimit && $ck_danhmuc_suachua_list->StartRecord > 1)
		$ck_danhmuc_suachua_list->Recordset->move($ck_danhmuc_suachua_list->StartRecord - 1);
} elseif (!$ck_danhmuc_suachua->AllowAddDeleteRow && $ck_danhmuc_suachua_list->StopRecord == 0) {
	$ck_danhmuc_suachua_list->StopRecord = $ck_danhmuc_suachua->GridAddRowCount;
}

// Initialize aggregate
$ck_danhmuc_suachua->RowType = ROWTYPE_AGGREGATEINIT;
$ck_danhmuc_suachua->resetAttributes();
$ck_danhmuc_suachua_list->renderRow();
while ($ck_danhmuc_suachua_list->RecordCount < $ck_danhmuc_suachua_list->StopRecord) {
	$ck_danhmuc_suachua_list->RecordCount++;
	if ($ck_danhmuc_suachua_list->RecordCount >= $ck_danhmuc_suachua_list->StartRecord) {
		$ck_danhmuc_suachua_list->RowCount++;

		// Set up key count
		$ck_danhmuc_suachua_list->KeyCount = $ck_danhmuc_suachua_list->RowIndex;

		// Init row class and style
		$ck_danhmuc_suachua->resetAttributes();
		$ck_danhmuc_suachua->CssClass = "";
		if ($ck_danhmuc_suachua_list->isGridAdd()) {
		} else {
			$ck_danhmuc_suachua_list->loadRowValues($ck_danhmuc_suachua_list->Recordset); // Load row values
		}
		$ck_danhmuc_suachua->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ck_danhmuc_suachua->RowAttrs->merge(["data-rowindex" => $ck_danhmuc_suachua_list->RowCount, "id" => "r" . $ck_danhmuc_suachua_list->RowCount . "_ck_danhmuc_suachua", "data-rowtype" => $ck_danhmuc_suachua->RowType]);

		// Render row
		$ck_danhmuc_suachua_list->renderRow();

		// Render list options
		$ck_danhmuc_suachua_list->renderListOptions();
?>
	<tr <?php echo $ck_danhmuc_suachua->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_danhmuc_suachua_list->ListOptions->render("body", "left", $ck_danhmuc_suachua_list->RowCount);
?>
	<?php if ($ck_danhmuc_suachua_list->chuanloai_id->Visible) { // chuanloai_id ?>
		<td data-name="chuanloai_id" <?php echo $ck_danhmuc_suachua_list->chuanloai_id->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_list->RowCount ?>_ck_danhmuc_suachua_chuanloai_id">
<span<?php echo $ck_danhmuc_suachua_list->chuanloai_id->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_list->chuanloai_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_list->thiet_bi_id->Visible) { // thiet_bi_id ?>
		<td data-name="thiet_bi_id" <?php echo $ck_danhmuc_suachua_list->thiet_bi_id->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_list->RowCount ?>_ck_danhmuc_suachua_thiet_bi_id">
<span<?php echo $ck_danhmuc_suachua_list->thiet_bi_id->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_list->thiet_bi_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td data-name="ngay_sua_chua" <?php echo $ck_danhmuc_suachua_list->ngay_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_list->RowCount ?>_ck_danhmuc_suachua_ngay_sua_chua">
<span<?php echo $ck_danhmuc_suachua_list->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_list->ngay_sua_chua->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_list->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
		<td data-name="noi_dung_sua_chua" <?php echo $ck_danhmuc_suachua_list->noi_dung_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_list->RowCount ?>_ck_danhmuc_suachua_noi_dung_sua_chua">
<span<?php echo $ck_danhmuc_suachua_list->noi_dung_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_list->noi_dung_sua_chua->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_list->thoi_gian_sua_chua->Visible) { // thoi_gian_sua_chua ?>
		<td data-name="thoi_gian_sua_chua" <?php echo $ck_danhmuc_suachua_list->thoi_gian_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_list->RowCount ?>_ck_danhmuc_suachua_thoi_gian_sua_chua">
<span<?php echo $ck_danhmuc_suachua_list->thoi_gian_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_list->thoi_gian_sua_chua->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_list->nguoi_nhap_lieu->Visible) { // nguoi_nhap_lieu ?>
		<td data-name="nguoi_nhap_lieu" <?php echo $ck_danhmuc_suachua_list->nguoi_nhap_lieu->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_list->RowCount ?>_ck_danhmuc_suachua_nguoi_nhap_lieu">
<span<?php echo $ck_danhmuc_suachua_list->nguoi_nhap_lieu->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_list->nguoi_nhap_lieu->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_list->dich_vu->Visible) { // dich_vu ?>
		<td data-name="dich_vu" <?php echo $ck_danhmuc_suachua_list->dich_vu->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_list->RowCount ?>_ck_danhmuc_suachua_dich_vu">
<span<?php echo $ck_danhmuc_suachua_list->dich_vu->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_dich_vu" class="custom-control-input" value="<?php echo $ck_danhmuc_suachua_list->dich_vu->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_danhmuc_suachua_list->dich_vu->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_dich_vu"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_list->hoan_thanh->Visible) { // hoan_thanh ?>
		<td data-name="hoan_thanh" <?php echo $ck_danhmuc_suachua_list->hoan_thanh->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_list->RowCount ?>_ck_danhmuc_suachua_hoan_thanh">
<span<?php echo $ck_danhmuc_suachua_list->hoan_thanh->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_hoan_thanh" class="custom-control-input" value="<?php echo $ck_danhmuc_suachua_list->hoan_thanh->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_danhmuc_suachua_list->hoan_thanh->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_hoan_thanh"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_list->id_don_hang->Visible) { // id_don_hang ?>
		<td data-name="id_don_hang" <?php echo $ck_danhmuc_suachua_list->id_don_hang->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_list->RowCount ?>_ck_danhmuc_suachua_id_don_hang">
<span<?php echo $ck_danhmuc_suachua_list->id_don_hang->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_list->id_don_hang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_list->ngay_hoan_thanh->Visible) { // ngay_hoan_thanh ?>
		<td data-name="ngay_hoan_thanh" <?php echo $ck_danhmuc_suachua_list->ngay_hoan_thanh->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_suachua_list->RowCount ?>_ck_danhmuc_suachua_ngay_hoan_thanh">
<span<?php echo $ck_danhmuc_suachua_list->ngay_hoan_thanh->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_list->ngay_hoan_thanh->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_danhmuc_suachua_list->ListOptions->render("body", "right", $ck_danhmuc_suachua_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ck_danhmuc_suachua_list->isGridAdd())
		$ck_danhmuc_suachua_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ck_danhmuc_suachua->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ck_danhmuc_suachua_list->Recordset)
	$ck_danhmuc_suachua_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ck_danhmuc_suachua_list->TotalRecords == 0 && !$ck_danhmuc_suachua->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ck_danhmuc_suachua_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ck_danhmuc_suachua_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ck_danhmuc_suachua_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");
	//$("#x_thiet_bi_id").on("change, blur", function(){this.form.submit();});

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$ck_danhmuc_suachua_list->terminate();
?>