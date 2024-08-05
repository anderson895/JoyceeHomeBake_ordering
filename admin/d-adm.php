<?php
include_once("../db.php");
if(isset($_GET['delete']))
{
    $id = $_GET['delete'];
    $delete = "Delete from users where id ='$id'";
    if(mysqli_query($con,$delete)){
        header("Location:m-adm.php");
    }else{
        header("Location:m-adm.php");
    }
}else
{
    header("Location:m-adm.php");
}
?>