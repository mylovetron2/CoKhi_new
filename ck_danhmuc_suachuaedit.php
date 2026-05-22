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
$ck_danhmuc_suachua_edit = new ck_danhmuc_suachua_edit();

// Run the page
$ck_danhmuc_suachua_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_danhmuc_suachua_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fck_danhmuc_suachuaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fck_danhmuc_suachuaedit = currentForm = new ew.Form("fck_danhmuc_suachuaedit", "edit");

	// Validate form
	fck_danhmuc_suachuaedit.validate = function() {
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
			<?php if ($ck_danhmuc_suachua_edit->sua_chua_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sua_chua_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_edit->sua_chua_id->caption(), $ck_danhmuc_suachua_edit->sua_chua_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sua_chua_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_danhmuc_suachua_edit->sua_chua_id->errorMessage()) ?>");
			<?php if ($ck_danhmuc_suachua_edit->chuanloai_id->Required) { ?>
				elm = this.getElements("x" + infix + "_chuanloai_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_edit->chuanloai_id->caption(), $ck_danhmuc_suachua_edit->chuanloai_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_edit->thiet_bi_id->Required) { ?>
				elm = this.getElements("x" + infix + "_thiet_bi_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_edit->thiet_bi_id->caption(), $ck_danhmuc_suachua_edit->thiet_bi_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_edit->ngay_sua_chua->Required) { ?>
				elm = this.getElements("x" + infix + "_ngay_sua_chua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_edit->ngay_sua_chua->caption(), $ck_danhmuc_suachua_edit->ngay_sua_chua->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ngay_sua_chua");
				if (elm && !ew.checkShortEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_danhmuc_suachua_edit->ngay_sua_chua->errorMessage()) ?>");
			<?php if ($ck_danhmuc_suachua_edit->noi_dung_sua_chua->Required) { ?>
				elm = this.getElements("x" + infix + "_noi_dung_sua_chua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_edit->noi_dung_sua_chua->caption(), $ck_danhmuc_suachua_edit->noi_dung_sua_chua->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_edit->thoi_gian_sua_chua->Required) { ?>
				elm = this.getElements("x" + infix + "_thoi_gian_sua_chua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_edit->thoi_gian_sua_chua->caption(), $ck_danhmuc_suachua_edit->thoi_gian_sua_chua->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_thoi_gian_sua_chua");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_danhmuc_suachua_edit->thoi_gian_sua_chua->errorMessage()) ?>");
			<?php if ($ck_danhmuc_suachua_edit->nguoi_nhap_lieu->Required) { ?>
				elm = this.getElements("x" + infix + "_nguoi_nhap_lieu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_edit->nguoi_nhap_lieu->caption(), $ck_danhmuc_suachua_edit->nguoi_nhap_lieu->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_edit->dich_vu->Required) { ?>
				elm = this.getElements("x" + infix + "_dich_vu[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_edit->dich_vu->caption(), $ck_danhmuc_suachua_edit->dich_vu->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_edit->hoan_thanh->Required) { ?>
				elm = this.getElements("x" + infix + "_hoan_thanh[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_edit->hoan_thanh->caption(), $ck_danhmuc_suachua_edit->hoan_thanh->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_edit->ghi_chu->Required) { ?>
				elm = this.getElements("x" + infix + "_ghi_chu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_edit->ghi_chu->caption(), $ck_danhmuc_suachua_edit->ghi_chu->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_edit->id_don_hang->Required) { ?>
				elm = this.getElements("x" + infix + "_id_don_hang");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_edit->id_don_hang->caption(), $ck_danhmuc_suachua_edit->id_don_hang->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_suachua_edit->ngay_hoan_thanh->Required) { ?>
				elm = this.getElements("x" + infix + "_ngay_hoan_thanh");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_suachua_edit->ngay_hoan_thanh->caption(), $ck_danhmuc_suachua_edit->ngay_hoan_thanh->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ngay_hoan_thanh");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_danhmuc_suachua_edit->ngay_hoan_thanh->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fck_danhmuc_suachuaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fck_danhmuc_suachuaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fck_danhmuc_suachuaedit.lists["x_chuanloai_id"] = <?php echo $ck_danhmuc_suachua_edit->chuanloai_id->Lookup->toClientList($ck_danhmuc_suachua_edit) ?>;
	fck_danhmuc_suachuaedit.lists["x_chuanloai_id"].options = <?php echo JsonEncode($ck_danhmuc_suachua_edit->chuanloai_id->lookupOptions()) ?>;
	fck_danhmuc_suachuaedit.lists["x_thiet_bi_id"] = <?php echo $ck_danhmuc_suachua_edit->thiet_bi_id->Lookup->toClientList($ck_danhmuc_suachua_edit) ?>;
	fck_danhmuc_suachuaedit.lists["x_thiet_bi_id"].options = <?php echo JsonEncode($ck_danhmuc_suachua_edit->thiet_bi_id->lookupOptions()) ?>;
	fck_danhmuc_suachuaedit.lists["x_nguoi_nhap_lieu"] = <?php echo $ck_danhmuc_suachua_edit->nguoi_nhap_lieu->Lookup->toClientList($ck_danhmuc_suachua_edit) ?>;
	fck_danhmuc_suachuaedit.lists["x_nguoi_nhap_lieu"].options = <?php echo JsonEncode($ck_danhmuc_suachua_edit->nguoi_nhap_lieu->lookupOptions()) ?>;
	fck_danhmuc_suachuaedit.lists["x_dich_vu[]"] = <?php echo $ck_danhmuc_suachua_edit->dich_vu->Lookup->toClientList($ck_danhmuc_suachua_edit) ?>;
	fck_danhmuc_suachuaedit.lists["x_dich_vu[]"].options = <?php echo JsonEncode($ck_danhmuc_suachua_edit->dich_vu->options(FALSE, TRUE)) ?>;
	fck_danhmuc_suachuaedit.lists["x_hoan_thanh[]"] = <?php echo $ck_danhmuc_suachua_edit->hoan_thanh->Lookup->toClientList($ck_danhmuc_suachua_edit) ?>;
	fck_danhmuc_suachuaedit.lists["x_hoan_thanh[]"].options = <?php echo JsonEncode($ck_danhmuc_suachua_edit->hoan_thanh->options(FALSE, TRUE)) ?>;
	fck_danhmuc_suachuaedit.lists["x_id_don_hang"] = <?php echo $ck_danhmuc_suachua_edit->id_don_hang->Lookup->toClientList($ck_danhmuc_suachua_edit) ?>;
	fck_danhmuc_suachuaedit.lists["x_id_don_hang"].options = <?php echo JsonEncode($ck_danhmuc_suachua_edit->id_don_hang->lookupOptions()) ?>;
	fck_danhmuc_suachuaedit.autoSuggests["x_id_don_hang"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fck_danhmuc_suachuaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ck_danhmuc_suachua_edit->showPageHeader(); ?>
<?php
$ck_danhmuc_suachua_edit->showMessage();
?>
<form name="fck_danhmuc_suachuaedit" id="fck_danhmuc_suachuaedit" class="<?php echo $ck_danhmuc_suachua_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_danhmuc_suachua">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ck_danhmuc_suachua_edit->IsModal ?>">
<?php if ($ck_danhmuc_suachua->getCurrentMasterTable() == "ck_don_hang") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="ck_don_hang">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_edit->id_don_hang->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($ck_danhmuc_suachua_edit->sua_chua_id->Visible) { // sua_chua_id ?>
	<div id="r_sua_chua_id" class="form-group row">
		<label id="elh_ck_danhmuc_suachua_sua_chua_id" for="x_sua_chua_id" class="<?php echo $ck_danhmuc_suachua_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_suachua_edit->sua_chua_id->caption() ?><?php echo $ck_danhmuc_suachua_edit->sua_chua_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_suachua_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_suachua_edit->sua_chua_id->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_sua_chua_id">
<span<?php echo $ck_danhmuc_suachua_edit->sua_chua_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_suachua_edit->sua_chua_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_sua_chua_id" name="x_sua_chua_id" id="x_sua_chua_id" value="<?php echo HtmlEncode($ck_danhmuc_suachua_edit->sua_chua_id->CurrentValue) ?>">
<?php echo $ck_danhmuc_suachua_edit->sua_chua_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_suachua_edit->chuanloai_id->Visible) { // chuanloai_id ?>
	<div id="r_chuanloai_id" class="form-group row">
		<label id="elh_ck_danhmuc_suachua_chuanloai_id" for="x_chuanloai_id" class="<?php echo $ck_danhmuc_suachua_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_suachua_edit->chuanloai_id->caption() ?><?php echo $ck_danhmuc_suachua_edit->chuanloai_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_suachua_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_suachua_edit->chuanloai_id->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_chuanloai_id">
<?php $ck_danhmuc_suachua_edit->chuanloai_id->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_suachua" data-field="x_chuanloai_id" data-value-separator="<?php echo $ck_danhmuc_suachua_edit->chuanloai_id->displayValueSeparatorAttribute() ?>" id="x_chuanloai_id" name="x_chuanloai_id"<?php echo $ck_danhmuc_suachua_edit->chuanloai_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_suachua_edit->chuanloai_id->selectOptionListHtml("x_chuanloai_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_suachua_edit->chuanloai_id->Lookup->getParamTag($ck_danhmuc_suachua_edit, "p_x_chuanloai_id") ?>
</span>
<?php echo $ck_danhmuc_suachua_edit->chuanloai_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_suachua_edit->thiet_bi_id->Visible) { // thiet_bi_id ?>
	<div id="r_thiet_bi_id" class="form-group row">
		<label id="elh_ck_danhmuc_suachua_thiet_bi_id" for="x_thiet_bi_id" class="<?php echo $ck_danhmuc_suachua_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_suachua_edit->thiet_bi_id->caption() ?><?php echo $ck_danhmuc_suachua_edit->thiet_bi_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_suachua_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_suachua_edit->thiet_bi_id->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_thiet_bi_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_suachua" data-field="x_thiet_bi_id" data-value-separator="<?php echo $ck_danhmuc_suachua_edit->thiet_bi_id->displayValueSeparatorAttribute() ?>" id="x_thiet_bi_id" name="x_thiet_bi_id"<?php echo $ck_danhmuc_suachua_edit->thiet_bi_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_suachua_edit->thiet_bi_id->selectOptionListHtml("x_thiet_bi_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_suachua_edit->thiet_bi_id->Lookup->getParamTag($ck_danhmuc_suachua_edit, "p_x_thiet_bi_id") ?>
</span>
<?php echo $ck_danhmuc_suachua_edit->thiet_bi_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_suachua_edit->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<div id="r_ngay_sua_chua" class="form-group row">
		<label id="elh_ck_danhmuc_suachua_ngay_sua_chua" for="x_ngay_sua_chua" class="<?php echo $ck_danhmuc_suachua_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_suachua_edit->ngay_sua_chua->caption() ?><?php echo $ck_danhmuc_suachua_edit->ngay_sua_chua->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_suachua_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_suachua_edit->ngay_sua_chua->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_ngay_sua_chua">
<input type="text" data-table="ck_danhmuc_suachua" data-field="x_ngay_sua_chua" data-format="14" name="x_ngay_sua_chua" id="x_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_edit->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_suachua_edit->ngay_sua_chua->EditValue ?>"<?php echo $ck_danhmuc_suachua_edit->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_danhmuc_suachua_edit->ngay_sua_chua->ReadOnly && !$ck_danhmuc_suachua_edit->ngay_sua_chua->Disabled && !isset($ck_danhmuc_suachua_edit->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_danhmuc_suachua_edit->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_danhmuc_suachuaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_danhmuc_suachuaedit", "x_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":14});
});
</script>
<?php } ?>
</span>
<?php echo $ck_danhmuc_suachua_edit->ngay_sua_chua->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_suachua_edit->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
	<div id="r_noi_dung_sua_chua" class="form-group row">
		<label id="elh_ck_danhmuc_suachua_noi_dung_sua_chua" for="x_noi_dung_sua_chua" class="<?php echo $ck_danhmuc_suachua_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_suachua_edit->noi_dung_sua_chua->caption() ?><?php echo $ck_danhmuc_suachua_edit->noi_dung_sua_chua->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_suachua_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_suachua_edit->noi_dung_sua_chua->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_noi_dung_sua_chua">
<textarea data-table="ck_danhmuc_suachua" data-field="x_noi_dung_sua_chua" name="x_noi_dung_sua_chua" id="x_noi_dung_sua_chua" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_edit->noi_dung_sua_chua->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_suachua_edit->noi_dung_sua_chua->editAttributes() ?>><?php echo $ck_danhmuc_suachua_edit->noi_dung_sua_chua->EditValue ?></textarea>
</span>
<?php echo $ck_danhmuc_suachua_edit->noi_dung_sua_chua->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_suachua_edit->thoi_gian_sua_chua->Visible) { // thoi_gian_sua_chua ?>
	<div id="r_thoi_gian_sua_chua" class="form-group row">
		<label id="elh_ck_danhmuc_suachua_thoi_gian_sua_chua" for="x_thoi_gian_sua_chua" class="<?php echo $ck_danhmuc_suachua_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_suachua_edit->thoi_gian_sua_chua->caption() ?><?php echo $ck_danhmuc_suachua_edit->thoi_gian_sua_chua->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_suachua_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_suachua_edit->thoi_gian_sua_chua->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_thoi_gian_sua_chua">
<input type="text" data-table="ck_danhmuc_suachua" data-field="x_thoi_gian_sua_chua" name="x_thoi_gian_sua_chua" id="x_thoi_gian_sua_chua" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_edit->thoi_gian_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_suachua_edit->thoi_gian_sua_chua->EditValue ?>"<?php echo $ck_danhmuc_suachua_edit->thoi_gian_sua_chua->editAttributes() ?>>
</span>
<?php echo $ck_danhmuc_suachua_edit->thoi_gian_sua_chua->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_suachua_edit->nguoi_nhap_lieu->Visible) { // nguoi_nhap_lieu ?>
	<div id="r_nguoi_nhap_lieu" class="form-group row">
		<label id="elh_ck_danhmuc_suachua_nguoi_nhap_lieu" for="x_nguoi_nhap_lieu" class="<?php echo $ck_danhmuc_suachua_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_suachua_edit->nguoi_nhap_lieu->caption() ?><?php echo $ck_danhmuc_suachua_edit->nguoi_nhap_lieu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_suachua_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_suachua_edit->nguoi_nhap_lieu->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_nguoi_nhap_lieu">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_suachua" data-field="x_nguoi_nhap_lieu" data-value-separator="<?php echo $ck_danhmuc_suachua_edit->nguoi_nhap_lieu->displayValueSeparatorAttribute() ?>" id="x_nguoi_nhap_lieu" name="x_nguoi_nhap_lieu"<?php echo $ck_danhmuc_suachua_edit->nguoi_nhap_lieu->editAttributes() ?>>
			<?php echo $ck_danhmuc_suachua_edit->nguoi_nhap_lieu->selectOptionListHtml("x_nguoi_nhap_lieu") ?>
		</select>
</div>
<?php echo $ck_danhmuc_suachua_edit->nguoi_nhap_lieu->Lookup->getParamTag($ck_danhmuc_suachua_edit, "p_x_nguoi_nhap_lieu") ?>
</span>
<?php echo $ck_danhmuc_suachua_edit->nguoi_nhap_lieu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_suachua_edit->dich_vu->Visible) { // dich_vu ?>
	<div id="r_dich_vu" class="form-group row">
		<label id="elh_ck_danhmuc_suachua_dich_vu" class="<?php echo $ck_danhmuc_suachua_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_suachua_edit->dich_vu->caption() ?><?php echo $ck_danhmuc_suachua_edit->dich_vu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_suachua_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_suachua_edit->dich_vu->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_dich_vu">
<?php
$selwrk = ConvertToBool($ck_danhmuc_suachua_edit->dich_vu->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ck_danhmuc_suachua" data-field="x_dich_vu" name="x_dich_vu[]" id="x_dich_vu[]_364882" value="1"<?php echo $selwrk ?><?php echo $ck_danhmuc_suachua_edit->dich_vu->editAttributes() ?>>
	<label class="custom-control-label" for="x_dich_vu[]_364882"></label>
</div>
</span>
<?php echo $ck_danhmuc_suachua_edit->dich_vu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_suachua_edit->hoan_thanh->Visible) { // hoan_thanh ?>
	<div id="r_hoan_thanh" class="form-group row">
		<label id="elh_ck_danhmuc_suachua_hoan_thanh" class="<?php echo $ck_danhmuc_suachua_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_suachua_edit->hoan_thanh->caption() ?><?php echo $ck_danhmuc_suachua_edit->hoan_thanh->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_suachua_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_suachua_edit->hoan_thanh->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_hoan_thanh">
<?php
$selwrk = ConvertToBool($ck_danhmuc_suachua_edit->hoan_thanh->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ck_danhmuc_suachua" data-field="x_hoan_thanh" name="x_hoan_thanh[]" id="x_hoan_thanh[]_703740" value="1"<?php echo $selwrk ?><?php echo $ck_danhmuc_suachua_edit->hoan_thanh->editAttributes() ?>>
	<label class="custom-control-label" for="x_hoan_thanh[]_703740"></label>
</div>
</span>
<?php echo $ck_danhmuc_suachua_edit->hoan_thanh->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_suachua_edit->ghi_chu->Visible) { // ghi_chu ?>
	<div id="r_ghi_chu" class="form-group row">
		<label id="elh_ck_danhmuc_suachua_ghi_chu" for="x_ghi_chu" class="<?php echo $ck_danhmuc_suachua_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_suachua_edit->ghi_chu->caption() ?><?php echo $ck_danhmuc_suachua_edit->ghi_chu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_suachua_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_suachua_edit->ghi_chu->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_ghi_chu">
<textarea data-table="ck_danhmuc_suachua" data-field="x_ghi_chu" name="x_ghi_chu" id="x_ghi_chu" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_edit->ghi_chu->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_suachua_edit->ghi_chu->editAttributes() ?>><?php echo $ck_danhmuc_suachua_edit->ghi_chu->EditValue ?></textarea>
</span>
<?php echo $ck_danhmuc_suachua_edit->ghi_chu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_suachua_edit->id_don_hang->Visible) { // id_don_hang ?>
	<div id="r_id_don_hang" class="form-group row">
		<label id="elh_ck_danhmuc_suachua_id_don_hang" class="<?php echo $ck_danhmuc_suachua_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_suachua_edit->id_don_hang->caption() ?><?php echo $ck_danhmuc_suachua_edit->id_don_hang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_suachua_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_suachua_edit->id_don_hang->cellAttributes() ?>>
<?php if ($ck_danhmuc_suachua_edit->id_don_hang->getSessionValue() != "") { ?>
<span id="el_ck_danhmuc_suachua_id_don_hang">
<span<?php echo $ck_danhmuc_suachua_edit->id_don_hang->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_suachua_edit->id_don_hang->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_id_don_hang" name="x_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_edit->id_don_hang->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ck_danhmuc_suachua_id_don_hang">
<?php
$onchange = $ck_danhmuc_suachua_edit->id_don_hang->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_danhmuc_suachua_edit->id_don_hang->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_don_hang">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_id_don_hang" id="sv_x_id_don_hang" value="<?php echo RemoveHtml($ck_danhmuc_suachua_edit->id_don_hang->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_edit->id_don_hang->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_edit->id_don_hang->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_suachua_edit->id_don_hang->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ck_danhmuc_suachua_edit->id_don_hang->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_id_don_hang',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($ck_danhmuc_suachua_edit->id_don_hang->ReadOnly || $ck_danhmuc_suachua_edit->id_don_hang->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="ck_danhmuc_suachua" data-field="x_id_don_hang" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ck_danhmuc_suachua_edit->id_don_hang->displayValueSeparatorAttribute() ?>" name="x_id_don_hang" id="x_id_don_hang" value="<?php echo HtmlEncode($ck_danhmuc_suachua_edit->id_don_hang->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_danhmuc_suachuaedit"], function() {
	fck_danhmuc_suachuaedit.createAutoSuggest({"id":"x_id_don_hang","forceSelect":false});
});
</script>
<?php echo $ck_danhmuc_suachua_edit->id_don_hang->Lookup->getParamTag($ck_danhmuc_suachua_edit, "p_x_id_don_hang") ?>
</span>
<?php } ?>
<?php echo $ck_danhmuc_suachua_edit->id_don_hang->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_suachua_edit->ngay_hoan_thanh->Visible) { // ngay_hoan_thanh ?>
	<div id="r_ngay_hoan_thanh" class="form-group row">
		<label id="elh_ck_danhmuc_suachua_ngay_hoan_thanh" for="x_ngay_hoan_thanh" class="<?php echo $ck_danhmuc_suachua_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_suachua_edit->ngay_hoan_thanh->caption() ?><?php echo $ck_danhmuc_suachua_edit->ngay_hoan_thanh->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_suachua_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_suachua_edit->ngay_hoan_thanh->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_ngay_hoan_thanh">
<input type="text" data-table="ck_danhmuc_suachua" data-field="x_ngay_hoan_thanh" data-format="7" name="x_ngay_hoan_thanh" id="x_ngay_hoan_thanh" maxlength="10" placeholder="<?php echo HtmlEncode($ck_danhmuc_suachua_edit->ngay_hoan_thanh->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_suachua_edit->ngay_hoan_thanh->EditValue ?>"<?php echo $ck_danhmuc_suachua_edit->ngay_hoan_thanh->editAttributes() ?>>
<?php if (!$ck_danhmuc_suachua_edit->ngay_hoan_thanh->ReadOnly && !$ck_danhmuc_suachua_edit->ngay_hoan_thanh->Disabled && !isset($ck_danhmuc_suachua_edit->ngay_hoan_thanh->EditAttrs["readonly"]) && !isset($ck_danhmuc_suachua_edit->ngay_hoan_thanh->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_danhmuc_suachuaedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_danhmuc_suachuaedit", "x_ngay_hoan_thanh", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $ck_danhmuc_suachua_edit->ngay_hoan_thanh->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("ck_chitiet_suachua", explode(",", $ck_danhmuc_suachua->getCurrentDetailTable())) && $ck_chitiet_suachua->DetailEdit) {
?>
<?php if ($ck_danhmuc_suachua->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("ck_chitiet_suachua", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ck_chitiet_suachuagrid.php" ?>
<?php } ?>
<?php if (!$ck_danhmuc_suachua_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ck_danhmuc_suachua_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ck_danhmuc_suachua_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ck_danhmuc_suachua_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");
	//$("#r_ghi_chu").hide();
	//$row=$(this).fields();
	//var current_value=$row["dich_vu"].value();
	//echo $("#x_dich_vu").val();

	/*
	if($("#x_noi_dung").val()=="test")
		$("#r_ghi_chu").show();
	else
		$("#r_ghi_chu").hide();
	*/
	//console.log( $(this).fields("dich_vu"));

	/*
	console.log($('#x_dich_vu').val());
	console.log($('#x_dich_vu:check').val());
	console.log($('#input:checked').val());
	console.log($('#x_dich_vu').prop('checked'));
	*/
});
</script>
<?php include_once "footer.php"; ?>
<?php
$ck_danhmuc_suachua_edit->terminate();
?>