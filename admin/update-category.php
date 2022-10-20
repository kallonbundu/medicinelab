<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <div class="categorybox2">
        <br><br>
        <h1>Update Category</h1>
        <br><br>

        <?php
        //check wether the id is set or not
        if(isset($_GET['id'])){
            //get the id and other details
            //echo "getting the data";
            $id = $_GET['id'];
            //create sql query to get all details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            //execute the query
            $res = mysqli_query($conn, $sql);

            //count the rows to check wether the id is valid or not
            $count = mysqli_num_rows($res);

            if($count==1){
                //get the details
                //echo "Admin available";
                $row = mysqli_fetch_assoc($res);
    
                $title = $row['Title'];
                $current_image = $row['Image_name'];
                $featured = $row['Featured'];
                $active = $row['Active'];
            }
            else{
                //redirect to manage category page
                header("location:".SITEURL.'admin/manage-category.php');
                $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
            }

        }
        else{
            //redirect to manage category page
            header("location:".SITEURL.'admin/manage-category.php');
        }
        
        ?>

        <!--Update category form start here-->
        <form action="" method="POST" enctype="multipart/form-data">
        <label>Title</label>
            <input class="txt" type="text" name="title" value="<?php echo $title; ?>">
            <br><br>

            <label>Current Image</label>
            <?php
            if($current_image != ""){
                //display the image
                ?>
                <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="100px" height="80">
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
        
            <label>Featured</label>
            <input <?php if($featured=="yes"){echo "checked";} ?> type="radio" name="featured" value="yes">Yes
            <input <?php if($featured=="no"){echo "checked";} ?> type="radio" name="featured" value="no">No
            
            <br><br>

            <label>Active</label>
            <input <?php if($active=="yes"){echo "checked";} ?> type="radio" name="active" value="yes">Yes
            <input <?php if($active=="no"){echo "checked";} ?> type="radio" name="active" value="no">No
            <br><br><br>

            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" name="submit" value="Updatecategory" class="btn-secondary">Update Category</button>
        </form>
        <!--Update category form ends here-->

        <?php
        
            if(isset($_POST['submit'])){
                //echo "clicked";
                // get all the values from our form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                
                //updating new image if selected
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
                    $image_name = "food_category_".rand(000, 999).'.'.$ext; // e.g. food_category.034.jpg

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/".$image_name;

                    //upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check wether the image is uploaded or not
                    //if the image is not uploaded then we will stope the process and redirect with error message
                    if($upload==false){
                        //set message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload Image</div>";
                        //Redirect page to Add category
                        header("location:".SITEURL.'admin/manage-category.php');
                        //stop the process
                        die();
                    }

                        //remove the current image if available
                        if($current_image != ""){
                            $remove_path = "../images/category/". $current_image;

                            $remove = unlink($remove_path);

                            //check wether the image is remove or not
                            //if fail to remove display message and stop the process
                            if($remove==false){
                                //failed to remove the image
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove Current image</div>";
                                header("location:".SITEURL.'admin/manage-category.php');
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
                $sql2 = "UPDATE tbl_category SET
                Title = '$title',
                Image_name = '$image_name',
                Featured = '$featured',
                Active = '$active'
                WHERE Id='$id'
                ";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                //redirect to manage category with message
                //Check wether query executed or not
                if($res2==true){
                    //category updated
                    $_SESSION['update'] = "<div class='success'>Category updated successfully</div>";
                    //Redirect to Category page
                    header("location:".SITEURL.'admin/manage-category.php');
                }
                else{
                    //fail to update category
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category</div>";
                    //Redirect to Category page
                    header("location:".SITEURL.'admin/manage-category.php');
                }
            }
        
        ?>

        </div>
    </div>
</div>
<?php include("partials/footer.php"); ?>
