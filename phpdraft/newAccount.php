<?php

include_once(dirname(__DIR__)."/model/Account.php");
$email = $_POST['email'];
$password = $_POST['password'];
$nickName = $_POST['nickName'];
$account = new account();
$result = $account->create($email, $password, $nickName);

switch ($result) {
    case 0:
        $response = [
        "code" => "0001",
        "msg" => "账号已存在"
        ];
        die(json_encode($response));
        break;
    case 1:
        setcookie('test',$nickName,time(),'/');
        $response = [
            "code" => "0000",
            "msg" => "注册成功"
        ];
        die(json_encode($response));
        break;
    case 2:
        $response = [
        "code" => "0001",
        "msg" => "无法连接网络"
        ];
        die(json_encode($response));
        break;
}

