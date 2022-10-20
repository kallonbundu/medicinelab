<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <div id="foodbox2">
            <br><br>
        <h1>Add Medicine</h1>
        <br><br>

        <?php
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];  //Displaying session message
            unset($_SESSION['upload']); //Removing session message
         }
        ?>

         <!--Add food form start-->
         <form action="" method="POST" enctype="multipart/form-data">

         <label>Title</label>
            <input class="txt" type="text" name="title" placeholder="Medicine title">
            <br><br>

        <label>Description</label>
            <textarea name="description" cols="30" rows="5" placeholder="Description"></textarea>
            <br><br>
        
        <label>Price</label>
            <input class="txt" type="number" name="price" placeholder="0.00">
            <br><br>

        <label>Select Image</label>
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
                    $id = $row['Id'];
                    $title = $row['Title'];

                    ?>

                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

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
            <input type="radio" name="featured" value="yes">Yes
            <input type="radio" name="featured" value="no">No
            <br><br>

        <label>Active</label>
            <input type="radio" name="active" value="yes">Yes
            <input type="radio" name="active" value="no">No
            <br><br>

        <button type="submit" name="submit" value="Addfood" class="btn-secondary">Add Medicine</button>

         </form>

         <?php
         
         //check wether the button is clicked or not
         if(isset($_POST['submit'])){
            //add the food in database
            //echo "clicked";

            //get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $image_name = $_POST['image_name'];
            $category = $_POST['category'];

            //check wether radio button is checked or not
            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            }
            else{
                $featured = "no"; //setting the default value
            }

            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }
            else{
                $active = "no"; //setting the default value
            }

            //upload the image if selected
            //check wether the select image is clicked or not
            if(isset($_FILES['image']['name'])){
                //get the details of the selected image
                $image_name = $_FILES['image']['name'];

                //check wether the image is selected or not, upload image only if selected
                if($image_name != ""){
                    //image is selected
                    //rename the image
                    $ext = end(explode('.', $image_name));
                    //rename the image
                    $image_name = $title.rand(000, 999).'.'.$ext;
                    
                    //source pathe of the image
                    $src = $_FILES['image']['tmp_name'];

                    //destination of the image
                    $dst = "../images/food/".$image_name;

                    //upload the image
                    $upload = move_uploaded_file($src, $dst);

                     //check wether the image is uploaded or not
                    //if the image is not uploaded then we will stope the process and redirect with error message
                    if($upload==false){
                        //set message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload Image</div>";
                        //Redirect page to Add food
                        header("location:".SITEURL.'admin/add-food.php');
                        //stop the process
                        die();
                    }
                }

            }
            else{
                $image_name = ""; //setting default value as blank
            }

            //insert into database

            //sql quary to save the data in database
            $sql2 = "INSERT INTO tbl_food SET
                Title = '$title',
                Description = '$description',
                Price = '$price',
                Image_name = '$image_name',
                Category_id = $category,
                Featured = '$featured',
                Active = '$active'
                ";

                //Executing quary and saving data in database
                $res2 = mysqli_query($conn, $sql2);

            //redirect to manage food with message
            
            if($res2==TRUE){
                //data inserted
                //echo "data inserted";
                //create a session varable to display message
                $_SESSION['add'] = "<div class='success'> Food added successfully</div>";
                //Redirect page to Manage admin
                header("location:".SITEURL.'admin/manage-food.php');
            }
            else{
                //failed to insert data
                //echo "fail to insert data";
                //create a session varable to display message
                $_SESSION['add'] = "<div class='error'>Failed to add Food</div>";
                //Redirect page to Add category
                header("location:".SITEURL.'admin/add-food.php');
            }
         }
         
         ?>


        </div>
        
    </div>

</div>


<?php include('partials/footer.php'); ?>
