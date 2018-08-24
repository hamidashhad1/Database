<?php
    include_once '../header.php';
    ?>
<?php

        if(isset($_POST['submit']))
        {
            include_once "inc.db.php";
            $oldps = mysqli_real_escape_string($connect,$_POST['oldpass']);
            $newps = mysqli_real_escape_string($connect,$_POST['newpass']);
            $conps = mysqli_real_escape_string($connect,$_POST['conpass']);
            if(strlen($newps) < 6)
            {
                echo "<script type='text/javascript'>
                    alert('Password must be more than 6 character long');
                    location = '../password.php';
                    </script>";
                exit();

            }
            if($newps == $conps)
            {
                $sql = "SELECT * FROM _user WHERE _pass = '$oldps'";
                $result = mysqli_query($connect,$sql)or die("An Error occured. Error code 0x0021");
                $resCheck = mysqli_num_rows($result);
                if($resCheck > 0)
                {
                    $sql = "update _user set _pass = '$newps'";
                    mysqli_query($connect,$sql) or die("An Error occured. Error code 0x0021");
                    echo "<script type='text/javascript'>
                    alert('Password Changed');
                    location = '../home.php';
                    </script>";
                    exit();
                }
                else
                {
                    echo "<script type='text/javascript'>
                    alert('Password Wrong');
                    location = '../password.php';
                     </script>";
                }
            }
            else
            {
                echo "<script type='text/javascript'>
                    alert('Password Mismatched');
                    location = '../password.php';
                    </script>";
            }
        }
?>