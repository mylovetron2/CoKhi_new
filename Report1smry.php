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
$Report1_summary = new Report1_summary();

// Run the page
$Report1_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Report1_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Report1_summary->isExport() && !$Report1_summary->DrillDown && !$DashboardReport) { ?>
<script>
var fsummary, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	fsummary = currentForm = new ew.Form("fsummary", "summary");
	currentPageID = ew.PAGE_ID = "summary";

	// Validate function for search
	fsummary.validate = function(fobj) {
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
	fsummary.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsummary.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fsummary.lists["x_chuanloai_id"] = <?php echo $Report1_summary->chuanloai_id->Lookup->toClientList($Report1_summary) ?>;
	fsummary.lists["x_chuanloai_id"].options = <?php echo JsonEncode($Report1_summary->chuanloai_id->lookupOptions()) ?>;
	fsummary.lists["x_thiet_bi_id"] = <?php echo $Report1_summary->thiet_bi_id->Lookup->toClientList($Report1_summary) ?>;
	fsummary.lists["x_thiet_bi_id"].options = <?php echo JsonEncode($Report1_summary->thiet_bi_id->lookupOptions()) ?>;
	fsummary.lists["x_baoduong_dinhky[]"] = <?php echo $Report1_summary->baoduong_dinhky->Lookup->toClientList($Report1_summary) ?>;
	fsummary.lists["x_baoduong_dinhky[]"].options = <?php echo JsonEncode($Report1_summary->baoduong_dinhky->options(FALSE, TRUE)) ?>;

	// Filters
	fsummary.filterList = <?php echo $Report1_summary->getFilterList() ?>;
	loadjs.done("fsummary");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Report1_summary->ShowCurrentFilter) { ?>
<?php $Report1_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Report1_summary->DrillDownInPanel) {
	$Report1_summary->ExportOptions->render("body");
	$Report1_summary->SearchOptions->render("body");
	$Report1_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Report1_summary->showPageHeader(); ?>
<?php
$Report1_summary->showMessage();
?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Report1_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$Report1_summary->isExport() && !$Report1_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Report1_summary->isExport() && !$Report1->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $Report1_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Report1">
	<div class="ew-extended-search">
<?php

// Render search row
$Report1->RowType = ROWTYPE_SEARCH;
$Report1->resetAttributes();
$Report1_summary->renderRow();
?>
<?php if ($Report1_summary->chuanloai_id->Visible) { // chuanloai_id ?>
	<?php
		$Report1_summary->SearchColumnCount++;
		if (($Report1_summary->SearchColumnCount - 1) % $Report1_summary->SearchFieldsPerRow == 0) {
			$Report1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Report1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_chuanloai_id" class="ew-cell form-group">
		<label for="x_chuanloai_id" class="ew-search-caption ew-label"><?php echo $Report1_summary->chuanloai_id->caption() ?></label>
		<span id="el_Report1_chuanloai_id" class="ew-search-field">
<?php $Report1_summary->chuanloai_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Report1" data-field="x_chuanloai_id" data-value-separator="<?php echo $Report1_summary->chuanloai_id->displayValueSeparatorAttribute() ?>" id="x_chuanloai_id" name="x_chuanloai_id"<?php echo $Report1_summary->chuanloai_id->editAttributes() ?>>
			<?php echo $Report1_summary->chuanloai_id->selectOptionListHtml("x_chuanloai_id") ?>
		</select>
</div>
<?php echo $Report1_summary->chuanloai_id->Lookup->getParamTag($Report1_summary, "p_x_chuanloai_id") ?>
</span>
	</div>
	<?php if ($Report1_summary->SearchColumnCount % $Report1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->thiet_bi_id->Visible) { // thiet_bi_id ?>
	<?php
		$Report1_summary->SearchColumnCount++;
		if (($Report1_summary->SearchColumnCount - 1) % $Report1_summary->SearchFieldsPerRow == 0) {
			$Report1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Report1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_thiet_bi_id" class="ew-cell form-group">
		<label for="x_thiet_bi_id" class="ew-search-caption ew-label"><?php echo $Report1_summary->thiet_bi_id->caption() ?></label>
		<span id="el_Report1_thiet_bi_id" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Report1" data-field="x_thiet_bi_id" data-value-separator="<?php echo $Report1_summary->thiet_bi_id->displayValueSeparatorAttribute() ?>" id="x_thiet_bi_id" name="x_thiet_bi_id"<?php echo $Report1_summary->thiet_bi_id->editAttributes() ?>>
			<?php echo $Report1_summary->thiet_bi_id->selectOptionListHtml("x_thiet_bi_id") ?>
		</select>
</div>
<?php echo $Report1_summary->thiet_bi_id->Lookup->getParamTag($Report1_summary, "p_x_thiet_bi_id") ?>
</span>
	</div>
	<?php if ($Report1_summary->SearchColumnCount % $Report1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->so_don_hang_id->Visible) { // so_don_hang_id ?>
	<?php
		$Report1_summary->SearchColumnCount++;
		if (($Report1_summary->SearchColumnCount - 1) % $Report1_summary->SearchFieldsPerRow == 0) {
			$Report1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Report1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_so_don_hang_id" class="ew-cell form-group">
		<label for="x_so_don_hang_id" class="ew-search-caption ew-label"><?php echo $Report1_summary->so_don_hang_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_so_don_hang_id" id="z_so_don_hang_id" value="LIKE">
</span>
		<span id="el_Report1_so_don_hang_id" class="ew-search-field">
<input type="text" data-table="Report1" data-field="x_so_don_hang_id" name="x_so_don_hang_id" id="x_so_don_hang_id" size="30" maxlength="110" placeholder="<?php echo HtmlEncode($Report1_summary->so_don_hang_id->getPlaceHolder()) ?>" value="<?php echo $Report1_summary->so_don_hang_id->EditValue ?>"<?php echo $Report1_summary->so_don_hang_id->editAttributes() ?>>
</span>
	</div>
	<?php if ($Report1_summary->SearchColumnCount % $Report1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->baoduong_dinhky->Visible) { // baoduong_dinhky ?>
	<?php
		$Report1_summary->SearchColumnCount++;
		if (($Report1_summary->SearchColumnCount - 1) % $Report1_summary->SearchFieldsPerRow == 0) {
			$Report1_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Report1_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_baoduong_dinhky" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $Report1_summary->baoduong_dinhky->caption() ?></label>
		<span id="el_Report1_baoduong_dinhky" class="ew-search-field">
<?php
$selwrk = ConvertToBool($Report1_summary->baoduong_dinhky->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="Report1" data-field="x_baoduong_dinhky" name="x_baoduong_dinhky[]" id="x_baoduong_dinhky[]_568446" value="1"<?php echo $selwrk ?><?php echo $Report1_summary->baoduong_dinhky->editAttributes() ?>>
	<label class="custom-control-label" for="x_baoduong_dinhky[]_568446"></label>
</div>
</span>
	</div>
	<?php if ($Report1_summary->SearchColumnCount % $Report1_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Report1_summary->SearchColumnCount % $Report1_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Report1_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Report1_summary->GroupCount <= count($Report1_summary->GroupRecords) && $Report1_summary->GroupCount <= $Report1_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Report1_summary->ShowHeader) {
?>
<?php if ($Report1_summary->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
</div>
<!-- /.ew-grid -->
<?php echo $Report1_summary->PageBreakContent ?>
<?php } ?>
<div class="<?php if (!$Report1_summary->isExport("word") && !$Report1_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Report1_summary->ReportTableStyle ?>>
<?php if (!$Report1_summary->isExport() && !($Report1_summary->DrillDown && $Report1_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Report1_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Report1" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $Report1_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Report1_summary->nhan_vien_id->Visible) { ?>
	<?php if ($Report1_summary->nhan_vien_id->ShowGroupHeaderAsRow) { ?>
	<th data-name="nhan_vien_id">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Report1_summary->sortUrl($Report1_summary->nhan_vien_id) == "") { ?>
	<th data-name="nhan_vien_id" class="<?php echo $Report1_summary->nhan_vien_id->headerCellClass() ?>"><div class="Report1_nhan_vien_id"><div class="ew-table-header-caption"><?php echo $Report1_summary->nhan_vien_id->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="nhan_vien_id" class="<?php echo $Report1_summary->nhan_vien_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->nhan_vien_id) ?>', 1);"><div class="Report1_nhan_vien_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->nhan_vien_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->nhan_vien_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->nhan_vien_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->ngay_sua_chua->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->ngay_sua_chua) == "") { ?>
	<th data-name="ngay_sua_chua" class="<?php echo $Report1_summary->ngay_sua_chua->headerCellClass() ?>"><div class="Report1_ngay_sua_chua"><div class="ew-table-header-caption"><?php echo $Report1_summary->ngay_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ngay_sua_chua" class="<?php echo $Report1_summary->ngay_sua_chua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->ngay_sua_chua) ?>', 1);"><div class="Report1_ngay_sua_chua">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->ngay_sua_chua->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->ngay_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->ngay_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->thoi_gian->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->thoi_gian) == "") { ?>
	<th data-name="thoi_gian" class="<?php echo $Report1_summary->thoi_gian->headerCellClass() ?>"><div class="Report1_thoi_gian"><div class="ew-table-header-caption"><?php echo $Report1_summary->thoi_gian->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="thoi_gian" class="<?php echo $Report1_summary->thoi_gian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->thoi_gian) ?>', 1);"><div class="Report1_thoi_gian">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->thoi_gian->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->thoi_gian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->thoi_gian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->noi_dung->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->noi_dung) == "") { ?>
	<th data-name="noi_dung" class="<?php echo $Report1_summary->noi_dung->headerCellClass() ?>"><div class="Report1_noi_dung"><div class="ew-table-header-caption"><?php echo $Report1_summary->noi_dung->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="noi_dung" class="<?php echo $Report1_summary->noi_dung->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->noi_dung) ?>', 1);"><div class="Report1_noi_dung">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->noi_dung->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->noi_dung->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->noi_dung->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->chuanloai_id->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->chuanloai_id) == "") { ?>
	<th data-name="chuanloai_id" class="<?php echo $Report1_summary->chuanloai_id->headerCellClass() ?>"><div class="Report1_chuanloai_id"><div class="ew-table-header-caption"><?php echo $Report1_summary->chuanloai_id->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="chuanloai_id" class="<?php echo $Report1_summary->chuanloai_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->chuanloai_id) ?>', 1);"><div class="Report1_chuanloai_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->chuanloai_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->chuanloai_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->chuanloai_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->thiet_bi_id->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->thiet_bi_id) == "") { ?>
	<th data-name="thiet_bi_id" class="<?php echo $Report1_summary->thiet_bi_id->headerCellClass() ?>"><div class="Report1_thiet_bi_id"><div class="ew-table-header-caption"><?php echo $Report1_summary->thiet_bi_id->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="thiet_bi_id" class="<?php echo $Report1_summary->thiet_bi_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->thiet_bi_id) ?>', 1);"><div class="Report1_thiet_bi_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->thiet_bi_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->thiet_bi_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->thiet_bi_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->so_don_hang_id->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->so_don_hang_id) == "") { ?>
	<th data-name="so_don_hang_id" class="<?php echo $Report1_summary->so_don_hang_id->headerCellClass() ?>"><div class="Report1_so_don_hang_id"><div class="ew-table-header-caption"><?php echo $Report1_summary->so_don_hang_id->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="so_don_hang_id" class="<?php echo $Report1_summary->so_don_hang_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->so_don_hang_id) ?>', 1);"><div class="Report1_so_don_hang_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->so_don_hang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->so_don_hang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->so_don_hang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->ngay_hoan_thanh->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->ngay_hoan_thanh) == "") { ?>
	<th data-name="ngay_hoan_thanh" class="<?php echo $Report1_summary->ngay_hoan_thanh->headerCellClass() ?>"><div class="Report1_ngay_hoan_thanh"><div class="ew-table-header-caption"><?php echo $Report1_summary->ngay_hoan_thanh->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ngay_hoan_thanh" class="<?php echo $Report1_summary->ngay_hoan_thanh->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->ngay_hoan_thanh) ?>', 1);"><div class="Report1_ngay_hoan_thanh">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->ngay_hoan_thanh->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->ngay_hoan_thanh->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->ngay_hoan_thanh->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->baoduong_dinhky->Visible) { ?>
	<?php if ($Report1_summary->sortUrl($Report1_summary->baoduong_dinhky) == "") { ?>
	<th data-name="baoduong_dinhky" class="<?php echo $Report1_summary->baoduong_dinhky->headerCellClass() ?>"><div class="Report1_baoduong_dinhky"><div class="ew-table-header-caption"><?php echo $Report1_summary->baoduong_dinhky->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="baoduong_dinhky" class="<?php echo $Report1_summary->baoduong_dinhky->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->baoduong_dinhky) ?>', 1);"><div class="Report1_baoduong_dinhky">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Report1_summary->baoduong_dinhky->caption() ?></span><span class="ew-table-header-sort"><?php if ($Report1_summary->baoduong_dinhky->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->baoduong_dinhky->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Report1_summary->TotalGroups == 0)
			break; // Show header only
		$Report1_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Report1_summary->nhan_vien_id, $Report1_summary->getSqlFirstGroupField(), $Report1_summary->nhan_vien_id->groupValue(), $Report1_summary->Dbid);
	if ($Report1_summary->PageFirstGroupFilter != "") $Report1_summary->PageFirstGroupFilter .= " OR ";
	$Report1_summary->PageFirstGroupFilter .= $where;
	if ($Report1_summary->Filter != "")
		$where = "($Report1_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Report1_summary->getSqlSelect(), $Report1_summary->getSqlWhere(), $Report1_summary->getSqlGroupBy(), $Report1_summary->getSqlHaving(), $Report1_summary->getSqlOrderBy(), $where, $Report1_summary->Sort);
	$rs = $Report1_summary->getRecordset($sql);
	$Report1_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Report1_summary->DetailRecordCount = count($Report1_summary->DetailRecords);
	$Report1_summary->setGroupCount($Report1_summary->DetailRecordCount, $Report1_summary->GroupCount);

	// Load detail records
	$Report1_summary->nhan_vien_id->Records = &$Report1_summary->DetailRecords;
	$Report1_summary->nhan_vien_id->LevelBreak = TRUE; // Set field level break
		$Report1_summary->GroupCounter[1] = $Report1_summary->GroupCount;
		$Report1_summary->nhan_vien_id->getCnt($Report1_summary->nhan_vien_id->Records); // Get record count
		$Report1_summary->setGroupCount($Report1_summary->nhan_vien_id->Count, $Report1_summary->GroupCounter[1]);
?>
<?php if ($Report1_summary->nhan_vien_id->Visible && $Report1_summary->nhan_vien_id->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Report1_summary->resetAttributes();
		$Report1_summary->RowType = ROWTYPE_TOTAL;
		$Report1_summary->RowTotalType = ROWTOTAL_GROUP;
		$Report1_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Report1_summary->RowGroupLevel = 1;
		$Report1_summary->renderRow();
?>
	<tr<?php echo $Report1_summary->rowAttributes(); ?>>
<?php if ($Report1_summary->nhan_vien_id->Visible) { ?>
		<td data-field="nhan_vien_id"<?php echo $Report1_summary->nhan_vien_id->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="nhan_vien_id" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Report1_summary->nhan_vien_id->cellAttributes() ?>>
<?php if ($Report1_summary->sortUrl($Report1_summary->nhan_vien_id) == "") { ?>
		<span class="ew-summary-caption Report1_nhan_vien_id"><span class="ew-table-header-caption"><?php echo $Report1_summary->nhan_vien_id->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Report1_nhan_vien_id" onclick="ew.sort(event, '<?php echo $Report1_summary->sortUrl($Report1_summary->nhan_vien_id) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Report1_summary->nhan_vien_id->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Report1_summary->nhan_vien_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Report1_summary->nhan_vien_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Report1_summary->nhan_vien_id->viewAttributes() ?>><?php echo $Report1_summary->nhan_vien_id->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Report1_summary->nhan_vien_id->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Report1_summary->RecordCount = 0; // Reset record count
	foreach ($Report1_summary->nhan_vien_id->Records as $record) {
		$Report1_summary->RecordCount++;
		$Report1_summary->RecordIndex++;
		$Report1_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Report1_summary->resetAttributes();
		$Report1_summary->RowType = ROWTYPE_DETAIL;
		$Report1_summary->renderRow();
?>
	<tr<?php echo $Report1_summary->rowAttributes(); ?>>
<?php if ($Report1_summary->nhan_vien_id->Visible) { ?>
	<?php if ($Report1_summary->nhan_vien_id->ShowGroupHeaderAsRow) { ?>
		<td data-field="nhan_vien_id"<?php echo $Report1_summary->nhan_vien_id->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="nhan_vien_id"<?php echo $Report1_summary->nhan_vien_id->cellAttributes(); ?>><span<?php echo $Report1_summary->nhan_vien_id->viewAttributes() ?>><?php echo $Report1_summary->nhan_vien_id->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Report1_summary->ngay_sua_chua->Visible) { ?>
		<td data-field="ngay_sua_chua"<?php echo $Report1_summary->ngay_sua_chua->cellAttributes() ?>>
<span<?php echo $Report1_summary->ngay_sua_chua->viewAttributes() ?>><?php echo $Report1_summary->ngay_sua_chua->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->thoi_gian->Visible) { ?>
		<td data-field="thoi_gian"<?php echo $Report1_summary->thoi_gian->cellAttributes() ?>>
<span<?php echo $Report1_summary->thoi_gian->viewAttributes() ?>><?php echo $Report1_summary->thoi_gian->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->noi_dung->Visible) { ?>
		<td data-field="noi_dung"<?php echo $Report1_summary->noi_dung->cellAttributes() ?>>
<span<?php echo $Report1_summary->noi_dung->viewAttributes() ?>><?php echo $Report1_summary->noi_dung->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->chuanloai_id->Visible) { ?>
		<td data-field="chuanloai_id"<?php echo $Report1_summary->chuanloai_id->cellAttributes() ?>>
<span<?php echo $Report1_summary->chuanloai_id->viewAttributes() ?>><?php echo $Report1_summary->chuanloai_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->thiet_bi_id->Visible) { ?>
		<td data-field="thiet_bi_id"<?php echo $Report1_summary->thiet_bi_id->cellAttributes() ?>>
<span<?php echo $Report1_summary->thiet_bi_id->viewAttributes() ?>><?php echo $Report1_summary->thiet_bi_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->so_don_hang_id->Visible) { ?>
		<td data-field="so_don_hang_id"<?php echo $Report1_summary->so_don_hang_id->cellAttributes() ?>>
<span<?php echo $Report1_summary->so_don_hang_id->viewAttributes() ?>><?php echo $Report1_summary->so_don_hang_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->ngay_hoan_thanh->Visible) { ?>
		<td data-field="ngay_hoan_thanh"<?php echo $Report1_summary->ngay_hoan_thanh->cellAttributes() ?>>
<span<?php echo $Report1_summary->ngay_hoan_thanh->viewAttributes() ?>><?php echo $Report1_summary->ngay_hoan_thanh->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Report1_summary->baoduong_dinhky->Visible) { ?>
		<td data-field="baoduong_dinhky"<?php echo $Report1_summary->baoduong_dinhky->cellAttributes() ?>>
<span<?php echo $Report1_summary->baoduong_dinhky->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_baoduong_dinhky" class="custom-control-input" value="<?php echo $Report1_summary->baoduong_dinhky->getViewValue() ?>" disabled<?php if (ConvertToBool($Report1_summary->baoduong_dinhky->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_baoduong_dinhky"></label></div></span>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php

	// Next group
	$Report1_summary->loadGroupRowValues();

	// Show header if page break
	if ($Report1_summary->isExport())
		$Report1_summary->ShowHeader = ($Report1_summary->ExportPageBreakCount == 0) ? FALSE : ($Report1_summary->GroupCount % $Report1_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Report1_summary->ShowHeader)
		$Report1_summary->Page_Breaking($Report1_summary->ShowHeader, $Report1_summary->PageBreakContent);
	$Report1_summary->GroupCount++;
} // End while
?>
<?php if ($Report1_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Report1_summary->resetAttributes();
	$Report1_summary->RowType = ROWTYPE_TOTAL;
	$Report1_summary->RowTotalType = ROWTOTAL_GRAND;
	$Report1_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Report1_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Report1_summary->renderRow();
?>
<?php if ($Report1_summary->nhan_vien_id->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Report1_summary->rowAttributes() ?>><td colspan="<?php echo ($Report1_summary->GroupColumnCount + $Report1_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Report1_summary->TotalCount, 0); ?></span>)</span></td></tr>
<?php } else { ?>
	<tr<?php echo $Report1_summary->rowAttributes() ?>><td colspan="<?php echo ($Report1_summary->GroupColumnCount + $Report1_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Report1_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-summary -->
<!-- Summary report (end) -->
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Report1_summary->isExport() || $Report1_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Report1_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Report1_summary->isExport() && !$Report1_summary->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "footer.php"; ?>
<?php } ?>
<?php
$Report1_summary->terminate();
?>