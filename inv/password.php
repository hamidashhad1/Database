<?php  include_once "header.php";

?>

<div class="container">
<div class="panel panel-info">
    <div class="panel-heading">Change Password </div>
    <div class="panel-body" style="margin-left: .1cm">
        <form action="include/pass.php" method="post">
            <div class="row">
                <label>Old Password</label>
                <input style="width: 8cm" class="form-control   " id="inputsm" type="password" placeholder="Old Password" name="oldpass">
            </div>
            <br>
            <div class="row">
                <label>New Password</label>
                <input style="width: 8cm" class="form-control   " id="inputsm" type="password" placeholder="New Password" name="newpass">
            </div>
            <br>
            <div class="row">
                <label>Confirm Password</label>
                <input style="width: 8cm" class="form-control  " id="inputsm" type="password" placeholder="Confirm Password" name="conpass">
            </div>
                <br>
                <input type="submit" value="Change Password" name="submit" class="btn btn-primary">
        </form>
</div>

</div>