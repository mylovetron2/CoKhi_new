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
$ck_chitiet_suachua_add = new ck_chitiet_suachua_add();

// Run the page
$ck_chitiet_suachua_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_chitiet_suachua_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fck_chitiet_suachuaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fck_chitiet_suachuaadd = currentForm = new ew.Form("fck_chitiet_suachuaadd", "add");

	// Validate form
	fck_chitiet_suachuaadd.validate = function() {
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
			<?php if ($ck_chitiet_suachua_add->sua_chua_id->Required) { ?>
				elm = this.getElements("x" + infix + "_sua_chua_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_chitiet_suachua_add->sua_chua_id->caption(), $ck_chitiet_suachua_add->sua_chua_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sua_chua_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_chitiet_suachua_add->sua_chua_id->errorMessage()) ?>");
			<?php if ($ck_chitiet_suachua_add->nhan_vien_id->Required) { ?>
				elm = this.getElements("x" + infix + "_nhan_vien_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_chitiet_suachua_add->nhan_vien_id->caption(), $ck_chitiet_suachua_add->nhan_vien_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nhan_vien_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_chitiet_suachua_add->nhan_vien_id->errorMessage()) ?>");
			<?php if ($ck_chitiet_suachua_add->ngay_sua_chua->Required) { ?>
				elm = this.getElements("x" + infix + "_ngay_sua_chua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_chitiet_suachua_add->ngay_sua_chua->caption(), $ck_chitiet_suachua_add->ngay_sua_chua->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ngay_sua_chua");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_chitiet_suachua_add->ngay_sua_chua->errorMessage()) ?>");
			<?php if ($ck_chitiet_suachua_add->thoi_gian->Required) { ?>
				elm = this.getElements("x" + infix + "_thoi_gian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_chitiet_suachua_add->thoi_gian->caption(), $ck_chitiet_suachua_add->thoi_gian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_thoi_gian");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_chitiet_suachua_add->thoi_gian->errorMessage()) ?>");
			<?php if ($ck_chitiet_suachua_add->noi_dung->Required) { ?>
				elm = this.getElements("x" + infix + "_noi_dung");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_chitiet_suachua_add->noi_dung->caption(), $ck_chitiet_suachua_add->noi_dung->RequiredErrorMessage)) ?>");
			<?php } ?>

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
	fck_chitiet_suachuaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fck_chitiet_suachuaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fck_chitiet_suachuaadd.lists["x_sua_chua_id"] = <?php echo $ck_chitiet_suachua_add->sua_chua_id->Lookup->toClientList($ck_chitiet_suachua_add) ?>;
	fck_chitiet_suachuaadd.lists["x_sua_chua_id"].options = <?php echo JsonEncode($ck_chitiet_suachua_add->sua_chua_id->lookupOptions()) ?>;
	fck_chitiet_suachuaadd.autoSuggests["x_sua_chua_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fck_chitiet_suachuaadd.lists["x_nhan_vien_id"] = <?php echo $ck_chitiet_suachua_add->nhan_vien_id->Lookup->toClientList($ck_chitiet_suachua_add) ?>;
	fck_chitiet_suachuaadd.lists["x_nhan_vien_id"].options = <?php echo JsonEncode($ck_chitiet_suachua_add->nhan_vien_id->lookupOptions()) ?>;
	fck_chitiet_suachuaadd.autoSuggests["x_nhan_vien_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fck_chitiet_suachuaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ck_chitiet_suachua_add->showPageHeader(); ?>
<?php
$ck_chitiet_suachua_add->showMessage();
?>
<form name="fck_chitiet_suachuaadd" id="fck_chitiet_suachuaadd" class="<?php echo $ck_chitiet_suachua_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_chitiet_suachua">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ck_chitiet_suachua_add->IsModal ?>">
<?php if ($ck_chitiet_suachua->getCurrentMasterTable() == "ck_danhmuc_suachua") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="ck_danhmuc_suachua">
<input type="hidden" name="fk_sua_chua_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_add->sua_chua_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($ck_chitiet_suachua_add->sua_chua_id->Visible) { // sua_chua_id ?>
	<div id="r_sua_chua_id" class="form-group row">
		<label id="elh_ck_chitiet_suachua_sua_chua_id" class="<?php echo $ck_chitiet_suachua_add->LeftColumnClass ?>"><?php echo $ck_chitiet_suachua_add->sua_chua_id->caption() ?><?php echo $ck_chitiet_suachua_add->sua_chua_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_chitiet_suachua_add->RightColumnClass ?>"><div <?php echo $ck_chitiet_suachua_add->sua_chua_id->cellAttributes() ?>>
<?php if ($ck_chitiet_suachua_add->sua_chua_id->getSessionValue() != "") { ?>
<span id="el_ck_chitiet_suachua_sua_chua_id">
<span<?php echo $ck_chitiet_suachua_add->sua_chua_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_chitiet_suachua_add->sua_chua_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_sua_chua_id" name="x_sua_chua_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_add->sua_chua_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ck_chitiet_suachua_sua_chua_id">
<?php
$onchange = $ck_chitiet_suachua_add->sua_chua_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_chitiet_suachua_add->sua_chua_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_sua_chua_id">
	<input type="text" class="form-control" name="sv_x_sua_chua_id" id="sv_x_sua_chua_id" value="<?php echo RemoveHtml($ck_chitiet_suachua_add->sua_chua_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_add->sua_chua_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_add->sua_chua_id->getPlaceHolder()) ?>"<?php echo $ck_chitiet_suachua_add->sua_chua_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_sua_chua_id" data-value-separator="<?php echo $ck_chitiet_suachua_add->sua_chua_id->displayValueSeparatorAttribute() ?>" name="x_sua_chua_id" id="x_sua_chua_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_add->sua_chua_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_chitiet_suachuaadd"], function() {
	fck_chitiet_suachuaadd.createAutoSuggest({"id":"x_sua_chua_id","forceSelect":false});
});
</script>
<?php echo $ck_chitiet_suachua_add->sua_chua_id->Lookup->getParamTag($ck_chitiet_suachua_add, "p_x_sua_chua_id") ?>
</span>
<?php } ?>
<?php echo $ck_chitiet_suachua_add->sua_chua_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_chitiet_suachua_add->nhan_vien_id->Visible) { // nhan_vien_id ?>
	<div id="r_nhan_vien_id" class="form-group row">
		<label id="elh_ck_chitiet_suachua_nhan_vien_id" class="<?php echo $ck_chitiet_suachua_add->LeftColumnClass ?>"><?php echo $ck_chitiet_suachua_add->nhan_vien_id->caption() ?><?php echo $ck_chitiet_suachua_add->nhan_vien_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_chitiet_suachua_add->RightColumnClass ?>"><div <?php echo $ck_chitiet_suachua_add->nhan_vien_id->cellAttributes() ?>>
<span id="el_ck_chitiet_suachua_nhan_vien_id">
<?php
$onchange = $ck_chitiet_suachua_add->nhan_vien_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ck_chitiet_suachua_add->nhan_vien_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_nhan_vien_id">
	<input type="text" class="form-control" name="sv_x_nhan_vien_id" id="sv_x_nhan_vien_id" value="<?php echo RemoveHtml($ck_chitiet_suachua_add->nhan_vien_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_add->nhan_vien_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_add->nhan_vien_id->getPlaceHolder()) ?>"<?php echo $ck_chitiet_suachua_add->nhan_vien_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="ck_chitiet_suachua" data-field="x_nhan_vien_id" data-value-separator="<?php echo $ck_chitiet_suachua_add->nhan_vien_id->displayValueSeparatorAttribute() ?>" name="x_nhan_vien_id" id="x_nhan_vien_id" value="<?php echo HtmlEncode($ck_chitiet_suachua_add->nhan_vien_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fck_chitiet_suachuaadd"], function() {
	fck_chitiet_suachuaadd.createAutoSuggest({"id":"x_nhan_vien_id","forceSelect":false});
});
</script>
<?php echo $ck_chitiet_suachua_add->nhan_vien_id->Lookup->getParamTag($ck_chitiet_suachua_add, "p_x_nhan_vien_id") ?>
</span>
<?php echo $ck_chitiet_suachua_add->nhan_vien_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_chitiet_suachua_add->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<div id="r_ngay_sua_chua" class="form-group row">
		<label id="elh_ck_chitiet_suachua_ngay_sua_chua" for="x_ngay_sua_chua" class="<?php echo $ck_chitiet_suachua_add->LeftColumnClass ?>"><?php echo $ck_chitiet_suachua_add->ngay_sua_chua->caption() ?><?php echo $ck_chitiet_suachua_add->ngay_sua_chua->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_chitiet_suachua_add->RightColumnClass ?>"><div <?php echo $ck_chitiet_suachua_add->ngay_sua_chua->cellAttributes() ?>>
