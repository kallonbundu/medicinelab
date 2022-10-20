<?php include("partials-front/menu.php");?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Medicine.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Medicine Menu</h2>

            <?php
             //getting foods from database
            $sql = "SELECT * FROM tbl_food WHERE active='yes' ";
             //execute the query
            $res = mysqli_query($conn, $sql);
                //count rows
            $count = mysqli_num_rows($res);

            //check wether food available or not
            if($count > 0){
                //food available
                while($row=mysqli_fetch_assoc($res)){
                    //get all the values
                    $id=$row['Id'];
                    $title=$row['Title'];
                    $description=$row['Description'];
                    $price=$row['Price'];
                    $image_name=$row['Image_name'];

                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                             //check wether image available or not
                             if($image_name==""){
                                //image not available
                                echo "<div class='error'>Image not available</div>";

                             }
                             else{
                                ?>
                                 <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php

                             }
                            ?>
                           
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">Le<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                        </div>
                     </div>

                    <?php

                }
                
            }
            else{
                //food not available
                echo "<div class='error'>Medicine not available</div>";
            }
            ?>

            

            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>index.php">And many more Medicines in store</a>
        </p>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("partials-front/footer.php");?>