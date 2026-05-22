<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php'; // mPDF autoload

// Connect to your database (adjust as needed)
$conn = new mysqli("localhost", "diavatly", "cntt2019", "diavatly_quanly");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');

// Lọc theo ngày và nhân viên nếu có
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to = isset($_GET['to']) ? $_GET['to'] : '';
$nhan_vien_id = isset($_GET['nhan_vien_id']) ? $_GET['nhan_vien_id'] : '';
$where = [];
if ($from) {
    $where[] = "ngay_sua_chua >= '" . $conn->real_escape_string($from) . "'";
}
if ($to) {
    $where[] = "ngay_sua_chua <= '" . $conn->real_escape_string($to) . "'";
}
if ($nhan_vien_id !== '' && $nhan_vien_id !== '-1') {
    $where[] = "nhan_vien_id = '" . $conn->real_escape_string($nhan_vien_id) . "'";
}
$where_sql = count($where) ? (' WHERE ' . implode(' AND ', $where)) : '';

$sql = "SELECT ten_nhan_vien, ngay_sua_chua, thoi_gian, REPLACE(REPLACE(noi_dung, '<p>', ''), '</p>', '') AS noi_dung FROM ck_view_nhanvien_suachua" . $where_sql . " ORDER BY ngay_sua_chua DESC";
$result = $conn->query($sql);

// Lấy danh sách nhân viên cho select
$nhanvien_options = '<option value="-1">-- Tất cả nhân viên --</option>';
$sql_nv = "SELECT DISTINCT nhan_vien_id, ten_nhan_vien FROM ck_view_nhanvien_suachua ORDER BY ten_nhan_vien ASC";
$result_nv = $conn->query($sql_nv);
if ($result_nv && $result_nv->num_rows > 0) {
    while ($row_nv = $result_nv->fetch_assoc()) {
        $selected = ($row_nv['nhan_vien_id'] == $nhan_vien_id) ? ' selected' : '';
        $nhanvien_options .= '<option value="' . htmlspecialchars($row_nv['nhan_vien_id']) . '"' . $selected . '>' . htmlspecialchars($row_nv['ten_nhan_vien']) . '</option>';
    }
}


// Prepare HTML for mPDF

// Lấy lại giá trị input cho form
$from_val = htmlspecialchars($from);
$to_val = htmlspecialchars($to);




