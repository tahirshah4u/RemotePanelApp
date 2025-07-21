<?php
require('config.php');

function sendFCM($topic, $title, $body) {
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = [
        'to' => '/topics/' . $topic,
        'notification' => [
            'title' => $title,
            'body' => $body
        ]
    ];
    $headers = [
        'Authorization: key=' . FCM_SERVER_KEY,
        'Content-Type: application/json'
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $topic = $_POST['topic'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    echo sendFCM($topic, $title, $body);
}
?>