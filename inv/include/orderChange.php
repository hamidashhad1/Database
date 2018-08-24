<?php
session_start();
ob_start();
if(!isset($_SESSION['id']))
{
    header("Location: ../home.php");
}
include_once 'inc.db.php';

foreach ($_SESSION['shopping_cart'] as $keys=> $values)
{
    $or = $values['item_quantity'];
    $id = $values['item_id'];
    $q12 = mysqli_query($connect, 'select quantity from dumyitem where itemid='.$id) or die("An Error Occured. Error code 0x0022");
    $quan = mysqli_fetch_assoc($q12);
    $iq = $quan['quantity'];
    $iq -= $or;
    mysqli_query($connect,"update dumyitem set quantity = '$iq' where itemid = '$id'") or die("An Error Occured. Error code 0x0022");
}
$orid  = abs( crc32(uniqid()));
$sql = "insert into _order(orderid, orderdatetime) values ('$orid', now())";
mysqli_query($connect, $sql)  or die("An error occured. Error code 0x0025");

$total = $_GET['total'];
$sql = "insert into sales values ('$orid', '$total', now())";
mysqli_query($connect,$sql) or die("An Error Occured. Error code 0x0026");

foreach ($_SESSION['shopping_cart'] as $keys=> $values)
{
    $id = $values['item_id'];
    $qu = $values['item_quantity'];
    $sql = "insert into oderitem values ('$orid','$id','$qu')";
    mysqli_query($connect, $sql) or die ("AN error occured. Error code 0x0024");
}
echo "<script type='text/javascript'>
        alert('Order Generated');
      </script>";
header("Location: print.php?id=".urlencode($orid));
exit();

?>