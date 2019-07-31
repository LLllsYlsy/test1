<?php
$do = "";
if(isset($_POST['do'])){
    $do = $_POST['do'];
}
if(isset($_GET['do'])){
    $do = $_GET['do'];
}

$do();

//获取问题列表
function questionList(){
    include_once(dirname(__DIR__).'/model/Question.php');
    $question = new Question();
    
    $result = $question->getAll(); 
    if(!$result){
        $response = [
            "code" => "0001",
            "msg" => "查询失败"
        ];
        die(json_encode($response));
    }
    else{
        if($result->num_rows === 0){
            $response = [
                "code" => "0002",
                "msg" => "目前没有人提问，想成为第一个提问的人吗？"
            ];
            die(json_encode($response));
        }
        $i = 1;
        while($row = $result->fetch_assoc()){
            $question = $row['content']; 
            $time = $row['time'];
            $id = $row['id'];
            $name = $row['name'];
            array_push($questions,[
                "question" => $question,
                "time" => $time,
                "i" => $i,
                "id" => $id,
                "name" => $name
            ]);
            $i++;    
        }
        $response = [
            "code" => "0000",
            "msg" => "获取成功",
            "data" => $questions
        ];
        die(json_encode($response));
    }
}

//提交问题
function questionSubmit(){
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
}


//删除问题
function delete(){
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
}