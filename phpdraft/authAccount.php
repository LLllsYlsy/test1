<?php
include_once(dirname(__DIR__) . "/model/Account.php");
$email = $_POST['email'];
$account = new account();
$authName = $account->authName($email);
switch ($authName) {
    case 1:
        $response = [
            "code" => "0001",
            "msg" => "邮箱已被注册"
        ];
        die(json_encode($response));
        break;
    case "null":
        $response = [
            "code" => "0000",
            "msg" => "该邮箱可以注册"
        ];
        die(json_encode($response));
        break;
}
