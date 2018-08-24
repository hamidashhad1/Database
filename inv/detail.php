<?php

include_once "header.php";
include_once "include/inc.db.php";

$id = $_GET['id'];

$sql = "SELECT * FROM dumyitem WHERE  itemid = '$id'";

$result = mysqli_query($connect, $sql) or die ("Error Occured. Error Code: 0x0012");
$res = mysqli_num_rows($result);
if($res == 0)
{
    echo "<script type='text/javascript'>
               alert('No Data Found against given ID');
               location = 'home.php';
               </script>";
    exit();
}
    $iq = 0;
    $sql = "SELECT SUM(quantity) as TQ From oderitem WHERE itemid = '$id'";
    $te = mysqli_query($connect, $sql) or die ("An error Occured. Error Code: 0x0012");
    $fetch = mysqli_fetch_assoc($te);
    $iq = $fetch['TQ'];
?>

<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">Item Details</div>

        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Total Quantity</th>
                    <th>Price</th>
                    <th>Total Sales</th>
                    <th>Date of Entry</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result))
                {
                    echo '<tr>';
                    echo "<td>" . $row['itemid']. "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['descrip'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $iq . "</td>";
                    echo "<td>" . $row['dateofentry'] . "</td>";
                    echo "<td><a class='btn btn-warning' href='include/revItem.php?id=" . $row['itemid'] . "'>Delete</a>";
                    $price= $row['price'];
                    $desc = $row['descrip'];
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="panel panel-info">
        <div class="panel-heading">Update Details</div>

        <div class="panel-body" style="margin-left: .1cm">
            <form method="get" action="include/update.php">
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label>Quantity: </label>
                        <input type="number" placeholder="Quantity" value="0" min="0" max="10000" name="quan" class="form-control">
                    </div>
                    <div class="col-sm-6 form-group">
                        <label>Carton: </label>
                        <input type="number" placeholder="Carton" value="0" min="0" max="10000" name="car" class="form-control">
                    </div>
                    <div class="col-sm-6 form-group">
                         <label>Price</label>
                         <input type="number" ondrop="return false" onpaste="return false" placeholder="Price" value="<?php echo $price;?>" name="price" class="form-control" required>
                    </div>

                    <div class="col-sm-6 form-group">
                        <label>Description</label>
                        <input type="text" placeholder="Description" value="<?php echo $desc;?>" name="descr" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                            <input type="submit" name="submit" class="btn btn-info" value="Update" style="margin-left: .5cm">
                            <input type="text" name="id" value="<?php echo $id ?>" hidden>
                </div>
            </form>
        </div>
    </div>
</div>