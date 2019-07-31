<?php
$do = "";
if(isset($_POST['do'])){
    $do = $_POST['do'];
}
if(isset($_GET['do'])){
    $do = $_GET['do'];
}

$do();


//登陆
function loginAccount(){
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
                setcookie('name', $result['name'], time() + 60 * 60 * 24 * 7, "/");
                $seven = "";
            } else {
                setcookie('name', $result['name'], time(), "/");
            }
            $response = [
                "code" => "0000",
                "msg" => "登陆成功"
            ];
            die(json_encode($response));
            break;
    }
    
}


//注册
function newAccount(){
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
}


//获取用户名
function getNickname(){
    session_start();
    if (isset($_COOKIE['name'])) {
        $_SESSION['name'] = $_COOKIE['name'];
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
    
}


//注册邮箱验证
function authEmail(){
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
    
}

//退出
function quit(){
    session_start();
    session_destroy();
    $_SESSION = array();
    setcookie('test',"",time()-3600,"/");
    $response = [
        "code" => "0000",
        "msg" => "成功退出"
    ];
    die(json_encode($response));
    
}