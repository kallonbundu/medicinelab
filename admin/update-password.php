<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <div class="adminbox">
    <h1>Change Password</h1>
    <br><br>

    <?php
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
    ?>

    <form action="" method="POST">
       
                <label>Current Password</label>
                <input class="ad" type="password" name="current_password" placeholder="Current Password" required>
                <br><br>
                
                <label>New Password</label>
                <input class="ad" type="password" name="new_password" placeholder="New Password" required>
                <br><br>

                <label>Confirm Password</LABEL>
                <input class="ad" type="password" name="comfirm_password" placeholder="Comfirm Password" required>
                <br><br><br>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" name="submit" value="ChangePassword" class="btn-secondary">ChangePassword</button>

    </form>
</div>
</div>
</div>

<?php
        //Check wether the submit button is click or not
        if(isset($_POST['submit'])){
            //echo "Button clicked";
            //Get all the values from form to update
            $id = $_POST['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $comfirm_password = md5($_POST['comfirm_password']);

            //check wether the user with current password and Id exist or not
            $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            if($res==true){
                //check wether data is available or not
                $count = mysqli_num_rows($res);

                if($count==1){
                    //user exist and password can change
                    //echo "User found";
                    //Check wether the new pasword and comfirm password match or not
                    if($new_password==$comfirm_password){
                        //update the password
                        $sql2 = "UPDATE tbl_admin SET
                        password = '$new_password'
                        WHERE id=$id
                        ";

                        //Execute the query
                        $res2 = mysqli_query($conn, $sql2);

                        //check wether the query is executed or not
                        if($res2==true){
                            //display success message
                            $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully</div>";
                            //Redirect to Admin page
                            header("location:".SITEURL.'admin/manage-admin.php');
                    }
                    else{
                        //displaay error message
                        $_SESSION['change-pwd'] = "<div class='success'>Failed to change password</div>";
                        //Redirect to Admin page
                        header("location:".SITEURL.'admin/manage-admin.php'); 
                    }
                
                }
                else{
                    //user does not exist
                    $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
                    header("location:".SITEURL.'admin/manage-admin.php');
                }
        }

            }
        }

?>


<?php include("partials/footer.php"); ?>