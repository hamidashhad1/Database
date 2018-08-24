<?php
session_start();
session_destroy();
session_unset();
echo "<script type='text/javascript'>
       alert('You are about to logged out');
        location = '../index.php';
      </script>";
exit();