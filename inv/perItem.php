<?php

include_once "header.php";
require_once 'include/inc.db.php';

$sql = "SELECT * from inventory";
$result = mysqli_query($connect, $sql) or die("An Error Occured. Error Code: 0x0013");
if (isset($_GET['submit']))
{
    $name = mysqli_real_escape_string($connect, $_GET['sear']);
    $sss = "SELECT * FROM inventory WHERE name like '%$name%'";
    $result = mysqli_query($connect, $sss) or die("An Error  Occured. Error Code: 0x0013");
    $num = mysqli_num_rows($result);
    if(!($num > 0))
    {
        echo "<script type='text/javascript'>
        alert('No Item Found');
        location = 'perItem.php';
      </script>";
    }
}

?>

    <div class="container">
        <div class="panel panel-default" style="border: none">
            <span class="bg-info text-white" style="font-size: 20px; font-weight: bold">Search by Item Name:</span>
            <div class="panel-body" style="margin-left: .1cm">
                <form action="" method="get">
                    <div class="row">
                        <input style="width: 8cm" class="form-control   " id="inputsm" type="text" placeholder="Search.." name="sear">
                        <br>
                        <input type="submit" value="Search" name="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">Sales Per Item</div>
            <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                        <th>Item Name</th>
                        <th>Total Sale</th>
                        <th>Total Earn</th>
                    </tr>
                    <?
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $sql = 'SELECT SUM(quantity) as TQ From oderitem WHERE itemid = '.$row['itemid'];
                        $res = mysqli_query($connect, $sql) or die("An Error occured. Error Code: 0x0014");
                        $r = mysqli_fetch_assoc($res);
                        $temp = $r['TQ'];
?>
                            <tr>
                                    <td> <? $row['name'] ?></td>
                                    <?php
                                        if(empty($temp))
                                            $temp = 0;
                                    ?>
                                    <td> <?echo $temp ?></td>
                                    <td> <? echo  $r['TQ']* $row['price'] ?> </td>
                            </tr>
                    <?}?>
                </table>
            </div>
        </div>
    </div>