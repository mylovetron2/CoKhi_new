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
$nhan_vien_list = new nhan_vien_list();

// Run the page
$nhan_vien_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$nhan_vien_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$nhan_vien_list->isExport()) { ?>
<script>
var fnhan_vienlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fnhan_vienlist = currentForm = new ew.Form("fnhan_vienlist", "list");
	fnhan_vienlist.formKeyCountName = '<?php echo $nhan_vien_list->FormKeyCountName ?>';
	loadjs.done("fnhan_vienlist");
});
var fnhan_vienlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fnhan_vienlistsrch = currentSearchForm = new ew.Form("fnhan_vienlistsrch");

	// Dynamic selection lists
	// Filters

	fnhan_vienlistsrch.filterList = <?php echo $nhan_vien_list->getFilterList() ?>;
	loadjs.done("fnhan_vienlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$nhan_vien_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($nhan_vien_list->TotalRecords > 0 && $nhan_vien_list->ExportOptions->visible()) { ?>
<?php $nhan_vien_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($nhan_vien_list->ImportOptions->visible()) { ?>
<?php $nhan_vien_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($nhan_vien_list->SearchOptions->visible()) { ?>
<?php $nhan_vien_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($nhan_vien_list->FilterOptions->visible()) { ?>
<?php $nhan_vien_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$nhan_vien_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$nhan_vien_list->isExport() && !$nhan_vien->CurrentAction) { ?>
<form name="fnhan_vienlistsrch" id="fnhan_vienlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fnhan_vienlistsrch-search-panel" class="<?php echo $nhan_vien_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="nhan_vien">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $nhan_vien_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($nhan_vien_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($nhan_vien_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $nhan_vien_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($nhan_vien_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($nhan_vien_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($nhan_vien_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($nhan_vien_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $nhan_vien_list->showPageHeader(); ?>
<?php
$nhan_vien_list->showMessage();
?>
<?php if ($nhan_vien_list->TotalRecords > 0 || $nhan_vien->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($nhan_vien_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> nhan_vien">
<?php if (!$nhan_vien_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$nhan_vien_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $nhan_vien_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $nhan_vien_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fnhan_vienlist" id="fnhan_vienlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="nhan_vien">
<div id="gmp_nhan_vien" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($nhan_vien_list->TotalRecords > 0 || $nhan_vien_list->isGridEdit()) { ?>
<table id="tbl_nhan_vienlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$nhan_vien->RowType = ROWTYPE_HEADER;

// Render list options
$nhan_vien_list->renderListOptions();

// Render list options (header, left)
$nhan_vien_list->ListOptions->render("header", "left");
?>
<?php if ($nhan_vien_list->danh_so->Visible) { // danh_so ?>
	<?php if ($nhan_vien_list->SortUrl($nhan_vien_list->danh_so) == "") { ?>
		<th data-name="danh_so" class="<?php echo $nhan_vien_list->danh_so->headerCellClass() ?>"><div id="elh_nhan_vien_danh_so" class="nhan_vien_danh_so"><div class="ew-table-header-caption"><?php echo $nhan_vien_list->danh_so->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="danh_so" class="<?php echo $nhan_vien_list->danh_so->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhan_vien_list->SortUrl($nhan_vien_list->danh_so) ?>', 1);"><div id="elh_nhan_vien_danh_so" class="nhan_vien_danh_so">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhan_vien_list->danh_so->caption() ?></span><span class="ew-table-header-sort"><?php if ($nhan_vien_list->danh_so->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhan_vien_list->danh_so->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhan_vien_list->ten_nhan_vien->Visible) { // ten_nhan_vien ?>
	<?php if ($nhan_vien_list->SortUrl($nhan_vien_list->ten_nhan_vien) == "") { ?>
		<th data-name="ten_nhan_vien" class="<?php echo $nhan_vien_list->ten_nhan_vien->headerCellClass() ?>"><div id="elh_nhan_vien_ten_nhan_vien" class="nhan_vien_ten_nhan_vien"><div class="ew-table-header-caption"><?php echo $nhan_vien_list->ten_nhan_vien->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ten_nhan_vien" class="<?php echo $nhan_vien_list->ten_nhan_vien->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhan_vien_list->SortUrl($nhan_vien_list->ten_nhan_vien) ?>', 1);"><div id="elh_nhan_vien_ten_nhan_vien" class="nhan_vien_ten_nhan_vien">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhan_vien_list->ten_nhan_vien->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nhan_vien_list->ten_nhan_vien->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhan_vien_list->ten_nhan_vien->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhan_vien_list->chuc_danh->Visible) { // chuc_danh ?>
	<?php if ($nhan_vien_list->SortUrl($nhan_vien_list->chuc_danh) == "") { ?>
		<th data-name="chuc_danh" class="<?php echo $nhan_vien_list->chuc_danh->headerCellClass() ?>"><div id="elh_nhan_vien_chuc_danh" class="nhan_vien_chuc_danh"><div class="ew-table-header-caption"><?php echo $nhan_vien_list->chuc_danh->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="chuc_danh" class="<?php echo $nhan_vien_list->chuc_danh->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhan_vien_list->SortUrl($nhan_vien_list->chuc_danh) ?>', 1);"><div id="elh_nhan_vien_chuc_danh" class="nhan_vien_chuc_danh">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhan_vien_list->chuc_danh->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nhan_vien_list->chuc_danh->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhan_vien_list->chuc_danh->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhan_vien_list->bo_phan_id->Visible) { // bo_phan_id ?>
	<?php if ($nhan_vien_list->SortUrl($nhan_vien_list->bo_phan_id) == "") { ?>
		<th data-name="bo_phan_id" class="<?php echo $nhan_vien_list->bo_phan_id->headerCellClass() ?>"><div id="elh_nhan_vien_bo_phan_id" class="nhan_vien_bo_phan_id"><div class="ew-table-header-caption"><?php echo $nhan_vien_list->bo_phan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bo_phan_id" class="<?php echo $nhan_vien_list->bo_phan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhan_vien_list->SortUrl($nhan_vien_list->bo_phan_id) ?>', 1);"><div id="elh_nhan_vien_bo_phan_id" class="nhan_vien_bo_phan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhan_vien_list->bo_phan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($nhan_vien_list->bo_phan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhan_vien_list->bo_phan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nhan_vien_list->_userlevel->Visible) { // userlevel ?>
	<?php if ($nhan_vien_list->SortUrl($nhan_vien_list->_userlevel) == "") { ?>
		<th data-name="_userlevel" class="<?php echo $nhan_vien_list->_userlevel->headerCellClass() ?>"><div id="elh_nhan_vien__userlevel" class="nhan_vien__userlevel"><div class="ew-table-header-caption"><?php echo $nhan_vien_list->_userlevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_userlevel" class="<?php echo $nhan_vien_list->_userlevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nhan_vien_list->SortUrl($nhan_vien_list->_userlevel) ?>', 1);"><div id="elh_nhan_vien__userlevel" class="nhan_vien__userlevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nhan_vien_list->_userlevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($nhan_vien_list->_userlevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nhan_vien_list->_userlevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$nhan_vien_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($nhan_vien_list->ExportAll && $nhan_vien_list->isExport()) {
	$nhan_vien_list->StopRecord = $nhan_vien_list->TotalRecords;
} else {

	// Set the last record to display
	if ($nhan_vien_list->TotalRecords > $nhan_vien_list->StartRecord + $nhan_vien_list->DisplayRecords - 1)
		$nhan_vien_list->StopRecord = $nhan_vien_list->StartRecord + $nhan_vien_list->DisplayRecords - 1;
	else
		$nhan_vien_list->StopRecord = $nhan_vien_list->TotalRecords;
}
$nhan_vien_list->RecordCount = $nhan_vien_list->StartRecord - 1;
if ($nhan_vien_list->Recordset && !$nhan_vien_list->Recordset->EOF) {
	$nhan_vien_list->Recordset->moveFirst();
	$selectLimit = $nhan_vien_list->UseSelectLimit;
	if (!$selectLimit && $nhan_vien_list->StartRecord > 1)
		$nhan_vien_list->Recordset->move($nhan_vien_list->StartRecord - 1);
} elseif (!$nhan_vien->AllowAddDeleteRow && $nhan_vien_list->StopRecord == 0) {
	$nhan_vien_list->StopRecord = $nhan_vien->GridAddRowCount;
}

// Initialize aggregate
$nhan_vien->RowType = ROWTYPE_AGGREGATEINIT;
$nhan_vien->resetAttributes();
$nhan_vien_list->renderRow();
while ($nhan_vien_list->RecordCount < $nhan_vien_list->StopRecord) {
	$nhan_vien_list->RecordCount++;
	if ($nhan_vien_list->RecordCount >= $nhan_vien_list->StartRecord) {
		$nhan_vien_list->RowCount++;

		// Set up key count
		$nhan_vien_list->KeyCount = $nhan_vien_list->RowIndex;

		// Init row class and style
		$nhan_vien->resetAttributes();
		$nhan_vien->CssClass = "";
		if ($nhan_vien_list->isGridAdd()) {
		} else {
			$nhan_vien_list->loadRowValues($nhan_vien_list->Recordset); // Load row values
		}
		$nhan_vien->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$nhan_vien->RowAttrs->merge(["data-rowindex" => $nhan_vien_list->RowCount, "id" => "r" . $nhan_vien_list->RowCount . "_nhan_vien", "data-rowtype" => $nhan_vien->RowType]);

		// Render row
		$nhan_vien_list->renderRow();

		// Render list options
		$nhan_vien_list->renderListOptions();
?>
	<tr <?php echo $nhan_vien->rowAttributes() ?>>
<?php

// Render list options (body, left)
$nhan_vien_list->ListOptions->render("body", "left", $nhan_vien_list->RowCount);
?>
	<?php if ($nhan_vien_list->danh_so->Visible) { // danh_so ?>
		<td data-name="danh_so" <?php echo $nhan_vien_list->danh_so->cellAttributes() ?>>
<span id="el<?php echo $nhan_vien_list->RowCount ?>_nhan_vien_danh_so">
<span<?php echo $nhan_vien_list->danh_so->viewAttributes() ?>><?php echo $nhan_vien_list->danh_so->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhan_vien_list->ten_nhan_vien->Visible) { // ten_nhan_vien ?>
		<td data-name="ten_nhan_vien" <?php echo $nhan_vien_list->ten_nhan_vien->cellAttributes() ?>>
<span id="el<?php echo $nhan_vien_list->RowCount ?>_nhan_vien_ten_nhan_vien">
<span<?php echo $nhan_vien_list->ten_nhan_vien->viewAttributes() ?>><?php echo $nhan_vien_list->ten_nhan_vien->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhan_vien_list->chuc_danh->Visible) { // chuc_danh ?>
		<td data-name="chuc_danh" <?php echo $nhan_vien_list->chuc_danh->cellAttributes() ?>>
<span id="el<?php echo $nhan_vien_list->RowCount ?>_nhan_vien_chuc_danh">
<span<?php echo $nhan_vien_list->chuc_danh->viewAttributes() ?>><?php echo $nhan_vien_list->chuc_danh->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhan_vien_list->bo_phan_id->Visible) { // bo_phan_id ?>
		<td data-name="bo_phan_id" <?php echo $nhan_vien_list->bo_phan_id->cellAttributes() ?>>
<span id="el<?php echo $nhan_vien_list->RowCount ?>_nhan_vien_bo_phan_id">
<span<?php echo $nhan_vien_list->bo_phan_id->viewAttributes() ?>><?php echo $nhan_vien_list->bo_phan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($nhan_vien_list->_userlevel->Visible) { // userlevel ?>
		<td data-name="_userlevel" <?php echo $nhan_vien_list->_userlevel->cellAttributes() ?>>
<span id="el<?php echo $nhan_vien_list->RowCount ?>_nhan_vien__userlevel">
<span<?php echo $nhan_vien_list->_userlevel->viewAttributes() ?>><?php echo $nhan_vien_list->_userlevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$nhan_vien_list->ListOptions->render("body", "right", $nhan_vien_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$nhan_vien_list->isGridAdd())
		$nhan_vien_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$nhan_vien->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($nhan_vien_list->Recordset)
	$nhan_vien_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($nhan_vien_list->TotalRecords == 0 && !$nhan_vien->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $nhan_vien_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$nhan_vien_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$nhan_vien_list->isExport()) { ?>
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
$nhan_vien_list->terminate();
?>