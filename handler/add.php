<?php

require "../config.php";
require "../addNew.php";



if(isset($_POST['carName']) && isset($_POST['userName']) && isset($_POST['email']) 
&& isset($_POST['price']) && isset($_POST['date'])){
   $addNew = new AddNew(null,$_POST['carName'],$_POST['userName'],$_POST['email'], isset($_POST['date']), $_POST['price']);
    $status = AddNew::add($addNew,$conn);
    
    if($status){
        echo "Success";
    }else{
        echo $status;
        echo "Failed";
    }
}
?>