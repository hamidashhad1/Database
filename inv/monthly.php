<?php
    include_once 'header.php';
    require_once 'include/inc.db.php';
    $sql = "SELECT DISTINCT Extract(month FROM orderdate) as mon, Extract(year FROM orderdate) as ye from sales";
    $res = mysqli_query($connect,$sql) or die("An Error Occured.. Error Code= 0x0016");
    $num = mysqli_num_rows($res);
    if(!($num > 0))
    {
        echo "No Data to be displayed";
        exit();
    }
    else
    {
?>

<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">Montly Sales</div>
        <div class="panel-body">
            <?php
                while ($row = mysqli_fetch_assoc($res))
                {
                    $mon = getMonth($row['mon']);
            ?>
                    <h3><?php echo $mon;?></h3>
                    <h5><?php echo date("Y", strtotime($row['ye']));?></h5>
                    <?php $mon = $row['mon'];?>
                    <table class="table table-hover">
                        <tr>
                            <?php
                            $sas = 'select sum(total) as T from sales where EXTRACT(month from orderdate)= '.$mon;
                            $pop = mysqli_query($connect,$sas) or die("AN error occured. Error Code = 0x0016");
                            $col = mysqli_fetch_assoc($pop);
                                 ?>
                            <td style="font-weight: bold">Total Earning: </td>
                            <td><?php echo $col['T'];   ?></td>
                        </tr>
                    </table>
            <?php
                }
             ?>
        </div>
    </div>
</div>


<?php

    }
    function getMonth($mon)
    {
        if($mon == 1)
        {
            return 'January';
        }
        else if($mon == 2)
        {
            return 'February';
        }
        else if($mon == 3)
        {
            return 'March';
        }
        else if($mon == 4)
        {
            return 'April';
        }
        else if($mon == 5)
        {
            return 'May';
        }
        else if($mon == 6)
        {
            return 'June';
        }
        else if($mon == 7)
        {
            return 'July';
        }
        else if($mon == 8)
        {
            return 'August';
        }
        else if($mon == 9)
        {
            return 'September';
        }
        else if($mon == 10)
        {
            return 'October';
        }
        else if($mon == 11)
        {
            return 'November';
        }
        else
        {
            return 'December';
        }
    }
?>