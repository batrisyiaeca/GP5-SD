<?php include ('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
		<body style="background-color: #ffad6a">

	  <link rel="stylesheet" type="text/css" href="css/form.css">

		<img class="bg-image" src="../images/user.png" alt="4flavour"></div>
		<section class="signup-form">
	  <div class="center">
		<h2><div style = " text-align: center; margin-top: 280px; color:#184C57; ">Log In</div></h2>
		</div>
			<form action="" method="post">
				<div class="input-group">
				<input type="text" name="username" placeholder="Enter username">
				</div>

				<div class="input-group">
				<input type="password" name="password" placeholder="Enter Password">
				</div>

				<div class="input-group">
				<button type = "submit" name="submitadmin">Log In</button>
				</div>

			</form>
			</div>

</body>
</html>

<?php
	//check wether submit button is click or no
	if (isset($_POST["submitadmin"])) {
		//process for login
		//1.get data from login form
		$adminName = $_POST['username'];
		$adminPwd = md5($_POST['password']);

		//2. sql to check wether the user with username and password exists or not
		$sql = "SELECT * FROM tbl_admin WHERE username = '$adminName' AND password ='$adminPwd' ";

		//3. execute the Query
		$res = mysqli_query($conn, $sql);

		//4. Count rows to check wheter the user exists or not
		$count = mysqli_num_rows($res);

		if($count==1)
		{
			//user available and login sucess
			$_SESSION['login'] = "<div class = 'success' >Login Successful.</div>";
			$_SESSION['username'] = $adminName; //To check either the user is logged in or not and logout will unset it.
			//redirect to Home page
			header('location:'.SITEURL.'admin/indexadmin.php');
		}
		else
			{
				//user not available and login success
				$_SESSION['login'] = "<div class ='error' >Username or Password is not match.</div>";
				//redirect to Home page
				header('location:'.SITEURL.'admin/loginadmin.php');
			}

	}
?>
