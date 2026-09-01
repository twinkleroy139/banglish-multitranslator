<?php
header('Content-Type: application/json');

$query = isset($_GET['text']) ? rawurlencode($_GET['text']) : '';
$from = isset($_GET['from']) ? rawurlencode($_GET['from']) : 'auto';
$to = isset($_GET['to']) ? rawurlencode($_GET['to']) : 'en';

if (empty($query)) {
    echo json_encode(["status" => "error", "message" => "No text provided."]);
    exit;
}

$python_url = "https://banglish-multitranslator.onrender.com/translate?text={$query}&from_lang={$from}&to_lang={$to}";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $python_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($http_code === 200 && $response !== false) {
    echo $response;
} else {
    http_response_code(500);
    echo json_encode([
        "status" => "error",
        "message" => "Could not reach Python translation engine."
    ]);
}