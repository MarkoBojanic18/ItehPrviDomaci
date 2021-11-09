<?php

require "config.php";

class User{
    public $id;
    public $full_name;
    public $email;
    public $password;

    public function __construct($id = null, $full_name = null, $email =null , $password = null){
        $this->id = $id;
        $this->full_name =$full_name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function getAll(mysqli $conn){
        $query = "SELECT * FROM users";
        return $conn->query($query);
    }

    public static function getById($id,mysqli $conn){
        $query = "SELECT * FROM users WHERE id = $id";
        $myArray = array();
        $result = $conn->query($query);
        if($result){
            while($row = $result->fetch_array()){
                $myArray[] = $row;
            }
        }

       
        return $myArray;
    }

    
}

?>