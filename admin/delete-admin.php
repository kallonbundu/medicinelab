<?php
    // include costants.php file here
    include('../config/constants.php');

    //1. get the id of the admin to be deleted
    $id = $_GET['id'];
    //2. create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    // check wether the query execute successfully or not
   if($res==true){
        //query executed successfully and admin deleted
       //echo "admin deleted";
       //create session to display message
       $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";
        //Redirect page to Manage admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        //failed to delete admin
        //echo "fail to delete admin";
        //create session to display message
       $_SESSION['delete'] = "<div class='error'>Failed to deleted Admin. Try again later</div>";
       //Redirect page to Manage admin
       header("location:".SITEURL.'admin/manage-admin.php');
    }
    //3. redirect to manage admin page with message(success or error)

?>