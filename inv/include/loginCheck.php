<?php
session_start();

    if (isset($_POST['submit'])) {
        include_once "inc.db.php";
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $pass = mysqli_real_escape_string($connect, $_POST['password']);

        if (empty($username) || empty($pass)) {
            echo "<script type='text/javascript'>
        alert('Empty fields');
        location = '../index.php';
      </script>";
            exit();
        } else {
            $query = "SELECT * FROM _user WHERE username = '$username'";
            $result = mysqli_query($connect, $query) or die("An error occured. Error code 0x0021");
            $resCheck = mysqli_num_rows($result);
            if ($resCheck == 0) {
                echo "<script type='text/javascript'>
            alert('Wrong Username');
            location = '../index.php';
            </script>";
                exit();
            } else {
                if ($row = mysqli_fetch_assoc($result)) {
                    if ($row['_pass'] != $pass) {
                        echo "<script type='text/javascript'>
               alert('Wrong password');
               location = '../index.php?login=Error';
               </script>";
                        exit();
                    } else {
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['_pass'] = $row['_pass'];
                        $_SESSION['shopping_cart'] = NULL;
                        echo "<script type='text/javascript'>
               alert('Login Success');
               location = '../home.php?login=Success';
               </script>";
                        exit();
                    }
                }

            }
        }

    } else {
        header("Location: ../index.php");
        exit();
    }

?>

