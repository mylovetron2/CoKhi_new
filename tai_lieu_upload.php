<?php
/**
 * Trang quản lý tài liệu đính kèm (upload lên Google Drive qua gdrive-cokhi)
 *
 * Cách dùng — link từ bất kỳ trang nào:
 *   <a href="tai_lieu_upload.php?bang=ck_don_hang&id=123">📎 Tài liệu</a>
 *
 * GET params:
 *   bang  - tên bảng (ck_don_hang, ck_danhmuc_thietbi, ...)
 *   id    - ID bản ghi
 */

require_once 'db.php';
require_once 'config_gdrive.php';
require_once 'classes/GDriveCoKhiUpload.php';

session_start();

$tenBang  = trim($_GET['bang'] ?? '');
$banGhiId = (int)($_GET['id'] ?? 0);

// Whitelist các bảng được phép gắn tài liệu
$bangChoPhep = ['ck_don_hang', 'ck_danhmuc_thietbi', 'ck_chitiet_suachua', 'ck_danhmuc_suachua'];

if (!$tenBang || !$banGhiId || !in_array($tenBang, $bangChoPhep, true)) {
    die('<div style="font-family:sans-serif;padding:30px;color:red">❌ Thiếu hoặc sai tham số (bang, id)</div>');
}

$gdrive  = new GDriveCoKhiUpload();
$message = '';
$msgType = '';

// ----------------------------------------------------------------
// Xử lý xóa file
// ----------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $delId = (int)($_POST['tai_lieu_id'] ?? 0);
    if ($delId) {
        $stmt = mysqli_prepare($conn, "DELETE FROM ck_tai_lieu WHERE id = ? AND ten_bang = ? AND ban_ghi_id = ?");
        mysqli_stmt_bind_param($stmt, 'isi', $delId, $tenBang, $banGhiId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $message = 'Đã xóa tài liệu.';
        $msgType = 'warning';
    }
}

// ----------------------------------------------------------------
// Xử lý upload
// ----------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $description  = trim($_POST['description'] ?? '');
    $nguoiUpload  = trim($_POST['nguoi_upload'] ?? 'user');

    $result = $gdrive->upload($_FILES['file'], null, $description, $nguoiUpload);

    if ($result['success']) {
        $saved = $gdrive->saveToDb(
            $conn,
            $tenBang,
            $banGhiId,
            $_FILES['file']['name'],
            $description,
            $result['web_link'] ?? '',
            $result['download_link'] ?? '',
            $result['gdrive_file_id'] ?? '',
            $nguoiUpload
        );
        $message = $saved ? '✔ Upload thành công! File đã được lưu lên Google Drive.' : '✔ Upload OK nhưng không lưu được vào DB.';
        $msgType = 'success';
    } else {
        $message = '✖ Lỗi: ' . ($result['message'] ?? 'Không rõ lỗi');
        $msgType = 'danger';
    }
}

// ----------------------------------------------------------------
// Lấy danh sách file hiện có
// ----------------------------------------------------------------
$danhSachFile = $gdrive->getFiles($conn, $tenBang, $banGhiId);

