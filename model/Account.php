<?php
include_once("SqlHelper.php");
class Account extends SqlHelper
{
    public function create($email, $password, $nickName)
    {
        $password = md5($password);
        $result = $this->query('select email from `user` where email ="' . $email . '"');
        if ($result->num_rows !== 0) {
            return 0;
        }
        $result = $this->query('insert into `user` (`email`,`password`,`name`) values("' . $email . '","' . $password . '","' . $nickName . '")');
        if ($result) {
            return 1;
        } else {
            return 2;
        }
    }


    public function login($email, $password)
    {
        $password = md5($password);
        if ($email!=="") {
            $result = $this->query('select * from `user` where email = "' . $email . '"');
            $row = $result->fetch_assoc();
            if ($result->num_rows !== 0) {
                if ($password == $row['password']) {
                    return $row;
                }
                return 1;
            } else {
                return 0;
            }
        }else{
            return 2;
        }
    }

    public function authName($email){
        $result = $this->query('select email from `user` where email ="' . $email . '"');
        if ($result->num_rows !== 0) {
            return 1;
        }
        else {
            return "null";
        }
    }

}
