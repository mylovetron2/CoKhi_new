<?php
namespace PHPMaker2020\projectCoKhi;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($ck_danhmuc_suachua_grid))
	$ck_danhmuc_suachua_grid = new ck_danhmuc_suachua_grid();

// Run the page
$ck_danhmuc_suachua_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_danhmuc_suachua_grid->Page_Render();
?>
<?php if (!$ck_danhmuc_suachua_grid->isExport()) { ?>
<script>
var fck_danhmuc_suachuagrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fck_danhmuc_suachuagrid = new ew.Form("fck_danhmuc_suachuagrid", "grid");
	fck_danhmuc_suachuagrid.formKeyCountName = '<?php echo $ck_danhmuc_suachua_grid->FormKeyCountName ?>';

	// Validate form
	fck_danhmuc_suachuagrid.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($ck_danhmuc_suachua_grid->chuanloai_id->Required) { ?>
				elm = this.getElements("x" + infix + "_chuanloai_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_grid->chuanloai_id->caption(), $ck_danhmuc_suachua_grid->chuanloai_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_grid->thiet_bi_id->Required) { ?>
				elm = this.getElements("x" + infix + "_thiet_bi_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_grid->thiet_bi_id->caption(), $ck_danhmuc_suachua_grid->thiet_bi_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_grid->ngay_sua_chua->Required) { ?>
				elm = this.getElements("x" + infix + "_ngay_sua_chua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_grid->ngay_sua_chua->caption(), $ck_danhmuc_suachua_grid->ngay_sua_chua->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ngay_sua_chua");
				if (elm && !ew.checkShortEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_danhmuc_suachua_grid->ngay_sua_chua->errorMessage()) ?>");
			<?php if ($ck_danhmuc_suachua_grid->noi_dung_sua_chua->Required) { ?>
				elm = this.getElements("x" + infix + "_noi_dung_sua_chua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_grid->noi_dung_sua_chua->caption(), $ck_danhmuc_suachua_grid->noi_dung_sua_chua->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->Required) { ?>
				elm = this.getElements("x" + infix + "_thoi_gian_sua_chua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->caption(), $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_thoi_gian_sua_chua");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->errorMessage()) ?>");
			<?php if ($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->Required) { ?>
				elm = this.getElements("x" + infix + "_nguoi_nhap_lieu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->caption(), $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_grid->dich_vu->Required) { ?>
				elm = this.getElements("x" + infix + "_dich_vu[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_grid->dich_vu->caption(), $ck_danhmuc_suachua_grid->dich_vu->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_grid->hoan_thanh->Required) { ?>
				elm = this.getElements("x" + infix + "_hoan_thanh[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_grid->hoan_thanh->caption(), $ck_danhmuc_suachua_grid->hoan_thanh->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_grid->id_don_hang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_don_hang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_grid->id_don_hang->caption(), $ck_danhmuc_suachua_grid->id_don_hang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_grid->ngay_hoan_thanh->Required) { ?>
				elm = this.getElements("x" + infix + "_ngay_hoan_thanh");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_grid->ngay_hoan_thanh->caption(), $ck_danhmuc_suachua_grid->ngay_hoan_thanh->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ngay_hoan_thanh");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_danhmuc_suachua_grid->ngay_hoan_thanh->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fck_danhmuc_suachuagrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "chuanloai_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "thiet_bi_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "ngay_sua_chua", false)) return false;
		if (ew.valueChanged(fobj, infix, "noi_dung_sua_chua", false)) return false;
		if (ew.valueChanged(fobj, infix, "thoi_gian_sua_chua", false)) return false;
		if (ew.valueChanged(fobj, infix, "nguoi_nhap_lieu", false)) return false;
		if (ew.valueChanged(fobj, infix, "dich_vu[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "hoan_thanh[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "id_don_hang", false)) return false;
		if (ew.valueChanged(fobj, infix, "ngay_hoan_thanh", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fck_danhmuc_suachuagrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fck_danhmuc_suachuagrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fck_danhmuc_suachuagrid.lists["x_chuanloai_id"] = <?php echo $ck_danhmuc_suachua_grid->chuanloai_id->Lookup->toClientList($ck_danhmuc_suachua_grid) ?>;
	fck_danhmuc_suachuagrid.lists["x_chuanloai_id"].options = <?php echo JsonEncode($ck_danhmuc_suachua_grid->chuanloai_id->lookupOptions()) ?>;
	fck_danhmuc_suachuagrid.lists["x_thiet_bi_id"] = <?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->Lookup->toClientList($ck_danhmuc_suachua_grid) ?>;
	fck_danhmuc_suachuagrid.lists["x_thiet_bi_id"].options = <?php echo JsonEncode($ck_danhmuc_suachua_grid->thiet_bi_id->lookupOptions()) ?>;
	fck_danhmuc_suachuagrid.lists["x_nguoi_nhap_lieu"] = <?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->Lookup->toClientList($ck_danhmuc_suachua_grid) ?>;
	fck_danhmuc_suachuagrid.lists["x_nguoi_nhap_lieu"].options = <?php echo JsonEncode($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->lookupOptions()) ?>;
	fck_danhmuc_suachuagrid.lists["x_dich_vu[]"] = <?php echo $ck_danhmuc_suachua_grid->dich_vu->Lookup->toClientList($ck_danhmuc_suachua_grid) ?>;
	fck_danhmuc_suachuagrid.lists["x_dich_vu[]"].options = <?php echo JsonEncode($ck_danhmuc_suachua_grid->dich_vu->options(FALSE, TRUE)) ?>;
	fck_danhmuc_suachuagrid.lists["x_hoan_thanh[]"] = <?php echo $ck_danhmuc_suachua_grid->hoan_thanh->Lookup->toClientList($ck_danhmuc_suachua_grid) ?>;
	fck_danhmuc_suachuagrid.lists["x_hoan_thanh[]"].options = <?php echo JsonEncode($ck_danhmuc_suachua_grid->hoan_thanh->options(FALSE, TRUE)) ?>;
	fck_danhmuc_suachuagrid.lists["x_id_don_hang"] = <?php echo $ck_danhmuc_suachua_grid->id_don_hang->Lookup->toClientList($ck_danhmuc_suachua_grid) ?>;
	fck_danhmuc_suachuagrid.lists["x_id_don_hang"].options = <?php echo JsonEncode($ck_danhmuc_suachua_grid->id_don_hang->lookupOptions()) ?>;
	fck_danhmuc_suachuagrid.autoSuggests["x_id_don_hang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fck_danhmuc_suachuagrid");
});
</script>
<?php } ?>
<?php
$ck_danhmuc_suachua_grid->renderOtherOptions();
?>
<?php if ($ck_danhmuc_suachua_grid->TotalRecords > 0 || $ck_danhmuc_suachua->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ck_danhmuc_suachua_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ck_danhmuc_suachua">
<?php if ($ck_danhmuc_suachua_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $ck_danhmuc_suachua_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fck_danhmuc_suachuagrid" class="ew-form ew-list-form form-inline">
<div id="gmp_ck_danhmuc_suachua" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_ck_danhmuc_suachuagrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ck_danhmuc_suachua->RowType = ROWTYPE_HEADER;

// Render list options
$ck_danhmuc_suachua_grid->renderListOptions();

// Render list options (header, left)
$ck_danhmuc_suachua_grid->ListOptions->render("header", "left");
?>
<?php if ($ck_danhmuc_suachua_grid->chuanloai_id->Visible) { // chuanloai_id ?>
	<?php if ($ck_danhmuc_suachua_grid->SortUrl($ck_danhmuc_suachua_grid->chuanloai_id) == "") { ?>
		<th data-name="chuanloai_id" class="<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_chuanloai_id" class="ck_danhmuc_suachua_chuanloai_id"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->chuanloai_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="chuanloai_id" class="<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_suachua_chuanloai_id" class="ck_danhmuc_suachua_chuanloai_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->chuanloai_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_grid->chuanloai_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_grid->chuanloai_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_grid->thiet_bi_id->Visible) { // thiet_bi_id ?>
	<?php if ($ck_danhmuc_suachua_grid->SortUrl($ck_danhmuc_suachua_grid->thiet_bi_id) == "") { ?>
		<th data-name="thiet_bi_id" class="<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_thiet_bi_id" class="ck_danhmuc_suachua_thiet_bi_id"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="thiet_bi_id" class="<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_suachua_thiet_bi_id" class="ck_danhmuc_suachua_thiet_bi_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_grid->thiet_bi_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_grid->thiet_bi_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_grid->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<?php if ($ck_danhmuc_suachua_grid->SortUrl($ck_danhmuc_suachua_grid->ngay_sua_chua) == "") { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_danhmuc_suachua_grid->ngay_sua_chua->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_ngay_sua_chua" class="ck_danhmuc_suachua_ngay_sua_chua"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->ngay_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ngay_sua_chua" class="<?php echo $ck_danhmuc_suachua_grid->ngay_sua_chua->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_suachua_ngay_sua_chua" class="ck_danhmuc_suachua_ngay_sua_chua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->ngay_sua_chua->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_grid->ngay_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_grid->ngay_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_grid->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
	<?php if ($ck_danhmuc_suachua_grid->SortUrl($ck_danhmuc_suachua_grid->noi_dung_sua_chua) == "") { ?>
		<th data-name="noi_dung_sua_chua" class="<?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_noi_dung_sua_chua" class="ck_danhmuc_suachua_noi_dung_sua_chua"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="noi_dung_sua_chua" class="<?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_suachua_noi_dung_sua_chua" class="ck_danhmuc_suachua_noi_dung_sua_chua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_grid->noi_dung_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_grid->noi_dung_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->Visible) { // thoi_gian_sua_chua ?>
	<?php if ($ck_danhmuc_suachua_grid->SortUrl($ck_danhmuc_suachua_grid->thoi_gian_sua_chua) == "") { ?>
		<th data-name="thoi_gian_sua_chua" class="<?php echo $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_thoi_gian_sua_chua" class="ck_danhmuc_suachua_thoi_gian_sua_chua"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="thoi_gian_sua_chua" class="<?php echo $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_suachua_thoi_gian_sua_chua" class="ck_danhmuc_suachua_thoi_gian_sua_chua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->Visible) { // nguoi_nhap_lieu ?>
	<?php if ($ck_danhmuc_suachua_grid->SortUrl($ck_danhmuc_suachua_grid->nguoi_nhap_lieu) == "") { ?>
		<th data-name="nguoi_nhap_lieu" class="<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_nguoi_nhap_lieu" class="ck_danhmuc_suachua_nguoi_nhap_lieu"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nguoi_nhap_lieu" class="<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_suachua_nguoi_nhap_lieu" class="ck_danhmuc_suachua_nguoi_nhap_lieu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_grid->dich_vu->Visible) { // dich_vu ?>
	<?php if ($ck_danhmuc_suachua_grid->SortUrl($ck_danhmuc_suachua_grid->dich_vu) == "") { ?>
		<th data-name="dich_vu" class="<?php echo $ck_danhmuc_suachua_grid->dich_vu->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_dich_vu" class="ck_danhmuc_suachua_dich_vu"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->dich_vu->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dich_vu" class="<?php echo $ck_danhmuc_suachua_grid->dich_vu->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_suachua_dich_vu" class="ck_danhmuc_suachua_dich_vu">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->dich_vu->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_grid->dich_vu->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_grid->dich_vu->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_grid->hoan_thanh->Visible) { // hoan_thanh ?>
	<?php if ($ck_danhmuc_suachua_grid->SortUrl($ck_danhmuc_suachua_grid->hoan_thanh) == "") { ?>
		<th data-name="hoan_thanh" class="<?php echo $ck_danhmuc_suachua_grid->hoan_thanh->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_hoan_thanh" class="ck_danhmuc_suachua_hoan_thanh"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->hoan_thanh->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hoan_thanh" class="<?php echo $ck_danhmuc_suachua_grid->hoan_thanh->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_suachua_hoan_thanh" class="ck_danhmuc_suachua_hoan_thanh">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->hoan_thanh->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_grid->hoan_thanh->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_grid->hoan_thanh->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_grid->id_don_hang->Visible) { // id_don_hang ?>
	<?php if ($ck_danhmuc_suachua_grid->SortUrl($ck_danhmuc_suachua_grid->id_don_hang) == "") { ?>
		<th data-name="id_don_hang" class="<?php echo $ck_danhmuc_suachua_grid->id_don_hang->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_id_don_hang" class="ck_danhmuc_suachua_id_don_hang"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->id_don_hang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_don_hang" class="<?php echo $ck_danhmuc_suachua_grid->id_don_hang->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_suachua_id_don_hang" class="ck_danhmuc_suachua_id_don_hang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->id_don_hang->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_grid->id_don_hang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_grid->id_don_hang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua_grid->ngay_hoan_thanh->Visible) { // ngay_hoan_thanh ?>
	<?php if ($ck_danhmuc_suachua_grid->SortUrl($ck_danhmuc_suachua_grid->ngay_hoan_thanh) == "") { ?>
		<th data-name="ngay_hoan_thanh" class="<?php echo $ck_danhmuc_suachua_grid->ngay_hoan_thanh->headerCellClass() ?>"><div id="elh_ck_danhmuc_suachua_ngay_hoan_thanh" class="ck_danhmuc_suachua_ngay_hoan_thanh"><div class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->ngay_hoan_thanh->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ngay_hoan_thanh" class="<?php echo $ck_danhmuc_suachua_grid->ngay_hoan_thanh->headerCellClass() ?>"><div><div id="elh_ck_danhmuc_suachua_ngay_hoan_thanh" class="ck_danhmuc_suachua_ngay_hoan_thanh">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ck_danhmuc_suachua_grid->ngay_hoan_thanh->caption() ?></span><span class="ew-table-header-sort"><?php if ($ck_danhmuc_suachua_grid->ngay_hoan_thanh->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ck_danhmuc_suachua_grid->ngay_hoan_thanh->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ck_danhmuc_suachua_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$ck_danhmuc_suachua_grid->StartRecord = 1;
$ck_danhmuc_suachua_grid->StopRecord = $ck_danhmuc_suachua_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($ck_danhmuc_suachua->isConfirm() || $ck_danhmuc_suachua_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($ck_danhmuc_suachua_grid->FormKeyCountName) && ($ck_danhmuc_suachua_grid->isGridAdd() || $ck_danhmuc_suachua_grid->isGridEdit() || $ck_danhmuc_suachua->isConfirm())) {
		$ck_danhmuc_suachua_grid->KeyCount = $CurrentForm->getValue($ck_danhmuc_suachua_grid->FormKeyCountName);
		$ck_danhmuc_suachua_grid->StopRecord = $ck_danhmuc_suachua_grid->StartRecord + $ck_danhmuc_suachua_grid->KeyCount - 1;
	}
}
$ck_danhmuc_suachua_grid->RecordCount = $ck_danhmuc_suachua_grid->StartRecord - 1;
if ($ck_danhmuc_suachua_grid->Recordset && !$ck_danhmuc_suachua_grid->Recordset->EOF) {
	$ck_danhmuc_suachua_grid->Recordset->moveFirst();
	$selectLimit = $ck_danhmuc_suachua_grid->UseSelectLimit;
	if (!$selectLimit && $ck_danhmuc_suachua_grid->StartRecord > 1)
		$ck_danhmuc_suachua_grid->Recordset->move($ck_danhmuc_suachua_grid->StartRecord - 1);
} elseif (!$ck_danhmuc_suachua->AllowAddDeleteRow && $ck_danhmuc_suachua_grid->StopRecord == 0) {
	$ck_danhmuc_suachua_grid->StopRecord = $ck_danhmuc_suachua->GridAddRowCount;
}

// Initialize aggregate
$ck_danhmuc_suachua->RowType = ROWTYPE_AGGREGATEINIT;
$ck_danhmuc_suachua->resetAttributes();
$ck_danhmuc_suachua_grid->renderRow();
if ($ck_danhmuc_suachua_grid->isGridAdd())
	$ck_danhmuc_suachua_grid->RowIndex = 0;
if ($ck_danhmuc_suachua_grid->isGridEdit())
	$ck_danhmuc_suachua_grid->RowIndex = 0;
while ($ck_danhmuc_suachua_grid->RecordCount < $ck_danhmuc_suachua_grid->StopRecord) {
	$ck_danhmuc_suachua_grid->RecordCount++;
	if ($ck_danhmuc_suachua_grid->RecordCount >= $ck_danhmuc_suachua_grid->StartRecord) {
		$ck_danhmuc_suachua_grid->RowCount++;
		if ($ck_danhmuc_suachua_grid->isGridAdd() || $ck_danhmuc_suachua_grid->isGridEdit() || $ck_danhmuc_suachua->isConfirm()) {
			$ck_danhmuc_suachua_grid->RowIndex++;
			$CurrentForm->Index = $ck_danhmuc_suachua_grid->RowIndex;
			if ($CurrentForm->hasValue($ck_danhmuc_suachua_grid->FormActionName) && ($ck_danhmuc_suachua->isConfirm() || $ck_danhmuc_suachua_grid->EventCancelled))
				$ck_danhmuc_suachua_grid->RowAction = strval($CurrentForm->getValue($ck_danhmuc_suachua_grid->FormActionName));
			elseif ($ck_danhmuc_suachua_grid->isGridAdd())
				$ck_danhmuc_suachua_grid->RowAction = "insert";
			else
				$ck_danhmuc_suachua_grid->RowAction = "";
		}

		// Set up key count
		$ck_danhmuc_suachua_grid->KeyCount = $ck_danhmuc_suachua_grid->RowIndex;

		// Init row class and style
		$ck_danhmuc_suachua->resetAttributes();
		$ck_danhmuc_suachua->CssClass = "";
		if ($ck_danhmuc_suachua_grid->isGridAdd()) {
			if ($ck_danhmuc_suachua->CurrentMode == "copy") {
				$ck_danhmuc_suachua_grid->loadRowValues($ck_danhmuc_suachua_grid->Recordset); // Load row values
				$ck_danhmuc_suachua_grid->setRecordKey($ck_danhmuc_suachua_grid->RowOldKey, $ck_danhmuc_suachua_grid->Recordset); // Set old record key
			} else {
				$ck_danhmuc_suachua_grid->loadRowValues(); // Load default values
				$ck_danhmuc_suachua_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$ck_danhmuc_suachua_grid->loadRowValues($ck_danhmuc_suachua_grid->Recordset); // Load row values
		}
		$ck_danhmuc_suachua->RowType = ROWTYPE_VIEW; // Render view
		if ($ck_danhmuc_suachua_grid->isGridAdd()) // Grid add
			$ck_danhmuc_suachua->RowType = ROWTYPE_ADD; // Render add
		if ($ck_danhmuc_suachua_grid->isGridAdd() && $ck_danhmuc_suachua->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$ck_danhmuc_suachua_grid->restoreCurrentRowFormValues($ck_danhmuc_suachua_grid->RowIndex); // Restore form values
		if ($ck_danhmuc_suachua_grid->isGridEdit()) { // Grid edit
			if ($ck_danhmuc_suachua->EventCancelled)
				$ck_danhmuc_suachua_grid->restoreCurrentRowFormValues($ck_danhmuc_suachua_grid->RowIndex); // Restore form values
			if ($ck_danhmuc_suachua_grid->RowAction == "insert")
				$ck_danhmuc_suachua->RowType = ROWTYPE_ADD; // Render add
			else
				$ck_danhmuc_suachua->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($ck_danhmuc_suachua_grid->isGridEdit() && ($ck_danhmuc_suachua->RowType == ROWTYPE_EDIT || $ck_danhmuc_suachua->RowType == ROWTYPE_ADD) && $ck_danhmuc_suachua->EventCancelled) // Update failed
			$ck_danhmuc_suachua_grid->restoreCurrentRowFormValues($ck_danhmuc_suachua_grid->RowIndex); // Restore form values
		if ($ck_danhmuc_suachua->RowType == ROWTYPE_EDIT) // Edit row
			$ck_danhmuc_suachua_grid->EditRowCount++;
		if ($ck_danhmuc_suachua->isConfirm()) // Confirm row
			$ck_danhmuc_suachua_grid->restoreCurrentRowFormValues($ck_danhmuc_suachua_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$ck_danhmuc_suachua->RowAttrs->merge(["data-rowindex" => $ck_danhmuc_suachua_grid->RowCount, "id" => "r" . $ck_danhmuc_suachua_grid->RowCount . "_ck_danhmuc_suachua", "data-rowtype" => $ck_danhmuc_suachua->RowType]);

		// Render row
		$ck_danhmuc_suachua_grid->renderRow();

		// Render list options
		$ck_danhmuc_suachua_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($ck_danhmuc_suachua_grid->RowAction != "delete" && $ck_danhmuc_suachua_grid->RowAction != "insertdelete" && !($ck_danhmuc_suachua_grid->RowAction == "insert" && $ck_danhmuc_suachua->isConfirm() && $ck_danhmuc_suachua_grid->emptyRow())) {
?>
	<tr <?php echo $ck_danhmuc_suachua->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_danhmuc_suachua_grid->ListOptions->render("body", "left", $ck_danhmuc_suachua_grid->RowCount);
?>
	<?php if ($ck_danhmuc_suachua_grid->chuanloai_id->Visible) { // chuanloai_id ?>
		<td data-name="chuanloai_id" <?php echo $ck_danhmuc_suachua_grid->chuanloai_id->cellAttributes() ?>>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_chuanloai_id" class="form-group">
<?php $ck_danhmuc_suachua_grid->chuanloai_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_suachua" data-field="x_chuanloai_id" data-value-separator="<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id"<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->selectOptionListHtml("x{$ck_danhmuc_suachua_grid->RowIndex}_chuanloai_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->Lookup->getParamTag($ck_danhmuc_suachua_grid, "p_x" . $ck_danhmuc_suachua_grid->RowIndex . "_chuanloai_id") ?>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_chuanloai_id" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->chuanloai_id->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_chuanloai_id" class="form-group">
<?php $ck_danhmuc_suachua_grid->chuanloai_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_suachua" data-field="x_chuanloai_id" data-value-separator="<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id"<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->selectOptionListHtml("x{$ck_danhmuc_suachua_grid->RowIndex}_chuanloai_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->Lookup->getParamTag($ck_danhmuc_suachua_grid, "p_x" . $ck_danhmuc_suachua_grid->RowIndex . "_chuanloai_id") ?>
</span>
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_chuanloai_id">
<span<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_grid->chuanloai_id->getViewValue() ?></span>
</span>
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_chuanloai_id" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->chuanloai_id->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_chuanloai_id" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->chuanloai_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_chuanloai_id" name="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" id="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->chuanloai_id->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_chuanloai_id" name="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" id="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->chuanloai_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_sua_chua_id" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_sua_chua_id" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_sua_chua_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->sua_chua_id->CurrentValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_sua_chua_id" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_sua_chua_id" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_sua_chua_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->sua_chua_id->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_EDIT || $ck_danhmuc_suachua->CurrentMode == "edit") { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_sua_chua_id" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_sua_chua_id" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_sua_chua_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->sua_chua_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->thiet_bi_id->Visible) { // thiet_bi_id ?>
		<td data-name="thiet_bi_id" <?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->cellAttributes() ?>>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_thiet_bi_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_suachua" data-field="x_thiet_bi_id" data-value-separator="<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id"<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->selectOptionListHtml("x{$ck_danhmuc_suachua_grid->RowIndex}_thiet_bi_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->Lookup->getParamTag($ck_danhmuc_suachua_grid, "p_x" . $ck_danhmuc_suachua_grid->RowIndex . "_thiet_bi_id") ?>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_thiet_bi_id" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thiet_bi_id->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_thiet_bi_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_suachua" data-field="x_thiet_bi_id" data-value-separator="<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id"<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->selectOptionListHtml("x{$ck_danhmuc_suachua_grid->RowIndex}_thiet_bi_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->Lookup->getParamTag($ck_danhmuc_suachua_grid, "p_x" . $ck_danhmuc_suachua_grid->RowIndex . "_thiet_bi_id") ?>
</span>
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_thiet_bi_id">
<span<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->getViewValue() ?></span>
</span>
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_thiet_bi_id" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thiet_bi_id->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_thiet_bi_id" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thiet_bi_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_thiet_bi_id" name="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" id="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thiet_bi_id->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_thiet_bi_id" name="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" id="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thiet_bi_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td data-name="ngay_sua_chua" <?php echo $ck_danhmuc_suachua_grid->ngay_sua_chua->cellAttributes() ?>>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_ngay_sua_chua" class="form-group">
<input type="text" data-table="ck_danhmuc_suachua" data-field="x_ngay_sua_chua" data-format="14" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_suachua_grid->ngay_sua_chua->EditValue ?>"<?php echo $ck_danhmuc_suachua_grid->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_danhmuc_suachua_grid->ngay_sua_chua->ReadOnly && !$ck_danhmuc_suachua_grid->ngay_sua_chua->Disabled && !isset($ck_danhmuc_suachua_grid->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_danhmuc_suachua_grid->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_danhmuc_suachuagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_danhmuc_suachuagrid", "x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":14});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_ngay_sua_chua" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_sua_chua->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_ngay_sua_chua" class="form-group">
<input type="text" data-table="ck_danhmuc_suachua" data-field="x_ngay_sua_chua" data-format="14" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_suachua_grid->ngay_sua_chua->EditValue ?>"<?php echo $ck_danhmuc_suachua_grid->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_danhmuc_suachua_grid->ngay_sua_chua->ReadOnly && !$ck_danhmuc_suachua_grid->ngay_sua_chua->Disabled && !isset($ck_danhmuc_suachua_grid->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_danhmuc_suachua_grid->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_danhmuc_suachuagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_danhmuc_suachuagrid", "x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":14});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_ngay_sua_chua">
<span<?php echo $ck_danhmuc_suachua_grid->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_grid->ngay_sua_chua->getViewValue() ?></span>
</span>
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_ngay_sua_chua" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_sua_chua->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_ngay_sua_chua" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_sua_chua->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_ngay_sua_chua" name="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" id="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_sua_chua->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_ngay_sua_chua" name="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" id="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_sua_chua->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
		<td data-name="noi_dung_sua_chua" <?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->cellAttributes() ?>>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_noi_dung_sua_chua" class="form-group">
<textarea data-table="ck_danhmuc_suachua" data-field="x_noi_dung_sua_chua" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->noi_dung_sua_chua->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->editAttributes() ?>><?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->EditValue ?></textarea>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_noi_dung_sua_chua" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->noi_dung_sua_chua->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_noi_dung_sua_chua" class="form-group">
<textarea data-table="ck_danhmuc_suachua" data-field="x_noi_dung_sua_chua" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->noi_dung_sua_chua->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->editAttributes() ?>><?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_noi_dung_sua_chua">
<span<?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->getViewValue() ?></span>
</span>
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_noi_dung_sua_chua" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->noi_dung_sua_chua->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_noi_dung_sua_chua" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->noi_dung_sua_chua->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_noi_dung_sua_chua" name="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" id="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->noi_dung_sua_chua->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_noi_dung_sua_chua" name="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" id="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->noi_dung_sua_chua->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->Visible) { // thoi_gian_sua_chua ?>
		<td data-name="thoi_gian_sua_chua" <?php echo $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->cellAttributes() ?>>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_thoi_gian_sua_chua" class="form-group">
<input type="text" data-table="ck_danhmuc_suachua" data-field="x_thoi_gian_sua_chua" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->EditValue ?>"<?php echo $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->editAttributes() ?>>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_thoi_gian_sua_chua" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_thoi_gian_sua_chua" class="form-group">
<input type="text" data-table="ck_danhmuc_suachua" data-field="x_thoi_gian_sua_chua" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->EditValue ?>"<?php echo $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_thoi_gian_sua_chua">
<span<?php echo $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->getViewValue() ?></span>
</span>
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_thoi_gian_sua_chua" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_thoi_gian_sua_chua" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_thoi_gian_sua_chua" name="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" id="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_thoi_gian_sua_chua" name="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" id="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->Visible) { // nguoi_nhap_lieu ?>
		<td data-name="nguoi_nhap_lieu" <?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->cellAttributes() ?>>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_nguoi_nhap_lieu" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_suachua" data-field="x_nguoi_nhap_lieu" data-value-separator="<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu"<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->editAttributes() ?>>
			<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->selectOptionListHtml("x{$ck_danhmuc_suachua_grid->RowIndex}_nguoi_nhap_lieu") ?>
		</select>
</div>
<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->Lookup->getParamTag($ck_danhmuc_suachua_grid, "p_x" . $ck_danhmuc_suachua_grid->RowIndex . "_nguoi_nhap_lieu") ?>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_nguoi_nhap_lieu" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_nguoi_nhap_lieu" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_suachua" data-field="x_nguoi_nhap_lieu" data-value-separator="<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu"<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->editAttributes() ?>>
			<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->selectOptionListHtml("x{$ck_danhmuc_suachua_grid->RowIndex}_nguoi_nhap_lieu") ?>
		</select>
</div>
<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->Lookup->getParamTag($ck_danhmuc_suachua_grid, "p_x" . $ck_danhmuc_suachua_grid->RowIndex . "_nguoi_nhap_lieu") ?>
</span>
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_nguoi_nhap_lieu">
<span<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->getViewValue() ?></span>
</span>
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_nguoi_nhap_lieu" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_nguoi_nhap_lieu" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_nguoi_nhap_lieu" name="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" id="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_nguoi_nhap_lieu" name="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" id="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->dich_vu->Visible) { // dich_vu ?>
		<td data-name="dich_vu" <?php echo $ck_danhmuc_suachua_grid->dich_vu->cellAttributes() ?>>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_dich_vu" class="form-group">
<?php
$selwrk = ConvertToBool($ck_danhmuc_suachua_grid->dich_vu->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ck_danhmuc_suachua" data-field="x_dich_vu" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]_794614" value="1"<?php echo $selwrk ?><?php echo $ck_danhmuc_suachua_grid->dich_vu->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]_794614"></label>
</div>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_dich_vu" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->dich_vu->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_dich_vu" class="form-group">
<?php
$selwrk = ConvertToBool($ck_danhmuc_suachua_grid->dich_vu->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ck_danhmuc_suachua" data-field="x_dich_vu" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]_673127" value="1"<?php echo $selwrk ?><?php echo $ck_danhmuc_suachua_grid->dich_vu->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]_673127"></label>
</div>
</span>
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_dich_vu">
<span<?php echo $ck_danhmuc_suachua_grid->dich_vu->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_dich_vu" class="custom-control-input" value="<?php echo $ck_danhmuc_suachua_grid->dich_vu->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_danhmuc_suachua_grid->dich_vu->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_dich_vu"></label></div></span>
</span>
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_dich_vu" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->dich_vu->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_dich_vu" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->dich_vu->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_dich_vu" name="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu" id="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->dich_vu->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_dich_vu" name="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]" id="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->dich_vu->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->hoan_thanh->Visible) { // hoan_thanh ?>
		<td data-name="hoan_thanh" <?php echo $ck_danhmuc_suachua_grid->hoan_thanh->cellAttributes() ?>>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_hoan_thanh" class="form-group">
<?php
$selwrk = ConvertToBool($ck_danhmuc_suachua_grid->hoan_thanh->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ck_danhmuc_suachua" data-field="x_hoan_thanh" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]_893237" value="1"<?php echo $selwrk ?><?php echo $ck_danhmuc_suachua_grid->hoan_thanh->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]_893237"></label>
</div>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_hoan_thanh" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->hoan_thanh->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_hoan_thanh" class="form-group">
<?php
$selwrk = ConvertToBool($ck_danhmuc_suachua_grid->hoan_thanh->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ck_danhmuc_suachua" data-field="x_hoan_thanh" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]_244544" value="1"<?php echo $selwrk ?><?php echo $ck_danhmuc_suachua_grid->hoan_thanh->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]_244544"></label>
</div>
</span>
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_hoan_thanh">
<span<?php echo $ck_danhmuc_suachua_grid->hoan_thanh->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_hoan_thanh" class="custom-control-input" value="<?php echo $ck_danhmuc_suachua_grid->hoan_thanh->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_danhmuc_suachua_grid->hoan_thanh->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_hoan_thanh"></label></div></span>
</span>
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_hoan_thanh" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->hoan_thanh->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_hoan_thanh" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->hoan_thanh->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_hoan_thanh" name="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh" id="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->hoan_thanh->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_hoan_thanh" name="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]" id="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->hoan_thanh->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->id_don_hang->Visible) { // id_don_hang ?>
		<td data-name="id_don_hang" <?php echo $ck_danhmuc_suachua_grid->id_don_hang->cellAttributes() ?>>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($ck_danhmuc_suachua_grid->id_don_hang->getSessionValue() != "") { ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_id_don_hang" class="form-group">
<span<?php echo $ck_danhmuc_suachua_grid->id_don_hang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_suachua_grid->id_don_hang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_id_don_hang" class="form-group">
<?php
$onchange = $ck_danhmuc_suachua_grid->id_don_hang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_danhmuc_suachua_grid->id_don_hang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" id="sv_x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo RemoveHtml($ck_danhmuc_suachua_grid->id_don_hang->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_suachua_grid->id_don_hang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ck_danhmuc_suachua_grid->id_don_hang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($ck_danhmuc_suachua_grid->id_don_hang->ReadOnly || $ck_danhmuc_suachua_grid->id_don_hang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_id_don_hang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ck_danhmuc_suachua_grid->id_don_hang->displayValueSeparatorAttribute() ?>" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_danhmuc_suachuagrid"], function() {
	fck_danhmuc_suachuagrid.createAutoSuggest({"id":"x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang","forceSelect":false});
});
</script>
<?php echo $ck_danhmuc_suachua_grid->id_don_hang->Lookup->getParamTag($ck_danhmuc_suachua_grid, "p_x" . $ck_danhmuc_suachua_grid->RowIndex . "_id_don_hang") ?>
</span>
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_id_don_hang" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($ck_danhmuc_suachua_grid->id_don_hang->getSessionValue() != "") { ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_id_don_hang" class="form-group">
<span<?php echo $ck_danhmuc_suachua_grid->id_don_hang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_suachua_grid->id_don_hang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_id_don_hang" class="form-group">
<?php
$onchange = $ck_danhmuc_suachua_grid->id_don_hang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_danhmuc_suachua_grid->id_don_hang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" id="sv_x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo RemoveHtml($ck_danhmuc_suachua_grid->id_don_hang->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_suachua_grid->id_don_hang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ck_danhmuc_suachua_grid->id_don_hang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($ck_danhmuc_suachua_grid->id_don_hang->ReadOnly || $ck_danhmuc_suachua_grid->id_don_hang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_id_don_hang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ck_danhmuc_suachua_grid->id_don_hang->displayValueSeparatorAttribute() ?>" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_danhmuc_suachuagrid"], function() {
	fck_danhmuc_suachuagrid.createAutoSuggest({"id":"x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang","forceSelect":false});
});
</script>
<?php echo $ck_danhmuc_suachua_grid->id_don_hang->Lookup->getParamTag($ck_danhmuc_suachua_grid, "p_x" . $ck_danhmuc_suachua_grid->RowIndex . "_id_don_hang") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_id_don_hang">
<span<?php echo $ck_danhmuc_suachua_grid->id_don_hang->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_grid->id_don_hang->getViewValue() ?></span>
</span>
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_id_don_hang" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_id_don_hang" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_id_don_hang" name="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" id="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_id_don_hang" name="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" id="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->ngay_hoan_thanh->Visible) { // ngay_hoan_thanh ?>
		<td data-name="ngay_hoan_thanh" <?php echo $ck_danhmuc_suachua_grid->ngay_hoan_thanh->cellAttributes() ?>>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_ngay_hoan_thanh" class="form-group">
<input type="text" data-table="ck_danhmuc_suachua" data-field="x_ngay_hoan_thanh" data-format="7" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" maxlength="10" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_hoan_thanh->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_suachua_grid->ngay_hoan_thanh->EditValue ?>"<?php echo $ck_danhmuc_suachua_grid->ngay_hoan_thanh->editAttributes() ?>>
<?php if (!$ck_danhmuc_suachua_grid->ngay_hoan_thanh->ReadOnly && !$ck_danhmuc_suachua_grid->ngay_hoan_thanh->Disabled && !isset($ck_danhmuc_suachua_grid->ngay_hoan_thanh->EditAttrs["readonly"]) && !isset($ck_danhmuc_suachua_grid->ngay_hoan_thanh->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_danhmuc_suachuagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_danhmuc_suachuagrid", "x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_ngay_hoan_thanh" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_hoan_thanh->OldValue) ?>">
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_ngay_hoan_thanh" class="form-group">
<input type="text" data-table="ck_danhmuc_suachua" data-field="x_ngay_hoan_thanh" data-format="7" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" maxlength="10" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_hoan_thanh->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_suachua_grid->ngay_hoan_thanh->EditValue ?>"<?php echo $ck_danhmuc_suachua_grid->ngay_hoan_thanh->editAttributes() ?>>
<?php if (!$ck_danhmuc_suachua_grid->ngay_hoan_thanh->ReadOnly && !$ck_danhmuc_suachua_grid->ngay_hoan_thanh->Disabled && !isset($ck_danhmuc_suachua_grid->ngay_hoan_thanh->EditAttrs["readonly"]) && !isset($ck_danhmuc_suachua_grid->ngay_hoan_thanh->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_danhmuc_suachuagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_danhmuc_suachuagrid", "x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ck_danhmuc_suachua_grid->RowCount ?>_ck_danhmuc_suachua_ngay_hoan_thanh">
<span<?php echo $ck_danhmuc_suachua_grid->ngay_hoan_thanh->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_grid->ngay_hoan_thanh->getViewValue() ?></span>
</span>
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_ngay_hoan_thanh" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_hoan_thanh->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_ngay_hoan_thanh" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_hoan_thanh->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_ngay_hoan_thanh" name="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" id="fck_danhmuc_suachuagrid$x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_hoan_thanh->FormValue) ?>">
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_ngay_hoan_thanh" name="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" id="fck_danhmuc_suachuagrid$o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_hoan_thanh->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_danhmuc_suachua_grid->ListOptions->render("body", "right", $ck_danhmuc_suachua_grid->RowCount);
?>
	</tr>
<?php if ($ck_danhmuc_suachua->RowType == ROWTYPE_ADD || $ck_danhmuc_suachua->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fck_danhmuc_suachuagrid", "load"], function() {
	fck_danhmuc_suachuagrid.updateLists(<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$ck_danhmuc_suachua_grid->isGridAdd() || $ck_danhmuc_suachua->CurrentMode == "copy")
		if (!$ck_danhmuc_suachua_grid->Recordset->EOF)
			$ck_danhmuc_suachua_grid->Recordset->moveNext();
}
?>
<?php
	if ($ck_danhmuc_suachua->CurrentMode == "add" || $ck_danhmuc_suachua->CurrentMode == "copy" || $ck_danhmuc_suachua->CurrentMode == "edit") {
		$ck_danhmuc_suachua_grid->RowIndex = '$rowindex$';
		$ck_danhmuc_suachua_grid->loadRowValues();

		// Set row properties
		$ck_danhmuc_suachua->resetAttributes();
		$ck_danhmuc_suachua->RowAttrs->merge(["data-rowindex" => $ck_danhmuc_suachua_grid->RowIndex, "id" => "r0_ck_danhmuc_suachua", "data-rowtype" => ROWTYPE_ADD]);
		$ck_danhmuc_suachua->RowAttrs->appendClass("ew-template");
		$ck_danhmuc_suachua->RowType = ROWTYPE_ADD;

		// Render row
		$ck_danhmuc_suachua_grid->renderRow();

		// Render list options
		$ck_danhmuc_suachua_grid->renderListOptions();
		$ck_danhmuc_suachua_grid->StartRowCount = 0;
?>
	<tr <?php echo $ck_danhmuc_suachua->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ck_danhmuc_suachua_grid->ListOptions->render("body", "left", $ck_danhmuc_suachua_grid->RowIndex);
?>
	<?php if ($ck_danhmuc_suachua_grid->chuanloai_id->Visible) { // chuanloai_id ?>
		<td data-name="chuanloai_id">
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_chuanloai_id" class="form-group ck_danhmuc_suachua_chuanloai_id">
<?php $ck_danhmuc_suachua_grid->chuanloai_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_suachua" data-field="x_chuanloai_id" data-value-separator="<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id"<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->selectOptionListHtml("x{$ck_danhmuc_suachua_grid->RowIndex}_chuanloai_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->Lookup->getParamTag($ck_danhmuc_suachua_grid, "p_x" . $ck_danhmuc_suachua_grid->RowIndex . "_chuanloai_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_chuanloai_id" class="form-group ck_danhmuc_suachua_chuanloai_id">
<span<?php echo $ck_danhmuc_suachua_grid->chuanloai_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_suachua_grid->chuanloai_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_chuanloai_id" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->chuanloai_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_chuanloai_id" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_chuanloai_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->chuanloai_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->thiet_bi_id->Visible) { // thiet_bi_id ?>
		<td data-name="thiet_bi_id">
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_thiet_bi_id" class="form-group ck_danhmuc_suachua_thiet_bi_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_suachua" data-field="x_thiet_bi_id" data-value-separator="<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id"<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->selectOptionListHtml("x{$ck_danhmuc_suachua_grid->RowIndex}_thiet_bi_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->Lookup->getParamTag($ck_danhmuc_suachua_grid, "p_x" . $ck_danhmuc_suachua_grid->RowIndex . "_thiet_bi_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_thiet_bi_id" class="form-group ck_danhmuc_suachua_thiet_bi_id">
<span<?php echo $ck_danhmuc_suachua_grid->thiet_bi_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_suachua_grid->thiet_bi_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_thiet_bi_id" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thiet_bi_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_thiet_bi_id" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thiet_bi_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thiet_bi_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<td data-name="ngay_sua_chua">
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_ngay_sua_chua" class="form-group ck_danhmuc_suachua_ngay_sua_chua">
<input type="text" data-table="ck_danhmuc_suachua" data-field="x_ngay_sua_chua" data-format="14" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_suachua_grid->ngay_sua_chua->EditValue ?>"<?php echo $ck_danhmuc_suachua_grid->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_danhmuc_suachua_grid->ngay_sua_chua->ReadOnly && !$ck_danhmuc_suachua_grid->ngay_sua_chua->Disabled && !isset($ck_danhmuc_suachua_grid->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_danhmuc_suachua_grid->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_danhmuc_suachuagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_danhmuc_suachuagrid", "x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":14});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_ngay_sua_chua" class="form-group ck_danhmuc_suachua_ngay_sua_chua">
<span<?php echo $ck_danhmuc_suachua_grid->ngay_sua_chua->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_suachua_grid->ngay_sua_chua->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_ngay_sua_chua" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_sua_chua->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_ngay_sua_chua" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_sua_chua->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
		<td data-name="noi_dung_sua_chua">
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_noi_dung_sua_chua" class="form-group ck_danhmuc_suachua_noi_dung_sua_chua">
<textarea data-table="ck_danhmuc_suachua" data-field="x_noi_dung_sua_chua" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->noi_dung_sua_chua->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->editAttributes() ?>><?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_noi_dung_sua_chua" class="form-group ck_danhmuc_suachua_noi_dung_sua_chua">
<span<?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua_grid->noi_dung_sua_chua->ViewValue ?></span>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_noi_dung_sua_chua" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->noi_dung_sua_chua->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_noi_dung_sua_chua" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_noi_dung_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->noi_dung_sua_chua->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->Visible) { // thoi_gian_sua_chua ?>
		<td data-name="thoi_gian_sua_chua">
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_thoi_gian_sua_chua" class="form-group ck_danhmuc_suachua_thoi_gian_sua_chua">
<input type="text" data-table="ck_danhmuc_suachua" data-field="x_thoi_gian_sua_chua" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->EditValue ?>"<?php echo $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_thoi_gian_sua_chua" class="form-group ck_danhmuc_suachua_thoi_gian_sua_chua">
<span<?php echo $ck_danhmuc_suachua_grid->thoi_gian_sua_chua->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_thoi_gian_sua_chua" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_thoi_gian_sua_chua" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_thoi_gian_sua_chua" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->thoi_gian_sua_chua->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->Visible) { // nguoi_nhap_lieu ?>
		<td data-name="nguoi_nhap_lieu">
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_nguoi_nhap_lieu" class="form-group ck_danhmuc_suachua_nguoi_nhap_lieu">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_suachua" data-field="x_nguoi_nhap_lieu" data-value-separator="<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->displayValueSeparatorAttribute() ?>" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu"<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->editAttributes() ?>>
			<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->selectOptionListHtml("x{$ck_danhmuc_suachua_grid->RowIndex}_nguoi_nhap_lieu") ?>
		</select>
</div>
<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->Lookup->getParamTag($ck_danhmuc_suachua_grid, "p_x" . $ck_danhmuc_suachua_grid->RowIndex . "_nguoi_nhap_lieu") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_nguoi_nhap_lieu" class="form-group ck_danhmuc_suachua_nguoi_nhap_lieu">
<span<?php echo $ck_danhmuc_suachua_grid->nguoi_nhap_lieu->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_nguoi_nhap_lieu" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_nguoi_nhap_lieu" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_nguoi_nhap_lieu" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->nguoi_nhap_lieu->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->dich_vu->Visible) { // dich_vu ?>
		<td data-name="dich_vu">
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_dich_vu" class="form-group ck_danhmuc_suachua_dich_vu">
<?php
$selwrk = ConvertToBool($ck_danhmuc_suachua_grid->dich_vu->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ck_danhmuc_suachua" data-field="x_dich_vu" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]_912962" value="1"<?php echo $selwrk ?><?php echo $ck_danhmuc_suachua_grid->dich_vu->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]_912962"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_dich_vu" class="form-group ck_danhmuc_suachua_dich_vu">
<span<?php echo $ck_danhmuc_suachua_grid->dich_vu->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_dich_vu" class="custom-control-input" value="<?php echo $ck_danhmuc_suachua_grid->dich_vu->ViewValue ?>" disabled<?php if (ConvertToBool($ck_danhmuc_suachua_grid->dich_vu->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_dich_vu"></label></div></span>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_dich_vu" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->dich_vu->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_dich_vu" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_dich_vu[]" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->dich_vu->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->hoan_thanh->Visible) { // hoan_thanh ?>
		<td data-name="hoan_thanh">
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_hoan_thanh" class="form-group ck_danhmuc_suachua_hoan_thanh">
<?php
$selwrk = ConvertToBool($ck_danhmuc_suachua_grid->hoan_thanh->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ck_danhmuc_suachua" data-field="x_hoan_thanh" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]_500204" value="1"<?php echo $selwrk ?><?php echo $ck_danhmuc_suachua_grid->hoan_thanh->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]_500204"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_hoan_thanh" class="form-group ck_danhmuc_suachua_hoan_thanh">
<span<?php echo $ck_danhmuc_suachua_grid->hoan_thanh->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_hoan_thanh" class="custom-control-input" value="<?php echo $ck_danhmuc_suachua_grid->hoan_thanh->ViewValue ?>" disabled<?php if (ConvertToBool($ck_danhmuc_suachua_grid->hoan_thanh->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_hoan_thanh"></label></div></span>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_hoan_thanh" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->hoan_thanh->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_hoan_thanh" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_hoan_thanh[]" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->hoan_thanh->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->id_don_hang->Visible) { // id_don_hang ?>
		<td data-name="id_don_hang">
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<?php if ($ck_danhmuc_suachua_grid->id_don_hang->getSessionValue() != "") { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_id_don_hang" class="form-group ck_danhmuc_suachua_id_don_hang">
<span<?php echo $ck_danhmuc_suachua_grid->id_don_hang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_suachua_grid->id_don_hang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_id_don_hang" class="form-group ck_danhmuc_suachua_id_don_hang">
<?php
$onchange = $ck_danhmuc_suachua_grid->id_don_hang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_danhmuc_suachua_grid->id_don_hang->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" id="sv_x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo RemoveHtml($ck_danhmuc_suachua_grid->id_don_hang->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_suachua_grid->id_don_hang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ck_danhmuc_suachua_grid->id_don_hang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($ck_danhmuc_suachua_grid->id_don_hang->ReadOnly || $ck_danhmuc_suachua_grid->id_don_hang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_id_don_hang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ck_danhmuc_suachua_grid->id_don_hang->displayValueSeparatorAttribute() ?>" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_danhmuc_suachuagrid"], function() {
	fck_danhmuc_suachuagrid.createAutoSuggest({"id":"x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang","forceSelect":false});
});
</script>
<?php echo $ck_danhmuc_suachua_grid->id_don_hang->Lookup->getParamTag($ck_danhmuc_suachua_grid, "p_x" . $ck_danhmuc_suachua_grid->RowIndex . "_id_don_hang") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_id_don_hang" class="form-group ck_danhmuc_suachua_id_don_hang">
<span<?php echo $ck_danhmuc_suachua_grid->id_don_hang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_suachua_grid->id_don_hang->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_id_don_hang" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_id_don_hang" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->id_don_hang->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ck_danhmuc_suachua_grid->ngay_hoan_thanh->Visible) { // ngay_hoan_thanh ?>
		<td data-name="ngay_hoan_thanh">
<?php if (!$ck_danhmuc_suachua->isConfirm()) { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_ngay_hoan_thanh" class="form-group ck_danhmuc_suachua_ngay_hoan_thanh">
<input type="text" data-table="ck_danhmuc_suachua" data-field="x_ngay_hoan_thanh" data-format="7" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" maxlength="10" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_hoan_thanh->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_suachua_grid->ngay_hoan_thanh->EditValue ?>"<?php echo $ck_danhmuc_suachua_grid->ngay_hoan_thanh->editAttributes() ?>>
<?php if (!$ck_danhmuc_suachua_grid->ngay_hoan_thanh->ReadOnly && !$ck_danhmuc_suachua_grid->ngay_hoan_thanh->Disabled && !isset($ck_danhmuc_suachua_grid->ngay_hoan_thanh->EditAttrs["readonly"]) && !isset($ck_danhmuc_suachua_grid->ngay_hoan_thanh->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_danhmuc_suachuagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_danhmuc_suachuagrid", "x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ck_danhmuc_suachua_ngay_hoan_thanh" class="form-group ck_danhmuc_suachua_ngay_hoan_thanh">
<span<?php echo $ck_danhmuc_suachua_grid->ngay_hoan_thanh->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_suachua_grid->ngay_hoan_thanh->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_ngay_hoan_thanh" name="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" id="x<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_hoan_thanh->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_ngay_hoan_thanh" name="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" id="o<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>_ngay_hoan_thanh" value="<?php echo HtmlEncode($ck_danhmuc_suachua_grid->ngay_hoan_thanh->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ck_danhmuc_suachua_grid->ListOptions->render("body", "right", $ck_danhmuc_suachua_grid->RowIndex);
?>
<script>
loadjs.ready(["fck_danhmuc_suachuagrid", "load"], function() {
	fck_danhmuc_suachuagrid.updateLists(<?php echo $ck_danhmuc_suachua_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($ck_danhmuc_suachua->CurrentMode == "add" || $ck_danhmuc_suachua->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $ck_danhmuc_suachua_grid->FormKeyCountName ?>" id="<?php echo $ck_danhmuc_suachua_grid->FormKeyCountName ?>" value="<?php echo $ck_danhmuc_suachua_grid->KeyCount ?>">
<?php echo $ck_danhmuc_suachua_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $ck_danhmuc_suachua_grid->FormKeyCountName ?>" id="<?php echo $ck_danhmuc_suachua_grid->FormKeyCountName ?>" value="<?php echo $ck_danhmuc_suachua_grid->KeyCount ?>">
<?php echo $ck_danhmuc_suachua_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ck_danhmuc_suachua->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fck_danhmuc_suachuagrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ck_danhmuc_suachua_grid->Recordset)
	$ck_danhmuc_suachua_grid->Recordset->Close();
?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ck_danhmuc_suachua_grid->TotalRecords == 0 && !$ck_danhmuc_suachua->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ck_danhmuc_suachua_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$ck_danhmuc_suachua_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");
	//$("#x_thiet_bi_id").on("change, blur", function(){this.form.submit();});

});
</script>
<?php } ?>
<?php
$ck_danhmuc_suachua_grid->terminate();
?>