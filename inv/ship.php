<?php

include_once 'include/inc.db.php';
require 'header.php';
if(isset($_POST["add_to_cart"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'			=>	$_GET["id"],
                'item_name'			=>	$_POST["hidden_name"],
                'item_price'		=>	$_POST["hidden_price"],
                'item_quantity'		=>	$_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
            echo '<script>alert("Item Already Added")</script>';
        }
    }
    else
    {
        $item_array = array(
            'item_id'			=>	$_GET["id"],
            'item_name'			=>	$_POST["hidden_name"],
            'item_price'		=>	$_POST["hidden_price"],
            'item_quantity'		=>	$_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}

if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="ship.php"</script>';
            }
        }
    }
}

?>
    <!DOCTYPE html>
    <html>
    <body>
    <br />
    <div class="container">
        <h3 align="center">New Order</h3><br />
        <br /><br />
        <h3>Order Details</h3>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th width="40%">Item Name</th>
                    <th width="10%">Quantity</th>
                    <th width="20%">Price</th>
                    <th width="15%">Total</th>
                    <th width="5%">Action</th>
                </tr>
                <?php
                if(!empty($_SESSION["shopping_cart"]))
                {
                    $total = 0;
                    foreach($_SESSION["shopping_cart"] as $keys => $values)
                    {
                        ?>
                        <tr>
                            <td><?php echo $values["item_name"]; ?></td>
                            <?php

                            ?>
                            <td><?php echo $values["item_quantity"]; ?></td>
                            <td> <?php echo $values["item_price"]; ?></td>
                            <td> <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                            <td><a href="ship.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
                        </tr>
                        <?php
                        $total = $total + ($values["item_quantity"] * $values["item_price"]);
                    }
                    ?>
                    <tr>
                        <td colspan="3" align="right">Total</td>
                        <td align="right"> <?php echo number_format($total, 2); ?></td>
                        <td></td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td align="right" colspan="5"><a href="include/orderChange.php?total=<?php echo $total?>" onclick="window.open('delay.php')"  class="btn btn-primary" >Confirm Order</a></td>
                </tr>
            </table>
        </div>
        <div class="panel panel-info">
            <div class="panel-heading">Items</div>
            <div class="panel-body">
                <?php
                $query = "SELECT * FROM dumyitem ORDER BY itemid ASC";
                $result = mysqli_query($connect, $query) or die("An Error Occured. Error code 0x0012");
                if(mysqli_num_rows($result) > 0)
                {
                    while($row = mysqli_fetch_array($result))
                    {
                        $re = mysqli_fetch_assoc(mysqli_query($connect, 'Select quantity from dumyitem where itemid = '.$row['itemid']));
                        $qua = $re['quantity'];
                        ?>
                        <div class="col-md-2">
                            <form method="post" action="ship.php?action=add&id=<?php echo $row["itemid"]; ?>">
                                <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
                                    <h4 class="text-info"><?php echo $row["name"]; ?></h4>

                                    <h4 class="text-danger"><?php echo $row["price"]; ?> rs</h4>

                                    <input type="number" name="quantity" min="1" value="" max="<?php echo $qua?>" class="form-control" />
                                    <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

                                    <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

                                    <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add Item" />

                                </div>
                            </form>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div style="clear:both"></div>
        <br />
    </div>
    <br />
    </body>
    </html>

<?php
//If you have use Older PHP Version, Please Uncomment this function for removing error

/*function array_column($array, $column_name)
{
	$output = array();

	foreach($array as $keys => $values)
	{
		$output[] = $values[$column_name];
	}
	return $output;
}*/
?>