<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <div id="updatebox">
            <h1>Update Order</h1>
            <br><br>

            <?php
                //check wether id is set or not
                if(isset($_GET['id'])){
                    //get order details
                    $id=$_GET['id'];

                    //sql query to get the order details
                    $sql = "SELECT * FROM tbl_order Where id=$id";
                    //execute the query
                    $res = mysqli_query($conn,$sql);
                    //count rows
                    $count = mysqli_num_rows($res);

                    if($count=="1"){
                        //detail is available
                        $row = mysqli_fetch_assoc($res);
                        
                        $food = $row['Food'];
                        $price = $row['Price'];
                        $qty = $row['Qty'];
                        $status = $row['Status'];

                    }
                    else{
                        //detail is not available
                        //redirect to manage order page
                        header("location:".SITEURL.'admin/manage-order.php');
                    }
                }
                else{
                    //redirect to manage order page
                    header("location:".SITEURL.'admin/manage-order.php');
                }
            ?>

            <form action="" method="POST">
            <label>Food Name</label>
                <input class="txt" type="text" name="food name" value="<?php echo $food; ?>">
                <br><br>
            
            <label>Price</label>
                <input class="txt" type="number" name="food name" value="<?php echo $price; ?>">
                <br><br>

            <label>Qty</label>
                <input class="txt" type="number" name="qty" value="<?php echo $qty; ?>">
                <br><br>

            <label>Status</label>
            <select name="status" >
                <option <?php if($status=="Ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                <option <?php if($status=="On Delevery"){echo "selected";}?> value="On Delevery">On Develery</option>
                <option <?php if($status=="Develered"){echo "selected";}?> value="Delevered">Delevered</option>
                <option <?php if($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
            </select>
            <br><br>

            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="hidden" name="price" value="<?php echo $price;?>">
            <button type="submit" name="submit" value="Update Order" class="btn-secondary">Update Order</button>        
            </form>

                <?php
                    //check wether the update button is click or not
                    if(isset($_POST['submit'])){
                        //get all the values from the form
                        $id = $_POST['id'];
                        $price = $_POST['price'];
                        $qty = $_POST['qty'];
                        $total = $price * $qty;
                        $status = $_POST['status'];

                        //update the values
                        $sql2 = "UPDATE tbl_order SET 
                            qty = $qty,
                            total = $total,
                            status = '$status'
                            WHERE id=$id
                        ";
                        //execute the query
                        $res2 = mysqli_query($conn,$sql2);
                        //check wether updated
                        if($res2==true){
                            //updated
                            $_SESSION['update'] = "<div class='success'>Order updated successfully</div>";
                            //Redirect page to Add category
                            header("location:".SITEURL.'admin/manage-order.php');
                        }
                        else{
                            //fail to update
                            $_SESSION['update'] = "<div class='error'>Failed to update Order</div>";
                            //Redirect page to Add category
                            header("location:".SITEURL.'admin/manage-order.php');
                        }

                    }
                    else{

                    }
                ?>

        </div>
    </div>
</div>

<?php include("partials/footer.php"); ?>