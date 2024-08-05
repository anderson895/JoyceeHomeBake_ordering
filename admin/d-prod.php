<?php
include_once("../db.php");
if(isset($_GET['delete']))
{
    $id = $_GET['delete'];
    $delete = "Delete from tbl_product where id ='$id'";
    if(mysqli_query($con,$delete)){
        header("Location:m-prod.php");
    }else{
        header("Location:m-prod.php");
    }
}else if(isset($_GET['delete_check']))
{
    $id = $_GET['delete_check'];
    $delete = "UPDATE `checkout` SET `checkout_status` = '4' WHERE `checkout`.`checkout_united_id` = '$id'";
    if(mysqli_query($con,$delete)){
        header("Location:m-ord.php");
    }else{
        header("Location:m-ord.php");
    }
}


else
{
    header("Location:m-prod.php");
}
?>