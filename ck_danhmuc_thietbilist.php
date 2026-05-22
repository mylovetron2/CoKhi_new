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
$ck_danhmuc_thietbi_list = new ck_danhmuc_thietbi_list();

// Run the page
$ck_danhmuc_thietbi_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_danhmuc_thietbi_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ck_danhmuc_thietbi_list->isExport()) { ?>
<script>
var fck_danhmuc_thietbilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fck_danhmuc_thietbilist = currentForm = new ew.Form("fck_danhmuc_thietbilist", "list");
	fck_danhmuc_thietbilist.formKeyCountName = '<?php echo $ck_danhmuc_thietbi_list->FormKeyCountName ?>';
	loadjs.done("fck_danhmuc_thietbilist");
});
var fck_danhmuc_thietbilistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fck_danhmuc_thietbilistsrch = currentSearchForm = new ew.Form("fck_danhmuc_thietbilistsrch");

	// Validate function for search
	fck_danhmuc_thietbilistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fck_danhmuc_thietbilistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fck_danhmuc_thietbilistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fck_danhmuc_thietbilistsrch.lists["x_chung_loai_id"] = <?php echo $ck_danhmuc_thietbi_list->chung_loai_id->Lookup->toClientList($ck_danhmuc_thietbi_list) ?>;
	fck_danhmuc_thietbilistsrch.lists["x_chung_loai_id"].options = <?php echo JsonEncode($ck_danhmuc_thietbi_list->chung_loai_id->lookupOptions()) ?>;

	// Filters
	fck_danhmuc_thietbilistsrch.filterList = <?php echo $ck_danhmuc_thietbi_list->getFilterList() ?>;
	loadjs.done("fck_danhmuc_thietbilistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ck_danhmuc_thietbi_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ck_danhmuc_thietbi_list->TotalRecords > 0 && $ck_danhmuc_thietbi_list->ExportOptions->visible()) { ?>
<?php $ck_danhmuc_thietbi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_list->ImportOptions->visible()) { ?>
<?php $ck_danhmuc_thietbi_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_list->SearchOptions->visible()) { ?>
<?php $ck_danhmuc_thietbi_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_list->FilterOptions->visible()) { ?>
<?php $ck_danhmuc_thietbi_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$ck_danhmuc_thietbi_list->isExport() || Config("EXPORT_MASTER_RECORD") && $ck_danhmuc_thietbi_list->isExport("print")) { ?>
<?php
if ($ck_danhmuc_thietbi_list->DbMasterFilter != "" && $ck_danhmuc_thietbi->getCurrentMasterTable() == "ck_chungloai_thietbi") {
	if ($ck_danhmuc_thietbi_list->MasterRecordExists) {
		include_once "ck_chungloai_thietbimaster.php";
	}
}
?>
<?php } ?>
<?php
$ck_danhmuc_thietbi_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ck_danhmuc_thietbi_list->isExport() && !$ck_danhmuc_thietbi->CurrentAction) { ?>
<form name="fck_danhmuc_thietbilistsrch" id="fck_danhmuc_thietbilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fck_danhmuc_thietbilistsrch-search-panel" class="<?php echo $ck_danhmuc_thietbi_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ck_danhmuc_thietbi">
	<div class="ew-extended-search">
<?php

// Render search row
$ck_danhmuc_thietbi->RowType = ROWTYPE_SEARCH;
$ck_danhmuc_thietbi->resetAttributes();
$ck_danhmuc_thietbi_list->renderRow();
?>
<?php if ($ck_danhmuc_thietbi_list->chung_loai_id->Visible) { // chung_loai_id ?>
	<?php
		$ck_danhmuc_thietbi_list->SearchColumnCount++;
		if (($ck_danhmuc_thietbi_list->SearchColumnCount - 1) % $ck_danhmuc_thietbi_list->SearchFieldsPerRow == 0) {
			$ck_danhmuc_thietbi_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $ck_danhmuc_thietbi_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_chung_loai_id" class="ew-cell form-group">
		<label for="x_chung_loai_id" class="ew-search-caption ew-label"><?php echo $ck_danhmuc_thietbi_list->chung_loai_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_chung_loai_id" id="z_chung_loai_id" value="=">
</span>
		<span id="el_ck_danhmuc_thietbi_chung_loai_id" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_thietbi" data-field="x_chung_loai_id" data-value-separator="<?php echo $ck_danhmuc_thietbi_list->chung_loai_id->displayValueSeparatorAttribute() ?>" id="x_chung_loai_id" name="x_chung_loai_id"<?php echo $ck_danhmuc_thietbi_list->chung_loai_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_thietbi_list->chung_loai_id->selectOptionListHtml("x_chung_loai_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_thietbi_list->chung_loai_id->Lookup->getParamTag($ck_danhmuc_thietbi_list, "p_x_chung_loai_id") ?>
</span>
	</div>
	<?php if ($ck_danhmuc_thietbi_list->SearchColumnCount % $ck_danhmuc_thietbi_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($ck_danhmuc_thietbi_list->SearchColumnCount % $ck_danhmuc_thietbi_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $ck_danhmuc_thietbi_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ck_danhmuc_thietbi_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ck_danhmuc_thietbi_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ck_danhmuc_thietbi_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ck_danhmuc_thietbi_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ck_danhmuc_thietbi_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ck_danhmuc_thietbi_list->showPageHeader(); ?>
<?php
$ck_danhmuc_thietbi_list->showMessage();
?>
<?php if ($ck_danhmuc_thietbi_list->TotalRecords > 0 || $ck_danhmuc_thietbi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ck_danhmuc_thietbi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ck_danhmuc_thietbi">
<?php if (!$ck_danhmuc_thietbi_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ck_danhmuc_thietbi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ck_danhmuc_thietbi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ck_danhmuc_thietbi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fck_danhmuc_thietbilist" id="fck_danhmuc_thietbilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_danhmuc_thietbi">
<?php if ($ck_danhmuc_thietbi->getCurrentMasterTable() == "ck_chungloai_thietbi" && $ck_danhmuc_thietbi->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="ck_chungloai_thietbi">
<input type="hidden" name="fk_chungloai_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_list->chung_loai_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_ck_danhmuc_thietbi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ck_danhmuc_thietbi_list->TotalRecords > 0 || $ck_danhmuc_thietbi_list->isGridEdit()) { ?>
<table id="tbl_ck_danhmuc_thietbilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ck_danhmuc_thietbi->RowType = ROWTYPE_HEADER;

// Render list options
$ck_danhmuc_thietbi_list->renderListOptions();

// Render list options (header, left)
$ck_danhmuc_thietbi_list->ListOptions->render("header", "left");
?>
<?php if ($ck_danhmuc_thietbi_list->chung_loai_id->Visible) { // chung_loai_id ?>
	<?php if ($ck_danhmuc_thietbi_list->SortUrl($ck_danhmuc_thietbi_list->chung_loai_id) == "") { ?>
		<th data-name="chung_loai_id" class="<?php echo $ck_danhmuc_thietbi_list->chung_loai_id->headerCellClass() ?>"><div id="elh_ck_danhmuc_thietbi_chung_loai_id" class="ck_danhmuc_thietbi_chung_loai_id"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_list->chung_loai_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="chung_loai_id" class="<?php echo $ck_danhmuc_thietbi_list->chung_loai_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_thietbi_list->SortUrl($ck_danhmuc_thietbi_list->chung_loai_id) ?>', 1);"><div id="elh_ck_danhmuc_thietbi_chung_loai_id" class="ck_danhmuc_thietbi_chung_loai_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_list->chung_loai_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_thietbi_list->chung_loai_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_thietbi_list->chung_loai_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_list->ky_ma_hieu->Visible) { // ky_ma_hieu ?>
	<?php if ($ck_danhmuc_thietbi_list->SortUrl($ck_danhmuc_thietbi_list->ky_ma_hieu) == "") { ?>
		<th data-name="ky_ma_hieu" class="<?php echo $ck_danhmuc_thietbi_list->ky_ma_hieu->headerCellClass() ?>"><div id="elh_ck_danhmuc_thietbi_ky_ma_hieu" class="ck_danhmuc_thietbi_ky_ma_hieu"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_list->ky_ma_hieu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ky_ma_hieu" class="<?php echo $ck_danhmuc_thietbi_list->ky_ma_hieu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_thietbi_list->SortUrl($ck_danhmuc_thietbi_list->ky_ma_hieu) ?>', 1);"><div id="elh_ck_danhmuc_thietbi_ky_ma_hieu" class="ck_danhmuc_thietbi_ky_ma_hieu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_list->ky_ma_hieu->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_thietbi_list->ky_ma_hieu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_thietbi_list->ky_ma_hieu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_list->bo_phan->Visible) { // bo_phan ?>
	<?php if ($ck_danhmuc_thietbi_list->SortUrl($ck_danhmuc_thietbi_list->bo_phan) == "") { ?>
		<th data-name="bo_phan" class="<?php echo $ck_danhmuc_thietbi_list->bo_phan->headerCellClass() ?>"><div id="elh_ck_danhmuc_thietbi_bo_phan" class="ck_danhmuc_thietbi_bo_phan"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_list->bo_phan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bo_phan" class="<?php echo $ck_danhmuc_thietbi_list->bo_phan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_thietbi_list->SortUrl($ck_danhmuc_thietbi_list->bo_phan) ?>', 1);"><div id="elh_ck_danhmuc_thietbi_bo_phan" class="ck_danhmuc_thietbi_bo_phan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_list->bo_phan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_thietbi_list->bo_phan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_thietbi_list->bo_phan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_list->namsx->Visible) { // namsx ?>
	<?php if ($ck_danhmuc_thietbi_list->SortUrl($ck_danhmuc_thietbi_list->namsx) == "") { ?>
		<th data-name="namsx" class="<?php echo $ck_danhmuc_thietbi_list->namsx->headerCellClass() ?>"><div id="elh_ck_danhmuc_thietbi_namsx" class="ck_danhmuc_thietbi_namsx"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_list->namsx->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="namsx" class="<?php echo $ck_danhmuc_thietbi_list->namsx->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_thietbi_list->SortUrl($ck_danhmuc_thietbi_list->namsx) ?>', 1);"><div id="elh_ck_danhmuc_thietbi_namsx" class="ck_danhmuc_thietbi_namsx">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_list->namsx->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_thietbi_list->namsx->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_thietbi_list->namsx->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_list->ghi_chu->Visible) { // ghi_chu ?>
	<?php if ($ck_danhmuc_thietbi_list->SortUrl($ck_danhmuc_thietbi_list->ghi_chu) == "") { ?>
		<th data-name="ghi_chu" class="<?php echo $ck_danhmuc_thietbi_list->ghi_chu->headerCellClass() ?>"><div id="elh_ck_danhmuc_thietbi_ghi_chu" class="ck_danhmuc_thietbi_ghi_chu"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_list->ghi_chu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ghi_chu" class="<?php echo $ck_danhmuc_thietbi_list->ghi_chu->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_danhmuc_thietbi_list->SortUrl($ck_danhmuc_thietbi_list->ghi_chu) ?>', 1);"><div id="elh_ck_danhmuc_thietbi_ghi_chu" class="ck_danhmuc_thietbi_ghi_chu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_thietbi_list->ghi_chu->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_thietbi_list->ghi_chu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_thietbi_list->ghi_chu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ck_danhmuc_thietbi_list->ListOptions->render("header", "right");
?>
	<th class="text-center" style="width:90px">Tài liệu</th>
	</tr>
</thead>
<tbody>
<?php
if ($ck_danhmuc_thietbi_list->ExportAll && $ck_danhmuc_thietbi_list->isExport()) {
	$ck_danhmuc_thietbi_list->StopRecord = $ck_danhmuc_thietbi_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ck_danhmuc_thietbi_list->TotalRecords > $ck_danhmuc_thietbi_list->StartRecord + $ck_danhmuc_thietbi_list->DisplayRecords - 1)
		$ck_danhmuc_thietbi_list->StopRecord = $ck_danhmuc_thietbi_list->StartRecord + $ck_danhmuc_thietbi_list->DisplayRecords - 1;
	else
		$ck_danhmuc_thietbi_list->StopRecord = $ck_danhmuc_thietbi_list->TotalRecords;
}
$ck_danhmuc_thietbi_list->RecordCount = $ck_danhmuc_thietbi_list->StartRecord - 1;
if ($ck_danhmuc_thietbi_list->Recordset && !$ck_danhmuc_thietbi_list->Recordset->EOF) {
	$ck_danhmuc_thietbi_list->Recordset->moveFirst();
	$selectLimit = $ck_danhmuc_thietbi_list->UseSelectLimit;
	if (!$selectLimit && $ck_danhmuc_thietbi_list->StartRecord > 1)
		$ck_danhmuc_thietbi_list->Recordset->move($ck_danhmuc_thietbi_list->StartRecord - 1);
} elseif (!$ck_danhmuc_thietbi->AllowAddDeleteRow && $ck_danhmuc_thietbi_list->StopRecord == 0) {
	$ck_danhmuc_thietbi_list->StopRecord = $ck_danhmuc_thietbi->GridAddRowCount;
}

// Initialize aggregate
$ck_danhmuc_thietbi->RowType = ROWTYPE_AGGREGATEINIT;
$ck_danhmuc_thietbi->resetAttributes();
$ck_danhmuc_thietbi_list->renderRow();
while ($ck_danhmuc_thietbi_list->RecordCount < $ck_danhmuc_thietbi_list->StopRecord) {
	$ck_danhmuc_thietbi_list->RecordCount++;
	if ($ck_danhmuc_thietbi_list->RecordCount >= $ck_danhmuc_thietbi_list->StartRecord) {
		$ck_danhmuc_thietbi_list->RowCount++;

		// Set up key count
		$ck_danhmuc_thietbi_list->KeyCount = $ck_danhmuc_thietbi_list->RowIndex;

		// Init row class and style
		$ck_danhmuc_thietbi->resetAttributes();
		$ck_danhmuc_thietbi->CssClass = "";
		if ($ck_danhmuc_thietbi_list->isGridAdd()) {
		} else {
			$ck_danhmuc_thietbi_list->loadRowValues($ck_danhmuc_thietbi_list->Recordset); // Load row values
		}
		$ck_danhmuc_thietbi->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ck_danhmuc_thietbi->RowAttrs->merge(["data-rowindex" => $ck_danhmuc_thietbi_list->RowCount, "id" => "r" . $ck_danhmuc_thietbi_list->RowCount . "_ck_danhmuc_thietbi", "data-rowtype" => $ck_danhmuc_thietbi->RowType]);

		// Render row
		$ck_danhmuc_thietbi_list->renderRow();

		// Render list options
		$ck_danhmuc_thietbi_list->renderListOptions();
?>
	<tr <?php echo $ck_danhmuc_thietbi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_danhmuc_thietbi_list->ListOptions->render("body", "left", $ck_danhmuc_thietbi_list->RowCount);
?>
	<?php if ($ck_danhmuc_thietbi_list->chung_loai_id->Visible) { // chung_loai_id ?>
		<td data-name="chung_loai_id" <?php echo $ck_danhmuc_thietbi_list->chung_loai_id->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_thietbi_list->RowCount ?>_ck_danhmuc_thietbi_chung_loai_id">
<span<?php echo $ck_danhmuc_thietbi_list->chung_loai_id->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_list->chung_loai_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_thietbi_list->ky_ma_hieu->Visible) { // ky_ma_hieu ?>
		<td data-name="ky_ma_hieu" <?php echo $ck_danhmuc_thietbi_list->ky_ma_hieu->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_thietbi_list->RowCount ?>_ck_danhmuc_thietbi_ky_ma_hieu">
<span<?php echo $ck_danhmuc_thietbi_list->ky_ma_hieu->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_list->ky_ma_hieu->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_thietbi_list->bo_phan->Visible) { // bo_phan ?>
		<td data-name="bo_phan" <?php echo $ck_danhmuc_thietbi_list->bo_phan->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_thietbi_list->RowCount ?>_ck_danhmuc_thietbi_bo_phan">
<span<?php echo $ck_danhmuc_thietbi_list->bo_phan->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_list->bo_phan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_thietbi_list->namsx->Visible) { // namsx ?>
		<td data-name="namsx" <?php echo $ck_danhmuc_thietbi_list->namsx->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_thietbi_list->RowCount ?>_ck_danhmuc_thietbi_namsx">
<span<?php echo $ck_danhmuc_thietbi_list->namsx->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_list->namsx->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_thietbi_list->ghi_chu->Visible) { // ghi_chu ?>
		<td data-name="ghi_chu" <?php echo $ck_danhmuc_thietbi_list->ghi_chu->cellAttributes() ?>>
<span id="el<?php echo $ck_danhmuc_thietbi_list->RowCount ?>_ck_danhmuc_thietbi_ghi_chu">
<span<?php echo $ck_danhmuc_thietbi_list->ghi_chu->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi_list->ghi_chu->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_danhmuc_thietbi_list->ListOptions->render("body", "right", $ck_danhmuc_thietbi_list->RowCount);
?>
	<td class="text-center">
		<button type="button"
		   class="btn btn-xs btn-info btn-tai-lieu"
		   data-bang="ck_danhmuc_thietbi"
		   data-id="<?php echo (int)$ck_danhmuc_thietbi_list->thiet_bi_id->CurrentValue ?>"
		   data-ten="<?php $_tenTB = $ck_danhmuc_thietbi_list->ky_ma_hieu->CurrentValue; echo htmlspecialchars($_tenTB ? $_tenTB : ('TB #' . (int)$ck_danhmuc_thietbi_list->thiet_bi_id->CurrentValue), ENT_QUOTES); ?>"
		   title="Tài liệu đính kèm">
			<i class="fas fa-paperclip"></i>
		</button>
	</td>
	</tr>
<?php
	}
	if (!$ck_danhmuc_thietbi_list->isGridAdd())
		$ck_danhmuc_thietbi_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ck_danhmuc_thietbi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ck_danhmuc_thietbi_list->Recordset)
	$ck_danhmuc_thietbi_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ck_danhmuc_thietbi_list->TotalRecords == 0 && !$ck_danhmuc_thietbi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ck_danhmuc_thietbi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ck_danhmuc_thietbi_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ck_danhmuc_thietbi_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>

<!-- ===== MODAL TÀI LIỆU ĐÍNH KÈM ===== -->
<div class="modal fade" id="modalTaiLieu" tabindex="-1" role="dialog" aria-labelledby="modalTaiLieuLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalTaiLieuLabel"><i class="fas fa-paperclip mr-2"></i>Tài liệu đính kèm — <span id="mlTieuDe"></span></h5>
        <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <!-- Form upload -->
        <form id="formTaiLieu" enctype="multipart/form-data">
          <input type="hidden" id="mlBang" name="bang" value="">
          <input type="hidden" id="mlId" name="ban_ghi_id" value="">
          <div class="form-row align-items-end">
            <div class="col-md-4">
              <label class="font-weight-bold">Chọn file <span class="text-danger">*</span></label>
              <input type="file" name="file" id="mlFile" class="form-control-file border p-1 w-100" required>
            </div>
            <div class="col-md-4">
              <label>Mô tả</label>
              <input type="text" name="description" id="mlMota" class="form-control" placeholder="Mô tả ngắn...">
            </div>
            <div class="col-md-2">
              <label>Người upload</label>
              <input type="text" name="nguoi_upload" id="mlNguoi" class="form-control" placeholder="Tên bạn">
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary btn-block" id="btnTaiLieu">
                <i class="fas fa-upload mr-1"></i>Upload
              </button>
            </div>
          </div>
          <div id="mlAlert" class="mt-2" style="display:none"></div>
        </form>
        <hr>
        <!-- Danh sách file -->
        <div id="mlDanhSach">
          <p class="text-muted text-center py-2"><i class="fas fa-spinner fa-spin mr-1"></i>Đang tải...</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
loadjs.ready("load", function() {
(function($) {
  // Mở modal
  $(document).on('click', '.btn-tai-lieu', function(e) {
    e.preventDefault();
    e.stopPropagation();
    var bang = $(this).data('bang');
    var id   = $(this).data('id');
    var ten  = $(this).data('ten') || ('#' + id);
    $('#mlBang').val(bang);
    $('#mlId').val(id);
    $('#mlTieuDe').text(ten);
    $('#mlAlert').hide();
    $('#mlFile').val('');
    $('#mlMota').val('');
    taiDanhSach(bang, id);
    $('#modalTaiLieu').modal('show');
  });

  // Tải danh sách file
  function taiDanhSach(bang, id) {
    $('#mlDanhSach').html('<p class="text-muted text-center py-2"><i class="fas fa-spinner fa-spin mr-1"></i>Đang tải...</p>');
    $.getJSON('api/upload_tai_lieu.php?action=list&bang=' + encodeURIComponent(bang) + '&id=' + id, function(data) {
      if (!data.files || data.files.length === 0) {
        $('#mlDanhSach').html('<p class="text-muted text-center py-2"><i class="fas fa-inbox mr-1"></i>Chưa có tài liệu</p>');
        return;
      }
      var html = '<table class="table table-sm table-hover">'
               + '<thead class="thead-dark"><tr><th>Tên file</th><th>Mô tả</th><th>Người upload</th><th>Ngày</th><th></th></tr></thead><tbody>';
      $.each(data.files, function(i, f) {
        html += '<tr>'
              + '<td><i class="fas fa-file mr-1 text-info"></i>' + esc(f.ten_file) + '</td>'
              + '<td>' + esc(f.mo_ta) + '</td>'
              + '<td>' + esc(f.nguoi_upload) + '</td>'
              + '<td>' + esc(f.ngay_upload) + '</td>'
              + '<td>'
              + (f.web_link ? '<a href="'+esc(f.web_link)+'" target="_blank" rel="noopener" class="btn btn-xs btn-info mr-1"><i class="fas fa-eye"></i></a>' : '')
              + (f.download_link ? '<a href="'+esc(f.download_link)+'" target="_blank" rel="noopener" class="btn btn-xs btn-success mr-1"><i class="fas fa-download"></i></a>' : '')
              + '<button class="btn btn-xs btn-danger btn-xoa" data-id="'+f.id+'"><i class="fas fa-trash"></i></button>'
              + '</td></tr>';
      });
      html += '</tbody></table>';
      $('#mlDanhSach').html(html);
    }).fail(function() {
      $('#mlDanhSach').html('<p class="text-danger text-center">Không tải được danh sách</p>');
    });
  }

  // Upload
  $('#formTaiLieu').on('submit', function(e) {
    e.preventDefault();
    var fd  = new FormData(this);
    var btn = $('#btnTaiLieu');
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Đang upload...');
    $.ajax({
      url: 'api/upload_tai_lieu.php',
      type: 'POST',
      data: fd,
      processData: false,
      contentType: false,
      dataType: 'json',
      success: function(res) {
        if (res.success) {
          $('#mlAlert').removeClass('alert-danger').addClass('alert alert-success').text(res.message).show();
          $('#mlFile').val(''); $('#mlMota').val('');
          taiDanhSach($('#mlBang').val(), $('#mlId').val());
        } else {
          $('#mlAlert').removeClass('alert-success').addClass('alert alert-danger').text(res.message).show();
        }
      },
      error: function() {
        $('#mlAlert').addClass('alert alert-danger').text('Lỗi kết nối server').show();
      },
      complete: function() {
        btn.prop('disabled', false).html('<i class="fas fa-upload mr-1"></i>Upload');
      }
    });
  });

  // Xóa file
  $(document).on('click', '.btn-xoa', function() {
    if (!confirm('Xóa tài liệu này?')) return;
    var id = $(this).data('id');
    $.post('api/upload_tai_lieu.php', {action: 'delete', tai_lieu_id: id}, function(res) {
      if (res.success) taiDanhSach($('#mlBang').val(), $('#mlId').val());
    }, 'json');
  });

  function esc(s) {
    return $('<div>').text(s || '').html();
  }
})(jQuery);
});
</script>
<?php include_once "footer.php"; ?>
<?php
$ck_danhmuc_thietbi_list->terminate();
?>