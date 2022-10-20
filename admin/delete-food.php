<?php
// include costants.php file here
include('../config/constants.php');

//1. Check wether the id and image_name is set or not
if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //get the value and delete
    //1. get the id and image_name to be deleted
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the physical image file if available
    if($image_name != ""){
        //image is available
        $path = "../images/food/".$image_name;
        //remove the image
        $remove = unlink($path);

        //if fail to remove image then add an error message and stop thew process
        if($remove==false){
            //set the session message
            $_SESSION['remove'] = "<div class='error'>Failed to remove food image</div>";
            //redirect to manage category page
            header("location:".SITEURL.'admin/manage-food.php');

            //stop the process
            die();
        }
    }

    //delete data from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    // check wether the query execute successfully or not
   if($res==true){
   //create session to display message
   $_SESSION['delete'] = "<div class='success'>Food deleted successfully</div>";
    //Redirect page to Manage category
    header("location:".SITEURL.'admin/manage-food.php');
}
else{
    //failed to delete admin
    //echo "fail to delete admin";
    //create session to display message
   $_SESSION['delete'] = "<div class='error'>Failed to deleted Food</div>";
   //Redirect page to Manage admin
   header("location:".SITEURL.'admin/manage-food.php');
}

}
else{
    //redirect to manage category page
    header("location:".SITEURL.'admin/manage-food.php');
}


?>