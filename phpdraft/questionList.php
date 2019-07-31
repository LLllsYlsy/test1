<?php
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
    echo $response;
    echo json_encode($response);
    die(json_encode($response));
}
?>