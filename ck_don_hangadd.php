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
$ck_don_hang_add = new ck_don_hang_add();

// Run the page
$ck_don_hang_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ck_don_hang_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fck_don_hangadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fck_don_hangadd = currentForm = new ew.Form("fck_don_hangadd", "add");

	// Validate form
	fck_don_hangadd.validate = function() {
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
			<?php if ($ck_don_hang_add->so_don_hang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_so_don_hang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_don_hang_add->so_don_hang_id->caption(), $ck_don_hang_add->so_don_hang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_don_hang_add->ngay_sua_chua->Required) { ?>
				elm = this.getElements("x" + infix + "_ngay_sua_chua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_don_hang_add->ngay_sua_chua->caption(), $ck_don_hang_add->ngay_sua_chua->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ngay_sua_chua");
				if (elm && !ew.checkShortEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_don_hang_add->ngay_sua_chua->errorMessage()) ?>");
			<?php if ($ck_don_hang_add->noi_dung_sua_chua->Required) { ?>
				elm = this.getElements("x" + infix + "_noi_dung_sua_chua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_don_hang_add->noi_dung_sua_chua->caption(), $ck_don_hang_add->noi_dung_sua_chua->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_don_hang_add->nguoi_nhap_lieu->Required) { ?>
				elm = this.getElements("x" + infix + "_nguoi_nhap_lieu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_don_hang_add->nguoi_nhap_lieu->caption(), $ck_don_hang_add->nguoi_nhap_lieu->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_don_hang_add->dich_vu->Required) { ?>
				elm = this.getElements("x" + infix + "_dich_vu[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_don_hang_add->dich_vu->caption(), $ck_don_hang_add->dich_vu->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_don_hang_add->baoduong_dinhky->Required) { ?>
				elm = this.getElements("x" + infix + "_baoduong_dinhky[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_don_hang_add->baoduong_dinhky->caption(), $ck_don_hang_add->baoduong_dinhky->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_don_hang_add->hoan_thanh->Required) { ?>
				elm = this.getElements("x" + infix + "_hoan_thanh[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_don_hang_add->hoan_thanh->caption(), $ck_don_hang_add->hoan_thanh->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_don_hang_add->ghi_chu->Required) { ?>
				elm = this.getElements("x" + infix + "_ghi_chu");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_don_hang_add->ghi_chu->caption(), $ck_don_hang_add->ghi_chu->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ck_don_hang_add->updated_at->Required) { ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ck_don_hang_add->updated_at->caption(), $ck_don_hang_add->updated_at->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_updated_at");
				if (elm && !ew.checkShortEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ck_don_hang_add->updated_at->errorMessage()) ?>");

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
	fck_don_hangadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fck_don_hangadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fck_don_hangadd.lists["x_nguoi_nhap_lieu"] = <?php echo $ck_don_hang_add->nguoi_nhap_lieu->Lookup->toClientList($ck_don_hang_add) ?>;
	fck_don_hangadd.lists["x_nguoi_nhap_lieu"].options = <?php echo JsonEncode($ck_don_hang_add->nguoi_nhap_lieu->lookupOptions()) ?>;
	fck_don_hangadd.lists["x_dich_vu[]"] = <?php echo $ck_don_hang_add->dich_vu->Lookup->toClientList($ck_don_hang_add) ?>;
	fck_don_hangadd.lists["x_dich_vu[]"].options = <?php echo JsonEncode($ck_don_hang_add->dich_vu->options(FALSE, TRUE)) ?>;
	fck_don_hangadd.lists["x_baoduong_dinhky[]"] = <?php echo $ck_don_hang_add->baoduong_dinhky->Lookup->toClientList($ck_don_hang_add) ?>;
	fck_don_hangadd.lists["x_baoduong_dinhky[]"].options = <?php echo JsonEncode($ck_don_hang_add->baoduong_dinhky->options(FALSE, TRUE)) ?>;
	fck_don_hangadd.lists["x_hoan_thanh[]"] = <?php echo $ck_don_hang_add->hoan_thanh->Lookup->toClientList($ck_don_hang_add) ?>;
	fck_don_hangadd.lists["x_hoan_thanh[]"].options = <?php echo JsonEncode($ck_don_hang_add->hoan_thanh->options(FALSE, TRUE)) ?>;
	loadjs.done("fck_don_hangadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ck_don_hang_add->showPageHeader(); ?>
<?php
$ck_don_hang_add->showMessage();
?>
<form name="fck_don_hangadd" id="fck_don_hangadd" class="<?php echo $ck_don_hang_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ck_don_hang">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ck_don_hang_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($ck_don_hang_add->so_don_hang_id->Visible) { // so_don_hang_id ?>
	<div id="r_so_don_hang_id" class="form-group row">
		<label id="elh_ck_don_hang_so_don_hang_id" for="x_so_don_hang_id" class="<?php echo $ck_don_hang_add->LeftColumnClass ?>"><?php echo $ck_don_hang_add->so_don_hang_id->caption() ?><?php echo $ck_don_hang_add->so_don_hang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_don_hang_add->RightColumnClass ?>"><div <?php echo $ck_don_hang_add->so_don_hang_id->cellAttributes() ?>>
<span id="el_ck_don_hang_so_don_hang_id">
<input type="text" data-table="ck_don_hang" data-field="x_so_don_hang_id" name="x_so_don_hang_id" id="x_so_don_hang_id" size="30" maxlength="110" placeholder="<?php echo HtmlEncode($ck_don_hang_add->so_don_hang_id->getPlaceHolder()) ?>" value="<?php echo $ck_don_hang_add->so_don_hang_id->EditValue ?>"<?php echo $ck_don_hang_add->so_don_hang_id->editAttributes() ?>>
</span>
<?php echo $ck_don_hang_add->so_don_hang_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_don_hang_add->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
	<div id="r_ngay_sua_chua" class="form-group row">
		<label id="elh_ck_don_hang_ngay_sua_chua" for="x_ngay_sua_chua" class="<?php echo $ck_don_hang_add->LeftColumnClass ?>"><?php echo $ck_don_hang_add->ngay_sua_chua->caption() ?><?php echo $ck_don_hang_add->ngay_sua_chua->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_don_hang_add->RightColumnClass ?>"><div <?php echo $ck_don_hang_add->ngay_sua_chua->cellAttributes() ?>>
<span id="el_ck_don_hang_ngay_sua_chua">
<input type="text" data-table="ck_don_hang" data-field="x_ngay_sua_chua" data-format="14" name="x_ngay_sua_chua" id="x_ngay_sua_chua" maxlength="10" placeholder="<?php echo HtmlEncode($ck_don_hang_add->ngay_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_don_hang_add->ngay_sua_chua->EditValue ?>"<?php echo $ck_don_hang_add->ngay_sua_chua->editAttributes() ?>>
<?php if (!$ck_don_hang_add->ngay_sua_chua->ReadOnly && !$ck_don_hang_add->ngay_sua_chua->Disabled && !isset($ck_don_hang_add->ngay_sua_chua->EditAttrs["readonly"]) && !isset($ck_don_hang_add->ngay_sua_chua->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_don_hangadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_don_hangadd", "x_ngay_sua_chua", {"ignoreReadonly":true,"useCurrent":false,"format":14});
});
</script>
<?php } ?>
</span>
<?php echo $ck_don_hang_add->ngay_sua_chua->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_don_hang_add->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
	<div id="r_noi_dung_sua_chua" class="form-group row">
		<label id="elh_ck_don_hang_noi_dung_sua_chua" for="x_noi_dung_sua_chua" class="<?php echo $ck_don_hang_add->LeftColumnClass ?>"><?php echo $ck_don_hang_add->noi_dung_sua_chua->caption() ?><?php echo $ck_don_hang_add->noi_dung_sua_chua->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_don_hang_add->RightColumnClass ?>"><div <?php echo $ck_don_hang_add->noi_dung_sua_chua->cellAttributes() ?>>
<span id="el_ck_don_hang_noi_dung_sua_chua">
<input type="text" data-table="ck_don_hang" data-field="x_noi_dung_sua_chua" name="x_noi_dung_sua_chua" id="x_noi_dung_sua_chua" size="100" maxlength="500" placeholder="<?php echo HtmlEncode($ck_don_hang_add->noi_dung_sua_chua->getPlaceHolder()) ?>" value="<?php echo $ck_don_hang_add->noi_dung_sua_chua->EditValue ?>"<?php echo $ck_don_hang_add->noi_dung_sua_chua->editAttributes() ?>>
</span>
<?php echo $ck_don_hang_add->noi_dung_sua_chua->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_don_hang_add->nguoi_nhap_lieu->Visible) { // nguoi_nhap_lieu ?>
	<div id="r_nguoi_nhap_lieu" class="form-group row">
		<label id="elh_ck_don_hang_nguoi_nhap_lieu" for="x_nguoi_nhap_lieu" class="<?php echo $ck_don_hang_add->LeftColumnClass ?>"><?php echo $ck_don_hang_add->nguoi_nhap_lieu->caption() ?><?php echo $ck_don_hang_add->nguoi_nhap_lieu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_don_hang_add->RightColumnClass ?>"><div <?php echo $ck_don_hang_add->nguoi_nhap_lieu->cellAttributes() ?>>
<span id="el_ck_don_hang_nguoi_nhap_lieu">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ck_don_hang" data-field="x_nguoi_nhap_lieu" data-value-separator="<?php echo $ck_don_hang_add->nguoi_nhap_lieu->displayValueSeparatorAttribute() ?>" id="x_nguoi_nhap_lieu" name="x_nguoi_nhap_lieu"<?php echo $ck_don_hang_add->nguoi_nhap_lieu->editAttributes() ?>>
			<?php echo $ck_don_hang_add->nguoi_nhap_lieu->selectOptionListHtml("x_nguoi_nhap_lieu") ?>
		</select>
</div>
<?php echo $ck_don_hang_add->nguoi_nhap_lieu->Lookup->getParamTag($ck_don_hang_add, "p_x_nguoi_nhap_lieu") ?>
</span>
<?php echo $ck_don_hang_add->nguoi_nhap_lieu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_don_hang_add->dich_vu->Visible) { // dich_vu ?>
	<div id="r_dich_vu" class="form-group row">
		<label id="elh_ck_don_hang_dich_vu" class="<?php echo $ck_don_hang_add->LeftColumnClass ?>"><?php echo $ck_don_hang_add->dich_vu->caption() ?><?php echo $ck_don_hang_add->dich_vu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_don_hang_add->RightColumnClass ?>"><div <?php echo $ck_don_hang_add->dich_vu->cellAttributes() ?>>
<span id="el_ck_don_hang_dich_vu">
<?php
$selwrk = ConvertToBool($ck_don_hang_add->dich_vu->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ck_don_hang" data-field="x_dich_vu" name="x_dich_vu[]" id="x_dich_vu[]_351978" value="1"<?php echo $selwrk ?><?php echo $ck_don_hang_add->dich_vu->editAttributes() ?>>
	<label class="custom-control-label" for="x_dich_vu[]_351978"></label>
</div>
</span>
<?php echo $ck_don_hang_add->dich_vu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_don_hang_add->baoduong_dinhky->Visible) { // baoduong_dinhky ?>
	<div id="r_baoduong_dinhky" class="form-group row">
		<label id="elh_ck_don_hang_baoduong_dinhky" class="<?php echo $ck_don_hang_add->LeftColumnClass ?>"><?php echo $ck_don_hang_add->baoduong_dinhky->caption() ?><?php echo $ck_don_hang_add->baoduong_dinhky->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_don_hang_add->RightColumnClass ?>"><div <?php echo $ck_don_hang_add->baoduong_dinhky->cellAttributes() ?>>
<span id="el_ck_don_hang_baoduong_dinhky">
<?php
$selwrk = ConvertToBool($ck_don_hang_add->baoduong_dinhky->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ck_don_hang" data-field="x_baoduong_dinhky" name="x_baoduong_dinhky[]" id="x_baoduong_dinhky[]_130562" value="1"<?php echo $selwrk ?><?php echo $ck_don_hang_add->baoduong_dinhky->editAttributes() ?>>
	<label class="custom-control-label" for="x_baoduong_dinhky[]_130562"></label>
</div>
</span>
<?php echo $ck_don_hang_add->baoduong_dinhky->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_don_hang_add->hoan_thanh->Visible) { // hoan_thanh ?>
	<div id="r_hoan_thanh" class="form-group row">
		<label id="elh_ck_don_hang_hoan_thanh" class="<?php echo $ck_don_hang_add->LeftColumnClass ?>"><?php echo $ck_don_hang_add->hoan_thanh->caption() ?><?php echo $ck_don_hang_add->hoan_thanh->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_don_hang_add->RightColumnClass ?>"><div <?php echo $ck_don_hang_add->hoan_thanh->cellAttributes() ?>>
<span id="el_ck_don_hang_hoan_thanh">
<?php
$selwrk = ConvertToBool($ck_don_hang_add->hoan_thanh->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ck_don_hang" data-field="x_hoan_thanh" name="x_hoan_thanh[]" id="x_hoan_thanh[]_647284" value="1"<?php echo $selwrk ?><?php echo $ck_don_hang_add->hoan_thanh->editAttributes() ?>>
	<label class="custom-control-label" for="x_hoan_thanh[]_647284"></label>
</div>
</span>
<?php echo $ck_don_hang_add->hoan_thanh->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_don_hang_add->ghi_chu->Visible) { // ghi_chu ?>
	<div id="r_ghi_chu" class="form-group row">
		<label id="elh_ck_don_hang_ghi_chu" for="x_ghi_chu" class="<?php echo $ck_don_hang_add->LeftColumnClass ?>"><?php echo $ck_don_hang_add->ghi_chu->caption() ?><?php echo $ck_don_hang_add->ghi_chu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_don_hang_add->RightColumnClass ?>"><div <?php echo $ck_don_hang_add->ghi_chu->cellAttributes() ?>>
<span id="el_ck_don_hang_ghi_chu">
<textarea data-table="ck_don_hang" data-field="x_ghi_chu" name="x_ghi_chu" id="x_ghi_chu" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ck_don_hang_add->ghi_chu->getPlaceHolder()) ?>"<?php echo $ck_don_hang_add->ghi_chu->editAttributes() ?>><?php echo $ck_don_hang_add->ghi_chu->EditValue ?></textarea>
</span>
<?php echo $ck_don_hang_add->ghi_chu->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ck_don_hang_add->updated_at->Visible) { // updated_at ?>
	<div id="r_updated_at" class="form-group row">
		<label id="elh_ck_don_hang_updated_at" for="x_updated_at" class="<?php echo $ck_don_hang_add->LeftColumnClass ?>"><?php echo $ck_don_hang_add->updated_at->caption() ?><?php echo $ck_don_hang_add->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ck_don_hang_add->RightColumnClass ?>"><div <?php echo $ck_don_hang_add->updated_at->cellAttributes() ?>>
<span id="el_ck_don_hang_updated_at">
<input type="text" data-table="ck_don_hang" data-field="x_updated_at" data-format="17" name="x_updated_at" id="x_updated_at" maxlength="19" placeholder="<?php echo HtmlEncode($ck_don_hang_add->updated_at->getPlaceHolder()) ?>" value="<?php echo $ck_don_hang_add->updated_at->EditValue ?>"<?php echo $ck_don_hang_add->updated_at->editAttributes() ?>>
<?php if (!$ck_don_hang_add->updated_at->ReadOnly && !$ck_don_hang_add->updated_at->Disabled && !isset($ck_don_hang_add->updated_at->EditAttrs["readonly"]) && !isset($ck_don_hang_add->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fck_don_hangadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fck_don_hangadd", "x_updated_at", {"ignoreReadonly":true,"useCurrent":false,"format":17});
});
</script>
<?php } ?>
</span>
<?php echo $ck_don_hang_add->updated_at->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("ck_danhmuc_suachua", explode(",", $ck_don_hang->getCurrentDetailTable())) && $ck_danhmuc_suachua->DetailAdd) {
?>
<?php if ($ck_don_hang->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("ck_danhmuc_suachua", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ck_danhmuc_suachuagrid.php" ?>
<?php } ?>
<?php if (!$ck_don_hang_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ck_don_hang_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ck_don_hang_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ck_don_hang_add->showPageFooter();
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
$ck_don_hang_add->terminate();
?>