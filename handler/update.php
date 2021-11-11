<?php

require "../config.php";
require "../addNew.php";

if(isset($_POST['id']) && isset($_POST['carNameEdit']) && isset($_POST['userNameEdit'])
  && isset($_POST['emailEdit']) && isset($_POST['dateEdit']) && isset($_POST['priceEdit'])){
    $obj=new AddNew($_POST['id'],$_POST['carNameEdit'],$_POST['userNameEdit'],$_POST['emailEdit'],$_POST['dateEdit'],$_POST['priceEdit']);
    $status=$obj->update($_POST['id'],$conn);

   
    if($status){
        echo "Success";
    }else{
        echo $status;
        echo "Failed";
    }
}
?>