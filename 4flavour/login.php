<!DOCTYPE html>

<html lang="en" dir="ltr">
		<body>

			<?php include 'navbar.php' ?>
	  <link rel="stylesheet" type="text/css" href="css/style.css">

		<img class="bg-image" src="images/user.png" alt="4flavour"></div>
		<section class="signup-form">
	  <div class="center">
		<h2><div style = " text-align: center; margin-top: -50px; color:#184C57; ">Log In</div></h2>
		</div>
			<form action="includes/login_incl.php" method="post">
				<div class="input-group">
				<input type="text" name="uid" placeholder="Username/Email">
				</div>

				<div class="input-group">
				<input type="password" name="pwd" placeholder="Password">
				</div>

				<div class="input-group">
				<button type = "submit" name="submit">Log In</button>
				</div>

				<div class="question">
				<a href="admin/loginadmin.php">Are you an admin? Click here</a>
				</div>

			</form>
			</div>

	<?php
		if (isset($_GET["error"])) {
			if ($_GET["error"] == "emptyinput") {
				echo "<p>Fill in all fields!</p>";
			}
			else if ($_GET["error"] == "wronglogin") {
				echo "<p>Incorrect login information!</p>";

			}

		}
	?>

</body>
</html>
