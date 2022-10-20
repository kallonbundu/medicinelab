<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <div class="adminbox2">
    <h1>Update Admin</h1>
    <br><br>

    <?php 
    //1. Get the Id of selected Admin
    $id=$_GET['id'];
    //2. Create sql query to get details
    $sql= "SELECT * FROM tbl_admin WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check wether the query is executed or not
    if($res==true){
        //check wether the data is available or not
        $count = mysqli_num_rows($res);
        //check wether if we have data or not
        if($count==1){
            //get the details
            //echo "Admin available";
            $row = mysqli_fetch_assoc($res);

            $full_name = $row['Full_Name'];
            $username = $row['Username'];
        }
        else{
            //redirect to manage Admin page
            header("location:".SITEURL.'admin/manage-admin.php');
        }
    }
    
    ?>

    <form action="" method="POST">

        <label>Full Name</label>
        <input class="ad" type="text" name="full_name" value="<?php echo $full_name; ?>">
        <br><br>

        <label>Username</label>
        <input class="ad" type="text" name="username" value="<?php echo $username; ?>">
        <br><br><br>

        <input type="hidden" name="id" value="<?php echo$id; ?>">
        <button type="submit" name="submit" value="UpdateAdmin" class="btn-secondary">UpdateAdmin</button>
               
    </form>
    </div>
</div>
</div>

<?php
//check wether the submit button is click or not
if(isset($_POST['submit'])){
    //echo "Button clicked";
    //Get all the values from form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //create sql query to update admin
    $sql = "UPDATE tbl_admin SET
    Full_name = '$full_name',
    Username = '$username' 
    WHERE id='$id'
    ";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check wether the query is executed successfully or not
    if($res==true){
        //query executed and admin added
        $_SESSION['update'] = "<div class='success'>Admin updated successfully</div>";
        //Redirect to Admin page
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else{
        //fail to update admin
        $_SESSION['update'] = "<div class='error'>Fail to Update Admin</div>";
        //Redirect to Admin page
        header("location:".SITEURL.'admin/manage-admin.php');

    }
}

?>

<?php include("partials/footer.php"); ?>