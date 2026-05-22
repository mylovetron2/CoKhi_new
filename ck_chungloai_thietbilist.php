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
$ck_chungloai_thietbi_list = new ck_chungloai_thietbi_list();

// Run the page
$ck_chungloai_thietbi_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_chungloai_thietbi_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ck_chungloai_thietbi_list->isExport()) { ?>
<script>
var fck_chungloai_thietbilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fck_chungloai_thietbilist = currentForm = new ew.Form("fck_chungloai_thietbilist", "list");
	fck_chungloai_thietbilist.formKeyCountName = '<?php echo $ck_chungloai_thietbi_list->FormKeyCountName ?>';
	loadjs.done("fck_chungloai_thietbilist");
});
var fck_chungloai_thietbilistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fck_chungloai_thietbilistsrch = currentSearchForm = new ew.Form("fck_chungloai_thietbilistsrch");

	// Dynamic selection lists
	// Filters

	fck_chungloai_thietbilistsrch.filterList = <?php echo $ck_chungloai_thietbi_list->getFilterList() ?>;
	loadjs.done("fck_chungloai_thietbilistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ck_chungloai_thietbi_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ck_chungloai_thietbi_list->TotalRecords > 0 && $ck_chungloai_thietbi_list->ExportOptions->visible()) { ?>
<?php $ck_chungloai_thietbi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ck_chungloai_thietbi_list->ImportOptions->visible()) { ?>
<?php $ck_chungloai_thietbi_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ck_chungloai_thietbi_list->SearchOptions->visible()) { ?>
<?php $ck_chungloai_thietbi_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ck_chungloai_thietbi_list->FilterOptions->visible()) { ?>
<?php $ck_chungloai_thietbi_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ck_chungloai_thietbi_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ck_chungloai_thietbi_list->isExport() && !$ck_chungloai_thietbi->CurrentAction) { ?>
<form name="fck_chungloai_thietbilistsrch" id="fck_chungloai_thietbilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fck_chungloai_thietbilistsrch-search-panel" class="<?php echo $ck_chungloai_thietbi_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ck_chungloai_thietbi">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ck_chungloai_thietbi_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ck_chungloai_thietbi_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ck_chungloai_thietbi_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ck_chungloai_thietbi_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ck_chungloai_thietbi_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ck_chungloai_thietbi_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ck_chungloai_thietbi_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ck_chungloai_thietbi_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ck_chungloai_thietbi_list->showPageHeader(); ?>
<?php
$ck_chungloai_thietbi_list->showMessage();
?>
<?php if ($ck_chungloai_thietbi_list->TotalRecords > 0 || $ck_chungloai_thietbi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ck_chungloai_thietbi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ck_chungloai_thietbi">
<?php if (!$ck_chungloai_thietbi_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ck_chungloai_thietbi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ck_chungloai_thietbi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ck_chungloai_thietbi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fck_chungloai_thietbilist" id="fck_chungloai_thietbilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_chungloai_thietbi">
<div id="gmp_ck_chungloai_thietbi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ck_chungloai_thietbi_list->TotalRecords > 0 || $ck_chungloai_thietbi_list->isGridEdit()) { ?>
<table id="tbl_ck_chungloai_thietbilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ck_chungloai_thietbi->RowType = ROWTYPE_HEADER;

// Render list options
$ck_chungloai_thietbi_list->renderListOptions();

// Render list options (header, left)
$ck_chungloai_thietbi_list->ListOptions->render("header", "left");
?>
<?php if ($ck_chungloai_thietbi_list->chungloai_id->Visible) { // chungloai_id ?>
	<?php if ($ck_chungloai_thietbi_list->SortUrl($ck_chungloai_thietbi_list->chungloai_id) == "") { ?>
		<th data-name="chungloai_id" class="<?php echo $ck_chungloai_thietbi_list->chungloai_id->headerCellClass() ?>"><div id="elh_ck_chungloai_thietbi_chungloai_id" class="ck_chungloai_thietbi_chungloai_id"><div class="ew-table-header-caption"><?php echo $ck_chungloai_thietbi_list->chungloai_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="chungloai_id" class="<?php echo $ck_chungloai_thietbi_list->chungloai_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_chungloai_thietbi_list->SortUrl($ck_chungloai_thietbi_list->chungloai_id) ?>', 1);"><div id="elh_ck_chungloai_thietbi_chungloai_id" class="ck_chungloai_thietbi_chungloai_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_chungloai_thietbi_list->chungloai_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_chungloai_thietbi_list->chungloai_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_chungloai_thietbi_list->chungloai_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_chungloai_thietbi_list->ten_chungloai->Visible) { // ten_chungloai ?>
	<?php if ($ck_chungloai_thietbi_list->SortUrl($ck_chungloai_thietbi_list->ten_chungloai) == "") { ?>
		<th data-name="ten_chungloai" class="<?php echo $ck_chungloai_thietbi_list->ten_chungloai->headerCellClass() ?>"><div id="elh_ck_chungloai_thietbi_ten_chungloai" class="ck_chungloai_thietbi_ten_chungloai"><div class="ew-table-header-caption"><?php echo $ck_chungloai_thietbi_list->ten_chungloai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ten_chungloai" class="<?php echo $ck_chungloai_thietbi_list->ten_chungloai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_chungloai_thietbi_list->SortUrl($ck_chungloai_thietbi_list->ten_chungloai) ?>', 1);"><div id="elh_ck_chungloai_thietbi_ten_chungloai" class="ck_chungloai_thietbi_ten_chungloai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_chungloai_thietbi_list->ten_chungloai->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ck_chungloai_thietbi_list->ten_chungloai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_chungloai_thietbi_list->ten_chungloai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ck_chungloai_thietbi_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ck_chungloai_thietbi_list->ExportAll && $ck_chungloai_thietbi_list->isExport()) {
	$ck_chungloai_thietbi_list->StopRecord = $ck_chungloai_thietbi_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ck_chungloai_thietbi_list->TotalRecords > $ck_chungloai_thietbi_list->StartRecord + $ck_chungloai_thietbi_list->DisplayRecords - 1)
		$ck_chungloai_thietbi_list->StopRecord = $ck_chungloai_thietbi_list->StartRecord + $ck_chungloai_thietbi_list->DisplayRecords - 1;
	else
		$ck_chungloai_thietbi_list->StopRecord = $ck_chungloai_thietbi_list->TotalRecords;
}
$ck_chungloai_thietbi_list->RecordCount = $ck_chungloai_thietbi_list->StartRecord - 1;
if ($ck_chungloai_thietbi_list->Recordset && !$ck_chungloai_thietbi_list->Recordset->EOF) {
	$ck_chungloai_thietbi_list->Recordset->moveFirst();
	$selectLimit = $ck_chungloai_thietbi_list->UseSelectLimit;
	if (!$selectLimit && $ck_chungloai_thietbi_list->StartRecord > 1)
		$ck_chungloai_thietbi_list->Recordset->move($ck_chungloai_thietbi_list->StartRecord - 1);
} elseif (!$ck_chungloai_thietbi->AllowAddDeleteRow && $ck_chungloai_thietbi_list->StopRecord == 0) {
	$ck_chungloai_thietbi_list->StopRecord = $ck_chungloai_thietbi->GridAddRowCount;
}

// Initialize aggregate
$ck_chungloai_thietbi->RowType = ROWTYPE_AGGREGATEINIT;
$ck_chungloai_thietbi->resetAttributes();
$ck_chungloai_thietbi_list->renderRow();
while ($ck_chungloai_thietbi_list->RecordCount < $ck_chungloai_thietbi_list->StopRecord) {
	$ck_chungloai_thietbi_list->RecordCount++;
	if ($ck_chungloai_thietbi_list->RecordCount >= $ck_chungloai_thietbi_list->StartRecord) {
		$ck_chungloai_thietbi_list->RowCount++;

		// Set up key count
		$ck_chungloai_thietbi_list->KeyCount = $ck_chungloai_thietbi_list->RowIndex;

		// Init row class and style
		$ck_chungloai_thietbi->resetAttributes();
		$ck_chungloai_thietbi->CssClass = "";
		if ($ck_chungloai_thietbi_list->isGridAdd()) {
		} else {
			$ck_chungloai_thietbi_list->loadRowValues($ck_chungloai_thietbi_list->Recordset); // Load row values
		}
		$ck_chungloai_thietbi->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ck_chungloai_thietbi->RowAttrs->merge(["data-rowindex" => $ck_chungloai_thietbi_list->RowCount, "id" => "r" . $ck_chungloai_thietbi_list->RowCount . "_ck_chungloai_thietbi", "data-rowtype" => $ck_chungloai_thietbi->RowType]);

		// Render row
		$ck_chungloai_thietbi_list->renderRow();

		// Render list options
		$ck_chungloai_thietbi_list->renderListOptions();
?>
	<tr <?php echo $ck_chungloai_thietbi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_chungloai_thietbi_list->ListOptions->render("body", "left", $ck_chungloai_thietbi_list->RowCount);
?>
	<?php if ($ck_chungloai_thietbi_list->chungloai_id->Visible) { // chungloai_id ?>
		<td data-name="chungloai_id" <?php echo $ck_chungloai_thietbi_list->chungloai_id->cellAttributes() ?>>
<span id="el<?php echo $ck_chungloai_thietbi_list->RowCount ?>_ck_chungloai_thietbi_chungloai_id">
<span<?php echo $ck_chungloai_thietbi_list->chungloai_id->viewAttributes() ?>><?php echo $ck_chungloai_thietbi_list->chungloai_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_chungloai_thietbi_list->ten_chungloai->Visible) { // ten_chungloai ?>
		<td data-name="ten_chungloai" <?php echo $ck_chungloai_thietbi_list->ten_chungloai->cellAttributes() ?>>
<span id="el<?php echo $ck_chungloai_thietbi_list->RowCount ?>_ck_chungloai_thietbi_ten_chungloai">
<span<?php echo $ck_chungloai_thietbi_list->ten_chungloai->viewAttributes() ?>><?php echo $ck_chungloai_thietbi_list->ten_chungloai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_chungloai_thietbi_list->ListOptions->render("body", "right", $ck_chungloai_thietbi_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ck_chungloai_thietbi_list->isGridAdd())
		$ck_chungloai_thietbi_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ck_chungloai_thietbi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ck_chungloai_thietbi_list->Recordset)
	$ck_chungloai_thietbi_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ck_chungloai_thietbi_list->TotalRecords == 0 && !$ck_chungloai_thietbi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ck_chungloai_thietbi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ck_chungloai_thietbi_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ck_chungloai_thietbi_list->isExport()) { ?>
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
$ck_chungloai_thietbi_list->terminate();
?>