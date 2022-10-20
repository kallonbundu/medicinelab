<?php include("partials/menu.php"); ?>

<!-- Main section section start-->
<div class="main-content">
   <div class="wrapper">
   <h1>Manage Contact</h1><br>

   <table class="tbl-full">
        <tr>
         <th>S.N.</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Phone Number</th>
         <th>Email</th>
         <th>Address</th>
         <th>Message</th>
        </tr>

        <?php
            // Query to get all admin
            $sql = "SELECT * FROM tbl_contact ORDER BY id DESC";
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
                        $first_name=$rows['First_Name'];
                        $last_name=$rows['Last_Name'];
                        $phone_number=$rows['Phone_Number'];
                        $email=$rows['Email'];
                        $address=$rows['Address'];
                        $message=$rows['Message'];
                        //display the values in our table
                        ?>
                            <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $first_name; ?></td>
                            <td><?php echo $last_name; ?></td>
                            <td><?php echo $phone_number; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $address; ?></td>
                            <td><?php echo $message; ?></td>
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
<!-- Main section section start-->

<?php include("partials/footer.php"); ?>