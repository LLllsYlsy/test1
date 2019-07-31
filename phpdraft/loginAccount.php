<?php
include_once(dirname(__DIR__) . "/model/Account.php");
$email = $_POST['email'];
$password = $_POST['password'];
$account = new account();
$result = $account->login($email, $password);
$seven = $_POST['sevenday'];
switch ($result) {
    case 0:
        //账号不存在
        $response = [
            "code" => "0001",
            "msg" => "账号或密码错误！"
        ];
        die(json_encode($response));
        break;
    case 1:
        //密码不正确
        $response = [
            "code" => "0001",
            "msg" => "账号或密码错误！"
        ];
        die(json_encode($response));
        break;
    case 2:
        $response = [
            "code" => "0001",
            "msg" => "账号或密码错误！"
        ];
        die(json_encode($response));
        break;
    default:
        //成功
        session_start();
        $_SESSION['name'] = $result['name'];
        if ($seven == "true") {
            setcookie('test', $result['name'], time() + 60 * 60 * 24 * 7, "/");
            $seven = "";
        } else {
            setcookie('test', $result['name'], time(), "/");
        }
        $response = [
            "code" => "0000",
            "msg" => "登陆成功"
        ];
        die(json_encode($response));
        break;
}
