<?php

include_once 'header.php';

if(isset($_GET['id']))
{
    include_once "inc.db.php";
    $id = $_GET['id'];
    $sql = "DELETE FROM dumyitem where itemid = '$id'";
    mysqli_query($connect,$sql) or die("An Error Occured. Error code 0x0022");
    echo "<script type='text/javascript'>
        alert('Item Removed');
        location = '../home.php';
      </script>";
    exit();
}
else
{
    header("Location: ../remove.php");
}

?>