<?php
    // session_start();
    error_reporting(0);
    include_once(dirname(__DIR__).'/model/Question.php');
    if(isset($_POST['question'])){
        if($_POST['question']==""){
            $response = [
                "code" => "0005",
                "msg" => "没有内容的问题不是问题!"
            ];
            die(json_encode($response));
        }
        $question = new Question();
        if($question->isConnectError){
            $response = [
                "code" => "0001",
                "msg" => "无法连接网络"
            ];
            die(json_encode($response));
        }
        // $session_id = empty($_SESSION['session_id'])?-1:$_SESSION['session_id'];
        // $post_id = empty($_POST['post_id'])?-2:$_POST['post_id'];
        // if($session_id == $post_id){
        // else{
            $result = $question->create($_POST['question'],$_POST['name']);
            if(!$result){
                $response = [
                    "code" => "0001",
                    "msg" => "创建失败"
                ];
                die(json_encode($response));
            }
            // $time = date("Y-m-d H:i:s");
            // $_SESSION['session_id'] = $post_id;
            // if($questions !=''){
            //    $result = $sqlHelper->query('insert into `questions` (`content`,`time`) values("'.$questions.'","'.$time.'")');    
        // }
        // }
    include_once('questionList.php');
    }
    
