<?php
function createUser(){
    header('Location:index.php');
    error_reporting(0);
    $mysqli = @new mysqli("localhost","root","","zero_php","3308");
    $mysqli->set_charset("utf8");
    $result = $mysqli->query("select * from user");
    $row = $result->fetch_assoc();
    $username = $_POST['username'];
    $password = $_POST['userpassword'];
    $email = $_POST['useremail'];
    for($i=0;$i<$result->num_rows;$i++){
        if($username !== $row['name'] && $email !== $row['email']){
            // if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            //     die("邮箱格式不对!");
            // }
            $result = $mysqli->query('insert into `user` (`name`,`password`,`email`) values('.$username.','.$password.','.$email.')');
            
            // if(!isset($result)){
            //     die("用户名或者邮箱重复");
            // }
        }
    }
}

createUser();
    