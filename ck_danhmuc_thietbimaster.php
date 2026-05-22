<?php
namespace PHPMaker2020\projectCoKhi;
?>
<?php if ($ck_danhmuc_thietbi->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_ck_danhmuc_thietbimaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($ck_danhmuc_thietbi->chung_loai_id->Visible) { // chung_loai_id ?>
		<tr id="r_chung_loai_id">
			<td class="<?php echo $ck_danhmuc_thietbi->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_thietbi->chung_loai_id->caption() ?></td>
			<td <?php echo $ck_danhmuc_thietbi->chung_loai_id->cellAttributes() ?>>
<span id="el_ck_danhmuc_thietbi_chung_loai_id">
<span<?php echo $ck_danhmuc_thietbi->chung_loai_id->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi->chung_loai_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_danhmuc_thietbi->ky_ma_hieu->Visible) { // ky_ma_hieu ?>
		<tr id="r_ky_ma_hieu">
			<td class="<?php echo $ck_danhmuc_thietbi->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_thietbi->ky_ma_hieu->caption() ?></td>
			<td <?php echo $ck_danhmuc_thietbi->ky_ma_hieu->cellAttributes() ?>>
<span id="el_ck_danhmuc_thietbi_ky_ma_hieu">
<span<?php echo $ck_danhmuc_thietbi->ky_ma_hieu->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi->ky_ma_hieu->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_danhmuc_thietbi->bo_phan->Visible) { // bo_phan ?>
		<tr id="r_bo_phan">
			<td class="<?php echo $ck_danhmuc_thietbi->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_thietbi->bo_phan->caption() ?></td>
			<td <?php echo $ck_danhmuc_thietbi->bo_phan->cellAttributes() ?>>
<span id="el_ck_danhmuc_thietbi_bo_phan">
<span<?php echo $ck_danhmuc_thietbi->bo_phan->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi->bo_phan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_danhmuc_thietbi->namsx->Visible) { // namsx ?>
		<tr id="r_namsx">
			<td class="<?php echo $ck_danhmuc_thietbi->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_thietbi->namsx->caption() ?></td>
			<td <?php echo $ck_danhmuc_thietbi->namsx->cellAttributes() ?>>
<span id="el_ck_danhmuc_thietbi_namsx">
<span<?php echo $ck_danhmuc_thietbi->namsx->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi->namsx->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_danhmuc_thietbi->ghi_chu->Visible) { // ghi_chu ?>
		<tr id="r_ghi_chu">
			<td class="<?php echo $ck_danhmuc_thietbi->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_thietbi->ghi_chu->caption() ?></td>
			<td <?php echo $ck_danhmuc_thietbi->ghi_chu->cellAttributes() ?>>
<span id="el_ck_danhmuc_thietbi_ghi_chu">
<span<?php echo $ck_danhmuc_thietbi->ghi_chu->viewAttributes() ?>><?php echo $ck_danhmuc_thietbi->ghi_chu->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>