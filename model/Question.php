<?php
include_once("SqlHelper.php");
class Question extends SqlHelper{

    public function create($content,$name){
        if($content!=''){
            $time = date('Y-m-d H:i:s');
            $result = $this->query('insert into `questions` (content,time,name) values ("'.$content.'","'.$time.'","'.$name.'")');
            if(!$result){
                return false;
            }
            return true;
            }
    }

    public function delete($id,$name){
        $result = $this->query('delete from `questions` where id="'.$id.'"and name ="'.$name.'"');
        if(!$result){
            return false;
        }else{
            return true;
        }
    }

    public function getAll(){
        $result = $this->query('select * from `questions`');
        return $result;
    }
}