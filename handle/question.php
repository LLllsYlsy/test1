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
    if ($question->isConnectError) {
        $response = [
            "code" => "0001",
            "msg" => "与数据库连接中断"
        ];
        die(json_encode($response));
    }
    if(!$result){
        $response = [
            "code" => "0002",
            "msg" => "查询失败"
        ];
        die(json_encode($response));
    }
    else{
        if($result->num_rows === 0){
            $response = [
                "code" => "0000",
                "msg" => "目前没有人提问，想成为第一个提问的人吗？",
                "data" => []
            ];
            die(json_encode($response));
        }
        $questions = [];
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
            "msg" => "",
            "data" => $questions
        ];
        die(json_encode($response));
    }
}

//提交问题
function questionSubmit(){
    error_reporting(0);
    include_once(dirname(__DIR__).'/model/Question.php');
    if(isset($_POST['question'])){
        if($_POST['question']==""){
            $response = [
                "code" => "0001",
                "msg" => "没有内容的问题不是问题!"
            ];
            die(json_encode($response));
        }
        $question = new Question();
        if($question->isConnectError){
            $response = [
                "code" => "0002",
                "msg" => "无法连接网络"
            ];
            die(json_encode($response));
        }

            $result = $question->create($_POST['question'],$_POST['name']);
            if(!$result){
                $response = [
                    "code" => "0003",
                    "msg" => "创建失败"
                ];
                die(json_encode($response));
            }

        questionList();
    }
}


//删除问题
function delete(){
    include_once(dirname(__DIR__).'/model/Question.php');
    $question = new Question();
    if($question->isConnectError){
        $response = [
            "code" => "0001",
            "msg" => "查询失败"
        ];
        die(json_encode($response));
    }
    $result = $question -> delete($_POST['id'],$_POST['name']);
    if(!$result){
        $response = [
            "code" => "0002",
            "msg" => "不是你提的问题"
        ];
        die(json_encode($response));
    }else{
        questionList();
        // include_once('questionList.php');
    }
}