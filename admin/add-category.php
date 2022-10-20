<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <div class="categorybox">
            <br><br>
        <h1>Add Category</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];  //Displaying session message
            unset($_SESSION['add']); //Removing session message
         }

         if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];  //Displaying session message
            unset($_SESSION['upload']); //Removing session message
         }
        ?>

        <br>

        <!--Add category form start-->
        <form action="" method="POST" enctype="multipart/form-data">
            
            <label>Title</label>
            <input class="txt" type="text" name="title" placeholder="Category title" required>
            <br><br>

            <label>Select Image</label>
            <input class="img" type="file" name="image">
            <br><br>
        
            <label>Featured</label>
            <input type="radio" name="featured" value="yes">Yes
            <input type="radio" name="featured" value="no">No

            <br><br>

            <label>Active</label>
            <input type="radio" name="active" value="yes">Yes
            <input type="radio" name="active" value="no">No
            <br><br><br>

            <button type="submit" name="submit" value="Addcategory" class="btn-secondary">Add Category</button>
    </form>

         <!--Add category form ends-->

        </div>
        
    </div>
</div>

<?php include("partials/footer.php"); ?>

<?php
 //check wether the submit button is click or not
 if(isset($_POST['submit'])){
    //echo "Clicked";

     //get the data from our form
     $title = $_POST['title'];

     //For radio input, we need to check the button is selected or not
     if(isset($_POST['featured'])){
        //get the value from form
        $featured = $_POST['featured'];

     }
     else{
        //set the default value
        $featured = "no";
     }

     if(isset($_POST['active'])){
        //get the value from form
        $active = $_POST['active'];

     }
     else{
        //set the default value
        $active = "no";
     }

     //check wether the image is selected or not and set the value for image name accordingly
     //print_r($_FILES['image']);
     //die(); //break the code here

     if(isset($_FILES['image']['name'])){
        //upload the image
        //to upload image we need image name, source path and destination
        $image_name = $_FILES['image']['name'];

        //upload image only if image is selected
         if($image_name != ""){
            
        //Auto rename image
        //get the extension of our image like (jpg, gif, png, etc) e.g "specialFood1.jpg"
        $ext = end(explode('.', $image_name));
        //rename the image
        $image_name = "medicine_category_".rand(000, 999).'.'.$ext; // e.g. food_category.034.jpg

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
            header("location:".SITEURL.'admin/add-category.php');
            //stop the process
            die();
        }
         }
     }
     else{
        //dont upload image and set image name as blak
        $image_name="";
     }

     //sql quary to save the data in database
     $sql = "INSERT INTO tbl_category SET
     Title = '$title',
     Image_name = '$image_name',
     Featured = '$featured',
     Active = '$active'
 ";

     //Executing quary and saving data in database
     $res = mysqli_query($conn, $sql);

     //check wether the quary is executed data is inserted or notand display apporate message

     if($res==TRUE){
        //data inserted
        //echo "data inserted";
        //create a session varable to display message
        $_SESSION['add'] = "<div class='success'> Category added successfully</div>";
        //Redirect page to Manage admin
        header("location:".SITEURL.'admin/manage-category.php');
    }
    else{
        //failed to insert data
        //echo "fail to insert data";
         //create a session varable to display message
         $_SESSION['add'] = "<div class='error'>Failed to add Category</div>";
         //Redirect page to Add category
         header("location:".SITEURL.'admin/add-category.php');
    }

 }
?>