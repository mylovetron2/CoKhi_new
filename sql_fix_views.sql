-- ============================================================
-- Fix: Tạo lại các view bị hỏng trong database diavatly_quanly
-- Chạy trong MySQL Workbench hoặc phpMyAdmin
-- Database: diavatly_quanly
-- ============================================================

-- 1. Recreate view ck_view_nhatky
--    Tổng hợp nhật ký sửa chữa từ: ck_chitiet_suachua + ck_danhmuc_suachua + ck_don_hang
-- ------------------------------------------------------------
CREATE OR REPLACE VIEW `ck_view_nhatky` AS
SELECT
    ct.nhan_vien_id,
    dh.ngay_sua_chua,
    ct.thoi_gian,
    ct.noi_dung,
    ds.chuanloai_id,
    ds.thiet_bi_id,
    dh.so_don_hang_id,
    ds.ngay_hoan_thanh,
    dh.baoduong_dinhky
FROM ck_chitiet_suachua ct
INNER JOIN ck_danhmuc_suachua ds ON ct.sua_chua_id = ds.sua_chua_id
INNER JOIN ck_don_hang dh        ON ds.id_don_hang = dh.id;


-- 2. Recreate view ck_view_nhan_vien_ck (nếu cũng bị lỗi)
--    Danh sách nhân viên cơ khí
-- ------------------------------------------------------------
-- CREATE OR REPLACE VIEW `ck_view_nhan_vien_ck` AS
-- SELECT nhan_vien_id, danh_so, ten_nhan_vien, chuc_danh, nhom_nhan_vien_id
-- FROM nhan_vien;
-- (Bỏ comment dòng trên nếu view này cũng bị lỗi)


-- ============================================================
-- Kiểm tra sau khi tạo:
--   SELECT * FROM ck_view_nhatky LIMIT 10;
-- ============================================================
