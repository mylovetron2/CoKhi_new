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
$nhan_vien_addopt = new nhan_vien_addopt();

// Run the page
$nhan_vien_addopt->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$nhan_vien_addopt->Page_Render();
?>
<script>
var fnhan_vienaddopt, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "addopt";
	fnhan_vienaddopt = currentForm = new ew.Form("fnhan_vienaddopt", "addopt");

	// Validate form
	fnhan_vienaddopt.validate = function() {
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
			<?php if ($nhan_vien_addopt->nhan_vien_id->Required) { ?>
				elm = this.getElements("x" + infix + "_nhan_vien_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->nhan_vien_id->caption(), $nhan_vien_addopt->nhan_vien_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_addopt->danh_so->Required) { ?>
				elm = this.getElements("x" + infix + "_danh_so");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->danh_so->caption(), $nhan_vien_addopt->danh_so->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_danh_so");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($nhan_vien_addopt->danh_so->errorMessage()) ?>");
			<?php if ($nhan_vien_addopt->ten_nhan_vien->Required) { ?>
				elm = this.getElements("x" + infix + "_ten_nhan_vien");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->ten_nhan_vien->caption(), $nhan_vien_addopt->ten_nhan_vien->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_addopt->chuc_danh->Required) { ?>
				elm = this.getElements("x" + infix + "_chuc_danh");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->chuc_danh->caption(), $nhan_vien_addopt->chuc_danh->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_addopt->luong->Required) { ?>
				elm = this.getElements("x" + infix + "_luong");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->luong->caption(), $nhan_vien_addopt->luong->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_luong");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($nhan_vien_addopt->luong->errorMessage()) ?>");
			<?php if ($nhan_vien_addopt->ngay_vao_dk->Required) { ?>
				elm = this.getElements("x" + infix + "_ngay_vao_dk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->ngay_vao_dk->caption(), $nhan_vien_addopt->ngay_vao_dk->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ngay_vao_dk");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($nhan_vien_addopt->ngay_vao_dk->errorMessage()) ?>");
			<?php if ($nhan_vien_addopt->ngay_vao_ld->Required) { ?>
				elm = this.getElements("x" + infix + "_ngay_vao_ld");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->ngay_vao_ld->caption(), $nhan_vien_addopt->ngay_vao_ld->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ngay_vao_ld");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($nhan_vien_addopt->ngay_vao_ld->errorMessage()) ?>");
			<?php if ($nhan_vien_addopt->ngayll->Required) { ?>
				elm = this.getElements("x" + infix + "_ngayll");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->ngayll->caption(), $nhan_vien_addopt->ngayll->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ngayll");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($nhan_vien_addopt->ngayll->errorMessage()) ?>");
			<?php if ($nhan_vien_addopt->ngay_sinh->Required) { ?>
				elm = this.getElements("x" + infix + "_ngay_sinh");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->ngay_sinh->caption(), $nhan_vien_addopt->ngay_sinh->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ngay_sinh");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($nhan_vien_addopt->ngay_sinh->errorMessage()) ?>");
			<?php if ($nhan_vien_addopt->ncl1->Required) { ?>
				elm = this.getElements("x" + infix + "_ncl1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->ncl1->caption(), $nhan_vien_addopt->ncl1->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ncl1");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($nhan_vien_addopt->ncl1->errorMessage()) ?>");
			<?php if ($nhan_vien_addopt->ncl2->Required) { ?>
				elm = this.getElements("x" + infix + "_ncl2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->ncl2->caption(), $nhan_vien_addopt->ncl2->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ncl2");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($nhan_vien_addopt->ncl2->errorMessage()) ?>");
			<?php if ($nhan_vien_addopt->ncl3->Required) { ?>
				elm = this.getElements("x" + infix + "_ncl3");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->ncl3->caption(), $nhan_vien_addopt->ncl3->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ncl3");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($nhan_vien_addopt->ncl3->errorMessage()) ?>");
			<?php if ($nhan_vien_addopt->DTCQ->Required) { ?>
				elm = this.getElements("x" + infix + "_DTCQ");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->DTCQ->caption(), $nhan_vien_addopt->DTCQ->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_addopt->DTNR->Required) { ?>
				elm = this.getElements("x" + infix + "_DTNR");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->DTNR->caption(), $nhan_vien_addopt->DTNR->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_addopt->DTDD->Required) { ?>
				elm = this.getElements("x" + infix + "_DTDD");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->DTDD->caption(), $nhan_vien_addopt->DTDD->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_addopt->que_quan->Required) { ?>
				elm = this.getElements("x" + infix + "_que_quan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->que_quan->caption(), $nhan_vien_addopt->que_quan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_addopt->dia_chi_noi_o->Required) { ?>
				elm = this.getElements("x" + infix + "_dia_chi_noi_o");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->dia_chi_noi_o->caption(), $nhan_vien_addopt->dia_chi_noi_o->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_addopt->cmnd->Required) { ?>
				elm = this.getElements("x" + infix + "_cmnd");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->cmnd->caption(), $nhan_vien_addopt->cmnd->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_addopt->noi_cap->Required) { ?>
				elm = this.getElements("x" + infix + "_noi_cap");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->noi_cap->caption(), $nhan_vien_addopt->noi_cap->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_addopt->ngay_cap->Required) { ?>
				elm = this.getElements("x" + infix + "_ngay_cap");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->ngay_cap->caption(), $nhan_vien_addopt->ngay_cap->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ngay_cap");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($nhan_vien_addopt->ngay_cap->errorMessage()) ?>");
			<?php if ($nhan_vien_addopt->bo_phan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_bo_phan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->bo_phan_id->caption(), $nhan_vien_addopt->bo_phan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_bo_phan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($nhan_vien_addopt->bo_phan_id->errorMessage()) ?>");
			<?php if ($nhan_vien_addopt->username->Required) { ?>
				elm = this.getElements("x" + infix + "_username");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->username->caption(), $nhan_vien_addopt->username->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_addopt->password->Required) { ?>
				elm = this.getElements("x" + infix + "_password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->password->caption(), $nhan_vien_addopt->password->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_addopt->_userlevel->Required) { ?>
				elm = this.getElements("x" + infix + "__userlevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_addopt->_userlevel->caption(), $nhan_vien_addopt->_userlevel->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fnhan_vienaddopt.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fnhan_vienaddopt.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fnhan_vienaddopt.lists["x__userlevel"] = <?php echo $nhan_vien_addopt->_userlevel->Lookup->toClientList($nhan_vien_addopt) ?>;
	fnhan_vienaddopt.lists["x__userlevel"].options = <?php echo JsonEncode($nhan_vien_addopt->_userlevel->lookupOptions()) ?>;
	loadjs.done("fnhan_vienaddopt");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $nhan_vien_addopt->showPageHeader(); ?>
<?php
$nhan_vien_addopt->showMessage();
?>
<form name="fnhan_vienaddopt" id="fnhan_vienaddopt" class="ew-form ew-horizontal" action="<?php echo Config("API_URL") ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="<?php echo Config("API_ACTION_NAME") ?>" id="<?php echo Config("API_ACTION_NAME") ?>" value="<?php echo Config("API_ADD_ACTION") ?>">
<input type="hidden" name="<?php echo Config("API_OBJECT_NAME") ?>" id="<?php echo Config("API_OBJECT_NAME") ?>" value="<?php echo $nhan_vien_addopt->TableVar ?>">
<input type="hidden" name="addopt" id="addopt" value="1">
<?php if ($nhan_vien_addopt->nhan_vien_id->Visible) { // nhan_vien_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_nhan_vien_id"><?php echo $nhan_vien_addopt->nhan_vien_id->caption() ?><?php echo $nhan_vien_addopt->nhan_vien_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<?php if (!$Security->isAdmin() && $Security->isLoggedIn() && !$nhan_vien->userIDAllow("addopt")) { // Non system admin ?>
<span<?php echo $nhan_vien_addopt->nhan_vien_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($nhan_vien_addopt->nhan_vien_id->EditValue)) ?>"></span>
<input type="hidden" data-table="nhan_vien" data-field="x_nhan_vien_id" name="x_nhan_vien_id" id="x_nhan_vien_id" value="<?php echo HtmlEncode($nhan_vien_addopt->nhan_vien_id->CurrentValue) ?>">
<?php } else { ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="nhan_vien" data-field="x_nhan_vien_id" data-value-separator="<?php echo $nhan_vien_addopt->nhan_vien_id->displayValueSeparatorAttribute() ?>" id="x_nhan_vien_id" name="x_nhan_vien_id"<?php echo $nhan_vien_addopt->nhan_vien_id->editAttributes() ?>>
			<?php echo $nhan_vien_addopt->nhan_vien_id->selectOptionListHtml("x_nhan_vien_id") ?>
		</select>
</div>
<?php } ?>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->danh_so->Visible) { // danh_so ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_danh_so"><?php echo $nhan_vien_addopt->danh_so->caption() ?><?php echo $nhan_vien_addopt->danh_so->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_danh_so" name="x_danh_so" id="x_danh_so" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->danh_so->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->danh_so->EditValue ?>"<?php echo $nhan_vien_addopt->danh_so->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->ten_nhan_vien->Visible) { // ten_nhan_vien ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_ten_nhan_vien"><?php echo $nhan_vien_addopt->ten_nhan_vien->caption() ?><?php echo $nhan_vien_addopt->ten_nhan_vien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_ten_nhan_vien" name="x_ten_nhan_vien" id="x_ten_nhan_vien" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->ten_nhan_vien->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->ten_nhan_vien->EditValue ?>"<?php echo $nhan_vien_addopt->ten_nhan_vien->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->chuc_danh->Visible) { // chuc_danh ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_chuc_danh"><?php echo $nhan_vien_addopt->chuc_danh->caption() ?><?php echo $nhan_vien_addopt->chuc_danh->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_chuc_danh" name="x_chuc_danh" id="x_chuc_danh" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->chuc_danh->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->chuc_danh->EditValue ?>"<?php echo $nhan_vien_addopt->chuc_danh->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->luong->Visible) { // luong ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_luong"><?php echo $nhan_vien_addopt->luong->caption() ?><?php echo $nhan_vien_addopt->luong->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_luong" name="x_luong" id="x_luong" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->luong->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->luong->EditValue ?>"<?php echo $nhan_vien_addopt->luong->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->ngay_vao_dk->Visible) { // ngay_vao_dk ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_ngay_vao_dk"><?php echo $nhan_vien_addopt->ngay_vao_dk->caption() ?><?php echo $nhan_vien_addopt->ngay_vao_dk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_ngay_vao_dk" name="x_ngay_vao_dk" id="x_ngay_vao_dk" maxlength="10" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->ngay_vao_dk->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->ngay_vao_dk->EditValue ?>"<?php echo $nhan_vien_addopt->ngay_vao_dk->editAttributes() ?>>
<?php if (!$nhan_vien_addopt->ngay_vao_dk->ReadOnly && !$nhan_vien_addopt->ngay_vao_dk->Disabled && !isset($nhan_vien_addopt->ngay_vao_dk->EditAttrs["readonly"]) && !isset($nhan_vien_addopt->ngay_vao_dk->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fnhan_vienaddopt", "datetimepicker"], function() {
	ew.createDateTimePicker("fnhan_vienaddopt", "x_ngay_vao_dk", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->ngay_vao_ld->Visible) { // ngay_vao_ld ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_ngay_vao_ld"><?php echo $nhan_vien_addopt->ngay_vao_ld->caption() ?><?php echo $nhan_vien_addopt->ngay_vao_ld->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_ngay_vao_ld" name="x_ngay_vao_ld" id="x_ngay_vao_ld" maxlength="10" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->ngay_vao_ld->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->ngay_vao_ld->EditValue ?>"<?php echo $nhan_vien_addopt->ngay_vao_ld->editAttributes() ?>>
<?php if (!$nhan_vien_addopt->ngay_vao_ld->ReadOnly && !$nhan_vien_addopt->ngay_vao_ld->Disabled && !isset($nhan_vien_addopt->ngay_vao_ld->EditAttrs["readonly"]) && !isset($nhan_vien_addopt->ngay_vao_ld->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fnhan_vienaddopt", "datetimepicker"], function() {
	ew.createDateTimePicker("fnhan_vienaddopt", "x_ngay_vao_ld", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->ngayll->Visible) { // ngayll ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_ngayll"><?php echo $nhan_vien_addopt->ngayll->caption() ?><?php echo $nhan_vien_addopt->ngayll->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_ngayll" name="x_ngayll" id="x_ngayll" maxlength="10" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->ngayll->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->ngayll->EditValue ?>"<?php echo $nhan_vien_addopt->ngayll->editAttributes() ?>>
<?php if (!$nhan_vien_addopt->ngayll->ReadOnly && !$nhan_vien_addopt->ngayll->Disabled && !isset($nhan_vien_addopt->ngayll->EditAttrs["readonly"]) && !isset($nhan_vien_addopt->ngayll->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fnhan_vienaddopt", "datetimepicker"], function() {
	ew.createDateTimePicker("fnhan_vienaddopt", "x_ngayll", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->ngay_sinh->Visible) { // ngay_sinh ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_ngay_sinh"><?php echo $nhan_vien_addopt->ngay_sinh->caption() ?><?php echo $nhan_vien_addopt->ngay_sinh->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_ngay_sinh" name="x_ngay_sinh" id="x_ngay_sinh" maxlength="10" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->ngay_sinh->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->ngay_sinh->EditValue ?>"<?php echo $nhan_vien_addopt->ngay_sinh->editAttributes() ?>>
<?php if (!$nhan_vien_addopt->ngay_sinh->ReadOnly && !$nhan_vien_addopt->ngay_sinh->Disabled && !isset($nhan_vien_addopt->ngay_sinh->EditAttrs["readonly"]) && !isset($nhan_vien_addopt->ngay_sinh->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fnhan_vienaddopt", "datetimepicker"], function() {
	ew.createDateTimePicker("fnhan_vienaddopt", "x_ngay_sinh", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->ncl1->Visible) { // ncl1 ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_ncl1"><?php echo $nhan_vien_addopt->ncl1->caption() ?><?php echo $nhan_vien_addopt->ncl1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_ncl1" name="x_ncl1" id="x_ncl1" maxlength="10" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->ncl1->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->ncl1->EditValue ?>"<?php echo $nhan_vien_addopt->ncl1->editAttributes() ?>>
<?php if (!$nhan_vien_addopt->ncl1->ReadOnly && !$nhan_vien_addopt->ncl1->Disabled && !isset($nhan_vien_addopt->ncl1->EditAttrs["readonly"]) && !isset($nhan_vien_addopt->ncl1->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fnhan_vienaddopt", "datetimepicker"], function() {
	ew.createDateTimePicker("fnhan_vienaddopt", "x_ncl1", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->ncl2->Visible) { // ncl2 ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_ncl2"><?php echo $nhan_vien_addopt->ncl2->caption() ?><?php echo $nhan_vien_addopt->ncl2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_ncl2" name="x_ncl2" id="x_ncl2" maxlength="10" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->ncl2->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->ncl2->EditValue ?>"<?php echo $nhan_vien_addopt->ncl2->editAttributes() ?>>
<?php if (!$nhan_vien_addopt->ncl2->ReadOnly && !$nhan_vien_addopt->ncl2->Disabled && !isset($nhan_vien_addopt->ncl2->EditAttrs["readonly"]) && !isset($nhan_vien_addopt->ncl2->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fnhan_vienaddopt", "datetimepicker"], function() {
	ew.createDateTimePicker("fnhan_vienaddopt", "x_ncl2", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->ncl3->Visible) { // ncl3 ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_ncl3"><?php echo $nhan_vien_addopt->ncl3->caption() ?><?php echo $nhan_vien_addopt->ncl3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_ncl3" name="x_ncl3" id="x_ncl3" maxlength="10" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->ncl3->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->ncl3->EditValue ?>"<?php echo $nhan_vien_addopt->ncl3->editAttributes() ?>>
<?php if (!$nhan_vien_addopt->ncl3->ReadOnly && !$nhan_vien_addopt->ncl3->Disabled && !isset($nhan_vien_addopt->ncl3->EditAttrs["readonly"]) && !isset($nhan_vien_addopt->ncl3->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fnhan_vienaddopt", "datetimepicker"], function() {
	ew.createDateTimePicker("fnhan_vienaddopt", "x_ncl3", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->DTCQ->Visible) { // DTCQ ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_DTCQ"><?php echo $nhan_vien_addopt->DTCQ->caption() ?><?php echo $nhan_vien_addopt->DTCQ->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_DTCQ" name="x_DTCQ" id="x_DTCQ" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->DTCQ->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->DTCQ->EditValue ?>"<?php echo $nhan_vien_addopt->DTCQ->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->DTNR->Visible) { // DTNR ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_DTNR"><?php echo $nhan_vien_addopt->DTNR->caption() ?><?php echo $nhan_vien_addopt->DTNR->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_DTNR" name="x_DTNR" id="x_DTNR" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->DTNR->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->DTNR->EditValue ?>"<?php echo $nhan_vien_addopt->DTNR->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->DTDD->Visible) { // DTDD ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_DTDD"><?php echo $nhan_vien_addopt->DTDD->caption() ?><?php echo $nhan_vien_addopt->DTDD->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_DTDD" name="x_DTDD" id="x_DTDD" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->DTDD->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->DTDD->EditValue ?>"<?php echo $nhan_vien_addopt->DTDD->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->que_quan->Visible) { // que_quan ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_que_quan"><?php echo $nhan_vien_addopt->que_quan->caption() ?><?php echo $nhan_vien_addopt->que_quan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_que_quan" name="x_que_quan" id="x_que_quan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->que_quan->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->que_quan->EditValue ?>"<?php echo $nhan_vien_addopt->que_quan->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->dia_chi_noi_o->Visible) { // dia_chi_noi_o ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_dia_chi_noi_o"><?php echo $nhan_vien_addopt->dia_chi_noi_o->caption() ?><?php echo $nhan_vien_addopt->dia_chi_noi_o->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_dia_chi_noi_o" name="x_dia_chi_noi_o" id="x_dia_chi_noi_o" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->dia_chi_noi_o->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->dia_chi_noi_o->EditValue ?>"<?php echo $nhan_vien_addopt->dia_chi_noi_o->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->cmnd->Visible) { // cmnd ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_cmnd"><?php echo $nhan_vien_addopt->cmnd->caption() ?><?php echo $nhan_vien_addopt->cmnd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_cmnd" name="x_cmnd" id="x_cmnd" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->cmnd->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->cmnd->EditValue ?>"<?php echo $nhan_vien_addopt->cmnd->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->noi_cap->Visible) { // noi_cap ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_noi_cap"><?php echo $nhan_vien_addopt->noi_cap->caption() ?><?php echo $nhan_vien_addopt->noi_cap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_noi_cap" name="x_noi_cap" id="x_noi_cap" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->noi_cap->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->noi_cap->EditValue ?>"<?php echo $nhan_vien_addopt->noi_cap->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->ngay_cap->Visible) { // ngay_cap ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_ngay_cap"><?php echo $nhan_vien_addopt->ngay_cap->caption() ?><?php echo $nhan_vien_addopt->ngay_cap->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_ngay_cap" name="x_ngay_cap" id="x_ngay_cap" maxlength="10" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->ngay_cap->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->ngay_cap->EditValue ?>"<?php echo $nhan_vien_addopt->ngay_cap->editAttributes() ?>>
<?php if (!$nhan_vien_addopt->ngay_cap->ReadOnly && !$nhan_vien_addopt->ngay_cap->Disabled && !isset($nhan_vien_addopt->ngay_cap->EditAttrs["readonly"]) && !isset($nhan_vien_addopt->ngay_cap->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fnhan_vienaddopt", "datetimepicker"], function() {
	ew.createDateTimePicker("fnhan_vienaddopt", "x_ngay_cap", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->bo_phan_id->Visible) { // bo_phan_id ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_bo_phan_id"><?php echo $nhan_vien_addopt->bo_phan_id->caption() ?><?php echo $nhan_vien_addopt->bo_phan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_bo_phan_id" name="x_bo_phan_id" id="x_bo_phan_id" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->bo_phan_id->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->bo_phan_id->EditValue ?>"<?php echo $nhan_vien_addopt->bo_phan_id->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->username->Visible) { // username ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_username"><?php echo $nhan_vien_addopt->username->caption() ?><?php echo $nhan_vien_addopt->username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_username" name="x_username" id="x_username" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->username->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->username->EditValue ?>"<?php echo $nhan_vien_addopt->username->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->password->Visible) { // password ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x_password"><?php echo $nhan_vien_addopt->password->caption() ?><?php echo $nhan_vien_addopt->password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<input type="text" data-table="nhan_vien" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($nhan_vien_addopt->password->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_addopt->password->EditValue ?>"<?php echo $nhan_vien_addopt->password->editAttributes() ?>>
</div>
	</div>
<?php } ?>
<?php if ($nhan_vien_addopt->_userlevel->Visible) { // userlevel ?>
	<div class="form-group row">
		<label class="col-sm-2 col-form-label ew-label" for="x__userlevel"><?php echo $nhan_vien_addopt->_userlevel->caption() ?><?php echo $nhan_vien_addopt->_userlevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="col-sm-10">
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($nhan_vien_addopt->_userlevel->EditValue)) ?>">
<?php } else { ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="nhan_vien" data-field="x__userlevel" data-value-separator="<?php echo $nhan_vien_addopt->_userlevel->displayValueSeparatorAttribute() ?>" id="x__userlevel" name="x__userlevel"<?php echo $nhan_vien_addopt->_userlevel->editAttributes() ?>>
			<?php echo $nhan_vien_addopt->_userlevel->selectOptionListHtml("x__userlevel") ?>
		</select>
</div>
<?php echo $nhan_vien_addopt->_userlevel->Lookup->getParamTag($nhan_vien_addopt, "p_x__userlevel") ?>
<?php } ?>
</div>
	</div>
<?php } ?>
</form>
<?php
$nhan_vien_addopt->showPageFooter();
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
$nhan_vien_addopt->terminate();
?>