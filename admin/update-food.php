<?php include('partials/menu.php'); ?>

<?php
    //check wether id is set or not
    if(isset($_GET['id'])){
        //get all the details
        $id = $_GET['id'];

        //sql query to get selected food
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
        //Executing quary and saving data in database
        $res2 = mysqli_query($conn, $sql2);

        //get the vale based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //get the individual value
        $title = $row2['Title'];
        $description = $row2['Description'];
        $price = $row2['Price'];
        $current_image = $row2['Image_name'];
        $current_category = $row2['Category_id'];
        $featured = $row2['Featured'];
        $active = $row2['Active'];
    }
    else{
        //redirect to Manage food
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>

<div class="main-content">
    <div class="wrapper">
        <div id="foodbox">
            <br><br>
        <h1>Update Medicine</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        <label>Title</label>
            <input class="txt" type="text" name="title" value="<?php echo $title; ?>">
            <br><br>

        <label>Description</label>
            <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
            <br><br>
        
        <label>Price</label>
            <input class="txt" type="number" name="price" value="<?php echo $price; ?>">
            <br><br>

        <label>Current Image</label>
            <?php
            if($current_image != ""){
                //display the image
                ?>
                <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="100px" height="80">
                <?php
            }
            else{
                //display message
                echo "<div class='error'>Image not added</div>";
            }
            ?>
            <br><br>

        <label>New Image</label>
        <input class="img" type="file" name="image">
        <br><br>

        <label>Category</label>
        <select name="category">

        <?php
            //create php to display category from database
            //create sql query to get active category
            $sql = "SELECT * FROM tbl_category WHERE active='yes' ";

            //creating query
            $res = mysqli_query($conn, $sql);

            //count row to check wether we have category or not
            $count = mysqli_num_rows($res);

            //if count is greater than zero, we have category else we dont have category
            if($count>0){
                //we have category
                while($row=mysqli_fetch_assoc($res)){
                    //get the details of categories
                    $category_id = $row['Id'];
                    $category_title = $row['Title'];

                //echo "<option value='$id'>$title</option>"; //this also work as the one below

                    ?>

                    <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                    <?php
                }
            }
            else{
                //we do not have category
                ?>
                <option value="0">No category found</option>
                <?php
            }
        ?>
        </select>
        <br><br>

        <label>Featured</label>
            <input <?php if($featured=="yes"){echo "checked";} ?> type="radio" name="featured" value="yes">Yes
            <input <?php if($featured=="no"){echo "checked";} ?> type="radio" name="featured" value="no">No
            <br><br>

        <label>Active</label>
            <input <?php if($active=="yes"){echo "checked";} ?> type="radio" name="active" value="yes">Yes
            <input <?php if($active=="no"){echo "checked";} ?> type="radio" name="active" value="no">No
            <br><br>

        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" name="submit" value="Updatefood" class="btn-secondary">Update Medicine</button>
        </form>

        <?php
            //check wether is click or not
            if(isset($_POST['submit'])){
                //echo "button clicked";
                // get all the values from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];

                 //check wether the image is selected or not
                 if(isset($_FILES['image']['name'])){
                    //get the image details
                    $image_name = $_FILES['image']['name'];

                    //check wether image is available or not
                    if($image_name != ""){
                        //image available
                        //upload the new image

                                    //Auto rename image
                        //get the extension of our image like (jpg, gif, png, etc) e.g "specialFood1.jpg"
                        $ext = end(explode('.', $image_name));
                        //rename the image
                        $image_name = $title.rand(000, 999).'.'.$ext; // e.g. food_category.034.jpg

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/food/".$image_name;

                        //upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //check wether the image is uploaded or not
                        //if the image is not uploaded then we will stope the process and redirect with error message
                        if($upload==false){
                        //set message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload Image</div>";
                        //Redirect page to Add category
                        header("location:".SITEURL.'admin/manage-food.php');
                        //stop the process
                        die();
                            }

                        //remove the current image if available
                        if($current_image != ""){
                            $remove_path = "../images/food/". $current_image;

                            $remove = unlink($remove_path);

                            //check wether the image is remove or not
                            //if fail to remove display message and stop the process
                            if($remove==false){
                                //failed to remove the image
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to remove Current image</div>";
                                header("location:".SITEURL.'admin/manage-food.php');
                                die(); //stop the process
                        }

                        }

                    }
                    else{
                        $image_name = $current_image;
                    }
                }
                else{
                    $image_name = $current_image;
                }

                //update the database
                $sql3 = "UPDATE tbl_food SET
                Title = '$title',
                Description = '$description',
                Price = '$price',
                Image_name = '$image_name',
                Category_id = '$category',
                Featured = '$featured',
                Active = '$active'
                WHERE Id='$id'
                ";

                //Execute the query
                $res3 = mysqli_query($conn, $sql3);

                //redirect to manage category with message
                //Check wether query executed or not
                if($res3==true){
                    //category updated
                    $_SESSION['update'] = "<div class='success'>Food updated successfully</div>";
                    //Redirect to food page
                    header("location:".SITEURL.'admin/manage-food.php');
                }
                else{
                    //fail to update food
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food</div>";
                    //Redirect to food page
                    header("location:".SITEURL.'admin/manage-food.php');
                }

            }
        ?>

        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>
