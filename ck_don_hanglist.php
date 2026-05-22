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
$ck_don_hang_list = new ck_don_hang_list();

// Run the page
$ck_don_hang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_don_hang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ck_don_hang_list->isExport()) { ?>
<script>
var fck_don_hanglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fck_don_hanglist = currentForm = new ew.Form("fck_don_hanglist", "list");
	fck_don_hanglist.formKeyCountName = '<?php echo $ck_don_hang_list->FormKeyCountName ?>';
	loadjs.done("fck_don_hanglist");
});
var fck_don_hanglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fck_don_hanglistsrch = currentSearchForm = new ew.Form("fck_don_hanglistsrch");

	// Dynamic selection lists
	// Filters

	fck_don_hanglistsrch.filterList = <?php echo $ck_don_hang_list->getFilterList() ?>;
	loadjs.done("fck_don_hanglistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ck_don_hang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ck_don_hang_list->TotalRecords > 0 && $ck_don_hang_list->ExportOptions->visible()) { ?>
<?php $ck_don_hang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ck_don_hang_list->ImportOptions->visible()) { ?>
<?php $ck_don_hang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ck_don_hang_list->SearchOptions->visible()) { ?>
<?php $ck_don_hang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ck_don_hang_list->FilterOptions->visible()) { ?>
<?php $ck_don_hang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ck_don_hang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ck_don_hang_list->isExport() && !$ck_don_hang->CurrentAction) { ?>
<form name="fck_don_hanglistsrch" id="fck_don_hanglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fck_don_hanglistsrch-search-panel" class="<?php echo $ck_don_hang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ck_don_hang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ck_don_hang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ck_don_hang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ck_don_hang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ck_don_hang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ck_don_hang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ck_don_hang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ck_don_hang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ck_don_hang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ck_don_hang_list->showPageHeader(); ?>
<?php
$ck_don_hang_list->showMessage();
?>
<?php if ($ck_don_hang_list->TotalRecords > 0 || $ck_don_hang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ck_don_hang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ck_don_hang">
<?php if (!$ck_don_hang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ck_don_hang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ck_don_hang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ck_don_hang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fck_don_hanglist" id="fck_don_hanglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_don_hang">
<div id="gmp_ck_don_hang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ck_don_hang_list->TotalRecords > 0 || $ck_don_hang_list->isGridEdit()) { ?>
<table id="tbl_ck_don_hanglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ck_don_hang->RowType = ROWTYPE_HEADER;

// Render list options
$ck_don_hang_list->renderListOptions();

// Render list options (header, left)
$ck_don_hang_list->ListOptions->render("header", "left");
?>
<?php if ($ck_don_hang_list->so_don_hang_id->Visible) { // so_don_hang_id ?>
	<?php if ($ck_don_hang_list->SortUrl($ck_don_hang_list->so_don_hang_id) == "") { ?>
		<th data-name="so_don_hang_id" class="<?php echo $ck_don_hang_list->so_don_hang_id->headerCellClass() ?>"><div id="elh_ck_don_hang_so_don_hang_id" class="ck_don_hang_so_don_hang_id"><div class="ew-table-header-caption"><?php echo $ck_don_hang_list->so_don_hang_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="so_don_hang_id" class="<?php echo $ck_don_hang_list->so_don_hang_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_don_hang_list->SortUrl($ck_don_hang_list->so_don_hang_id) ?>', 1);"><div id="elh_ck_don_hang_so_don_hang_id" class="ck_don_hang_so_don_hang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_don_hang_list->so_don_hang_id->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ck_don_hang_list->so_don_hang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_don_hang_list->so_don_hang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_don_hang_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<?php if ($ck_don_hang_list->SortUrl($ck_don_hang_list->ngay_sua_chua) == "") { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_don_hang_list->ngay_sua_chua->headerCellClass() ?>"><div id="elh_ck_don_hang_ngay_sua_chua" class="ck_don_hang_ngay_sua_chua"><div class="ew-table-header-caption"><?php echo $ck_don_hang_list->ngay_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_don_hang_list->ngay_sua_chua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_don_hang_list->SortUrl($ck_don_hang_list->ngay_sua_chua) ?>', 1);"><div id="elh_ck_don_hang_ngay_sua_chua" class="ck_don_hang_ngay_sua_chua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_don_hang_list->ngay_sua_chua->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_don_hang_list->ngay_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_don_hang_list->ngay_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_don_hang_list->chung_loai->Visible) { // chung_loai ?>
	<?php if ($ck_don_hang_list->SortUrl($ck_don_hang_list->chung_loai) == "") { ?>
		<th data-name="chung_loai" class="<?php echo $ck_don_hang_list->chung_loai->headerCellClass() ?>"><div id="elh_ck_don_hang_chung_loai" class="ck_don_hang_chung_loai"><div class="ew-table-header-caption"><?php echo $ck_don_hang_list->chung_loai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="chung_loai" class="<?php echo $ck_don_hang_list->chung_loai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_don_hang_list->SortUrl($ck_don_hang_list->chung_loai) ?>', 1);"><div id="elh_ck_don_hang_chung_loai" class="ck_don_hang_chung_loai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_don_hang_list->chung_loai->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ck_don_hang_list->chung_loai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_don_hang_list->chung_loai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_don_hang_list->ten_thiet_bi->Visible) { // ten_thiet_bi ?>
	<?php if ($ck_don_hang_list->SortUrl($ck_don_hang_list->ten_thiet_bi) == "") { ?>
		<th data-name="ten_thiet_bi" class="<?php echo $ck_don_hang_list->ten_thiet_bi->headerCellClass() ?>"><div id="elh_ck_don_hang_ten_thiet_bi" class="ck_don_hang_ten_thiet_bi"><div class="ew-table-header-caption"><?php echo $ck_don_hang_list->ten_thiet_bi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ten_thiet_bi" class="<?php echo $ck_don_hang_list->ten_thiet_bi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_don_hang_list->SortUrl($ck_don_hang_list->ten_thiet_bi) ?>', 1);"><div id="elh_ck_don_hang_ten_thiet_bi" class="ck_don_hang_ten_thiet_bi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_don_hang_list->ten_thiet_bi->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ck_don_hang_list->ten_thiet_bi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_don_hang_list->ten_thiet_bi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_don_hang_list->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
	<?php if ($ck_don_hang_list->SortUrl($ck_don_hang_list->noi_dung_sua_chua) == "") { ?>
		<th data-name="noi_dung_sua_chua" class="<?php echo $ck_don_hang_list->noi_dung_sua_chua->headerCellClass() ?>"><div id="elh_ck_don_hang_noi_dung_sua_chua" class="ck_don_hang_noi_dung_sua_chua"><div class="ew-table-header-caption"><?php echo $ck_don_hang_list->noi_dung_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="noi_dung_sua_chua" class="<?php echo $ck_don_hang_list->noi_dung_sua_chua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_don_hang_list->SortUrl($ck_don_hang_list->noi_dung_sua_chua) ?>', 1);"><div id="elh_ck_don_hang_noi_dung_sua_chua" class="ck_don_hang_noi_dung_sua_chua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_don_hang_list->noi_dung_sua_chua->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ck_don_hang_list->noi_dung_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_don_hang_list->noi_dung_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_don_hang_list->baoduong_dinhky->Visible) { // baoduong_dinhky ?>
	<?php if ($ck_don_hang_list->SortUrl($ck_don_hang_list->baoduong_dinhky) == "") { ?>
		<th data-name="baoduong_dinhky" class="<?php echo $ck_don_hang_list->baoduong_dinhky->headerCellClass() ?>"><div id="elh_ck_don_hang_baoduong_dinhky" class="ck_don_hang_baoduong_dinhky"><div class="ew-table-header-caption"><?php echo $ck_don_hang_list->baoduong_dinhky->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="baoduong_dinhky" class="<?php echo $ck_don_hang_list->baoduong_dinhky->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_don_hang_list->SortUrl($ck_don_hang_list->baoduong_dinhky) ?>', 1);"><div id="elh_ck_don_hang_baoduong_dinhky" class="ck_don_hang_baoduong_dinhky">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_don_hang_list->baoduong_dinhky->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_don_hang_list->baoduong_dinhky->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_don_hang_list->baoduong_dinhky->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ck_don_hang_list->ListOptions->render("header", "right");
?>
	<th class="text-center" style="width:90px">Tài liệu</th>
	</tr>
</thead>
<tbody>
<?php
if ($ck_don_hang_list->ExportAll && $ck_don_hang_list->isExport()) {
	$ck_don_hang_list->StopRecord = $ck_don_hang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ck_don_hang_list->TotalRecords > $ck_don_hang_list->StartRecord + $ck_don_hang_list->DisplayRecords - 1)
		$ck_don_hang_list->StopRecord = $ck_don_hang_list->StartRecord + $ck_don_hang_list->DisplayRecords - 1;
	else
		$ck_don_hang_list->StopRecord = $ck_don_hang_list->TotalRecords;
}
$ck_don_hang_list->RecordCount = $ck_don_hang_list->StartRecord - 1;
if ($ck_don_hang_list->Recordset && !$ck_don_hang_list->Recordset->EOF) {
	$ck_don_hang_list->Recordset->moveFirst();
	$selectLimit = $ck_don_hang_list->UseSelectLimit;
	if (!$selectLimit && $ck_don_hang_list->StartRecord > 1)
		$ck_don_hang_list->Recordset->move($ck_don_hang_list->StartRecord - 1);
} elseif (!$ck_don_hang->AllowAddDeleteRow && $ck_don_hang_list->StopRecord == 0) {
	$ck_don_hang_list->StopRecord = $ck_don_hang->GridAddRowCount;
}

// Initialize aggregate
$ck_don_hang->RowType = ROWTYPE_AGGREGATEINIT;
$ck_don_hang->resetAttributes();
$ck_don_hang_list->renderRow();
while ($ck_don_hang_list->RecordCount < $ck_don_hang_list->StopRecord) {
	$ck_don_hang_list->RecordCount++;
	if ($ck_don_hang_list->RecordCount >= $ck_don_hang_list->StartRecord) {
		$ck_don_hang_list->RowCount++;

		// Set up key count
		$ck_don_hang_list->KeyCount = $ck_don_hang_list->RowIndex;

		// Init row class and style
		$ck_don_hang->resetAttributes();
		$ck_don_hang->CssClass = "";
		if ($ck_don_hang_list->isGridAdd()) {
		} else {
			$ck_don_hang_list->loadRowValues($ck_don_hang_list->Recordset); // Load row values
		}
		$ck_don_hang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ck_don_hang->RowAttrs->merge(["data-rowindex" => $ck_don_hang_list->RowCount, "id" => "r" . $ck_don_hang_list->RowCount . "_ck_don_hang", "data-rowtype" => $ck_don_hang->RowType]);

		// Render row
		$ck_don_hang_list->renderRow();

		// Render list options
		$ck_don_hang_list->renderListOptions();
?>
	<tr <?php echo $ck_don_hang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_don_hang_list->ListOptions->render("body", "left", $ck_don_hang_list->RowCount);
?>
	<?php if ($ck_don_hang_list->so_don_hang_id->Visible) { // so_don_hang_id ?>
		<td data-name="so_don_hang_id" <?php echo $ck_don_hang_list->so_don_hang_id->cellAttributes() ?>>
<span id="el<?php echo $ck_don_hang_list->RowCount ?>_ck_don_hang_so_don_hang_id">
<span<?php echo $ck_don_hang_list->so_don_hang_id->viewAttributes() ?>><?php echo $ck_don_hang_list->so_don_hang_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_don_hang_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td data-name="ngay_sua_chua" <?php echo $ck_don_hang_list->ngay_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $ck_don_hang_list->RowCount ?>_ck_don_hang_ngay_sua_chua">
<span<?php echo $ck_don_hang_list->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_don_hang_list->ngay_sua_chua->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_don_hang_list->chung_loai->Visible) { // chung_loai ?>
		<td data-name="chung_loai" <?php echo $ck_don_hang_list->chung_loai->cellAttributes() ?>>
<span id="el<?php echo $ck_don_hang_list->RowCount ?>_ck_don_hang_chung_loai">
<span<?php echo $ck_don_hang_list->chung_loai->viewAttributes() ?>><?php echo $ck_don_hang_list->chung_loai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_don_hang_list->ten_thiet_bi->Visible) { // ten_thiet_bi ?>
		<td data-name="ten_thiet_bi" <?php echo $ck_don_hang_list->ten_thiet_bi->cellAttributes() ?>>
<span id="el<?php echo $ck_don_hang_list->RowCount ?>_ck_don_hang_ten_thiet_bi">
<span<?php echo $ck_don_hang_list->ten_thiet_bi->viewAttributes() ?>><?php echo $ck_don_hang_list->ten_thiet_bi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_don_hang_list->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
		<td data-name="noi_dung_sua_chua" <?php echo $ck_don_hang_list->noi_dung_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $ck_don_hang_list->RowCount ?>_ck_don_hang_noi_dung_sua_chua">
<span<?php echo $ck_don_hang_list->noi_dung_sua_chua->viewAttributes() ?>><?php echo $ck_don_hang_list->noi_dung_sua_chua->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_don_hang_list->baoduong_dinhky->Visible) { // baoduong_dinhky ?>
		<td data-name="baoduong_dinhky" <?php echo $ck_don_hang_list->baoduong_dinhky->cellAttributes() ?>>
<span id="el<?php echo $ck_don_hang_list->RowCount ?>_ck_don_hang_baoduong_dinhky">
<span<?php echo $ck_don_hang_list->baoduong_dinhky->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_baoduong_dinhky" class="custom-control-input" value="<?php echo $ck_don_hang_list->baoduong_dinhky->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_don_hang_list->baoduong_dinhky->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_baoduong_dinhky"></label></div></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_don_hang_list->ListOptions->render("body", "right", $ck_don_hang_list->RowCount);
?>
	<td class="text-center">
		<button type="button"
		   class="btn btn-xs btn-info btn-tai-lieu"
		   data-bang="ck_don_hang"
		   data-id="<?php echo (int)$ck_don_hang_list->id->CurrentValue ?>"
		   data-ten="<?php $_tenDH = $ck_don_hang_list->so_don_hang_id->CurrentValue; echo htmlspecialchars($_tenDH ? $_tenDH : ('DH #' . (int)$ck_don_hang_list->id->CurrentValue), ENT_QUOTES); ?>"
		   title="Tài liệu đính kèm">
			<i class="fas fa-paperclip"></i>
		</button>
	</td>
	</tr>
<?php
	}
	if (!$ck_don_hang_list->isGridAdd())
		$ck_don_hang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ck_don_hang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ck_don_hang_list->Recordset)
	$ck_don_hang_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ck_don_hang_list->TotalRecords == 0 && !$ck_don_hang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ck_don_hang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ck_don_hang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ck_don_hang_list->isExport()) { ?>
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
  $(document).on('click', '.btn-tai-lieu', function(e) {
    e.preventDefault(); e.stopPropagation();
    var bang = $(this).data('bang'), id = $(this).data('id'), ten = $(this).data('ten') || ('#' + id);
    $('#mlBang').val(bang); $('#mlId').val(id); $('#mlTieuDe').text(ten);
    $('#mlAlert').hide(); $('#mlFile').val(''); $('#mlMota').val('');
    taiDanhSach(bang, id);
    $('#modalTaiLieu').modal('show');
  });

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

  $('#formTaiLieu').on('submit', function(e) {
    e.preventDefault();
    var fd = new FormData(this), btn = $('#btnTaiLieu');
    btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Đang upload...');
    $.ajax({
      url: 'api/upload_tai_lieu.php', type: 'POST', data: fd,
      processData: false, contentType: false, dataType: 'json',
      success: function(res) {
        if (res.success) {
          $('#mlAlert').removeClass('alert-danger').addClass('alert alert-success').text(res.message).show();
          $('#mlFile').val(''); $('#mlMota').val('');
          taiDanhSach($('#mlBang').val(), $('#mlId').val());
        } else {
          $('#mlAlert').removeClass('alert-success').addClass('alert alert-danger').text(res.message).show();
        }
      },
      error: function() { $('#mlAlert').addClass('alert alert-danger').text('Lỗi kết nối server').show(); },
      complete: function() { btn.prop('disabled', false).html('<i class="fas fa-upload mr-1"></i>Upload'); }
    });
  });

  $(document).on('click', '.btn-xoa', function() {
    if (!confirm('Xóa tài liệu này?')) return;
    var id = $(this).data('id');
    $.post('api/upload_tai_lieu.php', {action: 'delete', tai_lieu_id: id}, function(res) {
      if (res.success) taiDanhSach($('#mlBang').val(), $('#mlId').val());
    }, 'json');
  });

  function esc(s) { return $('<div>').text(s || '').html(); }
})(jQuery);
});
</script>
<?php include_once "footer.php"; ?>
<?php
$ck_don_hang_list->terminate();
?>