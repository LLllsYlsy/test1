<?php 

class SqlHelper extends mysqli{

    private $host = "localhost";
    private $account = "root";
    private $password = "";
    private $db = "zero_php";
    private $port = "3308";

    public $isConnectError = false;

    public function __construct(){
        parent::__construct($this->host,$this->account,$this->password,$this->db,$this->port);
        
        if($this->connect_error){
            $this->isConnectError = true;
        }
        $this -> set_charset("utf8");
    }
}