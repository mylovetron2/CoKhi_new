<?php
/**
 * Test kết nối từ CoKhi server → gdrive-cokhi API
 * XÓA FILE NÀY SAU KHI TEST XONG
 */
if (!isset($_GET['run'])) {
    die('<a href="?run=1">Chạy test kết nối</a>');
}

$base   = 'https://diavatly.cloud/gdrive-cokhi';
$apiUrl = $base . '/api/external-upload.php';
$apiKey = 'ck-ext-7f3a9b2e1d4c8f6a0e5b3d7c9a2f1e4b';

echo '<pre>';
echo "PHP version: " . PHP_VERSION . "\n";
echo "cURL version: " . (function_exists('curl_version') ? curl_version()['version'] : 'N/A') . "\n";
echo "OpenSSL: " . (function_exists('curl_version') ? curl_version()['ssl_version'] : 'N/A') . "\n\n";

function testUrl($url, $label, $extraOpts = []) {
    $ch = curl_init($url);
    curl_setopt_array($ch, array_merge([
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 15,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSLVERSION     => CURL_SSLVERSION_TLSv1_2,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_NOBODY         => true,   // HEAD request
    ], $extraOpts));
    curl_exec($ch);
    $err  = curl_error($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $status = $code >= 200 && $code < 500 ? "OK ($code)" : "LỖI ($code)";
    echo "[$status] $label\n";
    if ($err) echo "  cURL error: $err\n";
}

echo "=== Kiểm tra các URL gdrive-cokhi ===\n";
testUrl($base . '/',                              'Trang chủ gdrive-cokhi');
testUrl($base . '/index.php',                     'index.php');
testUrl($base . '/api/external-upload.php',       'external-upload.php (cần 405/200, không phải 404)');
testUrl($base . '/api/google-auth.php',           'google-auth.php');
testUrl($base . '/config/config.php',             'config.php (cần 403, không phải 404)');

echo "\n=== Test POST đến external-upload.php ===\n";
$ch = curl_init($apiUrl);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => ['test' => '1'],
    CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
    CURLOPT_TIMEOUT        => 15,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSLVERSION     => CURL_SSLVERSION_TLSv1_2,
]);
$raw  = curl_exec($ch);
$err  = curl_error($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "HTTP code: $code\n";
echo "cURL error: " . ($err ?: 'none') . "\n";
echo "Response: " . substr($raw, 0, 300) . "\n\n";

echo "=== KẾT LUẬN ===\n";
echo "Nếu external-upload.php trả 404 → file chưa được upload lên diavatly.cloud\n";
echo "Nếu trả 200/400/401 → file đã có, kiểm tra API key và logic\n";
echo "Nếu trả 500 → file có nhưng lỗi PHP (chạy thêm test)\n";
echo '</pre>';


$apiUrl = 'https://diavatly.cloud/gdrive-cokhi/api/external-upload.php';
$apiKey = 'ck-ext-7f3a9b2e1d4c8f6a0e5b3d7c9a2f1e4b';

echo '<pre>';
echo "PHP version: " . PHP_VERSION . "\n";
echo "cURL version: " . (function_exists('curl_version') ? curl_version()['version'] : 'N/A') . "\n";
echo "OpenSSL: " . (function_exists('curl_version') ? curl_version()['ssl_version'] : 'N/A') . "\n\n";

// Test 1: kết nối đơn giản không SSL verify
echo "=== Test 1: GET request (no SSL verify) ===\n";
$ch = curl_init($apiUrl);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST  => 'GET',
    CURLOPT_TIMEOUT        => 15,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_HEADER         => true,
]);
$res  = curl_exec($ch);
$err  = curl_error($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "HTTP code: $code\n";
echo "cURL error: " . ($err ?: 'none') . "\n";
echo "Response (200 chars): " . substr($res, 0, 200) . "\n\n";

// Test 2: TLSv1.2
echo "=== Test 2: GET request (TLS 1.2 forced) ===\n";
$ch = curl_init($apiUrl);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST  => 'GET',
    CURLOPT_TIMEOUT        => 15,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSLVERSION     => CURL_SSLVERSION_TLSv1_2,
]);
$res  = curl_exec($ch);
$err  = curl_error($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "HTTP code: $code\n";
echo "cURL error: " . ($err ?: 'none') . "\n\n";

// Test 3: HTTP (không SSL)
$httpUrl = 'http://diavatly.cloud/gdrive-cokhi/api/external-upload.php';
echo "=== Test 3: HTTP (không SSL) ===\n";
$ch = curl_init($httpUrl);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST  => 'GET',
    CURLOPT_TIMEOUT        => 15,
]);
$res  = curl_exec($ch);
$err  = curl_error($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "HTTP code: $code\n";
echo "cURL error: " . ($err ?: 'none') . "\n\n";

echo "=== KẾT LUẬN ===\n";
echo "Nếu Test 1/2 đều lỗi 'Connection reset' → hosting chặn outbound HTTPS\n";
echo "Nếu Test 3 OK → cần dùng HTTP thay HTTPS (hoặc liên hệ hosting mở port)\n";
echo "Nếu tất cả lỗi → server không có outbound internet\n";
echo '</pre>';
