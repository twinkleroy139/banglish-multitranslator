<?php
header('Content-Type: application/json');

$query = isset($_GET['text']) ? urlencode($_GET['text']) : '';
$from = isset($_GET['from']) ? $_GET['from'] : 'auto';
$to = isset($_GET['to']) ? $_GET['to'] : 'en';

if (empty($query)) {
    echo json_encode(["status" => "error", "message" => "No text provided."]);
    exit;
}

$python_url = "http://127.0.0.1:5000/translate?text={$query}&from_lang={$from}&to_lang={$to}";

$ch = curl_init($python_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_code === 200) {
    echo $response;
} else {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Could not reach Python translation engine."
    ]);
}