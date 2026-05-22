<?php
namespace PHPMaker2020\projectCoKhi;
?>
<?php if ($ck_chungloai_thietbi->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_ck_chungloai_thietbimaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($ck_chungloai_thietbi->chungloai_id->Visible) { // chungloai_id ?>
		<tr id="r_chungloai_id">
			<td class="<?php echo $ck_chungloai_thietbi->TableLeftColumnClass ?>"><?php echo $ck_chungloai_thietbi->chungloai_id->caption() ?></td>
			<td <?php echo $ck_chungloai_thietbi->chungloai_id->cellAttributes() ?>>
<span id="el_ck_chungloai_thietbi_chungloai_id">
<span<?php echo $ck_chungloai_thietbi->chungloai_id->viewAttributes() ?>><?php echo $ck_chungloai_thietbi->chungloai_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_chungloai_thietbi->ten_chungloai->Visible) { // ten_chungloai ?>
		<tr id="r_ten_chungloai">
			<td class="<?php echo $ck_chungloai_thietbi->TableLeftColumnClass ?>"><?php echo $ck_chungloai_thietbi->ten_chungloai->caption() ?></td>
			<td <?php echo $ck_chungloai_thietbi->ten_chungloai->cellAttributes() ?>>
<span id="el_ck_chungloai_thietbi_ten_chungloai">
<span<?php echo $ck_chungloai_thietbi->ten_chungloai->viewAttributes() ?>><?php echo $ck_chungloai_thietbi->ten_chungloai->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>