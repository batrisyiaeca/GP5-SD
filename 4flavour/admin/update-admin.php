<?php include ('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<body>
 <?php include __DIR__.'/sidebar.php';?>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
        echo "<body style='background-color:#FFAD6A'>";
			<br><br>
            <h2>Update Admin</h2>
			<br><br>

        <?php
            //Get ID
            $adminId=$_GET['id'];

            //Create SQL Query
            $sql= "SELECT * FROM tbl_admin WHERE id=$adminId";

            //Execute Query
            $res=mysqli_query($conn,$sql);

            //Check if Query Executed
            if($res==true)
            {
                //Check if available
                $count = mysqli_num_rows($res);
                //Check have data or not
                if($count==1)
                {
                    //Get Details
                    $row = mysqli_fetch_assoc($res);

                    $adminName = $row['full_name'];
                    $adminUid = $row['username'];
                }
                else
                {
                    //Redirect to Manage Admin
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        ?>

            <form action="" method="POST">
                <table class = "tbl-full">
                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type = "text" name = "full_name" value= "<?php echo $adminName;?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type = "text" name = "username" value= "<?php echo $adminUid;?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type = "hidden" name = "id" value = "<?php echo $adminId;?>">
                            <input type ="submit" name="updateAdmin" value="Update Admin" class="btn-update">
                        </td>
                    </tr>
                </table>
             </form>

            <?php
                //Check submit button clicked or not
                if(isset($_POST['updateAdmin']))
                {
                    //Get Value to update
                    $adminId = $_POST['id'];
                    $adminName = $_POST['full_name'];
                    $adminUid = $_POST['username'];

                    //Create SQL Query
                    $sql = "UPDATE tbl_admin SET
                    full_name = '$adminName',
                    username = '$adminUid'
                    WHERE id= $adminId
                    ";

                //Execute Query
                    $res = mysqli_query($conn, $sql)or die(mysqli_error($conn));

                    if($res==true)
                    {
                        $_SESSION['update'] = "Admin Updated Successfully";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                        $_SESSION['update'] = "Admin Update Failed";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
            }
            ?>
<script src = "js/script.js"></script>
