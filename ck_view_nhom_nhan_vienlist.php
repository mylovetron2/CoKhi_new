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
$ck_view_nhom_nhan_vien_list = new ck_view_nhom_nhan_vien_list();

// Run the page
$ck_view_nhom_nhan_vien_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_view_nhom_nhan_vien_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ck_view_nhom_nhan_vien_list->isExport()) { ?>
<script>
var fck_view_nhom_nhan_vienlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fck_view_nhom_nhan_vienlist = currentForm = new ew.Form("fck_view_nhom_nhan_vienlist", "list");
	fck_view_nhom_nhan_vienlist.formKeyCountName = '<?php echo $ck_view_nhom_nhan_vien_list->FormKeyCountName ?>';
	loadjs.done("fck_view_nhom_nhan_vienlist");
});
var fck_view_nhom_nhan_vienlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fck_view_nhom_nhan_vienlistsrch = currentSearchForm = new ew.Form("fck_view_nhom_nhan_vienlistsrch");

	// Dynamic selection lists
	// Filters

	fck_view_nhom_nhan_vienlistsrch.filterList = <?php echo $ck_view_nhom_nhan_vien_list->getFilterList() ?>;
	loadjs.done("fck_view_nhom_nhan_vienlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ck_view_nhom_nhan_vien_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ck_view_nhom_nhan_vien_list->TotalRecords > 0 && $ck_view_nhom_nhan_vien_list->ExportOptions->visible()) { ?>
<?php $ck_view_nhom_nhan_vien_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ck_view_nhom_nhan_vien_list->ImportOptions->visible()) { ?>
<?php $ck_view_nhom_nhan_vien_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ck_view_nhom_nhan_vien_list->SearchOptions->visible()) { ?>
<?php $ck_view_nhom_nhan_vien_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ck_view_nhom_nhan_vien_list->FilterOptions->visible()) { ?>
<?php $ck_view_nhom_nhan_vien_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ck_view_nhom_nhan_vien_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ck_view_nhom_nhan_vien_list->isExport() && !$ck_view_nhom_nhan_vien->CurrentAction) { ?>
<form name="fck_view_nhom_nhan_vienlistsrch" id="fck_view_nhom_nhan_vienlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fck_view_nhom_nhan_vienlistsrch-search-panel" class="<?php echo $ck_view_nhom_nhan_vien_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ck_view_nhom_nhan_vien">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ck_view_nhom_nhan_vien_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ck_view_nhom_nhan_vien_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ck_view_nhom_nhan_vien_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ck_view_nhom_nhan_vien_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ck_view_nhom_nhan_vien_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ck_view_nhom_nhan_vien_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ck_view_nhom_nhan_vien_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ck_view_nhom_nhan_vien_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ck_view_nhom_nhan_vien_list->showPageHeader(); ?>
<?php
$ck_view_nhom_nhan_vien_list->showMessage();
?>
<?php if ($ck_view_nhom_nhan_vien_list->TotalRecords > 0 || $ck_view_nhom_nhan_vien->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ck_view_nhom_nhan_vien_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ck_view_nhom_nhan_vien">
<?php if (!$ck_view_nhom_nhan_vien_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ck_view_nhom_nhan_vien_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ck_view_nhom_nhan_vien_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ck_view_nhom_nhan_vien_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fck_view_nhom_nhan_vienlist" id="fck_view_nhom_nhan_vienlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_view_nhom_nhan_vien">
<div id="gmp_ck_view_nhom_nhan_vien" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ck_view_nhom_nhan_vien_list->TotalRecords > 0 || $ck_view_nhom_nhan_vien_list->isGridEdit()) { ?>
<table id="tbl_ck_view_nhom_nhan_vienlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ck_view_nhom_nhan_vien->RowType = ROWTYPE_HEADER;

// Render list options
$ck_view_nhom_nhan_vien_list->renderListOptions();

// Render list options (header, left)
$ck_view_nhom_nhan_vien_list->ListOptions->render("header", "left");
?>
<?php if ($ck_view_nhom_nhan_vien_list->nhom_nhan_vien_id->Visible) { // nhom_nhan_vien_id ?>
	<?php if ($ck_view_nhom_nhan_vien_list->SortUrl($ck_view_nhom_nhan_vien_list->nhom_nhan_vien_id) == "") { ?>
		<th data-name="nhom_nhan_vien_id" class="<?php echo $ck_view_nhom_nhan_vien_list->nhom_nhan_vien_id->headerCellClass() ?>"><div id="elh_ck_view_nhom_nhan_vien_nhom_nhan_vien_id" class="ck_view_nhom_nhan_vien_nhom_nhan_vien_id"><div class="ew-table-header-caption"><?php echo $ck_view_nhom_nhan_vien_list->nhom_nhan_vien_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nhom_nhan_vien_id" class="<?php echo $ck_view_nhom_nhan_vien_list->nhom_nhan_vien_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_view_nhom_nhan_vien_list->SortUrl($ck_view_nhom_nhan_vien_list->nhom_nhan_vien_id) ?>', 1);"><div id="elh_ck_view_nhom_nhan_vien_nhom_nhan_vien_id" class="ck_view_nhom_nhan_vien_nhom_nhan_vien_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhom_nhan_vien_list->nhom_nhan_vien_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhom_nhan_vien_list->nhom_nhan_vien_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhom_nhan_vien_list->nhom_nhan_vien_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhom_nhan_vien_list->ten_nhom->Visible) { // ten_nhom ?>
	<?php if ($ck_view_nhom_nhan_vien_list->SortUrl($ck_view_nhom_nhan_vien_list->ten_nhom) == "") { ?>
		<th data-name="ten_nhom" class="<?php echo $ck_view_nhom_nhan_vien_list->ten_nhom->headerCellClass() ?>"><div id="elh_ck_view_nhom_nhan_vien_ten_nhom" class="ck_view_nhom_nhan_vien_ten_nhom"><div class="ew-table-header-caption"><?php echo $ck_view_nhom_nhan_vien_list->ten_nhom->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ten_nhom" class="<?php echo $ck_view_nhom_nhan_vien_list->ten_nhom->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_view_nhom_nhan_vien_list->SortUrl($ck_view_nhom_nhan_vien_list->ten_nhom) ?>', 1);"><div id="elh_ck_view_nhom_nhan_vien_ten_nhom" class="ck_view_nhom_nhan_vien_ten_nhom">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhom_nhan_vien_list->ten_nhom->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhom_nhan_vien_list->ten_nhom->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhom_nhan_vien_list->ten_nhom->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhom_nhan_vien_list->bo_phan_id->Visible) { // bo_phan_id ?>
	<?php if ($ck_view_nhom_nhan_vien_list->SortUrl($ck_view_nhom_nhan_vien_list->bo_phan_id) == "") { ?>
		<th data-name="bo_phan_id" class="<?php echo $ck_view_nhom_nhan_vien_list->bo_phan_id->headerCellClass() ?>"><div id="elh_ck_view_nhom_nhan_vien_bo_phan_id" class="ck_view_nhom_nhan_vien_bo_phan_id"><div class="ew-table-header-caption"><?php echo $ck_view_nhom_nhan_vien_list->bo_phan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bo_phan_id" class="<?php echo $ck_view_nhom_nhan_vien_list->bo_phan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_view_nhom_nhan_vien_list->SortUrl($ck_view_nhom_nhan_vien_list->bo_phan_id) ?>', 1);"><div id="elh_ck_view_nhom_nhan_vien_bo_phan_id" class="ck_view_nhom_nhan_vien_bo_phan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhom_nhan_vien_list->bo_phan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhom_nhan_vien_list->bo_phan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhom_nhan_vien_list->bo_phan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ck_view_nhom_nhan_vien_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ck_view_nhom_nhan_vien_list->ExportAll && $ck_view_nhom_nhan_vien_list->isExport()) {
	$ck_view_nhom_nhan_vien_list->StopRecord = $ck_view_nhom_nhan_vien_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ck_view_nhom_nhan_vien_list->TotalRecords > $ck_view_nhom_nhan_vien_list->StartRecord + $ck_view_nhom_nhan_vien_list->DisplayRecords - 1)
		$ck_view_nhom_nhan_vien_list->StopRecord = $ck_view_nhom_nhan_vien_list->StartRecord + $ck_view_nhom_nhan_vien_list->DisplayRecords - 1;
	else
		$ck_view_nhom_nhan_vien_list->StopRecord = $ck_view_nhom_nhan_vien_list->TotalRecords;
}
$ck_view_nhom_nhan_vien_list->RecordCount = $ck_view_nhom_nhan_vien_list->StartRecord - 1;
if ($ck_view_nhom_nhan_vien_list->Recordset && !$ck_view_nhom_nhan_vien_list->Recordset->EOF) {
	$ck_view_nhom_nhan_vien_list->Recordset->moveFirst();
	$selectLimit = $ck_view_nhom_nhan_vien_list->UseSelectLimit;
	if (!$selectLimit && $ck_view_nhom_nhan_vien_list->StartRecord > 1)
		$ck_view_nhom_nhan_vien_list->Recordset->move($ck_view_nhom_nhan_vien_list->StartRecord - 1);
} elseif (!$ck_view_nhom_nhan_vien->AllowAddDeleteRow && $ck_view_nhom_nhan_vien_list->StopRecord == 0) {
	$ck_view_nhom_nhan_vien_list->StopRecord = $ck_view_nhom_nhan_vien->GridAddRowCount;
}

// Initialize aggregate
$ck_view_nhom_nhan_vien->RowType = ROWTYPE_AGGREGATEINIT;
$ck_view_nhom_nhan_vien->resetAttributes();
$ck_view_nhom_nhan_vien_list->renderRow();
while ($ck_view_nhom_nhan_vien_list->RecordCount < $ck_view_nhom_nhan_vien_list->StopRecord) {
	$ck_view_nhom_nhan_vien_list->RecordCount++;
	if ($ck_view_nhom_nhan_vien_list->RecordCount >= $ck_view_nhom_nhan_vien_list->StartRecord) {
		$ck_view_nhom_nhan_vien_list->RowCount++;

		// Set up key count
		$ck_view_nhom_nhan_vien_list->KeyCount = $ck_view_nhom_nhan_vien_list->RowIndex;

		// Init row class and style
		$ck_view_nhom_nhan_vien->resetAttributes();
		$ck_view_nhom_nhan_vien->CssClass = "";
		if ($ck_view_nhom_nhan_vien_list->isGridAdd()) {
		} else {
			$ck_view_nhom_nhan_vien_list->loadRowValues($ck_view_nhom_nhan_vien_list->Recordset); // Load row values
		}
		$ck_view_nhom_nhan_vien->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ck_view_nhom_nhan_vien->RowAttrs->merge(["data-rowindex" => $ck_view_nhom_nhan_vien_list->RowCount, "id" => "r" . $ck_view_nhom_nhan_vien_list->RowCount . "_ck_view_nhom_nhan_vien", "data-rowtype" => $ck_view_nhom_nhan_vien->RowType]);

		// Render row
		$ck_view_nhom_nhan_vien_list->renderRow();

		// Render list options
		$ck_view_nhom_nhan_vien_list->renderListOptions();
?>
	<tr <?php echo $ck_view_nhom_nhan_vien->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_view_nhom_nhan_vien_list->ListOptions->render("body", "left", $ck_view_nhom_nhan_vien_list->RowCount);
?>
	<?php if ($ck_view_nhom_nhan_vien_list->nhom_nhan_vien_id->Visible) { // nhom_nhan_vien_id ?>
		<td data-name="nhom_nhan_vien_id" <?php echo $ck_view_nhom_nhan_vien_list->nhom_nhan_vien_id->cellAttributes() ?>>
<span id="el<?php echo $ck_view_nhom_nhan_vien_list->RowCount ?>_ck_view_nhom_nhan_vien_nhom_nhan_vien_id">
<span<?php echo $ck_view_nhom_nhan_vien_list->nhom_nhan_vien_id->viewAttributes() ?>><?php echo $ck_view_nhom_nhan_vien_list->nhom_nhan_vien_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_view_nhom_nhan_vien_list->ten_nhom->Visible) { // ten_nhom ?>
		<td data-name="ten_nhom" <?php echo $ck_view_nhom_nhan_vien_list->ten_nhom->cellAttributes() ?>>
<span id="el<?php echo $ck_view_nhom_nhan_vien_list->RowCount ?>_ck_view_nhom_nhan_vien_ten_nhom">
<span<?php echo $ck_view_nhom_nhan_vien_list->ten_nhom->viewAttributes() ?>><?php echo $ck_view_nhom_nhan_vien_list->ten_nhom->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_view_nhom_nhan_vien_list->bo_phan_id->Visible) { // bo_phan_id ?>
		<td data-name="bo_phan_id" <?php echo $ck_view_nhom_nhan_vien_list->bo_phan_id->cellAttributes() ?>>
<span id="el<?php echo $ck_view_nhom_nhan_vien_list->RowCount ?>_ck_view_nhom_nhan_vien_bo_phan_id">
<span<?php echo $ck_view_nhom_nhan_vien_list->bo_phan_id->viewAttributes() ?>><?php echo $ck_view_nhom_nhan_vien_list->bo_phan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_view_nhom_nhan_vien_list->ListOptions->render("body", "right", $ck_view_nhom_nhan_vien_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ck_view_nhom_nhan_vien_list->isGridAdd())
		$ck_view_nhom_nhan_vien_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ck_view_nhom_nhan_vien->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ck_view_nhom_nhan_vien_list->Recordset)
	$ck_view_nhom_nhan_vien_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ck_view_nhom_nhan_vien_list->TotalRecords == 0 && !$ck_view_nhom_nhan_vien->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ck_view_nhom_nhan_vien_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ck_view_nhom_nhan_vien_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ck_view_nhom_nhan_vien_list->isExport()) { ?>
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
$ck_view_nhom_nhan_vien_list->terminate();
?>