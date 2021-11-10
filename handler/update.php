<?php

require "../config.php";
require "../addNew.php";



if(isset($_POST['id']) && isset($_POST['carName']) && isset($_POST['userName']) && isset($_POST['email']) 
&& isset($_POST['price']) && isset($_POST['date'])){
    $obj = new AddNew($_POST['id'], $_POST['carName'],$_POST['userName'],$_POST['email'], $_POST['date'], $_POST['price']);
    $status = $obj->update($conn);
    
    if($status){
        echo "Success";
    }else{
        echo $status;
        echo "Failed";
    }
}
?>