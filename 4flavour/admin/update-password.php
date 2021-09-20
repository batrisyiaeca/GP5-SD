<?php include ('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<body>
 <?php include __DIR__.'/sidebar.php';?>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
            <br><br>
            <h2>Update Password</h2>
			<br><br>
            <?php
                if(isset($_GET['id']))
                {
                    $id=$_GET['id'];
                }
            ?>
            
            <form action="" method="POST">
                <table>
                    <tr>
                        <td>Old Password: </td>
                        <td>
                            <input type="password" name="current_pwd" placeholder="Old Password">
                        </td>
                    </tr>
                    <tr>
                        <td>New Password: </td>
                        <td>
                            <input type="password" name="new_pwd" placeholder="New Password">
                        </td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td>
                            <input type="password" name="confirm_pwd" placeholder="Confirm Password">
                        </td>
                    </tr>
                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="submit" name="submit" value="Change Password" class="btn-update">
                        </td>
                        
                    </tr>
                </table>
            </form> 
        <?php
            if(isset($_POST['submit']))
            {
                //Get data
                $adminId = $_POST['id'];
                $adminPowd = md5($_POST['current_pwd']);
                $new_pwd =  md5($_POST['new_pwd']);
                $confirm_pwd = md5($_POST['confirm_pwd']);

                //Check User and Password exist
                $sql = "SELECT * FROM tbl_admin 
                WHERE id='$adminId' 
                AND password='$adminPowd'
                ";
            
                //Check New and Confirm match
                $res = mysqli_query($conn, $sql);
                
                if($res==true)
                {
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        if($new_pwd==$confirm_pwd)
                        {
                            echo "Password Match";
                            $sql2 = "UPDATE tbl_admin SET
                            password = '$new_pwd'
                            WHERE id= $adminId
                            ";

                            $res2 = mysqli_query($conn, $sql2);
                            if ($res2==true)
                            {
                                $_SESSION['change-pwd'] = "Password Changed Successfully.";
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                $_SESSION['change-pwd'] = "Failed to change Password.";
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                        }
                        else
                        {
                            $_SESSION['pwd-not-match'] = "Password did not match.";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }                    
                    }
                    else
                    {   
                        $_SESSION['user-not-found'] = "User not Found.";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    
                }
                //Change Password
            }
        ?>
<script src = "js/script.js"></script>