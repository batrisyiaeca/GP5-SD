<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<body>
 <?php include __DIR__.'/sidebar.php';?>
  <link rel="stylesheet" type="text/css" href="css/admin.css">
      echo "<body style='background-color:#FFAD6A'>";
      <h1>Add Category</h1>
      <br><br>

      <?php
        if(isset($_SESSION['add']))
        {
          echo $_SESSION['add'];
          unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload']))
        {
          echo $_SESSION['upload'];
          unset($_SESSION['upload']);
        }

       ?>

       <br><br>


      <form action="" method="POST" enctype="multipart/form-data">

          <table class="tbl-full" >
              <tr>
                  <td>Title: </td>
                  <td><input type="text" name="title" placeholder="Category Titlle">
              </td>
              </tr>


              <tr>
                  <td>Select Image: </td>
                  <td>
                    <input type="file" name="image">
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
                      <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                  </td>
              </tr>
          </table>
  </form>
  <!-- Add Category Form Ends -->

  <?php

    //Check whether the button is clicked or not
    if (isset($_POST['submit']))
    {
        //echo "Clicked";

        //1. Get the value from Category form
        $title = $_POST['title'];

        //For radio input, we need to check whether the button is selected or not
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

        //Check whether image is selected or not and set value for image name accordingly
        //print_r($_FILES[]);

        //die();//Break the code here

        if(isset($_FILES['image']['name']))
        {
          //upload the image
          //To upload image we need image name, source path and destination path
          $image_name = $_FILES['image']['name'];

          //Upload image only if image is selected
          if($image_name != "")
          {


            //Auto rename our image
            //Get the extension of our image


            //Rename the image
             // e.g. Food_Category_834.jpg

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
              header('location:'.SITEURL.'admin/add-category.php');
              //Stop the process
              die();
            }

        }

        }
        else
        {
          //Don't upload image and set the image_name value as blank
          $image_name="";
        }

        //2. Create SQL query to insert Category into Database
        $sql = "INSERT INTO tbl_category SET
          title = '$title',
          image_name = '$image_name',
          featured = '$featured',
          active = '$active'

        ";

        //3. Execute the query and save in database
          $res = mysqli_query($conn, $sql);

        //4. Check whether the query executed or not and data added or not
        if($res == true)
        {
          //Data inserted Successfully
          $_SESSION['add'] = "<div class = 'success'>Category added successfully.</div>";
          header ('location:',SITEURL.'admin/manage-category.php');
        }
        else
        {
          //Failed to insert data
          $_SESSION['add'] = "<div class = 'success'>Failed to add food.</div>";
          header ('location:',SITEURL.'admin/manage-category.php');
        }

    }