// Label hiển thị cho tên bảng
$labelBang = [
    'ck_don_hang'          => 'Đơn hàng sửa chữa',
    'ck_danhmuc_thietbi'   => 'Thiết bị',
    'ck_chitiet_suachua'   => 'Chi tiết sửa chữa',
    'ck_danhmuc_suachua'   => 'Danh mục sửa chữa',
];
$tenHienThi = ($labelBang[$tenBang] ?? $tenBang) . ' #' . $banGhiId;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tài liệu đính kèm – <?= htmlspecialchars($tenHienThi) ?></title>
    <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <style>
        body { background: #f4f6f9; font-family: 'Source Sans Pro', sans-serif; }
        .card { border-radius: 8px; }
        .table th { background: #343a40; color: #fff; }
        .file-icon { font-size: 1.3rem; }
    </style>
</head>
<body>
<div class="container mt-4 mb-5">

    <!-- Tiêu đề -->
    <div class="d-flex align-items-center mb-3">
        <button onclick="history.back()" class="btn btn-sm btn-secondary mr-3">
            <i class="fas fa-arrow-left"></i> Quay lại
        </button>
        <h4 class="mb-0"><i class="fas fa-paperclip text-primary mr-2"></i>Tài liệu đính kèm</h4>
        <span class="badge badge-info ml-2"><?= htmlspecialchars($tenHienThi) ?></span>
    </div>

    <?php if ($message): ?>
    <div class="alert alert-<?= $msgType ?> alert-dismissible fade show">
        <?= htmlspecialchars($message) ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
    <?php endif; ?>

    <div class="row">
        <!-- Form upload -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-cloud-upload-alt mr-1"></i> Upload tài liệu mới
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="formUpload">
                        <div class="form-group">
                            <label>Chọn file <span class="text-danger">*</span></label>
                            <input type="file" name="file" id="fileInput" class="form-control-file" required>
                            <small class="text-muted">PDF, Word, Excel, ảnh... (tối đa 100MB)</small>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <input type="text" name="description" class="form-control" placeholder="Nhập mô tả ngắn...">
                        </div>
                        <div class="form-group">
                            <label>Người upload</label>
                            <input type="text" name="nguoi_upload" class="form-control"
                                   value="<?= htmlspecialchars($_SESSION['username'] ?? '') ?>"
                                   placeholder="Tên của bạn">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" id="btnUpload">
                            <i class="fas fa-upload mr-1"></i> Upload lên Google Drive
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Danh sách file -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-folder-open mr-1"></i> Danh sách tài liệu</span>
                    <span class="badge badge-light"><?= count($danhSachFile) ?> file</span>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($danhSachFile)): ?>
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-2x mb-2"></i><br>Chưa có tài liệu nào
                    </div>
                    <?php else: ?>
                    <div class="table-responsive">
                    <table class="table table-hover table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Tên file</th>
                                <th>Mô tả</th>
                                <th>Người upload</th>
                                <th>Ngày</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($danhSachFile as $f): ?>
                            <tr>
                                <td>
                                    <?php
                                    $ext = strtolower(pathinfo($f['ten_file'], PATHINFO_EXTENSION));
                                    $icons = ['pdf'=>'fa-file-pdf text-danger','doc'=>'fa-file-word text-primary',
                                              'docx'=>'fa-file-word text-primary','xls'=>'fa-file-excel text-success',
                                              'xlsx'=>'fa-file-excel text-success','png'=>'fa-file-image text-info',
                                              'jpg'=>'fa-file-image text-info','jpeg'=>'fa-file-image text-info',
                                              'zip'=>'fa-file-archive text-warning','rar'=>'fa-file-archive text-warning'];
                                    $icon = $icons[$ext] ?? 'fa-file text-secondary';
                                    ?>
                                    <i class="fas <?= $icon ?> file-icon mr-1"></i>
                                    <span title="<?= htmlspecialchars($f['ten_file']) ?>">
                                        <?= htmlspecialchars(mb_strimwidth($f['ten_file'], 0, 30, '...')) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($f['mo_ta'] ?? '') ?></td>
                                <td><?= htmlspecialchars($f['nguoi_upload'] ?? '') ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($f['ngay_upload'])) ?></td>
                                <td>
                                    <?php if ($f['web_link']): ?>
                                    <a href="<?= htmlspecialchars($f['web_link']) ?>" target="_blank"
                                       class="btn btn-xs btn-info" title="Xem">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <?php endif; ?>
                                    <?php if ($f['download_link']): ?>
                                    <a href="<?= htmlspecialchars($f['download_link']) ?>" target="_blank"
                                       class="btn btn-xs btn-success" title="Tải xuống">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <?php endif; ?>
                                    <form method="POST" class="d-inline"
                                          onsubmit="return confirm('Xóa tài liệu này?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="tai_lieu_id" value="<?= (int)$f['id'] ?>">
                                        <button type="submit" class="btn btn-xs btn-danger" title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="jquery/jquery.min.js"></script>
<script src="bootstrap4/js/bootstrap.bundle.min.js"></script>
<script>
// Hiển thị loading khi upload
document.getElementById('formUpload').addEventListener('submit', function() {
    var btn = document.getElementById('btnUpload');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Đang upload...';
});
</script>
</body>
</html>
