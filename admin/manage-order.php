<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Medicines</h1>
    <br><br>

    <?php
      if(isset($_SESSION['update'])){
         echo $_SESSION['update'];  //Displaying session message
         unset($_SESSION['update']); //Removing session message
      }
    ?>
    <br><br>

      <table class="tbl-full">
         
         <tr>
            <th>S.N.</th>
            <th>Food</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Date</th>
            <th>Status</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Action</th>
         </tr>

         <?php

            //get all the orders from database
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //Display the latest order at first
            //Execute the query
            $res = mysqli_query($conn, $sql);
            //count the row 
            $count = mysqli_num_rows($res);

            $sn = 1; // create a varable and assign the value by one

            if($count>0){
               //order is available
               while($row=mysqli_fetch_assoc($res)){
                  $id=$row['Id'];
                  $food=$row['Food'];
                  $price=$row['Price'];
                  $qty=$row['Qty'];
                  $total=$row['Total'];
                  $order_date=$row['Order_date'];
                  $status=$row['Status'];
                  $customer_name=$row['Customer_name'];
                  $customer_contact=$row['Customer_contact'];
                  $customer_address=$row['Customer_address'];
                  ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $food; ?></td>
                        <td>$<?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td>$<?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>

                        <td>
                           <?php
                              if($status=="Ordered"){
                                 echo "<label>$status</label>";
                              }
                              elseif($status=="On Delevery"){
                                 echo "<label style='color:orange;'>$status</label>";

                              }
                              elseif($status=="Delevered"){
                                 echo "<label style='color:blue;'>$status</label>";

                              }
                              elseif($status=="Cancelled"){
                                 echo "<label style='color:red;'>$status</label>";

                              }
                           ?>
                        </td>

                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary2" >Update Order</a>
                        </td>
                     </tr> 
                  <?php
               }
            }
            else{
               //order is not available
               echo "<tr><td colspan='12' class='error'>Order is not Available</td></tr>" ;
            }

         ?>

      </table>
    
    </div>
</div>

<?php include("partials/footer.php"); ?>