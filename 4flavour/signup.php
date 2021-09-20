<!DOCTYPE html>

<html lang="en" dir="ltr">
		<body>

<?php include('partials-front/navbar.php');?>
	  <link rel="stylesheet" type="text/css" href="css/style.css">

		<img class="bg-image" src="images/user.png" alt="4flavour"></div>
	  <section class="signup-form">
	  <div class="center">
		<h2><div style = " text-align: center; margin-top: -50px; color:#184C57; ">Sign Up</div></h2>
		</div>
			<form action="includes/signup_incl.php" method="post">
				<div class="input-group">
				<input type="text" name="name" placeholder="Full name">
				</div>

				<div class="input-group">
				<input type="text" name="email" placeholder="Email">
				</div>

				<div class="input-group">
				<input type="text" name="uid" placeholder="Username">
				</div>

				<div class="input-group">
				<input type="password" name="pwd" placeholder="Password">
				</div>

				<div class="input-group">
				<input type="password" name="pwdrepeat" placeholder="Repeat Password">
				</div>

				<div class="input-group">
				<button type = "submit" name="submit">Sign Up</button>
				</div>

				</form>

				</div>

	<?php
		if (isset($_GET["error"])) {
			if ($_GET["error"] == "emptyinput") {
				echo "<p>Fill in all fields!</p>";
			}
			else if ($_GET["error"] == "invaliduid") {
				echo "<p>Choose a proper username!</p>";

			}else if ($_GET["error"] == "invalidemail") {
				echo "<p>Choose a proper email</p>";
			}
			else if ($_GET["error"] == "passwordsdontmatch") {
				echo "<p>Password doesn't match!</p>";
			}
			else if ($_GET["error"] == "stmtfailed") {
				echo "<p>Something went wrong, try again!</p>";
			}
			else if ($_GET["error"] == "usernametaken") {
				echo "<p>Username exist!</p>";
			}
			else if ($_GET["error"] == "none") {
				echo "<p>You have signed up!</p>";
			}
		}
	?>

		</section>

</body>
</html>

<script src = "js/script.js"></script>
