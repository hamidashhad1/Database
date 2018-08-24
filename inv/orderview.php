<?php

require 'include/inc.db.php';
include_once 'header.php';
$sql  = "SELECT * from _order order by orderdatetime desc ";
if(isset($_GET['submit']))
{
    $field = $_GET['sear'];
    $type = $_GET['type'];
    include_once "include/inc.db.php";
    if ($type == 'ID') {
        $sql = "SELECT * FROM _order WHERE orderid like '%$field%' order by orderdatetime desc";
    } else {
        $sql = "SELECT * FROM _order WHERE orderdatetime like '%$field%' order by orderdatetime desc";
    }
    $r = mysqli_query($connect, $sql) or die ("an error occured. Error code 0x0015");

    $num = mysqli_num_rows($r);
    if(!($num > 0))
    {
        echo "<script type='text/javascript'>
        alert('No order Found');
        location = 'orderview.php';
      </script>";
    }
}
$r = mysqli_query($connect, $sql) or die ("an error occured. Error code 0x0015");

$num = mysqli_num_rows($r);
 ?>

    <div class="container">
        <div class="panel panel-default" style="border: none">
            <span class="bg-info text-white" style="font-size: 20px; font-weight: bold">Search by Order ID:</span>
            <div class="panel-body" style="margin-left: .1cm">
                <form action="" method="get">
                    <div class="row">
                        <label>Search Item by:</label> <span class="badge badge-pill badge-warning">Date Format Should Be 'YYYY-MM-DD'</span>
                        <select class="form-control" style="width: 8cm" name="type">
                            <option>ID</option>
                            <option>Date</option>
                        </select>
                    </div>
                    <br>
                    <div class="row">
                        <input style="width: 8cm" class="form-control   " id="inputsm" type="text" placeholder="Search.." name="sear">
                        <br>

                        <input type="submit" value="Search" name="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">Orders</div>
            <div class="panel-body">
                <table class="table table-hover">
                   <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Option</th>
                    </tr>
                   </thead>
                    <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($r))
                    {
                        echo '<tr>';
                        echo "<td>" . $row['orderid']. "</td>";
                        echo "<td>" . $row['orderdatetime'] . "</td>";
                        echo "<td><a  href='orderdetail.php?orderid=" . $row['orderid'] . "'><input type='button' class='btn btn-info' value='View'></a>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php

?>
