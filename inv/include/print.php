<?php
session_start();
if(!isset($_SESSION['id']))
{
    echo "<script type='text/javascript'>
        location = '../home.php';
      </script>";
    exit();
}
require 'inc.db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM oderitem WHERE oderid = '.$id;
$sql1 = "SELECT  orderdatetime from _order where orderid = '$id'";
$result = mysqli_query($connect, $sql) or die ("An Error Occured. Error code 0x0024");
$result1 = mysqli_query($connect, $sql1) or die ("An Error Occured. Error code 0x0025");
$res = mysqli_fetch_assoc($result1);
$date = $res['orderdatetime'];
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    body {
        background: rgb(204,204,204);
    }
    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }
    page[size="A5"] {
        width: 5.3in;
        height: 5.8in;
    }
    @media print {
        body, page {
            margin: 0;
            box-shadow: 0;
        }
    }
</style>
<title>Print</title>
<page size="A5">

   <div class="container" style="max-height: 7.8in; max-width: 5.3in;">
       <h1 class="text-center" style="font-family: Calibri">Z&B Traders</h1>
       <br>
       <span class="pull-left">Order Number: <span style="font-weight: bold; font-size: 15px"><?php echo $id?></span></span>
       <span class="pull-right">Date: <span style="font-weight: bold; font-size: 15px"><?php echo $date?></span></span>
       <br><br>
        <table class="table table-hover">
           <tr>
               <th>Item Name</th>
               <th>Quantity</th>
               <th>Price</th>
           </tr>
                    <?php
        $total = 0;
            while ($row = mysqli_fetch_assoc($result))
            {
                $sql = 'SELECT * FROM inventory WHERE itemid = '.$row['itemid'];
                $result1 = mysqli_query($connect, $sql) or die("An error Occured. Error code 0x0023");
                $arr = mysqli_fetch_assoc($result1);

                echo '<tr>';
                echo "<td>" . $arr['name'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['quantity']* $arr['price'] . "</td>";
                $total+= $row['quantity']* $arr['price'];
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
       <div style="float: bottom;">
           <p></p>
       </div>
   </div>

</page>

<script>
    function print() {
        window.print();
    }
</script>