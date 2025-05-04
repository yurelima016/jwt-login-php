<?php
session_start();

if (!isset($_SESSION['jwt'])) {
    header('Location: ../index.html');
    exit;
}

$jwt = $_SESSION['jwt'];
$key = "key-just-for-test";

$parts = explode('.', $jwt);
if (count($parts) !== 3) {
    header('Location: ../index.html');
    exit;
}

list($headerB64, $payloadB64, $signatureB64) = $parts;

$validSignature = hash_hmac('sha256', "$headerB64.$payloadB64", $key, true);
$validSignatureB64 = rtrim(strtr(base64_encode($validSignature), '+/', '-_'), '=');

if (!hash_equals($validSignatureB64, $signatureB64)) {
    header('Location: ../index.html');
    exit;
}

$payloadJson = base64_decode(strtr($payloadB64, '-_', '+/'));
$payload = json_decode($payloadJson, true);

if ($payload['exp'] < time()) {
    session_destroy();
    header('Location: ../index.html');
    exit;
}

// Token válido → pode usar $payload['username']
$username = $payload['username'];
