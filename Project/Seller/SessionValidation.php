<?php
session_start();
if($_SESSION['sid']==""){
    header('location:../Guest/NewLogin.php');
}
?>