<?php
    include_once "header.php";
?>
<?php
if(isset($_SESSION['id']))
{
    if(isset($_GET['submit']))
    {
        include_once "include/inc.db.php";
        $name = $_GET['name'];
        $quan = $_GET['quan'];
        $price = $_GET['price'];
        $des = $_GET['des'];
        $car = $_GET['carton'];
        $itemCar = $_GET['cartonItem'];
        if(empty($car) && (empty($quan) || empty($itemCar)))
        {
            echo "<script type='text/javascript'>
            alert('Invalid Quantity'); 
           </script>";
            header("Location: addinv.php?name=".urlencode($name). '&des='.urlencode($des));
            exit();
        }

        if($quan < 0)
        {
            echo "<script type='text/javascript'>
            alert('Invalid Quantity');
            </script>";
            header("Location: addinv.php?name=".urlencode($name). '&des='.urlencode($des));
            exit();
        }
        else if($price < 0)
        {
            echo "<script type='text/javascript'>
              alert('Invalid Price');
                </script>";
            header("Location: addinv.php?name=".urlencode($name). '&des='.urlencode($des));
            exit();
        }
        else
        {
            $fin = 0;
            if(empty($quan) && !empty($car))
            {
                $quan = $car * $itemCar;
            }
            else
            {
                $car  = 0;
            }
            $sql = "INSERT INTO inventory(name, descrip,carton , quantity, caritem, price, dateofentry) values ('$name', '$des', $car,'$quan', '$itemCar','$price', now())";
            mysqli_query($connect, $sql) or die("Error Occured. Error code 0x0023");
            $sql = "INSERT INTO dumyitem(name, descrip, carton ,quantity, caritem, price, dateofentry) values ('$name', '$des', $car,'$quan', '$itemCar','$price', now())";
            mysqli_query($connect, $sql) or die("Error Occured. Error code 0x0022");
            echo "<script type='text/javascript'>
               alert('Item Added');
               location = 'home.php?add=Success';
               </script>";
            exit();
        }
    }
}
?>

<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">Add Item</div>
            <div class="panel-body">
                <form action="" method="GET">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label>Name: </label>
                                <input  type="text" class="form-control" placeholder="Name" <?php $na=''; if(isset($_GET['name'])) { $na = $_GET['name'];}?> name="name" value="<?php echo $na?>" required>
                            </div>
                            <div class="col-sm-12 form-group">
                                <label>Description</label>
                                <input type="text" name="des" placeholder="description" class="form-control" <?php $na=''; if(isset($_GET['name'])) { $na = $_GET['name'];}?> name="name" value="<?php echo $na?>"  required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 form-group">
                                <label>Quantity: </label>
                                <input type="number" placeholder="Quantity "  min="0" max="10000" name="quan" class="form-control" onkeypress="return event.charCode >=48
&& event.charCode <= 57">
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Carton: </label>
                                <input type="number" placeholder="Carton"  min="0" max="10000" name="carton" class="form-control" onkeypress="return event.charCode >=48
&& event.charCode <= 57" >
                            </div>
                            <div class="col-sm-4 form-group">
                                <label>Items in Carton: </label><span class="badge badge-pill badge-warning"> Enter only if adding carton in stock </span>
                                <input type="number" name ="cartonItem" placeholder="Items in carton" min="0" max="10000" name="carton" class="form-control" onkeypress="return event.charCode >=48
&& event.charCode <= 57">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Price</label>
                                <input type="number" placeholder="Price" name="price" min="0" max="1000000" class="form-control" onkeypress="return event.charCode >=48
&& event.charCode <= 57" required>
                            </div>
                        </div>
                        <input type="submit" name="submit" class="btn btn-info" value="Add" style="margin-left: .5cm">
                </form>
            </div>
    </div>
</div>
