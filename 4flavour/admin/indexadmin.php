<?php
session_start();
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
		<body>

 <?php include __DIR__.'/sidebar.php';?>

 <div class="section white-text center" style="background: #FFAD6A; margin-top: -120px; ">

 	<div class="row " style="padding: 200px; ">
 		<div class="col s12">

			 	<h1><div style = " text-align: center; margin-left: 220px; color:white; ">Dashboard </div> </h1>

 			<a class="dash-btn" href="manage-admin.php"><div class="sec white white-text" style="margin: 15px; margin-left: 220px;text-align: center; color:white; padding: 40px;border: 2px; border-radius: 20px; font-size: 20px; background: #4BAAA6;">Manage Admin</div></a>
 			<a class="dash-btn" href="manage-category.php"><div class="sec white white-text" style="margin: 15px; margin-left: 220px; text-align: center; color:white; padding: 40px;border: 2px; border-radius: 20px; font-size: 20px; background: #4BAAA6;">Category</div></a>
 			<a class="dash-btn" href="manage-dessert.php"><div class="sec white white-text" style="margin: 15px; margin-left: 220px; text-align: center; color:white; padding: 40px;border: 2px; border-radius: 20px; font-size: 20px; background: #4BAAA6;">Dessert</div></a>
 			<a class="dash-btn" href="#"><div class="sec white white-text" style="margin: 15px; margin-left: 220px; text-align: center; color:white; padding: 40px;border: 2px; border-radius: 20px; font-size: 20px; background: #4BAAA6;">Order</div></a>



		</div>

 	</div>

 </div>


</body>
</html>
