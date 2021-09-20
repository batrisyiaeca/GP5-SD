<?php include ('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<body>
 <?php include __DIR__.'/sidebar.php';?>
  <link rel="stylesheet" type="text/css" href="css/admin.css">
      echo "<body style='background-color:#FFAD6A'>";
      <h1>Update Dessert</h1>

      <br><br>

      <?php
        //Check whether the id is set or not
        if(isset($_GET['id']))
        {
          //Get the id and all other detail
          //echo "Getting the data";
          $id = $_GET['id'];

          //Create SQL query
          $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

          //Execute the Query
          $res2 = mysqli_query($conn , $sql2);

          //Count the rows
          $count2 = mysqli_num_rows($res2);

          if($count2==1)
          {
            //Get all the data
            $row2 = mysqli_fetch_assoc($res2);
            $title = $row2['title'];
            $description = $row2['description'];
            $price = $row2['price'];
            $current_image = $row2['image_name'];
            $current_category = $row2['category_id'];
            $featured = $row2['featured'];
            $active = $row2['active'];



          }
          else
          {
            //Redirect to manage dessert with session message
            $_SESSION['no-dessert-found'] = "<div class='error'>Dessert not found.</div";
            header('location:'.SITEURL.'admin/manage-dessert.php');
          }
        }
        else
        {
          //Redirect to manage category
          header('location:'.SITEURL.'admin/manage-dessert.php');
        }
       ?>

      <br><br>
      <form action="" method="POST" enctype="multipart/form-data">

          <table class="tbl-full" >
              <tr>
                  <td>Title: </td>
                  <td><input type="text" name="title" value="<?php echo $title; ?>">
              </td>
              </tr>

              <tr>
                <td>Description: </td>
                <td>
                  <textarea name="description" rows="5" cols="50"><?php echo $description; ?></textarea>
                </td>
              </tr>

              <tr>
                <td>Price: </td>
                <td>
                  <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
              </tr>


              <tr>
                  <td>Current Image: </td>
                  <td>
                    <?php
                      if($current_image != "")
                      {
                        //Display the images
                        ?>

                          <img src = "<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>"width="150px">

                        <?php
                      }
                      else
                      {
                        //Display message
                        echo "<div class='error'>Image Not Added.</div>";
                      }
                     ?>
                  </td>
              </tr>

              <tr>
                  <td>New Image: </td>
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
                          $category_id = $row['id'];
                          $category_title = $row['title'];

                          ?>

                          <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title;  ?></option>

                          <?php
                        }
                      }
                      else
                      {
                          //We do not have categories
                          ?>
                          <option value="0">No Dessert Found</option>
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
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No

                  </td>
              </tr>

              <tr>
                  <td>Active: </td>
                  <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No

                  </td>
              </tr>

              <tr>
                  <td>
                      <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <input type="submit" name="submit" value="Update Dessert" class="btn-update">
                  </td>
              </tr>
            </table>
          </form>

        <?php

          if(isset($_POST['submit']))
          {
            //echo "Clicked";
            //1. Get all the values from our form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. Updating New Image if selected
            if(isset($_FILES['image']['name']))
            {
              //Get image detail
              $image_name = $_FILES['image']['name'];

              //Check whether the image is available or not
              if($image_name != "")
              {
                //Image available
                //Upload the new image
                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/food/".$image_name;

                //Finally upload the image
                $upload = move_uploaded_file($source_path, $destination_path);

                //Check whether the image is uploaded or not
                //And if the image is not uploaded then we will stop the process and redirect with error message
                if($upload==false)
                {
                  //Set message
                  $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                  //Redirect to Add Category Page
                  header('location:'.SITEURL.'admin/manage-dessert.php');
                  //Stop the process
                  die();
                }

                //Remove the current image if available
                if($current_image != "")
                {
                  $remove_path = "../images/food/".$current_image;

                  $remove = unlink($remove_path);

                  //Check whether the image is removed or not
                  //If failed to remove them display message and stop process
                  if($remove==false)
                  {
                    //Failed to remove image
                    $_SESSION['failed-remove']="<div class='error'>Failed to remove current Image.</div>";
                    header('location:'.SITEURL.'admin/manage-dessert.php');
                    die();
                }

                }

              }
              else
              {
                $image_name = $current_image;
              }
            }
            else
            {
              $image_name = $current_image;
            }


            //3. Update the database
            $sql3 = "UPDATE tbl_food SET
              title = '$title',
              description = '$description',
              price = '$price',
              image_name = '$image_name',
              category_id = '$category',
              featured = '$featured',
              active = '$active'
              WHERE id=$id
            ";

            //Execute the query
            $res3 = mysqli_query($conn, $sql3);

            //4. Redirect to manage category with message
            //Check whether executed or not
            if($res3==true)
            {
              //Dessert Updated
              $_SESSION['update'] = "<div class='success'>Dessert Updated Successfully.</div>";
              header('location:'.SITEURL.'admin/manage-dessert.php');
            }
            else
            {
              //Failed to update category
              $_SESSION['update'] = "<div class='error'>Failed to Update Dessert.</div>";
              header('location:'.SITEURL.'admin/manage-dessert.php');
            }
          }

        ?>

    </body>
</html>

<script src = "js/script.js"></script>
