<?php
    include_once '../header.php';
    if(isset($_GET['submit']))
    {
        include_once "inc.db.php";
        $id = $_GET['id'];
        $qan = $_GET['quan'];
        $pri = $_GET['price'];
        $des = $_GET['descr'];
        $car = $_GET['car'];
        $sql = "SELECT quantity, caritem, carton from dumyitem where itemid = '$id'";
        $result = mysqli_query($connect, $sql)or die("An Error occured. Error code 0x0022");
        $res = mysqli_fetch_assoc($result);
        $quan = $res['quantity'];
        $carton = $res['carton'];
        $item = $res['caritem'];
        if($qan != 0 || $car != 0)
        {
            if($car != 0)
            {
                $qan = $car * $item;
                $qan += $quan;
            }
        }
        $car+=$carton;
        //$sql = "Update inventory set price = '$pri', quantity = '$final' where itemid='$id'";
        //mysqli_query($connect, $sql) or die ("An Error Occured");
        $sql = "Update dumyitem set price = '$pri', quantity = '$final', descrip ='$des', carton = '$car'  where itemid='$id'";
        mysqli_query($connect, $sql) or die ("An Error Occured. Error code 0x0022");
        echo "<script type='text/javascript'>
               alert('Item Updated');
               location = '../home.php?=Success';
               </script>";
        exit();
    }
    else
    {
        header("Location: home.php");
    }