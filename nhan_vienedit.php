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
$nhan_vien_edit = new nhan_vien_edit();

// Run the page
$nhan_vien_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$nhan_vien_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fnhan_vienedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fnhan_vienedit = currentForm = new ew.Form("fnhan_vienedit", "edit");

	// Validate form
	fnhan_vienedit.validate = function() {
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
			<?php if ($nhan_vien_edit->danh_so->Required) { ?>
				elm = this.getElements("x" + infix + "_danh_so");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_edit->danh_so->caption(), $nhan_vien_edit->danh_so->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_edit->ten_nhan_vien->Required) { ?>
				elm = this.getElements("x" + infix + "_ten_nhan_vien");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_edit->ten_nhan_vien->caption(), $nhan_vien_edit->ten_nhan_vien->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_edit->chuc_danh->Required) { ?>
				elm = this.getElements("x" + infix + "_chuc_danh");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_edit->chuc_danh->caption(), $nhan_vien_edit->chuc_danh->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nhan_vien_edit->_userlevel->Required) { ?>
				elm = this.getElements("x" + infix + "__userlevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nhan_vien_edit->_userlevel->caption(), $nhan_vien_edit->_userlevel->RequiredErrorMessage)) ?>");
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
	fnhan_vienedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fnhan_vienedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fnhan_vienedit.lists["x__userlevel"] = <?php echo $nhan_vien_edit->_userlevel->Lookup->toClientList($nhan_vien_edit) ?>;
	fnhan_vienedit.lists["x__userlevel"].options = <?php echo JsonEncode($nhan_vien_edit->_userlevel->lookupOptions()) ?>;
	loadjs.done("fnhan_vienedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $nhan_vien_edit->showPageHeader(); ?>
<?php
$nhan_vien_edit->showMessage();
?>
<form name="fnhan_vienedit" id="fnhan_vienedit" class="<?php echo $nhan_vien_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="nhan_vien">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$nhan_vien_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($nhan_vien_edit->danh_so->Visible) { // danh_so ?>
	<div id="r_danh_so" class="form-group row">
		<label id="elh_nhan_vien_danh_so" for="x_danh_so" class="<?php echo $nhan_vien_edit->LeftColumnClass ?>"><?php echo $nhan_vien_edit->danh_so->caption() ?><?php echo $nhan_vien_edit->danh_so->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $nhan_vien_edit->RightColumnClass ?>"><div <?php echo $nhan_vien_edit->danh_so->cellAttributes() ?>>
<span id="el_nhan_vien_danh_so">
<span<?php echo $nhan_vien_edit->danh_so->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($nhan_vien_edit->danh_so->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="nhan_vien" data-field="x_danh_so" name="x_danh_so" id="x_danh_so" value="<?php echo HtmlEncode($nhan_vien_edit->danh_so->CurrentValue) ?>">
<?php echo $nhan_vien_edit->danh_so->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($nhan_vien_edit->ten_nhan_vien->Visible) { // ten_nhan_vien ?>
	<div id="r_ten_nhan_vien" class="form-group row">
		<label id="elh_nhan_vien_ten_nhan_vien" for="x_ten_nhan_vien" class="<?php echo $nhan_vien_edit->LeftColumnClass ?>"><?php echo $nhan_vien_edit->ten_nhan_vien->caption() ?><?php echo $nhan_vien_edit->ten_nhan_vien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $nhan_vien_edit->RightColumnClass ?>"><div <?php echo $nhan_vien_edit->ten_nhan_vien->cellAttributes() ?>>
<span id="el_nhan_vien_ten_nhan_vien">
<span<?php echo $nhan_vien_edit->ten_nhan_vien->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($nhan_vien_edit->ten_nhan_vien->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="nhan_vien" data-field="x_ten_nhan_vien" name="x_ten_nhan_vien" id="x_ten_nhan_vien" value="<?php echo HtmlEncode($nhan_vien_edit->ten_nhan_vien->CurrentValue) ?>">
<?php echo $nhan_vien_edit->ten_nhan_vien->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($nhan_vien_edit->chuc_danh->Visible) { // chuc_danh ?>
	<div id="r_chuc_danh" class="form-group row">
		<label id="elh_nhan_vien_chuc_danh" for="x_chuc_danh" class="<?php echo $nhan_vien_edit->LeftColumnClass ?>"><?php echo $nhan_vien_edit->chuc_danh->caption() ?><?php echo $nhan_vien_edit->chuc_danh->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $nhan_vien_edit->RightColumnClass ?>"><div <?php echo $nhan_vien_edit->chuc_danh->cellAttributes() ?>>
<span id="el_nhan_vien_chuc_danh">
<input type="text" data-table="nhan_vien" data-field="x_chuc_danh" name="x_chuc_danh" id="x_chuc_danh" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($nhan_vien_edit->chuc_danh->getPlaceHolder()) ?>" value="<?php echo $nhan_vien_edit->chuc_danh->EditValue ?>"<?php echo $nhan_vien_edit->chuc_danh->editAttributes() ?>>
</span>
<?php echo $nhan_vien_edit->chuc_danh->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($nhan_vien_edit->_userlevel->Visible) { // userlevel ?>
	<div id="r__userlevel" class="form-group row">
		<label id="elh_nhan_vien__userlevel" for="x__userlevel" class="<?php echo $nhan_vien_edit->LeftColumnClass ?>"><?php echo $nhan_vien_edit->_userlevel->caption() ?><?php echo $nhan_vien_edit->_userlevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $nhan_vien_edit->RightColumnClass ?>"><div <?php echo $nhan_vien_edit->_userlevel->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_nhan_vien__userlevel">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($nhan_vien_edit->_userlevel->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_nhan_vien__userlevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="nhan_vien" data-field="x__userlevel" data-value-separator="<?php echo $nhan_vien_edit->_userlevel->displayValueSeparatorAttribute() ?>" id="x__userlevel" name="x__userlevel"<?php echo $nhan_vien_edit->_userlevel->editAttributes() ?>>
			<?php echo $nhan_vien_edit->_userlevel->selectOptionListHtml("x__userlevel") ?>
		</select>
</div>
<?php echo $nhan_vien_edit->_userlevel->Lookup->getParamTag($nhan_vien_edit, "p_x__userlevel") ?>
</span>
<?php } ?>
<?php echo $nhan_vien_edit->_userlevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
	<input type="hidden" data-table="nhan_vien" data-field="x_nhan_vien_id" name="x_nhan_vien_id" id="x_nhan_vien_id" value="<?php echo HtmlEncode($nhan_vien_edit->nhan_vien_id->CurrentValue) ?>">
<?php if (!$nhan_vien_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $nhan_vien_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $nhan_vien_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$nhan_vien_edit->showPageFooter();
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
$nhan_vien_edit->terminate();
?>