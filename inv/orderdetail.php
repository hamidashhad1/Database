<?php

include 'header.php';
require 'include/inc.db.php';

if(isset($_GET['orderid']))
{
    $id = $_GET['orderid'];

    $sql1 = "SELECT  orderdatetime from _order where orderid = '$id'";
    $result1 = mysqli_query($connect, $sql1) or die ("An error Occured. Error Code: 0x0015");
    $r = mysqli_fetch_assoc($result1);
    $sql = "SELECT itemid,quantity from oderitem where oderid = '$id'";
    $result = mysqli_query($connect, $sql) or die ("an error occured. Error Code: 0x0014");
    $num = mysqli_num_rows($result);
    if(!$num > 0)
    {
        echo "no data found against ". $id .' Order ID';
    }
    else
    {
?>

        <div class="container">
            <div class="panel panel-info">
                <div class="panel-heading">Order Details</div>
                <div class="panel-body">
                    <h3>Order ID: <?php echo $id?></h3>
                    <div class="align-right">Order Date: <?php echo $r['orderdatetime']; ?></div>
                    <br>
                    <table class="table table-hover">
        <tr>
            <th>Item Name</th>
            <th>Item Quantity</th>
            <th>Sub Total</th>
        </tr>
        <?php
        $total = 0;
            while ($row = mysqli_fetch_assoc($result))
            {
                $sql = 'SELECT * FROM inventory WHERE itemid = '.$row['itemid'];
                $result1 = mysqli_query($connect, $sql) or die("An error Occured. Error Code: 0x0013");
                $arr = mysqli_fetch_assoc($result1);

                echo '<tr>';
                echo "<td>" . $arr['name'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['quantity']* $arr['price'] . "</td>";
                $total+= $row['quantity']* $arr['price'];
            }
    }
}
else
{
    echo "no data to be displayed";
}
?>
                        <tr>
                            <td colspan="3" align="right">
                                <span class="badge badge-pill badge-success" style="font-size: 15px">Total:</span>
                                <span style="font-weight: bold; font-size: 17px">
                                <?php echo number_format($total, 2); ?>
                                </span>
                            </td>
                        </tr>
                        </table>
                    <br><br>
                        <a target="_blank" href="include/print.php?id=<?php echo $id ?>" class="btn btn-info">Print</a>
                        <a href="include/delorder.php?id=<?php echo $id ?>" class="btn btn-info disabled">Delete</a>
                        </div>
               </div>
            </div>
<script >
    function iprint() {
        var buttonId = document.getElementById('pb');
        buttonId.style.visibility = 'hidden';
        window.print();
        buttonId.style.visibility = 'visible';
    }
</script>