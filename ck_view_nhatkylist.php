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
$ck_view_nhatky_list = new ck_view_nhatky_list();

// Run the page
$ck_view_nhatky_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_view_nhatky_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ck_view_nhatky_list->isExport()) { ?>
<script>
var fck_view_nhatkylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fck_view_nhatkylist = currentForm = new ew.Form("fck_view_nhatkylist", "list");
	fck_view_nhatkylist.formKeyCountName = '<?php echo $ck_view_nhatky_list->FormKeyCountName ?>';
	loadjs.done("fck_view_nhatkylist");
});
var fck_view_nhatkylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fck_view_nhatkylistsrch = currentSearchForm = new ew.Form("fck_view_nhatkylistsrch");

	// Validate function for search
	fck_view_nhatkylistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ngay_sua_chua");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ck_view_nhatky_list->ngay_sua_chua->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fck_view_nhatkylistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fck_view_nhatkylistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fck_view_nhatkylistsrch.lists["x_nhan_vien_id"] = <?php echo $ck_view_nhatky_list->nhan_vien_id->Lookup->toClientList($ck_view_nhatky_list) ?>;
	fck_view_nhatkylistsrch.lists["x_nhan_vien_id"].options = <?php echo JsonEncode($ck_view_nhatky_list->nhan_vien_id->lookupOptions()) ?>;
	fck_view_nhatkylistsrch.lists["x_chuanloai_id"] = <?php echo $ck_view_nhatky_list->chuanloai_id->Lookup->toClientList($ck_view_nhatky_list) ?>;
	fck_view_nhatkylistsrch.lists["x_chuanloai_id"].options = <?php echo JsonEncode($ck_view_nhatky_list->chuanloai_id->lookupOptions()) ?>;
	fck_view_nhatkylistsrch.lists["x_thiet_bi_id"] = <?php echo $ck_view_nhatky_list->thiet_bi_id->Lookup->toClientList($ck_view_nhatky_list) ?>;
	fck_view_nhatkylistsrch.lists["x_thiet_bi_id"].options = <?php echo JsonEncode($ck_view_nhatky_list->thiet_bi_id->lookupOptions()) ?>;
	fck_view_nhatkylistsrch.lists["x_baoduong_dinhky[]"] = <?php echo $ck_view_nhatky_list->baoduong_dinhky->Lookup->toClientList($ck_view_nhatky_list) ?>;
	fck_view_nhatkylistsrch.lists["x_baoduong_dinhky[]"].options = <?php echo JsonEncode($ck_view_nhatky_list->baoduong_dinhky->options(FALSE, TRUE)) ?>;

	// Filters
	fck_view_nhatkylistsrch.filterList = <?php echo $ck_view_nhatky_list->getFilterList() ?>;
	loadjs.done("fck_view_nhatkylistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ck_view_nhatky_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ck_view_nhatky_list->TotalRecords > 0 && $ck_view_nhatky_list->ExportOptions->visible()) { ?>
<?php $ck_view_nhatky_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->ImportOptions->visible()) { ?>
<?php $ck_view_nhatky_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->SearchOptions->visible()) { ?>
<?php $ck_view_nhatky_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->FilterOptions->visible()) { ?>
<?php $ck_view_nhatky_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ck_view_nhatky_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ck_view_nhatky_list->isExport() && !$ck_view_nhatky->CurrentAction) { ?>
<form name="fck_view_nhatkylistsrch" id="fck_view_nhatkylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fck_view_nhatkylistsrch-search-panel" class="<?php echo $ck_view_nhatky_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ck_view_nhatky">
	<div class="ew-extended-search">
<?php

// Render search row
$ck_view_nhatky->RowType = ROWTYPE_SEARCH;
$ck_view_nhatky->resetAttributes();
$ck_view_nhatky_list->renderRow();
?>
<?php if ($ck_view_nhatky_list->nhan_vien_id->Visible) { // nhan_vien_id ?>
	<?php
		$ck_view_nhatky_list->SearchColumnCount++;
		if (($ck_view_nhatky_list->SearchColumnCount - 1) % $ck_view_nhatky_list->SearchFieldsPerRow == 0) {
			$ck_view_nhatky_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $ck_view_nhatky_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_nhan_vien_id" class="ew-cell form-group">
		<label for="x_nhan_vien_id" class="ew-search-caption ew-label"><?php echo $ck_view_nhatky_list->nhan_vien_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_nhan_vien_id" id="z_nhan_vien_id" value="=">
</span>
		<span id="el_ck_view_nhatky_nhan_vien_id" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_view_nhatky" data-field="x_nhan_vien_id" data-value-separator="<?php echo $ck_view_nhatky_list->nhan_vien_id->displayValueSeparatorAttribute() ?>" id="x_nhan_vien_id" name="x_nhan_vien_id"<?php echo $ck_view_nhatky_list->nhan_vien_id->editAttributes() ?>>
			<?php echo $ck_view_nhatky_list->nhan_vien_id->selectOptionListHtml("x_nhan_vien_id") ?>
		</select>
</div>
<?php echo $ck_view_nhatky_list->nhan_vien_id->Lookup->getParamTag($ck_view_nhatky_list, "p_x_nhan_vien_id") ?>
</span>
	</div>
	<?php if ($ck_view_nhatky_list->SearchColumnCount % $ck_view_nhatky_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<?php
		$ck_view_nhatky_list->SearchColumnCount++;
		if (($ck_view_nhatky_list->SearchColumnCount - 1) % $ck_view_nhatky_list->SearchFieldsPerRow == 0) {
			$ck_view_nhatky_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $ck_view_nhatky_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ngay_sua_chua" class="ew-cell form-group">
		<label for="x_ngay_sua_chua" class="ew-search-caption ew-label"><?php echo $ck_view_nhatky_list->ngay_sua_chua->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_ngay_sua_chua" id="z_ngay_sua_chua" value="BETWEEN">
</span>
		<span id="el_ck_view_nhatky_ngay_sua_chua" class="ew-search-field">
<input type="text" data-table="ck_view_nhatky" data-field="x_ngay_sua_chua" name="x_ngay_sua_chua" id="x_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_view_nhatky_list->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_view_nhatky_list->ngay_sua_chua->EditValue ?>"<?php echo $ck_view_nhatky_list->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_view_nhatky_list->ngay_sua_chua->ReadOnly && !$ck_view_nhatky_list->ngay_sua_chua->Disabled && !isset($ck_view_nhatky_list->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_view_nhatky_list->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_view_nhatkylistsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_view_nhatkylistsrch", "x_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
		<span id="el2_ck_view_nhatky_ngay_sua_chua" class="ew-search-field2">
<input type="text" data-table="ck_view_nhatky" data-field="x_ngay_sua_chua" name="y_ngay_sua_chua" id="y_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_view_nhatky_list->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_view_nhatky_list->ngay_sua_chua->EditValue2 ?>"<?php echo $ck_view_nhatky_list->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_view_nhatky_list->ngay_sua_chua->ReadOnly && !$ck_view_nhatky_list->ngay_sua_chua->Disabled && !isset($ck_view_nhatky_list->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_view_nhatky_list->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_view_nhatkylistsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_view_nhatkylistsrch", "y_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
	</div>
	<?php if ($ck_view_nhatky_list->SearchColumnCount % $ck_view_nhatky_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->chuanloai_id->Visible) { // chuanloai_id ?>
	<?php
		$ck_view_nhatky_list->SearchColumnCount++;
		if (($ck_view_nhatky_list->SearchColumnCount - 1) % $ck_view_nhatky_list->SearchFieldsPerRow == 0) {
			$ck_view_nhatky_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $ck_view_nhatky_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_chuanloai_id" class="ew-cell form-group">
		<label for="x_chuanloai_id" class="ew-search-caption ew-label"><?php echo $ck_view_nhatky_list->chuanloai_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_chuanloai_id" id="z_chuanloai_id" value="=">
</span>
		<span id="el_ck_view_nhatky_chuanloai_id" class="ew-search-field">
<?php $ck_view_nhatky_list->chuanloai_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_view_nhatky" data-field="x_chuanloai_id" data-value-separator="<?php echo $ck_view_nhatky_list->chuanloai_id->displayValueSeparatorAttribute() ?>" id="x_chuanloai_id" name="x_chuanloai_id"<?php echo $ck_view_nhatky_list->chuanloai_id->editAttributes() ?>>
			<?php echo $ck_view_nhatky_list->chuanloai_id->selectOptionListHtml("x_chuanloai_id") ?>
		</select>
</div>
<?php echo $ck_view_nhatky_list->chuanloai_id->Lookup->getParamTag($ck_view_nhatky_list, "p_x_chuanloai_id") ?>
</span>
	</div>
	<?php if ($ck_view_nhatky_list->SearchColumnCount % $ck_view_nhatky_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->thiet_bi_id->Visible) { // thiet_bi_id ?>
	<?php
		$ck_view_nhatky_list->SearchColumnCount++;
		if (($ck_view_nhatky_list->SearchColumnCount - 1) % $ck_view_nhatky_list->SearchFieldsPerRow == 0) {
			$ck_view_nhatky_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $ck_view_nhatky_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_thiet_bi_id" class="ew-cell form-group">
		<label for="x_thiet_bi_id" class="ew-search-caption ew-label"><?php echo $ck_view_nhatky_list->thiet_bi_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_thiet_bi_id" id="z_thiet_bi_id" value="=">
</span>
		<span id="el_ck_view_nhatky_thiet_bi_id" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_view_nhatky" data-field="x_thiet_bi_id" data-value-separator="<?php echo $ck_view_nhatky_list->thiet_bi_id->displayValueSeparatorAttribute() ?>" id="x_thiet_bi_id" name="x_thiet_bi_id"<?php echo $ck_view_nhatky_list->thiet_bi_id->editAttributes() ?>>
			<?php echo $ck_view_nhatky_list->thiet_bi_id->selectOptionListHtml("x_thiet_bi_id") ?>
		</select>
</div>
<?php echo $ck_view_nhatky_list->thiet_bi_id->Lookup->getParamTag($ck_view_nhatky_list, "p_x_thiet_bi_id") ?>
</span>
	</div>
	<?php if ($ck_view_nhatky_list->SearchColumnCount % $ck_view_nhatky_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->so_don_hang_id->Visible) { // so_don_hang_id ?>
	<?php
		$ck_view_nhatky_list->SearchColumnCount++;
		if (($ck_view_nhatky_list->SearchColumnCount - 1) % $ck_view_nhatky_list->SearchFieldsPerRow == 0) {
			$ck_view_nhatky_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $ck_view_nhatky_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_so_don_hang_id" class="ew-cell form-group">
		<label for="x_so_don_hang_id" class="ew-search-caption ew-label"><?php echo $ck_view_nhatky_list->so_don_hang_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_so_don_hang_id" id="z_so_don_hang_id" value="LIKE">
</span>
		<span id="el_ck_view_nhatky_so_don_hang_id" class="ew-search-field">
<input type="text" data-table="ck_view_nhatky" data-field="x_so_don_hang_id" name="x_so_don_hang_id" id="x_so_don_hang_id" size="30" maxlength="110" placeholder="<?php echo HtmlEncode($ck_view_nhatky_list->so_don_hang_id->getPlaceHolder()) ?>" value="<?php echo $ck_view_nhatky_list->so_don_hang_id->EditValue ?>"<?php echo $ck_view_nhatky_list->so_don_hang_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($ck_view_nhatky_list->SearchColumnCount % $ck_view_nhatky_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->baoduong_dinhky->Visible) { // baoduong_dinhky ?>
	<?php
		$ck_view_nhatky_list->SearchColumnCount++;
		if (($ck_view_nhatky_list->SearchColumnCount - 1) % $ck_view_nhatky_list->SearchFieldsPerRow == 0) {
			$ck_view_nhatky_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $ck_view_nhatky_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_baoduong_dinhky" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $ck_view_nhatky_list->baoduong_dinhky->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_baoduong_dinhky" id="z_baoduong_dinhky" value="=">
</span>
		<span id="el_ck_view_nhatky_baoduong_dinhky" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ck_view_nhatky_list->baoduong_dinhky->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ck_view_nhatky" data-field="x_baoduong_dinhky" name="x_baoduong_dinhky[]" id="x_baoduong_dinhky[]_898080" value="1"<?php echo $selwrk ?><?php echo $ck_view_nhatky_list->baoduong_dinhky->editAttributes() ?>>
	<label class="custom-control-label" for="x_baoduong_dinhky[]_898080"></label>
</div>
</span>
	</div>
	<?php if ($ck_view_nhatky_list->SearchColumnCount % $ck_view_nhatky_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($ck_view_nhatky_list->SearchColumnCount % $ck_view_nhatky_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $ck_view_nhatky_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ck_view_nhatky_list->showPageHeader(); ?>
<?php
$ck_view_nhatky_list->showMessage();
?>
<?php if ($ck_view_nhatky_list->TotalRecords > 0 || $ck_view_nhatky->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ck_view_nhatky_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ck_view_nhatky">
<?php if (!$ck_view_nhatky_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ck_view_nhatky_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ck_view_nhatky_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ck_view_nhatky_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fck_view_nhatkylist" id="fck_view_nhatkylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_view_nhatky">
<div id="gmp_ck_view_nhatky" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ck_view_nhatky_list->TotalRecords > 0 || $ck_view_nhatky_list->isGridEdit()) { ?>
<table id="tbl_ck_view_nhatkylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ck_view_nhatky->RowType = ROWTYPE_HEADER;

// Render list options
$ck_view_nhatky_list->renderListOptions();

// Render list options (header, left)
$ck_view_nhatky_list->ListOptions->render("header", "left");
?>
<?php if ($ck_view_nhatky_list->nhan_vien_id->Visible) { // nhan_vien_id ?>
	<?php if ($ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->nhan_vien_id) == "") { ?>
		<th data-name="nhan_vien_id" class="<?php echo $ck_view_nhatky_list->nhan_vien_id->headerCellClass() ?>"><div id="elh_ck_view_nhatky_nhan_vien_id" class="ck_view_nhatky_nhan_vien_id"><div class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->nhan_vien_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nhan_vien_id" class="<?php echo $ck_view_nhatky_list->nhan_vien_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->nhan_vien_id) ?>', 1);"><div id="elh_ck_view_nhatky_nhan_vien_id" class="ck_view_nhatky_nhan_vien_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->nhan_vien_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhatky_list->nhan_vien_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhatky_list->nhan_vien_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<?php if ($ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->ngay_sua_chua) == "") { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_view_nhatky_list->ngay_sua_chua->headerCellClass() ?>"><div id="elh_ck_view_nhatky_ngay_sua_chua" class="ck_view_nhatky_ngay_sua_chua"><div class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->ngay_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_view_nhatky_list->ngay_sua_chua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->ngay_sua_chua) ?>', 1);"><div id="elh_ck_view_nhatky_ngay_sua_chua" class="ck_view_nhatky_ngay_sua_chua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->ngay_sua_chua->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhatky_list->ngay_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhatky_list->ngay_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->thoi_gian->Visible) { // thoi_gian ?>
	<?php if ($ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->thoi_gian) == "") { ?>
		<th data-name="thoi_gian" class="<?php echo $ck_view_nhatky_list->thoi_gian->headerCellClass() ?>"><div id="elh_ck_view_nhatky_thoi_gian" class="ck_view_nhatky_thoi_gian"><div class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->thoi_gian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="thoi_gian" class="<?php echo $ck_view_nhatky_list->thoi_gian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->thoi_gian) ?>', 1);"><div id="elh_ck_view_nhatky_thoi_gian" class="ck_view_nhatky_thoi_gian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->thoi_gian->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhatky_list->thoi_gian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhatky_list->thoi_gian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->chuanloai_id->Visible) { // chuanloai_id ?>
	<?php if ($ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->chuanloai_id) == "") { ?>
		<th data-name="chuanloai_id" class="<?php echo $ck_view_nhatky_list->chuanloai_id->headerCellClass() ?>"><div id="elh_ck_view_nhatky_chuanloai_id" class="ck_view_nhatky_chuanloai_id"><div class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->chuanloai_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="chuanloai_id" class="<?php echo $ck_view_nhatky_list->chuanloai_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->chuanloai_id) ?>', 1);"><div id="elh_ck_view_nhatky_chuanloai_id" class="ck_view_nhatky_chuanloai_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->chuanloai_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhatky_list->chuanloai_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhatky_list->chuanloai_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->thiet_bi_id->Visible) { // thiet_bi_id ?>
	<?php if ($ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->thiet_bi_id) == "") { ?>
		<th data-name="thiet_bi_id" class="<?php echo $ck_view_nhatky_list->thiet_bi_id->headerCellClass() ?>"><div id="elh_ck_view_nhatky_thiet_bi_id" class="ck_view_nhatky_thiet_bi_id"><div class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->thiet_bi_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="thiet_bi_id" class="<?php echo $ck_view_nhatky_list->thiet_bi_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->thiet_bi_id) ?>', 1);"><div id="elh_ck_view_nhatky_thiet_bi_id" class="ck_view_nhatky_thiet_bi_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->thiet_bi_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhatky_list->thiet_bi_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhatky_list->thiet_bi_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->so_don_hang_id->Visible) { // so_don_hang_id ?>
	<?php if ($ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->so_don_hang_id) == "") { ?>
		<th data-name="so_don_hang_id" class="<?php echo $ck_view_nhatky_list->so_don_hang_id->headerCellClass() ?>"><div id="elh_ck_view_nhatky_so_don_hang_id" class="ck_view_nhatky_so_don_hang_id"><div class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->so_don_hang_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="so_don_hang_id" class="<?php echo $ck_view_nhatky_list->so_don_hang_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->so_don_hang_id) ?>', 1);"><div id="elh_ck_view_nhatky_so_don_hang_id" class="ck_view_nhatky_so_don_hang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->so_don_hang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhatky_list->so_don_hang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhatky_list->so_don_hang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->ngay_hoan_thanh->Visible) { // ngay_hoan_thanh ?>
	<?php if ($ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->ngay_hoan_thanh) == "") { ?>
		<th data-name="ngay_hoan_thanh" class="<?php echo $ck_view_nhatky_list->ngay_hoan_thanh->headerCellClass() ?>"><div id="elh_ck_view_nhatky_ngay_hoan_thanh" class="ck_view_nhatky_ngay_hoan_thanh"><div class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->ngay_hoan_thanh->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ngay_hoan_thanh" class="<?php echo $ck_view_nhatky_list->ngay_hoan_thanh->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->ngay_hoan_thanh) ?>', 1);"><div id="elh_ck_view_nhatky_ngay_hoan_thanh" class="ck_view_nhatky_ngay_hoan_thanh">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->ngay_hoan_thanh->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhatky_list->ngay_hoan_thanh->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhatky_list->ngay_hoan_thanh->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_list->baoduong_dinhky->Visible) { // baoduong_dinhky ?>
	<?php if ($ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->baoduong_dinhky) == "") { ?>
		<th data-name="baoduong_dinhky" class="<?php echo $ck_view_nhatky_list->baoduong_dinhky->headerCellClass() ?>"><div id="elh_ck_view_nhatky_baoduong_dinhky" class="ck_view_nhatky_baoduong_dinhky"><div class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->baoduong_dinhky->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="baoduong_dinhky" class="<?php echo $ck_view_nhatky_list->baoduong_dinhky->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_view_nhatky_list->SortUrl($ck_view_nhatky_list->baoduong_dinhky) ?>', 1);"><div id="elh_ck_view_nhatky_baoduong_dinhky" class="ck_view_nhatky_baoduong_dinhky">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhatky_list->baoduong_dinhky->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhatky_list->baoduong_dinhky->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhatky_list->baoduong_dinhky->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ck_view_nhatky_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ck_view_nhatky_list->ExportAll && $ck_view_nhatky_list->isExport()) {
	$ck_view_nhatky_list->StopRecord = $ck_view_nhatky_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ck_view_nhatky_list->TotalRecords > $ck_view_nhatky_list->StartRecord + $ck_view_nhatky_list->DisplayRecords - 1)
		$ck_view_nhatky_list->StopRecord = $ck_view_nhatky_list->StartRecord + $ck_view_nhatky_list->DisplayRecords - 1;
	else
		$ck_view_nhatky_list->StopRecord = $ck_view_nhatky_list->TotalRecords;
}
$ck_view_nhatky_list->RecordCount = $ck_view_nhatky_list->StartRecord - 1;
if ($ck_view_nhatky_list->Recordset && !$ck_view_nhatky_list->Recordset->EOF) {
	$ck_view_nhatky_list->Recordset->moveFirst();
	$selectLimit = $ck_view_nhatky_list->UseSelectLimit;
	if (!$selectLimit && $ck_view_nhatky_list->StartRecord > 1)
		$ck_view_nhatky_list->Recordset->move($ck_view_nhatky_list->StartRecord - 1);
} elseif (!$ck_view_nhatky->AllowAddDeleteRow && $ck_view_nhatky_list->StopRecord == 0) {
	$ck_view_nhatky_list->StopRecord = $ck_view_nhatky->GridAddRowCount;
}

// Initialize aggregate
$ck_view_nhatky->RowType = ROWTYPE_AGGREGATEINIT;
$ck_view_nhatky->resetAttributes();
$ck_view_nhatky_list->renderRow();
while ($ck_view_nhatky_list->RecordCount < $ck_view_nhatky_list->StopRecord) {
	$ck_view_nhatky_list->RecordCount++;
	if ($ck_view_nhatky_list->RecordCount >= $ck_view_nhatky_list->StartRecord) {
		$ck_view_nhatky_list->RowCount++;

		// Set up key count
		$ck_view_nhatky_list->KeyCount = $ck_view_nhatky_list->RowIndex;

		// Init row class and style
		$ck_view_nhatky->resetAttributes();
		$ck_view_nhatky->CssClass = "";
		if ($ck_view_nhatky_list->isGridAdd()) {
		} else {
			$ck_view_nhatky_list->loadRowValues($ck_view_nhatky_list->Recordset); // Load row values
		}
		$ck_view_nhatky->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ck_view_nhatky->RowAttrs->merge(["data-rowindex" => $ck_view_nhatky_list->RowCount, "id" => "r" . $ck_view_nhatky_list->RowCount . "_ck_view_nhatky", "data-rowtype" => $ck_view_nhatky->RowType]);

		// Render row
		$ck_view_nhatky_list->renderRow();

		// Render list options
		$ck_view_nhatky_list->renderListOptions();
?>
	<tr <?php echo $ck_view_nhatky->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_view_nhatky_list->ListOptions->render("body", "left", $ck_view_nhatky_list->RowCount);
?>
	<?php if ($ck_view_nhatky_list->nhan_vien_id->Visible) { // nhan_vien_id ?>
		<td data-name="nhan_vien_id" <?php echo $ck_view_nhatky_list->nhan_vien_id->cellAttributes() ?>>
<span id="el<?php echo $ck_view_nhatky_list->RowCount ?>_ck_view_nhatky_nhan_vien_id">
<span<?php echo $ck_view_nhatky_list->nhan_vien_id->viewAttributes() ?>><?php echo $ck_view_nhatky_list->nhan_vien_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_view_nhatky_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td data-name="ngay_sua_chua" <?php echo $ck_view_nhatky_list->ngay_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $ck_view_nhatky_list->RowCount ?>_ck_view_nhatky_ngay_sua_chua">
<span<?php echo $ck_view_nhatky_list->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_view_nhatky_list->ngay_sua_chua->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_view_nhatky_list->thoi_gian->Visible) { // thoi_gian ?>
		<td data-name="thoi_gian" <?php echo $ck_view_nhatky_list->thoi_gian->cellAttributes() ?>>
<span id="el<?php echo $ck_view_nhatky_list->RowCount ?>_ck_view_nhatky_thoi_gian">
<span<?php echo $ck_view_nhatky_list->thoi_gian->viewAttributes() ?>><?php echo $ck_view_nhatky_list->thoi_gian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_view_nhatky_list->chuanloai_id->Visible) { // chuanloai_id ?>
		<td data-name="chuanloai_id" <?php echo $ck_view_nhatky_list->chuanloai_id->cellAttributes() ?>>
<span id="el<?php echo $ck_view_nhatky_list->RowCount ?>_ck_view_nhatky_chuanloai_id">
<span<?php echo $ck_view_nhatky_list->chuanloai_id->viewAttributes() ?>><?php echo $ck_view_nhatky_list->chuanloai_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_view_nhatky_list->thiet_bi_id->Visible) { // thiet_bi_id ?>
		<td data-name="thiet_bi_id" <?php echo $ck_view_nhatky_list->thiet_bi_id->cellAttributes() ?>>
<span id="el<?php echo $ck_view_nhatky_list->RowCount ?>_ck_view_nhatky_thiet_bi_id">
<span<?php echo $ck_view_nhatky_list->thiet_bi_id->viewAttributes() ?>><?php echo $ck_view_nhatky_list->thiet_bi_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_view_nhatky_list->so_don_hang_id->Visible) { // so_don_hang_id ?>
		<td data-name="so_don_hang_id" <?php echo $ck_view_nhatky_list->so_don_hang_id->cellAttributes() ?>>
<span id="el<?php echo $ck_view_nhatky_list->RowCount ?>_ck_view_nhatky_so_don_hang_id">
<span<?php echo $ck_view_nhatky_list->so_don_hang_id->viewAttributes() ?>><?php echo $ck_view_nhatky_list->so_don_hang_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_view_nhatky_list->ngay_hoan_thanh->Visible) { // ngay_hoan_thanh ?>
		<td data-name="ngay_hoan_thanh" <?php echo $ck_view_nhatky_list->ngay_hoan_thanh->cellAttributes() ?>>
<span id="el<?php echo $ck_view_nhatky_list->RowCount ?>_ck_view_nhatky_ngay_hoan_thanh">
<span<?php echo $ck_view_nhatky_list->ngay_hoan_thanh->viewAttributes() ?>><?php echo $ck_view_nhatky_list->ngay_hoan_thanh->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_view_nhatky_list->baoduong_dinhky->Visible) { // baoduong_dinhky ?>
		<td data-name="baoduong_dinhky" <?php echo $ck_view_nhatky_list->baoduong_dinhky->cellAttributes() ?>>
<span id="el<?php echo $ck_view_nhatky_list->RowCount ?>_ck_view_nhatky_baoduong_dinhky">
<span<?php echo $ck_view_nhatky_list->baoduong_dinhky->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_baoduong_dinhky" class="custom-control-input" value="<?php echo $ck_view_nhatky_list->baoduong_dinhky->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_view_nhatky_list->baoduong_dinhky->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_baoduong_dinhky"></label></div></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_view_nhatky_list->ListOptions->render("body", "right", $ck_view_nhatky_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ck_view_nhatky_list->isGridAdd())
		$ck_view_nhatky_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ck_view_nhatky->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ck_view_nhatky_list->Recordset)
	$ck_view_nhatky_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ck_view_nhatky_list->TotalRecords == 0 && !$ck_view_nhatky->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ck_view_nhatky_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ck_view_nhatky_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ck_view_nhatky_list->isExport()) { ?>
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
$ck_view_nhatky_list->terminate();
?>