// Sử dụng phông chữ giống trang index: Tahoma, Arial, Helvetica, sans-serif
$html = '<style>
    body, html { font-family: Tahoma, Arial, Helvetica, sans-serif !important; background: #f4f8fb; margin: 0; padding: 0; font-size: 14px; }
    .container { max-width: 980px; margin: 40px auto; background: #fff; border-radius: 18px; box-shadow: 0 8px 32px rgba(41,128,185,0.10), 0 1.5px 8px rgba(41,128,185,0.06); padding: 40px 48px 32px 48px; font-size: 14px; }
    h2.title { text-align: left; color: #2980b9; margin-bottom: 6px; font-size: 1.5rem; letter-spacing: 1.5px; font-weight: 800; font-family: Tahoma, Arial, Helvetica, sans-serif !important; }
    .subtitle { text-align: left; color: #555; margin-bottom: 32px; font-size: 1rem; font-weight: 500; font-family: Tahoma, Arial, Helvetica, sans-serif !important; }
    .print-btn { display: block; margin: 0 0 28px auto; padding: 10px 28px; background: #2980b9; color: #fff; border: none; border-radius: 10px; font-size: 1rem; font-weight: 700; cursor: pointer; transition: background 0.2s; box-shadow: 0 2px 12px rgba(41,128,185,0.10); letter-spacing: 0.7px; font-family: Tahoma, Arial, Helvetica, sans-serif !important; }
    .print-btn:hover { background: #206090; }
    table { border-collapse: separate; border-spacing: 0; width: 100%; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(41,128,185,0.06); margin-bottom: 18px; font-family: Tahoma, Arial, Helvetica, sans-serif !important; font-size: 14px; }
    th, td { border: none; padding: 10px 10px; font-family: Tahoma, Arial, Helvetica, sans-serif !important; font-size: 14px; }
    th { background: #2980b9; color: #fff; font-weight: 800; font-size: 1rem; border-bottom: 3px solid #e0e6ed; letter-spacing: 0.5px; font-family: Tahoma, Arial, Helvetica, sans-serif !important; }
    tr { transition: background 0.18s; }
    tr:nth-child(even) { background-color: #f2f8fd; }
    tr:nth-child(odd) { background-color: #fafdff; }
    tr:hover { background: #eaf3fa; }
    td { font-size: 14px; color: #222; vertical-align: top; font-family: Tahoma, Arial, Helvetica, sans-serif !important; }
    .footer { text-align: right; font-style: italic; color: #888; font-size: 13px; margin-top: 32px; font-family: Tahoma, Arial, Helvetica, sans-serif !important; }
    .filter-form-pro {
        display: flex;
        gap: 18px;
        align-items: flex-end;
        justify-content: flex-end;
        margin-bottom: 24px;
        flex-wrap: wrap;
        font-family: Tahoma, Arial, Helvetica, sans-serif !important;
        font-size: 14px;
    }
    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
        min-width: 150px;
        font-family: Tahoma, Arial, Helvetica, sans-serif !important;
        font-size: 14px;
    }
    .filter-group label {
        font-weight: 700;
        color: #2980b9;
        margin-bottom: 2px;
        font-size: 14px;
        letter-spacing: 0.3px;
        font-family: Tahoma, Arial, Helvetica, sans-serif !important;
    }
    .filter-group input[type="date"],
    .filter-group select {
        padding: 8px 10px;
        border: 2px solid #b2c6dd;
        border-radius: 8px;
        font-size: 14px;
        background: #f8fbff;
        color: #222;
        transition: border 0.2s, box-shadow 0.2s;
        outline: none;
        box-shadow: 0 1.5px 6px rgba(41,128,185,0.04);
        font-family: Tahoma, Arial, Helvetica, sans-serif !important;
    }
    .filter-group input[type="date"]:focus,
    .filter-group select:focus {
        border: 2px solid #2980b9;
        box-shadow: 0 2px 10px rgba(41,128,185,0.10);
    }
    .filter-btn-pro {
        padding: 10px 24px;
        background: #2980b9;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 2px 10px rgba(41,128,185,0.10);
        cursor: pointer;
        transition: background 0.2s, box-shadow 0.2s;
        letter-spacing: 0.6px;
        margin-left: 10px;
        font-family: Tahoma, Arial, Helvetica, sans-serif !important;
    }
    .filter-btn-pro:hover {
        background: #206090;
        box-shadow: 0 4px 18px rgba(41,128,185,0.18);
    }
    .filter-form-pro-pdf {
        margin-bottom: 30px;
        display: flex;
        gap: 18px;
        align-items: flex-end;
        justify-content: flex-end;
        flex-wrap: wrap;
        font-family: Tahoma, Arial, Helvetica, sans-serif !important;
        font-size: 16px;
    }
    .filter-value-pro {
        display: inline-block;
        min-width: 120px;
        padding: 8px 10px;
        background: #f8fbff;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        color: #222;
        font-weight: 600;
        box-shadow: 0 1.5px 6px rgba(41,128,185,0.04);
        margin-top: 2px;
        font-family: Tahoma, Arial, Helvetica, sans-serif !important;
    }
</style>';

$html .= '<div class="container">';
if (!isset($_GET['preview']) || $_GET['preview'] != '1') {
    $html .= '<div style="text-align:center; font-size:1.7rem; font-weight:bold; color:#2980b9; margin-bottom:6px; letter-spacing:1.5px; font-family: Tahoma, Arial, Helvetica, sans-serif !important;">Chi tiết sửa chữa</div>';
}
else
    $html .= '<h2 class="title">Chi tiết sửa chữa</h2>';
//$html .= '<div class="subtitle">Tiếng Việt có dấu: <b>Nguyễn Văn A</b></div>';
$html .= '<div class="subtitle"><br></div>';

$is_preview = (isset($_GET['preview']) && $_GET['preview'] == '1');
if ($is_preview) {
    $html .= '
<form method="get" class="filter-form-pro">
        <div class="filter-group">
            <label for="nhan_vien_id">Nhân viên</label>
            <select id="nhan_vien_id" name="nhan_vien_id">'.$nhanvien_options.'</select>
        </div>
        <div class="filter-group">
            <label for="from">Từ ngày</label>
            <input type="date" id="from" name="from" value="'.$from_val.'">
        </div>
        <div class="filter-group">
            <label for="to">Đến ngày</label>
            <input type="date" id="to" name="to" value="'.$to_val.'">
        </div>
        <input type="hidden" name="preview" value="1">
        <button type="submit" class="filter-btn-pro">Lọc</button>
</form>';
} else {
    // Hiển thị filter dạng đẹp cho PDF (không phải input)
    $nv_label = '<span class="filter-value-pro" style="font-weight:bold;">Tất cả nhân viên</span>';
    if ($nhan_vien_id !== '' && $nhan_vien_id !== '-1') {
        // Tìm tên nhân viên tương ứng với id đã chọn
        $ten_nv = '';
        $sql_nv_label = "SELECT ten_nhan_vien FROM ck_view_nhanvien_suachua WHERE nhan_vien_id = '" . $conn->real_escape_string($nhan_vien_id) . "' LIMIT 1";
        $result_nv_label = $conn->query($sql_nv_label);
        if ($result_nv_label && $row_nv_label = $result_nv_label->fetch_assoc()) {
            $ten_nv = $row_nv_label['ten_nhan_vien'];
        }
        $nv_label = '<span class="filter-value-pro" style="font-weight:bold;">' . ($ten_nv ? htmlspecialchars($ten_nv) : ('Mã NV: '.htmlspecialchars($nhan_vien_id))) . '</span>';
    }
    // Format date for filter summary (dd/mm/Y)
    $from_val_fmt = '';
    if ($from_val) {
        $d = DateTime::createFromFormat('Y-m-d', $from_val);
        $from_val_fmt = $d ? $d->format('d/m/Y') : htmlspecialchars($from_val);
    }
    $to_val_fmt = '';
    if ($to_val) {
        $d = DateTime::createFromFormat('Y-m-d', $to_val);
        $to_val_fmt = $d ? $d->format('d/m/Y') : htmlspecialchars($to_val);
    }
    $html .= '<div class="filter-form-pro filter-form-pro-pdf">
        <div class="filter-group">
            <label>Nhân viên</label>
            '.$nv_label.'
        </div>
        <div class="filter-group">
            <label>Từ ngày</label>
            <span class="filter-value-pro">'.($from_val_fmt ? $from_val_fmt : '<span style="color:#aaa">--</span>').'</span>
        </div>
        <div class="filter-group">
            <label>Đến ngày</label>
            <span class="filter-value-pro">'.($to_val_fmt ? $to_val_fmt : '<span style="color:#aaa">--</span>').'</span>
        </div>
    </div>';
}

// Đã chuyển toàn bộ phông chữ sang Tahoma, Arial, Helvetica, sans-serif ở trên
    $html .= '<table autosize="1">';
    $html .= '<thead><tr>';
    $html .= '<th>Ngày sửa chữa</th>';
    $html .= '<th>Thời gian</th>';
    $html .= '<th>Nội dung</th>';
    $html .= '</tr></thead><tbody>';

    $tong_thoi_gian = 0;
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';
            // Format ngày sửa chữa dd/mm/Y
            $ngay_sua_chua = $row['ngay_sua_chua'];
            $ngay_sua_chua_fmt = '';
            if ($ngay_sua_chua && $ngay_sua_chua !== '0000-00-00') {
                $d = DateTime::createFromFormat('Y-m-d', $ngay_sua_chua);
                if ($d) {
                    $ngay_sua_chua_fmt = $d->format('d/m/Y');
                } else {
                    $ngay_sua_chua_fmt = htmlspecialchars($ngay_sua_chua);
                }
            }
            $html .= '<td style="text-align:center;">' . $ngay_sua_chua_fmt . '</td>';
            $html .= '<td style="text-align:center;">' . htmlspecialchars($row['thoi_gian']) . '</td>';
            $html .= '<td>' . nl2br(htmlspecialchars($row['noi_dung'])) . '</td>';
            $html .= '</tr>';
            // Cộng tổng thời gian (giả sử trường thoi_gian là số giờ, nếu là chuỗi HH:MM thì cần xử lý khác)
            if (is_numeric($row['thoi_gian'])) {
                $tong_thoi_gian += (float)$row['thoi_gian'];
            }
        }
        // Thêm dòng tổng thời gian
        $html .= '<tr style="font-weight:bold;background:#eaf3fa;">';
        $html .= '<td style="text-align:right;">Tổng thời gian:</td>';
        $html .= '<td style="text-align:center;">' . $tong_thoi_gian . '</td>';
        $html .= '<td></td>';
        $html .= '</tr>';
    } else {
        $html .= '<tr><td colspan="3" style="text-align:center;">Không có dữ liệu</td></tr>';
    }

    $html .= '</tbody></table>';
$html .= '</div>';

$conn->close();

// Preview HTML if ?preview=1
if (isset($_GET['preview']) && $_GET['preview'] == '1') {
    header('Content-Type: text/html; charset=utf-8');
    echo '<style>
    .print-btn-pro { float: right; margin-bottom: 18px; margin-top: 4px; padding: 10px 32px; background: linear-gradient(90deg,#2980b9 60%,#6dd5fa 100%); color: #fff; border: none; border-radius: 8px; font-size: 1.08rem; font-weight: 600; box-shadow: 0 2px 8px rgba(41,128,185,0.10); cursor: pointer; transition: background 0.2s, box-shadow 0.2s; letter-spacing: 0.5px; }
    .print-btn-pro:hover { background: linear-gradient(90deg,#206090 60%,#2980b9 100%); box-shadow: 0 4px 16px rgba(41,128,185,0.18); }
    .preview-flex-wrap { display: flex; align-items: flex-start; min-height: 100vh; background: #f4f6fa; }
    .preview-menu-vertical { background:#18191a;color:#fff;padding:24px 0 24px 0;border-radius:12px;box-shadow:0 2px 12px rgba(40,167,69,0.10);min-width:210px;max-width:210px;height:100%;margin:24px 0 24px 24px; }
    .preview-menu-vertical ul { list-style:none;display:block;margin:0;padding:0; }
    .preview-menu-vertical li { margin-bottom:10px; }
    .preview-menu-vertical .menu-title-main {
        margin-bottom: 18px;
        text-align: left;
        font-size: 1.08rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: #b0b3b8;
        background: none;
        border-radius: 0;
        padding: 0 24px 6px 24px;
        border-bottom: 1.5px solid #333;
        box-shadow: none;
    }
    .preview-menu-vertical .menu-section-title {
        font-size:1.08rem;
        font-weight:700;
        color:#6dd5fa;
        padding-left:24px;
        margin-bottom:6px;
        margin-top:18px;
        letter-spacing:0.5px;
        text-transform:uppercase;
        border-left: 4px solid #28A745;
        background:rgba(41,128,185,0.08);
        border-radius: 0 12px 12px 0;
        padding-top: 6px;
        padding-bottom: 6px;
    }
    .preview-menu-vertical a { color:#fff;font-weight:500;text-decoration:none;padding:10px 24px;display:block;border-radius:6px;transition:background 0.18s; }
    .preview-menu-vertical a.active, .preview-menu-vertical a:focus { background:#28A745 !important; color:#fff !important; }
    .preview-menu-vertical a:hover { background:#28A745 !important; color:#fff !important; }
    .preview-content { flex:1; padding:32px 32px 32px 32px; }
    </style>';
    echo '<div class="preview-flex-wrap">';
    // Menu dọc bên trái
    // Xác định trang hiện tại để highlight menu
    $current_page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    echo '<nav class="preview-menu-vertical">'
        .'<ul>'
        .'<li class="menu-title-main">Quản lý thiết bị cơ khí</li>'
        .'<li><a href="index.php"'.($current_page=="index.php"?' class="active"':'').'>Trang chủ</a></li>'
        .'<li><a href="ck_chitiet_suachualist.php"'.($current_page=="ck_chitiet_suachualist.php"?' class="active"':'').'>Chi tiết sửa chữa</a></li>'
        .'<li><a href="ck_danhmuc_thietbilist.php"'.($current_page=="ck_danhmuc_thietbilist.php"?' class="active"':'').'>Danh mục thiết bị</a></li>'
        .'<li><a href="ck_don_hanglist.php"'.($current_page=="ck_don_hanglist.php"?' class="active"':'').'>Đơn hàng</a></li>'
        .'<li><a href="nhan_vienlist.php"'.($current_page=="nhan_vienlist.php"?' class="active"':'').'>Nhân viên</a></li>'
        .'<li style="margin:18px 0 10px 0;border-top:1px solid #444;"></li>'
        .'<li class="menu-section-title">Tra cứu/In</li>'
        .'<li><a href="in_bao_cao.php"'.($current_page=="in_bao_cao.php"?' class="active"':'').'>Báo cáo thiết bị</a></li>'
        .'<li><a href="in_bao_cao_nv.php"'.($current_page=="in_bao_cao_nv.php"?' class="active"':'').'>Báo cáo nhân sự</a></li>'
        .'<li><a href="export_ck_chitiet_suachua_pdf.php?preview=1"'.(strpos($_SERVER['REQUEST_URI'], 'export_ck_chitiet_suachua_pdf.php') !== false ? ' class="active"' : '').'>Báo cáo chi tiết sửa chữa</a></li>'
       
        .'<li style="margin-top:18px;"><a href="logout.php"'.($current_page=="logout.php"?' class="active"':'').'>Đăng xuất</a></li>'
        .'</ul>'
        .'</nav>';
    // Nội dung bên phải: bọc toàn bộ phần còn lại trong 1 div
    echo '<div class="preview-content">';
    // Print button above content
    echo '<button class="print-btn-pro" onclick="window.location.href=\'https://diavatly.com/mPdf/export_ck_chitiet_suachua_pdf.php?from=' . urlencode($from_val) . '&to=' . urlencode($to_val) . '&nhan_vien_id=' . urlencode($nhan_vien_id) . '\'">&#128424; In PDF</button>';
    // Remove the first <div class="container"> from $html (since we already opened it)
    $html = preg_replace('/<div class=\\"container\\">/', '', $html, 1);
    echo $html;
    // Close content, flex
    echo '</div></div>';
    exit;
}

// mPDF config
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'margin_top' => 15,
    'margin_bottom' => 20,
    'margin_left' => 10,
    'margin_right' => 10,
    'default_font' => 'dejavusans',
]);

$mpdf->SetTitle('Danh sách chi tiết sửa chữa');
$mpdf->SetAuthor('PHPMaker Export');
$mpdf->SetFooter('Trang {PAGENO}/{nb}');

ob_clean();
$mpdf->WriteHTML($html);
$mpdf->Output('ck_chitiet_suachua.pdf', \Mpdf\Output\Destination::DOWNLOAD);
exit;