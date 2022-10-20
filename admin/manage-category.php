<?php include("partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Manage Category</h1>
    <br><br>

    <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];  //Displaying session message
            unset($_SESSION['add']); //Removing session message
         }

         if(isset($_SESSION['remove'])){
            echo $_SESSION['remove'];  //Displaying session message
            unset($_SESSION['remove']); //Removing session message
         }

         if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];  //Displaying session message
            unset($_SESSION['delete']); //Removing session message
         }

         if(isset($_SESSION['no-category-found'])){
            echo $_SESSION['no-category-found'];  //Displaying session message
            unset($_SESSION['no-category-found']); //Removing session message
         }

         if(isset($_SESSION['update'])){
            echo $_SESSION['update'];  //Displaying session message
            unset($_SESSION['update']); //Removing session message
         }

         if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];  //Displaying session message
            unset($_SESSION['upload']); //Removing session message
         }
         
         if(isset($_SESSION['failed-remove'])){
            echo $_SESSION['failed-remove'];  //Displaying session message
            unset($_SESSION['failed-remove']); //Removing session message
         }
        
        ?>

   <br><br>
<!--Button to Add Category-->
    <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
    <br><br>

    <table class="tbl-full">
      <tr>
         <th>S.N.</th>
         <th>Title</th>
         <th>Image</th>
         <th>Featured</th>
         <th>Active</th>
         <th>Action</th>
      </tr>
<?php
// Query to get all category from database
$sql = "SELECT * FROM tbl_category";
// Execute the Query
   $res = mysqli_query($conn, $sql);

$count = mysqli_num_rows($res); //function to get all the rows in database

$sn = 1; // create a varable and assign the value by one

// Check wether we have data in database
      if($count>0){
         //we have data in database
         //get the data and display
         while($rows=mysqli_fetch_assoc($res)){
            $id=$rows['Id'];
            $title=$rows['Title'];
            $image_name=$rows['Image_name'];
            $featured=$rows['Featured'];
            $active=$rows['Active'];

            //display the values in our table
            ?>

            <tr>
                     <td><?php echo $sn++;?></td>
                     <td><?php echo $title; ?></td>

                     <td>
                        <?php 
                        //check wether image name is available or not
                        if($image_name!=""){
                           //display the image
                           ?>
                           <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" height="80px">
                           <?php
                        }
                        else{
                           //display the message
                           echo "<div class='error'>Image not Added</div>";
                        }
                        
                        ?>
                     </td>

                     <td><?php echo $featured; ?></td>
                     <td><?php echo $active; ?></td>
                     <td>
                        <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
                        <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                     </td>
                  </tr>
            <?php
         }

      }

      else{
         //we do not have data in database
         //we will display the message inside table
         ?>
         <td colspan="6" class="error">No Category Added</td>
         <?php

      }
?>
      
    </table>

    </div>
</div>

<?php include("partials/footer.php"); ?>