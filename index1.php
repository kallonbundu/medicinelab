<div id="admin-access">
    <h5>Kpatama Pharmaceutical Company Limited</h5>
</div>

<?php include("partials-front/menu.php");?>

<style>
    h5{
        background-color:grey;
        padding:15px;
        color:white;
        cursor:pointer;
        text-align:center;
    }
   
</style>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Medicine.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        if(isset($_SESSION['contact'])){
            echo $_SESSION['contact'];  //Displaying session message
            unset($_SESSION['contact']); //Removing session message
        }
    ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Medicines</h2>

            <?php
            
            //create sql query to display caterories from database
            $sql = "SELECT * FROM tbl_category WHERE featured='yes' AND active='yes' LIMIT 3";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count rows to check wether category is available or not
            $count = mysqli_num_rows($res);

            if($count>0){
                //categories available
                while($rows=mysqli_fetch_assoc($res)){
                    //get the data and display
                    $id=$rows['Id'];
                    $title=$rows['Title'];
                    $image_name=$rows['Image_name'];
                    ?>

                            <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                                <div class="box-1 float-container">
                                    <?php
                                    //check wether image is available or not
                                    if($image_name==""){
                                        //display message
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
                                </div>
                            </a>

                    <?php
                }
            }
            else{
                //categories not available
                echo "<div class='error'>Fail to add Categories</div>";
            }
            
            ?>

           
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Medicines</h2>

            <?php
            //getting foods from database
            $sql2 = "SELECT * FROM tbl_food WHERE active='yes' LIMIT 6 ";
            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //count rows
            $count2 = mysqli_num_rows($res2);

            //check wether food available or not
            if($count2 > 0){
                //food available
                while($row=mysqli_fetch_assoc($res2)){
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
                                //image available
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
            <a href="<?php echo SITEURL; ?>foods.php">See All Medicines</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include("partials-front/footer.php");?>