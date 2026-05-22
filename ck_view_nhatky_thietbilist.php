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
$ck_view_nhatky_thietbi_list = new ck_view_nhatky_thietbi_list();

// Run the page
$ck_view_nhatky_thietbi_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_view_nhatky_thietbi_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ck_view_nhatky_thietbi_list->isExport()) { ?>
<script>
var fck_view_nhatky_thietbilist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fck_view_nhatky_thietbilist = currentForm = new ew.Form("fck_view_nhatky_thietbilist", "list");
	fck_view_nhatky_thietbilist.formKeyCountName = '<?php echo $ck_view_nhatky_thietbi_list->FormKeyCountName ?>';
	loadjs.done("fck_view_nhatky_thietbilist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ck_view_nhatky_thietbi_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ck_view_nhatky_thietbi_list->TotalRecords > 0 && $ck_view_nhatky_thietbi_list->ExportOptions->visible()) { ?>
<?php $ck_view_nhatky_thietbi_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ck_view_nhatky_thietbi_list->ImportOptions->visible()) { ?>
<?php $ck_view_nhatky_thietbi_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$ck_view_nhatky_thietbi_list->isExport() || Config("EXPORT_MASTER_RECORD") && $ck_view_nhatky_thietbi_list->isExport("print")) { ?>
<?php
if ($ck_view_nhatky_thietbi_list->DbMasterFilter != "" && $ck_view_nhatky_thietbi->getCurrentMasterTable() == "ck_danhmuc_thietbi") {
	if ($ck_view_nhatky_thietbi_list->MasterRecordExists) {
		include_once "ck_danhmuc_thietbimaster.php";
	}
}
?>
<?php } ?>
<?php
$ck_view_nhatky_thietbi_list->renderOtherOptions();
?>
<?php $ck_view_nhatky_thietbi_list->showPageHeader(); ?>
<?php
$ck_view_nhatky_thietbi_list->showMessage();
?>
<?php if ($ck_view_nhatky_thietbi_list->TotalRecords > 0 || $ck_view_nhatky_thietbi->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ck_view_nhatky_thietbi_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ck_view_nhatky_thietbi">
<?php if (!$ck_view_nhatky_thietbi_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ck_view_nhatky_thietbi_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ck_view_nhatky_thietbi_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ck_view_nhatky_thietbi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fck_view_nhatky_thietbilist" id="fck_view_nhatky_thietbilist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_view_nhatky_thietbi">
<?php if ($ck_view_nhatky_thietbi->getCurrentMasterTable() == "ck_danhmuc_thietbi" && $ck_view_nhatky_thietbi->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="ck_danhmuc_thietbi">
<input type="hidden" name="fk_thiet_bi_id" value="<?php echo HtmlEncode($ck_view_nhatky_thietbi_list->thiet_bi_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_ck_view_nhatky_thietbi" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ck_view_nhatky_thietbi_list->TotalRecords > 0 || $ck_view_nhatky_thietbi_list->isGridEdit()) { ?>
<table id="tbl_ck_view_nhatky_thietbilist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ck_view_nhatky_thietbi->RowType = ROWTYPE_HEADER;

// Render list options
$ck_view_nhatky_thietbi_list->renderListOptions();

// Render list options (header, left)
$ck_view_nhatky_thietbi_list->ListOptions->render("header", "left");
?>
<?php if ($ck_view_nhatky_thietbi_list->nhan_vien_id->Visible) { // nhan_vien_id ?>
	<?php if ($ck_view_nhatky_thietbi_list->SortUrl($ck_view_nhatky_thietbi_list->nhan_vien_id) == "") { ?>
		<th data-name="nhan_vien_id" class="<?php echo $ck_view_nhatky_thietbi_list->nhan_vien_id->headerCellClass() ?>"><div id="elh_ck_view_nhatky_thietbi_nhan_vien_id" class="ck_view_nhatky_thietbi_nhan_vien_id"><div class="ew-table-header-caption"><?php echo $ck_view_nhatky_thietbi_list->nhan_vien_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nhan_vien_id" class="<?php echo $ck_view_nhatky_thietbi_list->nhan_vien_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_view_nhatky_thietbi_list->SortUrl($ck_view_nhatky_thietbi_list->nhan_vien_id) ?>', 1);"><div id="elh_ck_view_nhatky_thietbi_nhan_vien_id" class="ck_view_nhatky_thietbi_nhan_vien_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhatky_thietbi_list->nhan_vien_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhatky_thietbi_list->nhan_vien_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhatky_thietbi_list->nhan_vien_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_thietbi_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<?php if ($ck_view_nhatky_thietbi_list->SortUrl($ck_view_nhatky_thietbi_list->ngay_sua_chua) == "") { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_view_nhatky_thietbi_list->ngay_sua_chua->headerCellClass() ?>"><div id="elh_ck_view_nhatky_thietbi_ngay_sua_chua" class="ck_view_nhatky_thietbi_ngay_sua_chua"><div class="ew-table-header-caption"><?php echo $ck_view_nhatky_thietbi_list->ngay_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_view_nhatky_thietbi_list->ngay_sua_chua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_view_nhatky_thietbi_list->SortUrl($ck_view_nhatky_thietbi_list->ngay_sua_chua) ?>', 1);"><div id="elh_ck_view_nhatky_thietbi_ngay_sua_chua" class="ck_view_nhatky_thietbi_ngay_sua_chua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhatky_thietbi_list->ngay_sua_chua->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhatky_thietbi_list->ngay_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhatky_thietbi_list->ngay_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_view_nhatky_thietbi_list->noi_dung->Visible) { // noi_dung ?>
	<?php if ($ck_view_nhatky_thietbi_list->SortUrl($ck_view_nhatky_thietbi_list->noi_dung) == "") { ?>
		<th data-name="noi_dung" class="<?php echo $ck_view_nhatky_thietbi_list->noi_dung->headerCellClass() ?>"><div id="elh_ck_view_nhatky_thietbi_noi_dung" class="ck_view_nhatky_thietbi_noi_dung"><div class="ew-table-header-caption"><?php echo $ck_view_nhatky_thietbi_list->noi_dung->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="noi_dung" class="<?php echo $ck_view_nhatky_thietbi_list->noi_dung->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_view_nhatky_thietbi_list->SortUrl($ck_view_nhatky_thietbi_list->noi_dung) ?>', 1);"><div id="elh_ck_view_nhatky_thietbi_noi_dung" class="ck_view_nhatky_thietbi_noi_dung">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_view_nhatky_thietbi_list->noi_dung->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_view_nhatky_thietbi_list->noi_dung->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_view_nhatky_thietbi_list->noi_dung->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ck_view_nhatky_thietbi_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ck_view_nhatky_thietbi_list->ExportAll && $ck_view_nhatky_thietbi_list->isExport()) {
	$ck_view_nhatky_thietbi_list->StopRecord = $ck_view_nhatky_thietbi_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ck_view_nhatky_thietbi_list->TotalRecords > $ck_view_nhatky_thietbi_list->StartRecord + $ck_view_nhatky_thietbi_list->DisplayRecords - 1)
		$ck_view_nhatky_thietbi_list->StopRecord = $ck_view_nhatky_thietbi_list->StartRecord + $ck_view_nhatky_thietbi_list->DisplayRecords - 1;
	else
		$ck_view_nhatky_thietbi_list->StopRecord = $ck_view_nhatky_thietbi_list->TotalRecords;
}
$ck_view_nhatky_thietbi_list->RecordCount = $ck_view_nhatky_thietbi_list->StartRecord - 1;
if ($ck_view_nhatky_thietbi_list->Recordset && !$ck_view_nhatky_thietbi_list->Recordset->EOF) {
	$ck_view_nhatky_thietbi_list->Recordset->moveFirst();
	$selectLimit = $ck_view_nhatky_thietbi_list->UseSelectLimit;
	if (!$selectLimit && $ck_view_nhatky_thietbi_list->StartRecord > 1)
		$ck_view_nhatky_thietbi_list->Recordset->move($ck_view_nhatky_thietbi_list->StartRecord - 1);
} elseif (!$ck_view_nhatky_thietbi->AllowAddDeleteRow && $ck_view_nhatky_thietbi_list->StopRecord == 0) {
	$ck_view_nhatky_thietbi_list->StopRecord = $ck_view_nhatky_thietbi->GridAddRowCount;
}

// Initialize aggregate
$ck_view_nhatky_thietbi->RowType = ROWTYPE_AGGREGATEINIT;
$ck_view_nhatky_thietbi->resetAttributes();
$ck_view_nhatky_thietbi_list->renderRow();
while ($ck_view_nhatky_thietbi_list->RecordCount < $ck_view_nhatky_thietbi_list->StopRecord) {
	$ck_view_nhatky_thietbi_list->RecordCount++;
	if ($ck_view_nhatky_thietbi_list->RecordCount >= $ck_view_nhatky_thietbi_list->StartRecord) {
		$ck_view_nhatky_thietbi_list->RowCount++;

		// Set up key count
		$ck_view_nhatky_thietbi_list->KeyCount = $ck_view_nhatky_thietbi_list->RowIndex;

		// Init row class and style
		$ck_view_nhatky_thietbi->resetAttributes();
		$ck_view_nhatky_thietbi->CssClass = "";
		if ($ck_view_nhatky_thietbi_list->isGridAdd()) {
		} else {
			$ck_view_nhatky_thietbi_list->loadRowValues($ck_view_nhatky_thietbi_list->Recordset); // Load row values
		}
		$ck_view_nhatky_thietbi->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ck_view_nhatky_thietbi->RowAttrs->merge(["data-rowindex" => $ck_view_nhatky_thietbi_list->RowCount, "id" => "r" . $ck_view_nhatky_thietbi_list->RowCount . "_ck_view_nhatky_thietbi", "data-rowtype" => $ck_view_nhatky_thietbi->RowType]);

		// Render row
		$ck_view_nhatky_thietbi_list->renderRow();

		// Render list options
		$ck_view_nhatky_thietbi_list->renderListOptions();
?>
	<tr <?php echo $ck_view_nhatky_thietbi->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_view_nhatky_thietbi_list->ListOptions->render("body", "left", $ck_view_nhatky_thietbi_list->RowCount);
?>
	<?php if ($ck_view_nhatky_thietbi_list->nhan_vien_id->Visible) { // nhan_vien_id ?>
		<td data-name="nhan_vien_id" <?php echo $ck_view_nhatky_thietbi_list->nhan_vien_id->cellAttributes() ?>>
<span id="el<?php echo $ck_view_nhatky_thietbi_list->RowCount ?>_ck_view_nhatky_thietbi_nhan_vien_id">
<span<?php echo $ck_view_nhatky_thietbi_list->nhan_vien_id->viewAttributes() ?>><?php echo $ck_view_nhatky_thietbi_list->nhan_vien_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_view_nhatky_thietbi_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td data-name="ngay_sua_chua" <?php echo $ck_view_nhatky_thietbi_list->ngay_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $ck_view_nhatky_thietbi_list->RowCount ?>_ck_view_nhatky_thietbi_ngay_sua_chua">
<span<?php echo $ck_view_nhatky_thietbi_list->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_view_nhatky_thietbi_list->ngay_sua_chua->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_view_nhatky_thietbi_list->noi_dung->Visible) { // noi_dung ?>
		<td data-name="noi_dung" <?php echo $ck_view_nhatky_thietbi_list->noi_dung->cellAttributes() ?>>
<span id="el<?php echo $ck_view_nhatky_thietbi_list->RowCount ?>_ck_view_nhatky_thietbi_noi_dung">
<span<?php echo $ck_view_nhatky_thietbi_list->noi_dung->viewAttributes() ?>><?php echo $ck_view_nhatky_thietbi_list->noi_dung->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_view_nhatky_thietbi_list->ListOptions->render("body", "right", $ck_view_nhatky_thietbi_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ck_view_nhatky_thietbi_list->isGridAdd())
		$ck_view_nhatky_thietbi_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ck_view_nhatky_thietbi->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ck_view_nhatky_thietbi_list->Recordset)
	$ck_view_nhatky_thietbi_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ck_view_nhatky_thietbi_list->TotalRecords == 0 && !$ck_view_nhatky_thietbi->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ck_view_nhatky_thietbi_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ck_view_nhatky_thietbi_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ck_view_nhatky_thietbi_list->isExport()) { ?>
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
$ck_view_nhatky_thietbi_list->terminate();
?>