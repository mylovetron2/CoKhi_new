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
$ck_danhmuc_thietbi_addopt = new ck_danhmuc_thietbi_addopt();

// Run the page
$ck_danhmuc_thietbi_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_danhmuc_thietbi_addopt->Page_Render();
?>
<script>
var fck_danhmuc_thietbiaddopt, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "addopt";
	fck_danhmuc_thietbiaddopt = currentForm = new ew.Form("fck_danhmuc_thietbiaddopt", "addopt");

	// Validate form
	fck_danhmuc_thietbiaddopt.validate = function() {
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
			<?php if ($ck_danhmuc_thietbi_addopt->thiet_bi_id->Required) { ?>
				elm = this.getElements("x" + infix + "_thiet_bi_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_addopt->thiet_bi_id->caption(), $ck_danhmuc_thietbi_addopt->thiet_bi_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_thietbi_addopt->chung_loai_id->Required) { ?>
				elm = this.getElements("x" + infix + "_chung_loai_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_addopt->chung_loai_id->caption(), $ck_danhmuc_thietbi_addopt->chung_loai_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_thietbi_addopt->ky_ma_hieu->Required) { ?>
				elm = this.getElements("x" + infix + "_ky_ma_hieu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_addopt->ky_ma_hieu->caption(), $ck_danhmuc_thietbi_addopt->ky_ma_hieu->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_thietbi_addopt->bo_phan->Required) { ?>
				elm = this.getElements("x" + infix + "_bo_phan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_addopt->bo_phan->caption(), $ck_danhmuc_thietbi_addopt->bo_phan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_thietbi_addopt->namsx->Required) { ?>
				elm = this.getElements("x" + infix + "_namsx");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_addopt->namsx->caption(), $ck_danhmuc_thietbi_addopt->namsx->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_thietbi_addopt->ghi_chu->Required) { ?>
				elm = this.getElements("x" + infix + "_ghi_chu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_addopt->ghi_chu->caption(), $ck_danhmuc_thietbi_addopt->ghi_chu->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fck_danhmuc_thietbiaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fck_danhmuc_thietbiaddopt.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fck_danhmuc_thietbiaddopt.lists["x_chung_loai_id"] = <?php echo $ck_danhmuc_thietbi_addopt->chung_loai_id->Lookup->toClientList($ck_danhmuc_thietbi_addopt) ?>;
	fck_danhmuc_thietbiaddopt.lists["x_chung_loai_id"].options = <?php echo JsonEncode($ck_danhmuc_thietbi_addopt->chung_loai_id->lookupOptions()) ?>;
	loadjs.done("fck_danhmuc_thietbiaddopt");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ck_danhmuc_thietbi_addopt->showPageHeader(); ?>
<?php
$ck_danhmuc_thietbi_addopt->showMessage();
?>
<form name="fck_danhmuc_thietbiaddopt" id="fck_danhmuc_thietbiaddopt" class="ew-form ew-horizontal" action="<?php echo Config("API_URL") ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="<?php echo Config("API_ACTION_NAME") ?>" id="<?php echo Config("API_ACTION_NAME") ?>" value="<?php echo Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?php echo Config("API_OBJECT_NAME") ?>" id="<?php echo Config("API_OBJECT_NAME") ?>" value="<?php echo $ck_danhmuc_thietbi_addopt->TableVar ?>">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($ck_danhmuc_thietbi_addopt->thiet_bi_id->Visible) { // thiet_bi_id ?>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_addopt->chung_loai_id->Visible) { // chung_loai_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_chung_loai_id"><?php echo $ck_danhmuc_thietbi_addopt->chung_loai_id->caption() ?><?php echo $ck_danhmuc_thietbi_addopt->chung_loai_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_thietbi" data-field="x_chung_loai_id" data-value-separator="<?php echo $ck_danhmuc_thietbi_addopt->chung_loai_id->displayValueSeparatorAttribute() ?>" id="x_chung_loai_id" name="x_chung_loai_id"<?php echo $ck_danhmuc_thietbi_addopt->chung_loai_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_thietbi_addopt->chung_loai_id->selectOptionListHtml("x_chung_loai_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_thietbi_addopt->chung_loai_id->Lookup->getParamTag($ck_danhmuc_thietbi_addopt, "p_x_chung_loai_id") ?>
</div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_addopt->ky_ma_hieu->Visible) { // ky_ma_hieu ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_ky_ma_hieu"><?php echo $ck_danhmuc_thietbi_addopt->ky_ma_hieu->caption() ?><?php echo $ck_danhmuc_thietbi_addopt->ky_ma_hieu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_ky_ma_hieu" name="x_ky_ma_hieu" id="x_ky_ma_hieu" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_addopt->ky_ma_hieu->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_addopt->ky_ma_hieu->EditValue ?>"<?php echo $ck_danhmuc_thietbi_addopt->ky_ma_hieu->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_addopt->bo_phan->Visible) { // bo_phan ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_bo_phan"><?php echo $ck_danhmuc_thietbi_addopt->bo_phan->caption() ?><?php echo $ck_danhmuc_thietbi_addopt->bo_phan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_bo_phan" name="x_bo_phan" id="x_bo_phan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_addopt->bo_phan->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_addopt->bo_phan->EditValue ?>"<?php echo $ck_danhmuc_thietbi_addopt->bo_phan->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_addopt->namsx->Visible) { // namsx ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_namsx"><?php echo $ck_danhmuc_thietbi_addopt->namsx->caption() ?><?php echo $ck_danhmuc_thietbi_addopt->namsx->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_namsx" name="x_namsx" id="x_namsx" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_addopt->namsx->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_addopt->namsx->EditValue ?>"<?php echo $ck_danhmuc_thietbi_addopt->namsx->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_addopt->ghi_chu->Visible) { // ghi_chu ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_ghi_chu"><?php echo $ck_danhmuc_thietbi_addopt->ghi_chu->caption() ?><?php echo $ck_danhmuc_thietbi_addopt->ghi_chu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<textarea data-table="ck_danhmuc_thietbi" data-field="x_ghi_chu" name="x_ghi_chu" id="x_ghi_chu" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_addopt->ghi_chu->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_thietbi_addopt->ghi_chu->editAttributes() ?>><?php echo $ck_danhmuc_thietbi_addopt->ghi_chu->EditValue ?></textarea>
</div>
	</div>
<?php } ?>
</form>
<?php
$ck_danhmuc_thietbi_addopt->showPageFooter();
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
<?php
$ck_danhmuc_thietbi_addopt->terminate();
?>