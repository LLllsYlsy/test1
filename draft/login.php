<?php
    include_once('sqlHelper.php');
    setcookie('login','123123',time()+60*60*24*7);
    error_reporting(0);
    $sqlHelper = new SqlHelper();
    $username = $_POST['username'];
    $password = $_POST['userpassword'];
    if ($sqlHelper->isConnectError) {
        die('Connect Error: ' . $sqlHelper->connect_error);
    }
    $result=$sqlHelper->query("select * from `user` where name='".$username."'");
    $row=$result->fetch_assoc();
    if(!$result){
        die($sqlHelper->isConnectError);
    }
    if($result->num_rows===0){
        die("这个用户不存在");
    }
    if($password!=$row['password']){
        die("密码错误");
    }
    include_once("index.php");
?>
