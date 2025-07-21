<?php
require('config.php');

$device_id = $_POST['device_id'];
$status = $_POST['status'];

$db_url = FIREBASE_DB_URL . "devices/$device_id/status.json";
$data = json_encode($status);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $db_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>