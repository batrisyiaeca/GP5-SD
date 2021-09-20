<!DOCTYPE html>

<?php include('partials-front/navbar.php');?>

<html lang="en" dir="ltr">

			<head>

			<link rel="stylesheet" href="css/cat.css">
			</head>

		<body>
<section class="food-menu">
	<div class="container">
		<h2 class="text-center">Desserts</h2>

		<?php
		//Getting data from database
		$sql="SELECT * FROM tbl_food WHERE active='Yes'LIMIT 6";

		$res=mysqli_query($conn,$sql);
		$count=mysqli_num_rows($res);

		//check data exist or not
		if($count>0)
		{
			//Data exist
			while($row=mysqli_fetch_assoc($res))
			{
				//Declare Value
				$id=$row['id'];
				$title=$row['title'];
				$price=$row['price'];
				$description=$row['description'];
				$image_name=$row['image_name'];
				?>

				<div class="food-menu-box">
					<div class="food-menu-img">
					<?php
						//Checi if image is availble
						if($image_name=="")
						{
							echo"<div class='error'>Image not Available</div>";
						}
						else
						{
						?>
							<img src="<?php echo SITEURL; ?>images/food<?php echo $image_name; ?> width="100px">
						<?php
						}
					?>
					</div>

					<div class="food-menu-desc">
						<h4><?php echo $title?></h4>
						<p class="food-price"><?php echo $price?></p>
						<p class="food-detail"><?php echo $description?></p>
						<br>

						<a href="order.html" class="btn btn-primary">Order Now</a>
					</div>
				</div>

				<?php
			}
		}
		else
		{
			echo"<div class='error'>Desert Not Available</div>";
		}

		?>


		<div class="clearfix"></div>

	</div>
</section>


</body>
</html>

<?php include('partials-front/footer.php');?>
