<?php

    include_once "header.php";
?>

<?php
    include_once "include/inc.db.php";
    $sql = "SELECT * FROM dumyitem";
    $result = mysqli_query($connect, $sql) or die ("An Error occured. Error Code: 0x0012");
    if(isset($_GET['submit']))
    {
        $field = $_GET['sear'];
        $sql = "SELECT * FROM dumyitem WHERE name like '%$field%'";
        $result = mysqli_query($connect, $sql) or die("An Error occured. Error Code: 0x0012");
        $num = mysqli_num_rows($result);
        if(!($num >0))
        {
            echo "<script type='text/javascript'>
        alert('No Item Found');
        location = 'home.php';
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
        <div class="panel-heading">Inventory</div>

        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Cartons</th>
                    <th>Total Quantity</th>
                    <th>Price</th>
                    <th>Date of Entry</th>
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
                        echo "<td>" . $row['carton'] . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['dateofentry'] . "</td>";
                        echo "<td><a  href='detail.php?id=" . $row['itemid'] . "'><input type='button' class='btn btn-info' value='Details'></a>";
                    }
                ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

</body>
</html>