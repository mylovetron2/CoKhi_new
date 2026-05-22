<?php
/**
 * Cấu hình kết nối tới gdrive-cokhi
 * File này không commit lên git
 */

// URL của project gdrive-cokhi
define('GDRIVE_COKHI_API_URL', 'https://diavatly.cloud/gdrive-cokhi/api/external-upload.php');

// API key (phải khớp với EXTERNAL_API_KEY trong gdrive-cokhi/config/config.local.php)
define('GDRIVE_COKHI_API_KEY', 'ck-ext-7f3a9b2e1d4c8f6a0e5b3d7c9a2f1e4b');

// Folder mặc định trong gdrive-cokhi (null = root, hoặc set ID thư mục Cơ Khí)
define('GDRIVE_COKHI_DEFAULT_FOLDER', null);
