<!DOCTYPE html>

<?php include('partials-front/navbar.php');?>

<html lang="en" dir="ltr">

			<head>

			<link rel="stylesheet" href="css/cat.css">
			</head>

<!-- Category Section start here -->
<body>
<section class="food-menu">
	<div class="container">
		<h2 class="text-center">Explore Desserts</h2>

		<?php
            //Display All categories that are active
            $sql="SELECT * FROM tbl_category WHERE active='Yes'";

            $res=mysqli_query($conn,$sql);
            //count rows
            $count=mysqli_num_rows($res);

            //check data exist or not
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    //Declare Value
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                        <a href="category-food.html">
                            <div class="box-3 float-container">
                            <?php
							//Checi if image is availble
							if($image_name=="")
							{
								echo"<div class='error'>Image not Available</div>";
							}
							else
							{
							?>
								<img src="<?php echo SITEURL; ?>images/category<?php echo $image_name; ?>" width="100px" >
							<?php
							}
							?>
                                <h3 class='float-text text-white'><?php echo $title; ?></h3>
                            </div>
                        </a>

                    <?php

                }
            }
            else
            {
                echo"<div class='error'>Category Not Found</div>";
            }

        ?>


    </div>
</section>
</body>
</html>
<!-- Category Section end here -->

<?php include('partials-front/footer.php');?>
