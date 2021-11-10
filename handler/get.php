<?php

require "../config.php";
require "../addNew.php";

if(isset($_POST['id'])){
    $myArray = AddNew::getById($_POST['id'], $conn);
    echo json_encode($myArray);
}

?>