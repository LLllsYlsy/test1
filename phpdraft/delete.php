<?php
// session_start();
// error_reporting(0);
// $errorText='';
// $mysqli = @new mysqli("localhost","root","","zero_php","3308");
// $mysqli->set_charset("utf8");
// if($mysqli->connect_error){
//     $errorText="连接失败，请稍后再试";
// }else{
//     $session_id = empty($_SESSION['session_id'])?-1:$_SESSION['session_id'];
//     $post_id = empty($_POST['post_id'])?-2:$_POST['post_id'];
//     if($session_id == $post_id){
//     }else{
// echo $_POST['id'];
    include_once(dirname(__DIR__).'/model/Question.php');
    $question = new Question();
    if($question->isConnectError){
        die("fail");
    }
    $result = $question -> delete($_POST['id'],$_POST['name']);
    if(!$result){
        die('fail');
    }else{
        include_once('questionList.php');
    }