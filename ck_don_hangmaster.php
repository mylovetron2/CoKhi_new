<?php
namespace PHPMaker2020\projectCoKhi;
?>
<?php if ($ck_don_hang->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_ck_don_hangmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($ck_don_hang->so_don_hang_id->Visible) { // so_don_hang_id ?>
		<tr id="r_so_don_hang_id">
			<td class="<?php echo $ck_don_hang->TableLeftColumnClass ?>"><?php echo $ck_don_hang->so_don_hang_id->caption() ?></td>
			<td <?php echo $ck_don_hang->so_don_hang_id->cellAttributes() ?>>
<span id="el_ck_don_hang_so_don_hang_id">
<span<?php echo $ck_don_hang->so_don_hang_id->viewAttributes() ?>><?php echo $ck_don_hang->so_don_hang_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_don_hang->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<tr id="r_ngay_sua_chua">
			<td class="<?php echo $ck_don_hang->TableLeftColumnClass ?>"><?php echo $ck_don_hang->ngay_sua_chua->caption() ?></td>
			<td <?php echo $ck_don_hang->ngay_sua_chua->cellAttributes() ?>>
<span id="el_ck_don_hang_ngay_sua_chua">
<span<?php echo $ck_don_hang->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_don_hang->ngay_sua_chua->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_don_hang->chung_loai->Visible) { // chung_loai ?>
		<tr id="r_chung_loai">
			<td class="<?php echo $ck_don_hang->TableLeftColumnClass ?>"><?php echo $ck_don_hang->chung_loai->caption() ?></td>
			<td <?php echo $ck_don_hang->chung_loai->cellAttributes() ?>>
<span id="el_ck_don_hang_chung_loai">
<span<?php echo $ck_don_hang->chung_loai->viewAttributes() ?>><?php echo $ck_don_hang->chung_loai->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_don_hang->ten_thiet_bi->Visible) { // ten_thiet_bi ?>
		<tr id="r_ten_thiet_bi">
			<td class="<?php echo $ck_don_hang->TableLeftColumnClass ?>"><?php echo $ck_don_hang->ten_thiet_bi->caption() ?></td>
			<td <?php echo $ck_don_hang->ten_thiet_bi->cellAttributes() ?>>
<span id="el_ck_don_hang_ten_thiet_bi">
<span<?php echo $ck_don_hang->ten_thiet_bi->viewAttributes() ?>><?php echo $ck_don_hang->ten_thiet_bi->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_don_hang->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
		<tr id="r_noi_dung_sua_chua">
			<td class="<?php echo $ck_don_hang->TableLeftColumnClass ?>"><?php echo $ck_don_hang->noi_dung_sua_chua->caption() ?></td>
			<td <?php echo $ck_don_hang->noi_dung_sua_chua->cellAttributes() ?>>
<span id="el_ck_don_hang_noi_dung_sua_chua">
<span<?php echo $ck_don_hang->noi_dung_sua_chua->viewAttributes() ?>><?php echo $ck_don_hang->noi_dung_sua_chua->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_don_hang->baoduong_dinhky->Visible) { // baoduong_dinhky ?>
		<tr id="r_baoduong_dinhky">
			<td class="<?php echo $ck_don_hang->TableLeftColumnClass ?>"><?php echo $ck_don_hang->baoduong_dinhky->caption() ?></td>
			<td <?php echo $ck_don_hang->baoduong_dinhky->cellAttributes() ?>>
<span id="el_ck_don_hang_baoduong_dinhky">
<span<?php echo $ck_don_hang->baoduong_dinhky->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_baoduong_dinhky" class="custom-control-input" value="<?php echo $ck_don_hang->baoduong_dinhky->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_don_hang->baoduong_dinhky->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_baoduong_dinhky"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>