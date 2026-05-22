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
$view1_list = new view1_list();

// Run the page
$view1_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$view1_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$view1_list->isExport()) { ?>
<script>
var fview1list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fview1list = currentForm = new ew.Form("fview1list", "list");
	fview1list.formKeyCountName = '<?php echo $view1_list->FormKeyCountName ?>';
	loadjs.done("fview1list");
});
var fview1listsrch;
loadjs.ready("head", function() {

	// Form object for search
	fview1listsrch = currentSearchForm = new ew.Form("fview1listsrch");

	// Validate function for search
	fview1listsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ngay_sua_chua");
		if (elm && !ew.checkEuroDate(elm.value))
			return this.onError(elm, "<?php echo JsEncode($view1_list->ngay_sua_chua->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fview1listsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fview1listsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fview1listsrch.lists["x_search"] = <?php echo $view1_list->search->Lookup->toClientList($view1_list) ?>;
	fview1listsrch.lists["x_search"].options = <?php echo JsonEncode($view1_list->search->options(FALSE, TRUE)) ?>;

	// Filters
	fview1listsrch.filterList = <?php echo $view1_list->getFilterList() ?>;
	loadjs.done("fview1listsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$view1_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($view1_list->TotalRecords > 0 && $view1_list->ExportOptions->visible()) { ?>
<?php $view1_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($view1_list->ImportOptions->visible()) { ?>
<?php $view1_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($view1_list->SearchOptions->visible()) { ?>
<?php $view1_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($view1_list->FilterOptions->visible()) { ?>
<?php $view1_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$view1_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$view1_list->isExport() && !$view1->CurrentAction) { ?>
<form name="fview1listsrch" id="fview1listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fview1listsrch-search-panel" class="<?php echo $view1_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="view1">
	<div class="ew-extended-search">
<?php

// Render search row
$view1->RowType = ROWTYPE_SEARCH;
$view1->resetAttributes();
$view1_list->renderRow();
?>
<?php if ($view1_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<?php
		$view1_list->SearchColumnCount++;
		if (($view1_list->SearchColumnCount - 1) % $view1_list->SearchFieldsPerRow == 0) {
			$view1_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $view1_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ngay_sua_chua" class="ew-cell form-group">
		<label for="x_ngay_sua_chua" class="ew-search-caption ew-label"><?php echo $view1_list->ngay_sua_chua->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("BETWEEN") ?>
<input type="hidden" name="z_ngay_sua_chua" id="z_ngay_sua_chua" value="BETWEEN">
</span>
		<span id="el_view1_ngay_sua_chua" class="ew-search-field">
<input type="text" data-table="view1" data-field="x_ngay_sua_chua" data-format="7" name="x_ngay_sua_chua" id="x_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($view1_list->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $view1_list->ngay_sua_chua->EditValue ?>"<?php echo $view1_list->ngay_sua_chua->editAttributes() ?>>
<?php if (!$view1_list->ngay_sua_chua->ReadOnly && !$view1_list->ngay_sua_chua->Disabled && !isset($view1_list->ngay_sua_chua->EditAttrs["readonly"]) && !isset($view1_list->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fview1listsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("fview1listsrch", "x_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
		<span class="ew-search-and"><label><?php echo $Language->phrase("AND") ?></label></span>
		<span id="el2_view1_ngay_sua_chua" class="ew-search-field2">
<input type="text" data-table="view1" data-field="x_ngay_sua_chua" data-format="7" name="y_ngay_sua_chua" id="y_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($view1_list->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $view1_list->ngay_sua_chua->EditValue2 ?>"<?php echo $view1_list->ngay_sua_chua->editAttributes() ?>>
<?php if (!$view1_list->ngay_sua_chua->ReadOnly && !$view1_list->ngay_sua_chua->Disabled && !isset($view1_list->ngay_sua_chua->EditAttrs["readonly"]) && !isset($view1_list->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fview1listsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("fview1listsrch", "y_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
	</div>
	<?php if ($view1_list->SearchColumnCount % $view1_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->search->Visible) { // search ?>
	<?php
		$view1_list->SearchColumnCount++;
		if (($view1_list->SearchColumnCount - 1) % $view1_list->SearchFieldsPerRow == 0) {
			$view1_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $view1_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_search" class="ew-cell form-group">
		<label for="x_search" class="ew-search-caption ew-label"><?php echo $view1_list->search->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_search" id="z_search" value="LIKE">
</span>
		<span id="el_view1_search" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="view1" data-field="x_search" data-value-separator="<?php echo $view1_list->search->displayValueSeparatorAttribute() ?>" id="x_search" name="x_search"<?php echo $view1_list->search->editAttributes() ?>>
			<?php echo $view1_list->search->selectOptionListHtml("x_search") ?>
		</select>
</div>
</span>
	</div>
	<?php if ($view1_list->SearchColumnCount % $view1_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($view1_list->SearchColumnCount % $view1_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $view1_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $view1_list->showPageHeader(); ?>
<?php
$view1_list->showMessage();
?>
<?php if ($view1_list->TotalRecords > 0 || $view1->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($view1_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> view1">
<?php if (!$view1_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$view1_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $view1_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $view1_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fview1list" id="fview1list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="view1">
<div id="gmp_view1" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($view1_list->TotalRecords > 0 || $view1_list->isGridEdit()) { ?>
<table id="tbl_view1list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$view1->RowType = ROWTYPE_HEADER;

// Render list options
$view1_list->renderListOptions();

// Render list options (header, left)
$view1_list->ListOptions->render("header", "left");
?>
<?php if ($view1_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<?php if ($view1_list->SortUrl($view1_list->ngay_sua_chua) == "") { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $view1_list->ngay_sua_chua->headerCellClass() ?>"><div id="elh_view1_ngay_sua_chua" class="view1_ngay_sua_chua"><div class="ew-table-header-caption"><?php echo $view1_list->ngay_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $view1_list->ngay_sua_chua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->ngay_sua_chua) ?>', 1);"><div id="elh_view1_ngay_sua_chua" class="view1_ngay_sua_chua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->ngay_sua_chua->caption() ?></span><span class="ew-table-header-sort"><?php if ($view1_list->ngay_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->ngay_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($view1_list->search->Visible) { // search ?>
	<?php if ($view1_list->SortUrl($view1_list->search) == "") { ?>
		<th data-name="search" class="<?php echo $view1_list->search->headerCellClass() ?>"><div id="elh_view1_search" class="view1_search"><div class="ew-table-header-caption"><?php echo $view1_list->search->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="search" class="<?php echo $view1_list->search->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $view1_list->SortUrl($view1_list->search) ?>', 1);"><div id="elh_view1_search" class="view1_search">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $view1_list->search->caption() ?></span><span class="ew-table-header-sort"><?php if ($view1_list->search->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($view1_list->search->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$view1_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($view1_list->ExportAll && $view1_list->isExport()) {
	$view1_list->StopRecord = $view1_list->TotalRecords;
} else {

	// Set the last record to display
	if ($view1_list->TotalRecords > $view1_list->StartRecord + $view1_list->DisplayRecords - 1)
		$view1_list->StopRecord = $view1_list->StartRecord + $view1_list->DisplayRecords - 1;
	else
		$view1_list->StopRecord = $view1_list->TotalRecords;
}
$view1_list->RecordCount = $view1_list->StartRecord - 1;
if ($view1_list->Recordset && !$view1_list->Recordset->EOF) {
	$view1_list->Recordset->moveFirst();
	$selectLimit = $view1_list->UseSelectLimit;
	if (!$selectLimit && $view1_list->StartRecord > 1)
		$view1_list->Recordset->move($view1_list->StartRecord - 1);
} elseif (!$view1->AllowAddDeleteRow && $view1_list->StopRecord == 0) {
	$view1_list->StopRecord = $view1->GridAddRowCount;
}

// Initialize aggregate
$view1->RowType = ROWTYPE_AGGREGATEINIT;
$view1->resetAttributes();
$view1_list->renderRow();
while ($view1_list->RecordCount < $view1_list->StopRecord) {
	$view1_list->RecordCount++;
	if ($view1_list->RecordCount >= $view1_list->StartRecord) {
		$view1_list->RowCount++;

		// Set up key count
		$view1_list->KeyCount = $view1_list->RowIndex;

		// Init row class and style
		$view1->resetAttributes();
		$view1->CssClass = "";
		if ($view1_list->isGridAdd()) {
		} else {
			$view1_list->loadRowValues($view1_list->Recordset); // Load row values
		}
		$view1->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$view1->RowAttrs->merge(["data-rowindex" => $view1_list->RowCount, "id" => "r" . $view1_list->RowCount . "_view1", "data-rowtype" => $view1->RowType]);

		// Render row
		$view1_list->renderRow();

		// Render list options
		$view1_list->renderListOptions();
?>
	<tr <?php echo $view1->rowAttributes() ?>>
<?php

// Render list options (body, left)
$view1_list->ListOptions->render("body", "left", $view1_list->RowCount);
?>
	<?php if ($view1_list->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td data-name="ngay_sua_chua" <?php echo $view1_list->ngay_sua_chua->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_ngay_sua_chua">
<span<?php echo $view1_list->ngay_sua_chua->viewAttributes() ?>><?php echo $view1_list->ngay_sua_chua->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($view1_list->search->Visible) { // search ?>
		<td data-name="search" <?php echo $view1_list->search->cellAttributes() ?>>
<span id="el<?php echo $view1_list->RowCount ?>_view1_search">
<span<?php echo $view1_list->search->viewAttributes() ?>><?php echo $view1_list->search->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$view1_list->ListOptions->render("body", "right", $view1_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$view1_list->isGridAdd())
		$view1_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$view1->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($view1_list->Recordset)
	$view1_list->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($view1_list->TotalRecords == 0 && !$view1->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $view1_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$view1_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$view1_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(document).ready(function(){$("#x_search").change(function(){sessionStorage.setItem("bao_cao",$(this).val()),console.log($(this).val())})}),html='<button class="ew-export-option ew-list-option-separator text-nowrap" name="btn-in" id="btn-in" >In báo cáo</button>',$(".ew-toolbar").append(html),$("#x_ngay_sua_chua").on("change, blur",function(){sessionStorage.setItem("ngay_sua_chua",$(this).val()),console.log($(this).val())}),$("#y_ngay_sua_chua").on("change, blur",function(){sessionStorage.setItem("ngay_sua_chua2",$(this).val()),console.log($(this).val())}),$("#btn-in").on("click",function(){search_id=sessionStorage.getItem("ngay_sua_chua"),search_id2=sessionStorage.getItem("ngay_sua_chua2"),baocao=sessionStorage.getItem("bao_cao"),1==baocao?window.location.href="in_excel.php?search="+search_id+"&search2="+search_id2+"&baocao="+baocao:window.location.href="in_excel_ns.php"});
});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$view1_list->terminate();
?>