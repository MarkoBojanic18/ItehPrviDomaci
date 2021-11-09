<?php

require "../config.php";
require "../addNew.php";

if(isset($_POST['id'])){
    $obj = new AddNew($_POST['id']);
    $status = $obj->deleteById($conn);
    if ($status){
        echo "Success";
    }else{
        echo "Failed";
    }
}

?>