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
$ck_chitiet_suachua_list = new ck_chitiet_suachua_list();

// Run the page
$ck_chitiet_suachua_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_chitiet_suachua_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ck_chitiet_suachua_list->isExport()) { ?>
<script>
var fck_chitiet_suachualist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fck_chitiet_suachualist = currentForm = new ew.Form("fck_chitiet_suachualist", "list");
	fck_chitiet_suachualist.formKeyCountName = '<?php echo $ck_chitiet_suachua_list->FormKeyCountName ?>';
	loadjs.done("fck_chitiet_suachualist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ck_chitiet_suachua_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ck_chitiet_suachua_list->TotalRecords > 0 && $ck_chitiet_suachua_list->ExportOptions->visible()) { ?>
<?php $ck_chitiet_suachua_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ck_chitiet_suachua_list->ImportOptions->visible()) { ?>
<?php $ck_chitiet_suachua_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$ck_chitiet_suachua_list->isExport() || Config("EXPORT_MASTER_RECORD") && $ck_chitiet_suachua_list->isExport("print")) { ?>
<?php
if ($ck_chitiet_suachua_list->DbMasterFilter != "" && $ck_chitiet_suachua->getCurrentMasterTable() == "ck_danhmuc_suachua") {
	if ($ck_chitiet_suachua_list->MasterRecordExists) {
		include_once "ck_danhmuc_suachuamaster.php";
	}
}
?>
<?php } ?>
<?php
$ck_chitiet_suachua_list->renderOtherOptions();
?>
<?php $ck_chitiet_suachua_list->showPageHeader(); ?>
<?php
$ck_chitiet_suachua_list->showMessage();
?>
<?php if ($ck_chitiet_suachua_list->TotalRecords > 0 || $ck_chitiet_suachua->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ck_chitiet_suachua_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ck_chitiet_suachua">
<?php if (!$ck_chitiet_suachua_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ck_chitiet_suachua_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ck_chitiet_suachua_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ck_chitiet_suachua_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fck_chitiet_suachualist" id="fck_chitiet_suachualist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_chitiet_suachua">
<?php if ($ck_chitiet_suachua->getCurrentMasterTable() == "ck_danhmuc_suachua" && $ck_chitiet_suachua->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="ck_danhmuc_suachua">
<input type="hidden" name="fk_sua_chua_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_list->sua_chua_id->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_ck_chitiet_suachua" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ck_chitiet_suachua_list->TotalRecords > 0 || $ck_chitiet_suachua_list->isGridEdit()) { ?>
<table id="tbl_ck_chitiet_suachualist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ck_chitiet_suachua->RowType = ROWTYPE_HEADER;

// Render list options
$ck_chitiet_suachua_list->renderListOptions();

// Render list options (header, left)
$ck_chitiet_suachua_list->ListOptions->render("header", "left");
?>
<?php if ($ck_chitiet_suachua_list->tennhanvien->Visible) { // tennhanvien ?>
	<?php if ($ck_chitiet_suachua_list->SortUrl($ck_chitiet_suachua_list->tennhanvien) == "") { ?>
		<th data-name="tennhanvien" class="<?php echo $ck_chitiet_suachua_list->tennhanvien->headerCellClass() ?>"><div id="elh_ck_chitiet_suachua_tennhanvien" class="ck_chitiet_suachua_tennhanvien"><div class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_list->tennhanvien->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tennhanvien" class="<?php echo $ck_chitiet_suachua_list->tennhanvien->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_chitiet_suachua_list->SortUrl($ck_chitiet_suachua_list->tennhanvien) ?>', 1);"><div id="elh_ck_chitiet_suachua_tennhanvien" class="ck_chitiet_suachua_tennhanvien">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_list->tennhanvien->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_chitiet_suachua_list->tennhanvien->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_chitiet_suachua_list->tennhanvien->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_chitiet_suachua_list->nhan_vien_id->Visible) { // nhan_vien_id ?>
	<?php if ($ck_chitiet_suachua_list->SortUrl($ck_chitiet_suachua_list->nhan_vien_id) == "") { ?>
		<th data-name="nhan_vien_id" class="<?php echo $ck_chitiet_suachua_list->nhan_vien_id->headerCellClass() ?>"><div id="elh_ck_chitiet_suachua_nhan_vien_id" class="ck_chitiet_suachua_nhan_vien_id"><div class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_list->nhan_vien_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nhan_vien_id" class="<?php echo $ck_chitiet_suachua_list->nhan_vien_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_chitiet_suachua_list->SortUrl($ck_chitiet_suachua_list->nhan_vien_id) ?>', 1);"><div id="elh_ck_chitiet_suachua_nhan_vien_id" class="ck_chitiet_suachua_nhan_vien_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_list->nhan_vien_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_chitiet_suachua_list->nhan_vien_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_chitiet_suachua_list->nhan_vien_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_chitiet_suachua_list->chuc_danh->Visible) { // chuc_danh ?>
	<?php if ($ck_chitiet_suachua_list->SortUrl($ck_chitiet_suachua_list->chuc_danh) == "") { ?>
		<th data-name="chuc_danh" class="<?php echo $ck_chitiet_suachua_list->chuc_danh->headerCellClass() ?>"><div id="elh_ck_chitiet_suachua_chuc_danh" class="ck_chitiet_suachua_chuc_danh"><div class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_list->chuc_danh->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="chuc_danh" class="<?php echo $ck_chitiet_suachua_list->chuc_danh->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_chitiet_suachua_list->SortUrl($ck_chitiet_suachua_list->chuc_danh) ?>', 1);"><div id="elh_ck_chitiet_suachua_chuc_danh" class="ck_chitiet_suachua_chuc_danh">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_list->chuc_danh->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_chitiet_suachua_list->chuc_danh->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_chitiet_suachua_list->chuc_danh->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_chitiet_suachua_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<?php if ($ck_chitiet_suachua_list->SortUrl($ck_chitiet_suachua_list->ngay_sua_chua) == "") { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_chitiet_suachua_list->ngay_sua_chua->headerCellClass() ?>"><div id="elh_ck_chitiet_suachua_ngay_sua_chua" class="ck_chitiet_suachua_ngay_sua_chua"><div class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_list->ngay_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_chitiet_suachua_list->ngay_sua_chua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_chitiet_suachua_list->SortUrl($ck_chitiet_suachua_list->ngay_sua_chua) ?>', 1);"><div id="elh_ck_chitiet_suachua_ngay_sua_chua" class="ck_chitiet_suachua_ngay_sua_chua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_list->ngay_sua_chua->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_chitiet_suachua_list->ngay_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_chitiet_suachua_list->ngay_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_chitiet_suachua_list->thoi_gian->Visible) { // thoi_gian ?>
	<?php if ($ck_chitiet_suachua_list->SortUrl($ck_chitiet_suachua_list->thoi_gian) == "") { ?>
		<th data-name="thoi_gian" class="<?php echo $ck_chitiet_suachua_list->thoi_gian->headerCellClass() ?>"><div id="elh_ck_chitiet_suachua_thoi_gian" class="ck_chitiet_suachua_thoi_gian"><div class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_list->thoi_gian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="thoi_gian" class="<?php echo $ck_chitiet_suachua_list->thoi_gian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_chitiet_suachua_list->SortUrl($ck_chitiet_suachua_list->thoi_gian) ?>', 1);"><div id="elh_ck_chitiet_suachua_thoi_gian" class="ck_chitiet_suachua_thoi_gian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_list->thoi_gian->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_chitiet_suachua_list->thoi_gian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_chitiet_suachua_list->thoi_gian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_chitiet_suachua_list->noi_dung->Visible) { // noi_dung ?>
	<?php if ($ck_chitiet_suachua_list->SortUrl($ck_chitiet_suachua_list->noi_dung) == "") { ?>
		<th data-name="noi_dung" class="<?php echo $ck_chitiet_suachua_list->noi_dung->headerCellClass() ?>"><div id="elh_ck_chitiet_suachua_noi_dung" class="ck_chitiet_suachua_noi_dung"><div class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_list->noi_dung->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="noi_dung" class="<?php echo $ck_chitiet_suachua_list->noi_dung->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ck_chitiet_suachua_list->SortUrl($ck_chitiet_suachua_list->noi_dung) ?>', 1);"><div id="elh_ck_chitiet_suachua_noi_dung" class="ck_chitiet_suachua_noi_dung">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_chitiet_suachua_list->noi_dung->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_chitiet_suachua_list->noi_dung->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_chitiet_suachua_list->noi_dung->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ck_chitiet_suachua_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ck_chitiet_suachua_list->ExportAll && $ck_chitiet_suachua_list->isExport()) {
	$ck_chitiet_suachua_list->StopRecord = $ck_chitiet_suachua_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ck_chitiet_suachua_list->TotalRecords > $ck_chitiet_suachua_list->StartRecord + $ck_chitiet_suachua_list->DisplayRecords - 1)
		$ck_chitiet_suachua_list->StopRecord = $ck_chitiet_suachua_list->StartRecord + $ck_chitiet_suachua_list->DisplayRecords - 1;
	else
		$ck_chitiet_suachua_list->StopRecord = $ck_chitiet_suachua_list->TotalRecords;
}
$ck_chitiet_suachua_list->RecordCount = $ck_chitiet_suachua_list->StartRecord - 1;
if ($ck_chitiet_suachua_list->Recordset && !$ck_chitiet_suachua_list->Recordset->EOF) {
	$ck_chitiet_suachua_list->Recordset->moveFirst();
	$selectLimit = $ck_chitiet_suachua_list->UseSelectLimit;
	if (!$selectLimit && $ck_chitiet_suachua_list->StartRecord > 1)
		$ck_chitiet_suachua_list->Recordset->move($ck_chitiet_suachua_list->StartRecord - 1);
} elseif (!$ck_chitiet_suachua->AllowAddDeleteRow && $ck_chitiet_suachua_list->StopRecord == 0) {
	$ck_chitiet_suachua_list->StopRecord = $ck_chitiet_suachua->GridAddRowCount;
}

// Initialize aggregate
$ck_chitiet_suachua->RowType = ROWTYPE_AGGREGATEINIT;
$ck_chitiet_suachua->resetAttributes();
$ck_chitiet_suachua_list->renderRow();
while ($ck_chitiet_suachua_list->RecordCount < $ck_chitiet_suachua_list->StopRecord) {
	$ck_chitiet_suachua_list->RecordCount++;
	if ($ck_chitiet_suachua_list->RecordCount >= $ck_chitiet_suachua_list->StartRecord) {
		$ck_chitiet_suachua_list->RowCount++;

		// Set up key count
		$ck_chitiet_suachua_list->KeyCount = $ck_chitiet_suachua_list->RowIndex;

		// Init row class and style
		$ck_chitiet_suachua->resetAttributes();
		$ck_chitiet_suachua->CssClass = "";
		if ($ck_chitiet_suachua_list->isGridAdd()) {
		} else {
			$ck_chitiet_suachua_list->loadRowValues($ck_chitiet_suachua_list->Recordset); // Load row values
		}
		$ck_chitiet_suachua->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ck_chitiet_suachua->RowAttrs->merge(["data-rowindex" => $ck_chitiet_suachua_list->RowCount, "id" => "r" . $ck_chitiet_suachua_list->RowCount . "_ck_chitiet_suachua", "data-rowtype" => $ck_chitiet_suachua->RowType]);

		// Render row
		$ck_chitiet_suachua_list->renderRow();

		// Render list options
		$ck_chitiet_suachua_list->renderListOptions();
?>
	<tr <?php echo $ck_chitiet_suachua->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_chitiet_suachua_list->ListOptions->render("body", "left", $ck_chitiet_suachua_list->RowCount);
?>
	<?php if ($ck_chitiet_suachua_list->tennhanvien->Visible) { // tennhanvien ?>
		<td data-name="tennhanvien" <?php echo $ck_chitiet_suachua_list->tennhanvien->cellAttributes() ?>>
<span id="el<?php echo $ck_chitiet_suachua_list->RowCount ?>_ck_chitiet_suachua_tennhanvien">
<span<?php echo $ck_chitiet_suachua_list->tennhanvien->viewAttributes() ?>><?php echo $ck_chitiet_suachua_list->tennhanvien->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_chitiet_suachua_list->nhan_vien_id->Visible) { // nhan_vien_id ?>
		<td data-name="nhan_vien_id" <?php echo $ck_chitiet_suachua_list->nhan_vien_id->cellAttributes() ?>>
<span id="el<?php echo $ck_chitiet_suachua_list->RowCount ?>_ck_chitiet_suachua_nhan_vien_id">
<span<?php echo $ck_chitiet_suachua_list->nhan_vien_id->viewAttributes() ?>><?php echo $ck_chitiet_suachua_list->nhan_vien_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_chitiet_suachua_list->chuc_danh->Visible) { // chuc_danh ?>
		<td data-name="chuc_danh" <?php echo $ck_chitiet_suachua_list->chuc_danh->cellAttributes() ?>>
<span id="el<?php echo $ck_chitiet_suachua_list->RowCount ?>_ck_chitiet_suachua_chuc_danh">
<span<?php echo $ck_chitiet_suachua_list->chuc_danh->viewAttributes() ?>><?php echo $ck_chitiet_suachua_list->chuc_danh->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_chitiet_suachua_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td data-name="ngay_sua_chua" <?php echo $ck_chitiet_suachua_list->ngay_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $ck_chitiet_suachua_list->RowCount ?>_ck_chitiet_suachua_ngay_sua_chua">
<span<?php echo $ck_chitiet_suachua_list->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_chitiet_suachua_list->ngay_sua_chua->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_chitiet_suachua_list->thoi_gian->Visible) { // thoi_gian ?>
		<td data-name="thoi_gian" <?php echo $ck_chitiet_suachua_list->thoi_gian->cellAttributes() ?>>
<span id="el<?php echo $ck_chitiet_suachua_list->RowCount ?>_ck_chitiet_suachua_thoi_gian">
<span<?php echo $ck_chitiet_suachua_list->thoi_gian->viewAttributes() ?>><?php echo $ck_chitiet_suachua_list->thoi_gian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ck_chitiet_suachua_list->noi_dung->Visible) { // noi_dung ?>
		<td data-name="noi_dung" <?php echo $ck_chitiet_suachua_list->noi_dung->cellAttributes() ?>>
<span id="el<?php echo $ck_chitiet_suachua_list->RowCount ?>_ck_chitiet_suachua_noi_dung">
<span<?php echo $ck_chitiet_suachua_list->noi_dung->viewAttributes() ?>><?php echo $ck_chitiet_suachua_list->noi_dung->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_chitiet_suachua_list->ListOptions->render("body", "right", $ck_chitiet_suachua_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ck_chitiet_suachua_list->isGridAdd())
		$ck_chitiet_suachua_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ck_chitiet_suachua->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ck_chitiet_suachua_list->Recordset)
	$ck_chitiet_suachua_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ck_chitiet_suachua_list->TotalRecords == 0 && !$ck_chitiet_suachua->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ck_chitiet_suachua_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ck_chitiet_suachua_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ck_chitiet_suachua_list->isExport()) { ?>
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
$ck_chitiet_suachua_list->terminate();
?>