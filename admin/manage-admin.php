<?php include("partials/menu.php"); ?>

   <!-- Main section section start-->
   <div class="main-content">

   <div class="wrapper">
    <h1>Manage Admin</h1><br>

    <?php
      if(isset($_SESSION['add'])){
         echo $_SESSION['add'];  //Displaying session message
         unset($_SESSION['add']); //Removing session message
      }

      if(isset($_SESSION['delete'])){
         echo $_SESSION['delete'];  //Displaying session message
         unset($_SESSION['delete']); //Removing session message

      }

      if(isset($_SESSION['update'])){
         echo $_SESSION['update'];  //Displaying session message
         unset($_SESSION['update']); //Removing session message
      }

      if(isset($_SESSION['user-not-found'])){
         echo $_SESSION['user-not-found'];  //Displaying session message
         unset($_SESSION['user-not-found']); //Removing session message
      }

      if(isset($_SESSION['pwd-not-match'])){
         echo $_SESSION['pwd-not-match'];  //Displaying session message
         unset($_SESSION['pwd-not-match']); //Removing session message
      }

      
      if(isset($_SESSION['change-pwd'])){
         echo $_SESSION['change-pwd'];  //Displaying session message
         unset($_SESSION['change-pwd']); //Removing session message
      }

    ?>

    <br><br><br>

    <!-- Button to add Admin-->
    <a href="add-admin.php" class="btn-primary">Add Admin</a>
    <br><br>

    <table class="tbl-full">
      <tr>
         <th>S.N.</th>
         <th>Full Name</th>
         <th>Username</th>
         <th>Action</th>
      </tr>

      <?php
         // Query to get all admin
            $sql = "SELECT * FROM tbl_admin";
         // Execute the Query
            $res = mysqli_query($conn, $sql);

         // Check wether the query is execute or not
            if($res==TRUE){
         // Count rows to check wether we have data in database or not
            $count = mysqli_num_rows($res); //function to get all the rows in database

            $sn = 1; // create a varable and assign the value to one

         //check the numbers of rows
            if($count>0){
               //we have data in database
               while($rows=mysqli_fetch_assoc($res)){

                  $id=$rows['Id'];
                  $full_name=$rows['Full_Name'];
                  $username=$rows['Username'];

                  //display the values in our table
                  ?>

                     <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                           <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                           <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                           <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                        </td>
                     </tr>
                  <?php
               }
            }
            else{
               //we do no have data in database
            } 
         }
      ?>

    </table>
    
    </div>
   </div>
   <!-- Main section section end-->

   <?php include("partials/footer.php"); ?>