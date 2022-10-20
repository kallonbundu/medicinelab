<?php include("partials-front/menu.php");?>

<?php
    //check wether food id is set or not
    if(isset($_GET['food_id'])){
        //get the food id and details
        $food_id = $_GET['food_id'];

        //get the details of the selected food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        //execute the query
        $res = mysqli_query($conn, $sql);
        //count the rows
        $count = mysqli_num_rows($res);
        //check wether the data is available or not
        if($count==1){
            //we have data
            //GET the data from database
            $row = mysqli_fetch_assoc($res);
            $title = $row['Title'];
            $price = $row['Price'];
            $image_name = $row['Image_name'];
        }
        else{
            //food not available
            //redirect to home page
            header('location:'.SITEURL);
        }

    }
    else{
        //redirect to home page
        header('location:'.SITEURL);
    }
?>

    <!-- fOOD order Section Starts Here -->
    <section class="food-order">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Medicine</legend>

                    <div class="food-menu-img">
                        <?php
                        //check wether image is available or not
                            if($image_name==""){
                                //image is not available
                                echo "<div class='error'>Image not Available</div>";
                            }
                            else{
                                //image is available
                                ?>
                                     <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }

                        ?>

                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">Le<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Gerald Williams" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. +232xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@geraldwilliams.com" class="input-responsive">

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

                //check wether submit button is click or not
                if(isset($_POST['submit'])){
                    //get all the details from the form
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; //will get the total price

                    $order_date = date("y-m-d h:m:s"); //order date

                    $status = "Ordered"; //Ordered on delevery

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    //save the order in database
                    //create sql to save the data
                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = '$price',
                        qty = '$qty',
                        total = '$total',
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    //execute the query
                    $res2 = mysqli_query($conn,$sql2);

                    //check wether query executed successfully or not
                    if($res2==true){
                        //query executed and order save
                       $_SESSION['order'] = "<div class='success text-center'>Order is placed successfully</div>";
                        header('location:'.SITEURL);
                    }
                    else{
                        //failed to save order
                       $_SESSION['order'] = "<div class='error'>Order failed</div>";
                       header('location:'.SITEURL);

                    }
                }

            ?>

        </div>
    </section>
    <!-- fOOD order Section Ends Here -->

<?php include("partials-front/footer.php");?>