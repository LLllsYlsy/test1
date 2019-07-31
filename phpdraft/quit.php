<?php

session_start();
session_destroy();
$_SESSION = array();
setcookie('test',"",time()-3600,"/");
$response = [
    "code" => "0000",
    "msg" => "成功退出"
];
die(json_encode($response));
