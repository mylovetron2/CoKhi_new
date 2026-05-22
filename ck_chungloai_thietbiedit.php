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
$ck_chungloai_thietbi_edit = new ck_chungloai_thietbi_edit();

// Run the page
$ck_chungloai_thietbi_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_chungloai_thietbi_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fck_chungloai_thietbiedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fck_chungloai_thietbiedit = currentForm = new ew.Form("fck_chungloai_thietbiedit", "edit");

	// Validate form
	fck_chungloai_thietbiedit.validate = function() {
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
			<?php if ($ck_chungloai_thietbi_edit->chungloai_id->Required) { ?>
				elm = this.getElements("x" + infix + "_chungloai_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_chungloai_thietbi_edit->chungloai_id->caption(), $ck_chungloai_thietbi_edit->chungloai_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_chungloai_thietbi_edit->ten_chungloai->Required) { ?>
				elm = this.getElements("x" + infix + "_ten_chungloai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_chungloai_thietbi_edit->ten_chungloai->caption(), $ck_chungloai_thietbi_edit->ten_chungloai->RequiredErrorMessage)) ?>");
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
	fck_chungloai_thietbiedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fck_chungloai_thietbiedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fck_chungloai_thietbiedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ck_chungloai_thietbi_edit->showPageHeader(); ?>
<?php
$ck_chungloai_thietbi_edit->showMessage();
?>
<form name="fck_chungloai_thietbiedit" id="fck_chungloai_thietbiedit" class="<?php echo $ck_chungloai_thietbi_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_chungloai_thietbi">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ck_chungloai_thietbi_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($ck_chungloai_thietbi_edit->chungloai_id->Visible) { // chungloai_id ?>
	<div id="r_chungloai_id" class="form-group row">
		<label id="elh_ck_chungloai_thietbi_chungloai_id" class="<?php echo $ck_chungloai_thietbi_edit->LeftColumnClass ?>"><?php echo $ck_chungloai_thietbi_edit->chungloai_id->caption() ?><?php echo $ck_chungloai_thietbi_edit->chungloai_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_chungloai_thietbi_edit->RightColumnClass ?>"><div <?php echo $ck_chungloai_thietbi_edit->chungloai_id->cellAttributes() ?>>
<span id="el_ck_chungloai_thietbi_chungloai_id">
<span<?php echo $ck_chungloai_thietbi_edit->chungloai_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ck_chungloai_thietbi_edit->chungloai_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ck_chungloai_thietbi" data-field="x_chungloai_id" name="x_chungloai_id" id="x_chungloai_id" value="<?php echo HtmlEncode($ck_chungloai_thietbi_edit->chungloai_id->CurrentValue) ?>">
<?php echo $ck_chungloai_thietbi_edit->chungloai_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_chungloai_thietbi_edit->ten_chungloai->Visible) { // ten_chungloai ?>
	<div id="r_ten_chungloai" class="form-group row">
		<label id="elh_ck_chungloai_thietbi_ten_chungloai" for="x_ten_chungloai" class="<?php echo $ck_chungloai_thietbi_edit->LeftColumnClass ?>"><?php echo $ck_chungloai_thietbi_edit->ten_chungloai->caption() ?><?php echo $ck_chungloai_thietbi_edit->ten_chungloai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_chungloai_thietbi_edit->RightColumnClass ?>"><div <?php echo $ck_chungloai_thietbi_edit->ten_chungloai->cellAttributes() ?>>
<span id="el_ck_chungloai_thietbi_ten_chungloai">
<input type="text" data-table="ck_chungloai_thietbi" data-field="x_ten_chungloai" name="x_ten_chungloai" id="x_ten_chungloai" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($ck_chungloai_thietbi_edit->ten_chungloai->getPlaceHolder()) ?>" value="<?php echo $ck_chungloai_thietbi_edit->ten_chungloai->EditValue ?>"<?php echo $ck_chungloai_thietbi_edit->ten_chungloai->editAttributes() ?>>
</span>
<?php echo $ck_chungloai_thietbi_edit->ten_chungloai->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("ck_danhmuc_thietbi", explode(",", $ck_chungloai_thietbi->getCurrentDetailTable())) && $ck_danhmuc_thietbi->DetailEdit) {
?>
<?php if ($ck_chungloai_thietbi->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("ck_danhmuc_thietbi", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ck_danhmuc_thietbigrid.php" ?>
<?php } ?>
<?php if (!$ck_chungloai_thietbi_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ck_chungloai_thietbi_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ck_chungloai_thietbi_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ck_chungloai_thietbi_edit->showPageFooter();
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
$ck_chungloai_thietbi_edit->terminate();
?>