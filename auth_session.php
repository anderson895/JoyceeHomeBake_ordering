<?php
    session_start();
    function user(){
        if(!isset($_SESSION["username"])&&!isset($_SESSION["user"])) {
            header("Location: login.php");
            exit();
        }else if($_SESSION["user"]=='0')
        {
            // header("Location: dashboard.php");
        }else if($_SESSION["user"]=='1')
        {
            header("Location: admin/");
        }
    }
    function admin(){
        if(!isset($_SESSION["username"])&&!isset($_SESSION["user"])) {
            header("Location: ../login.php");
            exit();
        }else if($_SESSION["user"]=='0')
        {
            header("Location: ../dashboard.php");
        }else if($_SESSION["user"]=='1')
        {
            // header("Location: admin/");
        }
    }
    function login(){
        if(!isset($_SESSION["username"])&&!isset($_SESSION["user"])) {
            // header("Location: login.php");
            // exit();
        }else if($_SESSION["user"]=='0')
        {
            header("Location: dashboard.php");
        }else if($_SESSION["user"]=='1')
        {
            header("Location: admin/");
        }
    }
?>
