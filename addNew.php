<?php

require "config.php";

class AddNew{
    public $id;
    public $carName;
    public $userName;
    public $email;
    public $date;
    public $price;

    public function __construct($id = null, $carName = null, $userName =null , $email = null, $date =null , $price = null){
        $this->id = $id;
        $this->carName = $carName;
        $this->userName = $userName;
        $this->email = $email;
        $this->date = $date;
        $this->price = $price;
    }

    public static function getAll(mysqli $conn){
        $query = "SELECT * FROM cars";
        return $conn->query($query);
    }

    public static function getById($id,mysqli $conn){
        $query = "SELECT * FROM cars WHERE id = $id";
        $myArray = array();
        $result = $conn->query($query);
        if($result){
            while($row = $result->fetch_array()){
                $myArray[] = $row;
            }
        }

        return $myArray;
    }

    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM cars WHERE id=$this->id";
        return $conn->query($query);
    }

    public static function add(AddNew $addNew, mysqli $conn)
    {
        $q = "INSERT INTO cars(carName,userName,email,date,price) VALUES('$addNew->carName','$addNew->userName','$addNew->email','$addNew->date','$addNew->price')";
        return $conn->query($q);
    }

    public function update($id, mysqli $conn)
    {
        $query = "UPDATE cars set carName = '$this->carName',userName = '$this->userName',email = '$this->email',date = '$this->date',price = '$this->price' WHERE id='$id'";

        return $conn->query($query);
    }
}

?>