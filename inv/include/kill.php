<?php
//session_start();
if(!isset($_SESSION['id']))
{
    header("Location: home.php");
}
unset($_SESSION['shopping_cart']);
?>