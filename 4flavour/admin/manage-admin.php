<?php include ('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<body>
 <?php include __DIR__.'/sidebar.php';?>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
			<h2>Manage Admin</h2>
			<!--add admin-->
			<br/>

			<?php
			if(isset($_SESSION['add']))
				{
					echo $_SESSION['add'];//Display message
					unset($_SESSION['add']);//Remove message
				}
			?>
			<br><br>
				<a href="add-admin.php" class="btn-add">Add Admin</a>
			<br/><br/>
			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Full Name</th>
					<th>Username</th>
					<th>Actions</th>
				</tr>

				<?php
					//Query to Get all Admin
					$sql = "SELECT * FROM tbl_admin";

					//Execute the Query
					$res = mysqli_query($conn, $sql);

					//Check wether the Query is Executed or not
					if($res==TRUE)
					{
						//Data in database
						$count = mysqli_num_rows($res);//Get all the rows in database

						$sn=1; //Create variable and assign value

						//check num of row
						if($count>0)
						{
							while($rows=mysqli_fetch_assoc($res))
							{
							//Get individual data
								$adminId=$rows['id'];
								$adminName=$rows['full_name'];
								$adminUid=$rows['username'];

								//Display in Table

								?>
									<tr>
										<td><?php echo $sn++;?></td>
										<td><?php echo $adminName;?></td>
										<td><?php echo $adminUid;?></td>
										<td>
											<a href=# class="btn-update">Update Admin</a>
											<a href=# class="btn-delete">Delete Admin</a>
										</td>
									</tr>

								<?php

								}
							}
							else
							{
								//Data we dont have
							}
						}
						?>

			</table>


</body>
</html>

<script src = "js/script.js"></script>
