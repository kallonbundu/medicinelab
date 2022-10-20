<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <div class="adminbox">
        <h1>Add Admin</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];  //Displaying session message
                unset($_SESSION['add']); //Removing session message
            }
         ?>

        <form action="" method="POST">
            
                <label>Full Name </label>
                <input class="ad" type="text" name="full_name" placeholder="Enter your Full name" required>
                <br><br>
            
                <label>Username</label>
                <input class="ad" type="text" name="username" placeholder="Enter your Username" required>
                <br><br>

                <label>Password</label>
                <input class="ad" type="password" name="password" placeholder="Enter your Password" required>
                <br><br><br>

                <button type="submit" name="submit" value="AddAdmin" class="btn-secondary">Add Admin</button>
        </form>

    </div>
</div>
</div>

<?php include("partials/footer.php"); ?>

<?php
    // process the value from form and save it in the database
    //check wether the submit button is click or not

    if(isset($_POST['submit'])){
        //button clicked
        //echo"button clicked";

        //get the data from our form
        $_full_name = $_POST['full_name'];
        $_username = $_POST['username'];
        $_password = md5($_POST['password']); //password encripted with md5

        //sql quary to save the data in database
        $sql = "INSERT INTO tbl_admin SET
            Full_name = '$_full_name',
            Username = '$_username',
            Password = '$_password'
        ";
        
        //Executing quary and saving data in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //check wether the quary is executed data is inserted or notand display apporate message

        if($res==TRUE){
            //data inserted
            //echo "data inserted";
            //create a session varable to display message
            $_SESSION['add'] = "<div class='success'> Admin added successfully</div>";
            //Redirect page to Manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //failed to insert data
            //echo "fail to insert data";
             //create a session varable to display message
             $_SESSION['add'] = "<div class='error'>Fail to add Admin</div>";
             //Redirect page to Add admin
             header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>