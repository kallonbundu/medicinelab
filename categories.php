<?php include("partials-front/menu.php");?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Medicines</h2>

            <?php
            //Display caterories from database that are active
            $sql = "SELECT * FROM tbl_category WHERE active='yes' ";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count rows to check wether category is available or not
            $count = mysqli_num_rows($res);

            //check wether category is available or not
            if($count>0){
                //categories available
                while($rows=mysqli_fetch_assoc($res)){
                    //get the data and display
                    $id=$rows['Id'];
                    $title=$rows['Title'];
                    $image_name=$rows['Image_name'];
                    ?>
                        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php
                                        //check wether image is available or not
                                        if($image_name==""){
                                            //display message, image not available
                                            echo "<div class'error'>Image not available</div>";
                                        }
                                        else{
                                            //image is available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                ?>

                                <i class='bx bx-category category-icon'><h3 class="product-title text-black"><?php echo $title;?></h3></i>
                        </a>
                        </div>
 

                    <?php
                }
            }
            else{
                //categories not available
                echo "<div class='error'>Categories not found</div>";
            }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include("partials-front/footer.php");?>