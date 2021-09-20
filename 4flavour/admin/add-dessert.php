<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<body>
 <?php include __DIR__.'/sidebar.php';?>
  <link rel="stylesheet" type="text/css" href="css/admin.css">
      echo "<body style='background-color:#FFAD6A'>";
      <h1>Add Dessert</h1>


      <br><br>

    <?php
      if(isset($_SESSION['upload']))
      {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
      }
     ?>

    <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">

          <tr>
            <td>Title: </td>
            <td>
              <input type="text" name="title" placeholder="Title of the food">
            </td>
          </tr>

          <tr>
            <td>Description: </td>
            <td>
              <textarea name="description" rows="5" cols="50" placeholder="Description of the food"></textarea>
            </td>
          </tr>

          <tr>
            <td>Price: </td>
            <td>
              <input type="number" name="price">
            </td>
          </tr>

          <tr>
            <td>Select Image: </td>
            <td>
              <input type="file" name="image">
            </td>
          </tr>

          <tr>
            <td>Category: </td>
            <td>
              <select name="category" >

                <?php
                  //create PHP code to display categories from database
                  //1/ Create SQL to get all active categories from database
                  $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                  //Executing query
                  $res = mysqli_query($conn, $sql);

                  //Count rows to check whether we have categories or not
                  $count = mysqli_num_rows($res);

                  //If count is greater than zero, we have categories else we do not have categories
                  if($count>0)
                  {
                    //We have categories
                    while($row = mysqli_fetch_assoc($res))
                    {
                      //get the details of categories
                      $id = $row['id'];
                      $title = $row['title'];

                      ?>

                      <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                      <?php
                    }
                  }
                  else
                  {
                      //We do not have categories
                      ?>
                      <option value="0">No Categories Found</option>
                      <?php

                  }

                  //2. Display on dropdown

                 ?>

              </select>
            </td>
          </tr>

          <tr>
            <td>Featured: </td>
            <td>
              <input type="radio" name="featured" value="Yes"> Yes
              <input type="radio" name="featured" value="No"> No
            </td>
          </tr>

          <tr>
            <td>Active: </td>
            <td>
              <input type="radio" name="active" value="Yes"> Yes
              <input type="radio" name="active" value="No"> No
            </td>
          </tr>

          <tr>
            <td colspan="2">
              <input type="submit" name="submit" value="Add Order" class="btn-secondary">
            </td>
          </tr>

        </table>


    </form>

    <?php

      //Check whether the button is clicked or not
      if (isset($_POST['submit']))
      {
          //Add the Food in database
          //echo "Clicked";

          //1. Get the data from form
          $title = $_POST['title'];
          $description = $_POST['description'];
          $price = $_POST['price'];
          $category = $_POST['category'];

          //Check whether radion button for feature and active are checked or not
          if (isset($_POST['featured']))
          {
            $featured = $_POST['featured'];
          }
          else
          {
            $featured = "No"; //Setting the default value
          }

          if(isset($_POST['active']))
          {
            $active = $_POST['active'];
          }
          else
          {
            $active = "No"; //Setting default value
          }

          //2. Upload the image if selected
          //Check whether the select image is clicked or not and upload the image only if the image is selected
          if(isset($_FILES['image']['name']))
          {
            //Get the details of the selected image
            $image_name = $_FILES['image']['name'];

            //Check whether the image is selected or not and upload image only if selected
            if($image_name!= "")
            {
              //Image is selected
              //1. Rename the image
              //Get the extension of selected image


              //Create new name for image
               //New image name

              //2. Upload the image
              //Get the src path and destination path

              //Source path is the current location of the image
              $src = $_FILES['image']['tmp_name'];

              //Destination path for the image to be uploaded
              $dst = "../images/food/".$image_name;

              //Finally upload food image
              $upload = move_uploaded_file($src,  $dst);

              //Check whether image uploaded or not
              if($upload==false)
              {
                //Failde to upload image
                //Redirect to Add Order page with error message
                $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                header('location:'.SITEURL.'admin/add-dessert.php');
                //Stop process
                die();
              }
            }

          }
          else
          {
            $image_name = "";
          }

          //3. Insert into Database

          //Create an SQL query to save or add food
          //For numerical we do not need to pass value inside quotes '' but for string value it is compulsory to add quotes ''
          $sql2 = "INSERT INTO tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active = '$active'
            ";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);
            //Check whether data inserted or not

          //4. Redirect with Message to manage food page
          if($res2 == true)
          {
            //Data inserted Successfully
            $_SESSION['add'] = "<div class = 'success'>Food added successfully.</div>";
            header ('location:',SITEURL.'admin/manage-dessert.php');
          }
          else
          {
            //Failed to insert data
            $_SESSION['add'] = "<div class = 'failed'>Failed to add food.</div>";
            header ('location:',SITEURL.'admin/manage-dessert.php');
          }

      }

     ?>

  </div>
</div>
