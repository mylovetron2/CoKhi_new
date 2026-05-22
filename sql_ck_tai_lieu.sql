-- Bảng lưu tài liệu đính kèm (link Google Drive) cho project CoKhi
-- Chạy trong database: diavatly_quanly

CREATE TABLE IF NOT EXISTS `ck_tai_lieu` (
    `id`             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `ten_bang`       VARCHAR(100) NOT NULL COMMENT 'Tên bảng gốc (vd: ck_don_hang)',
    `ban_ghi_id`     INT UNSIGNED NOT NULL COMMENT 'ID bản ghi trong bảng gốc',
    `ten_file`       VARCHAR(255) NOT NULL,
    `mo_ta`          VARCHAR(500) DEFAULT '',
    `web_link`       TEXT COMMENT 'Link xem trên Google Drive',
    `download_link`  TEXT COMMENT 'Link tải trực tiếp',
    `gdrive_file_id` VARCHAR(255) DEFAULT '' COMMENT 'Google Drive file ID',
    `nguoi_upload`   VARCHAR(100) DEFAULT '',
    `ngay_upload`    DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_bang_id` (`ten_bang`, `ban_ghi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Tài liệu đính kèm lưu trên Google Drive qua gdrive-cokhi';
