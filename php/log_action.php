<?php
require('config.php');

$device = $_POST['device_id'];
$action = $_POST['action'];
$timestamp = time();

$url = "https://firestore.googleapis.com/v1/projects/" . FIRESTORE_PROJECT_ID . "/databases/(default)/documents/logs";
$data = [
    "fields" => [
        "device" => ["stringValue" => $device],
        "action" => ["stringValue" => $action],
        "timestamp" => ["integerValue" => $timestamp]
    ]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>