<?php include ('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<body>
 <?php include __DIR__.'/sidebar.php';?>
  <link rel="stylesheet" type="text/css" href="css/admin.css">
      echo "<body style='background-color:#FFAD6A'>";
      <h1>Update Category</h1>

      <br><br>

      <?php
        //Check whether the id is set or not
        if(isset($_GET['id']))
        {
          //Get the id and all other detail
          //echo "Getting the data";
          $id = $_GET['id'];

          //Create SQL query
          $sql = "SELECT * FROM tbl_category WHERE id=$id";

          //Execute the Query
          $res = mysqli_query($conn , $sql);

          //Count the rows
          $count = mysqli_num_rows($res);

          if($count==1)
          {
            //Get all the data
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];



          }
          else
          {
            //Redirect to manage category with session message
            $_SESSION['no-category-found'] = "<div class='error'>Category not found.</div";
            header('location:'.SITEURL.'admin/manage-category.php');
          }
        }
        else
        {
          //Redirect to manage category
          header('location:'.SITEURL.'admin/manage-category.php');
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
                  <td>Current Image: </td>
                  <td>
                    <?php
                      if($current_image != "")
                      {
                        //Display the images
                        ?>
                          <img src = "<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>"width="150px">
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
                      <input type="submit" name="submit" value="Update Category" class="btn-update">
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
              $current_image = $_POST['current_image'];
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

                  $destination_path = "../images/category/".$image_name;

                  //Finally upload the image
                  $upload = move_uploaded_file($source_path, $destination_path);

                  //Check whether the image is uploaded or not
                  //And if the image is not uploaded then we will stop the process and redirect with error message
                  if($upload==false)
                  {
                    //Set message
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                    //Redirect to Add Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                    //Stop the process
                    die();
                  }

                  //Remove the current image if available
                  if($current_image != "")
                  {
                    $remove_path = "../images/category/".$current_image;

                    $remove = unlink($remove_path);

                    //Check whether the image is removed or not
                    //If failed to remove them display message and stop process
                    if($remove==false)
                    {
                      //Failed to remove image
                      $_SESSION['failed-remove']="<div class='error'>Failed to remove current Image.</div>";
                      header('location:'.SITEURL.'admin/manage-category.php');
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
              $sql2 = "UPDATE tbl_category SET
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
              ";

              //Execute the query
              $res2 = mysqli_query($conn, $sql2);

              //4. Redirect to manage category with message
              //Check whether executed or not
              if($res2==true)
              {
                //Category Updated
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
              }
              else
              {
                //Failed to update category
                $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
              }
            }

           ?>

        </body>
      </html>


<script src = "js/script.js"></script>