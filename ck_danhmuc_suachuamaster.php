<?php
namespace PHPMaker2020\projectCoKhi;
?>
<?php if ($ck_danhmuc_suachua->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_ck_danhmuc_suachuamaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($ck_danhmuc_suachua->chuanloai_id->Visible) { // chuanloai_id ?>
		<tr id="r_chuanloai_id">
			<td class="<?php echo $ck_danhmuc_suachua->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_suachua->chuanloai_id->caption() ?></td>
			<td <?php echo $ck_danhmuc_suachua->chuanloai_id->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_chuanloai_id">
<span<?php echo $ck_danhmuc_suachua->chuanloai_id->viewAttributes() ?>><?php echo $ck_danhmuc_suachua->chuanloai_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua->thiet_bi_id->Visible) { // thiet_bi_id ?>
		<tr id="r_thiet_bi_id">
			<td class="<?php echo $ck_danhmuc_suachua->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_suachua->thiet_bi_id->caption() ?></td>
			<td <?php echo $ck_danhmuc_suachua->thiet_bi_id->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_thiet_bi_id">
<span<?php echo $ck_danhmuc_suachua->thiet_bi_id->viewAttributes() ?>><?php echo $ck_danhmuc_suachua->thiet_bi_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua->ngay_sua_chua->Visible) { // ngay_sua_chua ?>
		<tr id="r_ngay_sua_chua">
			<td class="<?php echo $ck_danhmuc_suachua->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_suachua->ngay_sua_chua->caption() ?></td>
			<td <?php echo $ck_danhmuc_suachua->ngay_sua_chua->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_ngay_sua_chua">
<span<?php echo $ck_danhmuc_suachua->ngay_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua->ngay_sua_chua->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua->noi_dung_sua_chua->Visible) { // noi_dung_sua_chua ?>
		<tr id="r_noi_dung_sua_chua">
			<td class="<?php echo $ck_danhmuc_suachua->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_suachua->noi_dung_sua_chua->caption() ?></td>
			<td <?php echo $ck_danhmuc_suachua->noi_dung_sua_chua->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_noi_dung_sua_chua">
<span<?php echo $ck_danhmuc_suachua->noi_dung_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua->noi_dung_sua_chua->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua->thoi_gian_sua_chua->Visible) { // thoi_gian_sua_chua ?>
		<tr id="r_thoi_gian_sua_chua">
			<td class="<?php echo $ck_danhmuc_suachua->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_suachua->thoi_gian_sua_chua->caption() ?></td>
			<td <?php echo $ck_danhmuc_suachua->thoi_gian_sua_chua->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_thoi_gian_sua_chua">
<span<?php echo $ck_danhmuc_suachua->thoi_gian_sua_chua->viewAttributes() ?>><?php echo $ck_danhmuc_suachua->thoi_gian_sua_chua->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua->nguoi_nhap_lieu->Visible) { // nguoi_nhap_lieu ?>
		<tr id="r_nguoi_nhap_lieu">
			<td class="<?php echo $ck_danhmuc_suachua->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_suachua->nguoi_nhap_lieu->caption() ?></td>
			<td <?php echo $ck_danhmuc_suachua->nguoi_nhap_lieu->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_nguoi_nhap_lieu">
<span<?php echo $ck_danhmuc_suachua->nguoi_nhap_lieu->viewAttributes() ?>><?php echo $ck_danhmuc_suachua->nguoi_nhap_lieu->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua->dich_vu->Visible) { // dich_vu ?>
		<tr id="r_dich_vu">
			<td class="<?php echo $ck_danhmuc_suachua->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_suachua->dich_vu->caption() ?></td>
			<td <?php echo $ck_danhmuc_suachua->dich_vu->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_dich_vu">
<span<?php echo $ck_danhmuc_suachua->dich_vu->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_dich_vu" class="custom-control-input" value="<?php echo $ck_danhmuc_suachua->dich_vu->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_danhmuc_suachua->dich_vu->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_dich_vu"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua->hoan_thanh->Visible) { // hoan_thanh ?>
		<tr id="r_hoan_thanh">
			<td class="<?php echo $ck_danhmuc_suachua->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_suachua->hoan_thanh->caption() ?></td>
			<td <?php echo $ck_danhmuc_suachua->hoan_thanh->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_hoan_thanh">
<span<?php echo $ck_danhmuc_suachua->hoan_thanh->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_hoan_thanh" class="custom-control-input" value="<?php echo $ck_danhmuc_suachua->hoan_thanh->getViewValue() ?>" disabled<?php if (ConvertToBool($ck_danhmuc_suachua->hoan_thanh->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_hoan_thanh"></label></div></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua->id_don_hang->Visible) { // id_don_hang ?>
		<tr id="r_id_don_hang">
			<td class="<?php echo $ck_danhmuc_suachua->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_suachua->id_don_hang->caption() ?></td>
			<td <?php echo $ck_danhmuc_suachua->id_don_hang->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_id_don_hang">
<span<?php echo $ck_danhmuc_suachua->id_don_hang->viewAttributes() ?>><?php echo $ck_danhmuc_suachua->id_don_hang->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($ck_danhmuc_suachua->ngay_hoan_thanh->Visible) { // ngay_hoan_thanh ?>
		<tr id="r_ngay_hoan_thanh">
			<td class="<?php echo $ck_danhmuc_suachua->TableLeftColumnClass ?>"><?php echo $ck_danhmuc_suachua->ngay_hoan_thanh->caption() ?></td>
			<td <?php echo $ck_danhmuc_suachua->ngay_hoan_thanh->cellAttributes() ?>>
<span id="el_ck_danhmuc_suachua_ngay_hoan_thanh">
<span<?php echo $ck_danhmuc_suachua->ngay_hoan_thanh->viewAttributes() ?>><?php echo $ck_danhmuc_suachua->ngay_hoan_thanh->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>