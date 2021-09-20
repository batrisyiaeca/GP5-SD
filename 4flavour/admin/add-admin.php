<?php include ('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<body>

  <?php include __DIR__.'/sidebar.php';?>
     <link rel="stylesheet" type="text/css" href="css/admin.css">
     echo "<body style='background-color:#FFAD6A'>";
     <h1>Add Admin</h1>
     <br><br>
    <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];//Display Message
            unset ($_SESSION['add']);//Remove Message
        }
    ?>

    <form action="" method="POST">

        <table class="tbl-full" >
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="Enter Your Name Here">
            </td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" placeholder="Your Username"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" placeholder="Your Password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="add-adminbtn" value="Add Admin" class="btn-add">
                </td>
            </tr>
        </table>
</form>
<?php
    if(isset($_POST['add-adminbtn']))
    {
        $adminName = $_POST['full_name'];
        $adminUid = $_POST['username'];
        $adminPwd= md5($_POST['password']);

        $sql = "INSERT INTO tbl_admin SET
            full_name ='$adminName',
            username ='$adminUid',
            password ='$adminPwd'
        ";
        $res = mysqli_query($conn, $sql)or die(mysqli_error($conn));

        if($res==TRUE)
        {
            //Data Insert
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "Admin Added Successfully";
            //redirect Admin to Manage Admin
            header("location: manage-admin.php");
        }
        else
        {
            //Failed to Insert Data
            $_SESSION['add'] = "Failed to Add Admin";
            //redirect Admin to Manage Admin
            header("location: /manage-admin.php");
        }
    }
?>
<script src = "js/script.js"></script>
