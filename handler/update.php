<?php

require "../config.php";
require "../addNew.php";



if(isset($_POST['id']) && isset($_POST['carNameEdit']) && isset($_POST['userNameEdit']) && isset($_POST['emailEdit']) 
&& isset($_POST['priceEdit']) && isset($_POST['dateEdit'])){
    $obj = new AddNew(null, $_POST['carNameEdit'],$_POST['userNameEdit'],$_POST['emailEdit'], $_POST['dateEdit'], $_POST['priceEdit']);
    $id = $_POST['id'];
    $status = $obj->update($id,$conn);
    
    if($status){
        echo "Success";
    }else{
        echo $status;
        echo "Failed";
    }
}
?>