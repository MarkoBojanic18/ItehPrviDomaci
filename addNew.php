<?php

class AddNew{
    public $id;
    public $carName;
    public $userName;
    public $email;
    public $photo;
    public $price;

    public function __construct($id = null, $carName = null, $userName = null, $email = null, $photo = null, $price = null){
        $this->$id = $id;
        $this->$carName = $carName;
        $this->$userName = $userName;
        $this->$email = $email;
        $this->$photo = $photo;
        $this->$price = $price;
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

    public static function deleteById(mysqli $conn){
        $query = "DELETE FROM cars WHERE id = $this->id";
        return $conn->query($query);
    }

    public static function add(AddNew $addNew, mysqli $conn)
    {
        $query = "INSERT INTO cars(carName,userName,email,photo,price) VALUES('$addNew->carName','$addNew->userName','$addNew->email','$addNew->photo','$addNew->price')";
        return $conn->query($query);
    }

    public static function update(mysqli $conn){
        $query = "UPDATE cars SET carName = $this->carName', userName = '$this->userName', email='$this->email',photo = '$this->photo',price='$this->price'";
        return $conn->query($query);
    }
}

?>