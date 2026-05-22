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
$ck_danhmuc_thietbi_edit = new ck_danhmuc_thietbi_edit();

// Run the page
$ck_danhmuc_thietbi_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_danhmuc_thietbi_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fck_danhmuc_thietbiedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fck_danhmuc_thietbiedit = currentForm = new ew.Form("fck_danhmuc_thietbiedit", "edit");

	// Validate form
	fck_danhmuc_thietbiedit.validate = function() {
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
			<?php if ($ck_danhmuc_thietbi_edit->thiet_bi_id->Required) { ?>
				elm = this.getElements("x" + infix + "_thiet_bi_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_edit->thiet_bi_id->caption(), $ck_danhmuc_thietbi_edit->thiet_bi_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_thietbi_edit->chung_loai_id->Required) { ?>
				elm = this.getElements("x" + infix + "_chung_loai_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_edit->chung_loai_id->caption(), $ck_danhmuc_thietbi_edit->chung_loai_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_thietbi_edit->ky_ma_hieu->Required) { ?>
				elm = this.getElements("x" + infix + "_ky_ma_hieu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_edit->ky_ma_hieu->caption(), $ck_danhmuc_thietbi_edit->ky_ma_hieu->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_thietbi_edit->bo_phan->Required) { ?>
				elm = this.getElements("x" + infix + "_bo_phan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_edit->bo_phan->caption(), $ck_danhmuc_thietbi_edit->bo_phan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_thietbi_edit->namsx->Required) { ?>
				elm = this.getElements("x" + infix + "_namsx");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_edit->namsx->caption(), $ck_danhmuc_thietbi_edit->namsx->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_danhmuc_thietbi_edit->ghi_chu->Required) { ?>
				elm = this.getElements("x" + infix + "_ghi_chu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_danhmuc_thietbi_edit->ghi_chu->caption(), $ck_danhmuc_thietbi_edit->ghi_chu->RequiredErrorMessage)) ?>");
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
	fck_danhmuc_thietbiedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fck_danhmuc_thietbiedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fck_danhmuc_thietbiedit.lists["x_chung_loai_id"] = <?php echo $ck_danhmuc_thietbi_edit->chung_loai_id->Lookup->toClientList($ck_danhmuc_thietbi_edit) ?>;
	fck_danhmuc_thietbiedit.lists["x_chung_loai_id"].options = <?php echo JsonEncode($ck_danhmuc_thietbi_edit->chung_loai_id->lookupOptions()) ?>;
	loadjs.done("fck_danhmuc_thietbiedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ck_danhmuc_thietbi_edit->showPageHeader(); ?>
<?php
$ck_danhmuc_thietbi_edit->showMessage();
?>
<form name="fck_danhmuc_thietbiedit" id="fck_danhmuc_thietbiedit" class="<?php echo $ck_danhmuc_thietbi_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_danhmuc_thietbi">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ck_danhmuc_thietbi_edit->IsModal ?>">
<?php if ($ck_danhmuc_thietbi->getCurrentMasterTable() == "ck_chungloai_thietbi") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="ck_chungloai_thietbi">
<input type="hidden" name="fk_chungloai_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_edit->chung_loai_id->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($ck_danhmuc_thietbi_edit->thiet_bi_id->Visible) { // thiet_bi_id ?>
	<div id="r_thiet_bi_id" class="form-group row">
		<label id="elh_ck_danhmuc_thietbi_thiet_bi_id" class="<?php echo $ck_danhmuc_thietbi_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_thietbi_edit->thiet_bi_id->caption() ?><?php echo $ck_danhmuc_thietbi_edit->thiet_bi_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_thietbi_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_thietbi_edit->thiet_bi_id->cellAttributes() ?>>
<span id="el_ck_danhmuc_thietbi_thiet_bi_id">
<span<?php echo $ck_danhmuc_thietbi_edit->thiet_bi_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_thietbi_edit->thiet_bi_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_danhmuc_thietbi" data-field="x_thiet_bi_id" name="x_thiet_bi_id" id="x_thiet_bi_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_edit->thiet_bi_id->CurrentValue) ?>">
<?php echo $ck_danhmuc_thietbi_edit->thiet_bi_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_edit->chung_loai_id->Visible) { // chung_loai_id ?>
	<div id="r_chung_loai_id" class="form-group row">
		<label id="elh_ck_danhmuc_thietbi_chung_loai_id" for="x_chung_loai_id" class="<?php echo $ck_danhmuc_thietbi_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_thietbi_edit->chung_loai_id->caption() ?><?php echo $ck_danhmuc_thietbi_edit->chung_loai_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_thietbi_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_thietbi_edit->chung_loai_id->cellAttributes() ?>>
<?php if ($ck_danhmuc_thietbi_edit->chung_loai_id->getSessionValue() != "") { ?>
<span id="el_ck_danhmuc_thietbi_chung_loai_id">
<span<?php echo $ck_danhmuc_thietbi_edit->chung_loai_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_danhmuc_thietbi_edit->chung_loai_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_chung_loai_id" name="x_chung_loai_id" value="<?php echo HtmlEncode($ck_danhmuc_thietbi_edit->chung_loai_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ck_danhmuc_thietbi_chung_loai_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_danhmuc_thietbi" data-field="x_chung_loai_id" data-value-separator="<?php echo $ck_danhmuc_thietbi_edit->chung_loai_id->displayValueSeparatorAttribute() ?>" id="x_chung_loai_id" name="x_chung_loai_id"<?php echo $ck_danhmuc_thietbi_edit->chung_loai_id->editAttributes() ?>>
			<?php echo $ck_danhmuc_thietbi_edit->chung_loai_id->selectOptionListHtml("x_chung_loai_id") ?>
		</select>
</div>
<?php echo $ck_danhmuc_thietbi_edit->chung_loai_id->Lookup->getParamTag($ck_danhmuc_thietbi_edit, "p_x_chung_loai_id") ?>
</span>
<?php } ?>
<?php echo $ck_danhmuc_thietbi_edit->chung_loai_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_edit->ky_ma_hieu->Visible) { // ky_ma_hieu ?>
	<div id="r_ky_ma_hieu" class="form-group row">
		<label id="elh_ck_danhmuc_thietbi_ky_ma_hieu" for="x_ky_ma_hieu" class="<?php echo $ck_danhmuc_thietbi_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_thietbi_edit->ky_ma_hieu->caption() ?><?php echo $ck_danhmuc_thietbi_edit->ky_ma_hieu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_thietbi_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_thietbi_edit->ky_ma_hieu->cellAttributes() ?>>
<span id="el_ck_danhmuc_thietbi_ky_ma_hieu">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_ky_ma_hieu" name="x_ky_ma_hieu" id="x_ky_ma_hieu" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_edit->ky_ma_hieu->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_edit->ky_ma_hieu->EditValue ?>"<?php echo $ck_danhmuc_thietbi_edit->ky_ma_hieu->editAttributes() ?>>
</span>
<?php echo $ck_danhmuc_thietbi_edit->ky_ma_hieu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_edit->bo_phan->Visible) { // bo_phan ?>
	<div id="r_bo_phan" class="form-group row">
		<label id="elh_ck_danhmuc_thietbi_bo_phan" for="x_bo_phan" class="<?php echo $ck_danhmuc_thietbi_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_thietbi_edit->bo_phan->caption() ?><?php echo $ck_danhmuc_thietbi_edit->bo_phan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_thietbi_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_thietbi_edit->bo_phan->cellAttributes() ?>>
<span id="el_ck_danhmuc_thietbi_bo_phan">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_bo_phan" name="x_bo_phan" id="x_bo_phan" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_edit->bo_phan->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_edit->bo_phan->EditValue ?>"<?php echo $ck_danhmuc_thietbi_edit->bo_phan->editAttributes() ?>>
</span>
<?php echo $ck_danhmuc_thietbi_edit->bo_phan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_edit->namsx->Visible) { // namsx ?>
	<div id="r_namsx" class="form-group row">
		<label id="elh_ck_danhmuc_thietbi_namsx" for="x_namsx" class="<?php echo $ck_danhmuc_thietbi_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_thietbi_edit->namsx->caption() ?><?php echo $ck_danhmuc_thietbi_edit->namsx->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_thietbi_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_thietbi_edit->namsx->cellAttributes() ?>>
<span id="el_ck_danhmuc_thietbi_namsx">
<input type="text" data-table="ck_danhmuc_thietbi" data-field="x_namsx" name="x_namsx" id="x_namsx" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_edit->namsx->getPlaceHolder()) ?>" value="<?php echo $ck_danhmuc_thietbi_edit->namsx->EditValue ?>"<?php echo $ck_danhmuc_thietbi_edit->namsx->editAttributes() ?>>
</span>
<?php echo $ck_danhmuc_thietbi_edit->namsx->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_danhmuc_thietbi_edit->ghi_chu->Visible) { // ghi_chu ?>
	<div id="r_ghi_chu" class="form-group row">
		<label id="elh_ck_danhmuc_thietbi_ghi_chu" for="x_ghi_chu" class="<?php echo $ck_danhmuc_thietbi_edit->LeftColumnClass ?>"><?php echo $ck_danhmuc_thietbi_edit->ghi_chu->caption() ?><?php echo $ck_danhmuc_thietbi_edit->ghi_chu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_danhmuc_thietbi_edit->RightColumnClass ?>"><div <?php echo $ck_danhmuc_thietbi_edit->ghi_chu->cellAttributes() ?>>
<span id="el_ck_danhmuc_thietbi_ghi_chu">
<textarea data-table="ck_danhmuc_thietbi" data-field="x_ghi_chu" name="x_ghi_chu" id="x_ghi_chu" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_danhmuc_thietbi_edit->ghi_chu->getPlaceHolder()) ?>"<?php echo $ck_danhmuc_thietbi_edit->ghi_chu->editAttributes() ?>><?php echo $ck_danhmuc_thietbi_edit->ghi_chu->EditValue ?></textarea>
</span>
<?php echo $ck_danhmuc_thietbi_edit->ghi_chu->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("ck_view_nhatky_thietbi", explode(",", $ck_danhmuc_thietbi->getCurrentDetailTable())) && $ck_view_nhatky_thietbi->DetailEdit) {
?>
<?php if ($ck_danhmuc_thietbi->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("ck_view_nhatky_thietbi", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ck_view_nhatky_thietbigrid.php" ?>
<?php } ?>
<?php if (!$ck_danhmuc_thietbi_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ck_danhmuc_thietbi_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ck_danhmuc_thietbi_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ck_danhmuc_thietbi_edit->showPageFooter();
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
$ck_danhmuc_thietbi_edit->terminate();
?>