<span id="el_ck_chitiet_suachua_ngay_sua_chua">
<input type="text" data-table="ck_chitiet_suachua" data-field="x_ngay_sua_chua" data-format="7" name="x_ngay_sua_chua" id="x_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_add->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_chitiet_suachua_add->ngay_sua_chua->EditValue ?>"<?php echo $ck_chitiet_suachua_add->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_chitiet_suachua_add->ngay_sua_chua->ReadOnly && !$ck_chitiet_suachua_add->ngay_sua_chua->Disabled && !isset($ck_chitiet_suachua_add->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_chitiet_suachua_add->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_chitiet_suachuaadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_chitiet_suachuaadd", "x_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $ck_chitiet_suachua_add->ngay_sua_chua->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_chitiet_suachua_add->thoi_gian->Visible) { // thoi_gian ?>
	<div id="r_thoi_gian" class="form-group row">
		<label id="elh_ck_chitiet_suachua_thoi_gian" for="x_thoi_gian" class="<?php echo $ck_chitiet_suachua_add->LeftColumnClass ?>"><?php echo $ck_chitiet_suachua_add->thoi_gian->caption() ?><?php echo $ck_chitiet_suachua_add->thoi_gian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_chitiet_suachua_add->RightColumnClass ?>"><div <?php echo $ck_chitiet_suachua_add->thoi_gian->cellAttributes() ?>>
<span id="el_ck_chitiet_suachua_thoi_gian">
<input type="text" data-table="ck_chitiet_suachua" data-field="x_thoi_gian" name="x_thoi_gian" id="x_thoi_gian" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_add->thoi_gian->getPlaceHolder()) ?>" value="<?php echo $ck_chitiet_suachua_add->thoi_gian->EditValue ?>"<?php echo $ck_chitiet_suachua_add->thoi_gian->editAttributes() ?>>
</span>
<?php echo $ck_chitiet_suachua_add->thoi_gian->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_chitiet_suachua_add->noi_dung->Visible) { // noi_dung ?>
	<div id="r_noi_dung" class="form-group row">
		<label id="elh_ck_chitiet_suachua_noi_dung" class="<?php echo $ck_chitiet_suachua_add->LeftColumnClass ?>"><?php echo $ck_chitiet_suachua_add->noi_dung->caption() ?><?php echo $ck_chitiet_suachua_add->noi_dung->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_chitiet_suachua_add->RightColumnClass ?>"><div <?php echo $ck_chitiet_suachua_add->noi_dung->cellAttributes() ?>>
<span id="el_ck_chitiet_suachua_noi_dung">
<?php $ck_chitiet_suachua_add->noi_dung->EditAttrs->appendClass("editor"); ?>
<textarea data-table="ck_chitiet_suachua" data-field="x_noi_dung" name="x_noi_dung" id="x_noi_dung" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_chitiet_suachua_add->noi_dung->getPlaceHolder()) ?>"<?php echo $ck_chitiet_suachua_add->noi_dung->editAttributes() ?>><?php echo $ck_chitiet_suachua_add->noi_dung->EditValue ?></textarea>
<script>
loadjs.ready(["fck_chitiet_suachuaadd", "editor"], function() {
	ew.createEditor("fck_chitiet_suachuaadd", "x_noi_dung", 35, 4, <?php echo $ck_chitiet_suachua_add->noi_dung->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $ck_chitiet_suachua_add->noi_dung->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ck_chitiet_suachua_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ck_chitiet_suachua_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ck_chitiet_suachua_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ck_chitiet_suachua_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$ck_chitiet_suachua_add->terminate();
?>