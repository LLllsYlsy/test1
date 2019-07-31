<?php
session_start();
if (isset($_COOKIE['test'])) {
    $_SESSION['name'] = $_COOKIE['test'];
}
if (!isset($_SESSION['name'])) {
    $response = [
        "code" => "0001",
        "msg" => "notLogin"
    ];
    die(json_encode($response));
    // header("location:login.php");
}
$response = [
    "code" => "0000",
    "msg" => "成功获取名字",
    "data" => $_SESSION['name']
];
die(json_encode($response));
