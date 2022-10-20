<?php include("../config/constants.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/admin.css">

    <style>
        body{
            background: lightgray;
        }
    </style>

</head>
<body>
    <div class="login">
        
        <h3>Sign In</h3><br>

        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if(isset($_SESSION['no-login-message'])){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }

        ?>
        <br>

        <!-- Login form start here-->
        <section class="ad-login">

        <form action="" method="POST">
            <label>Username</label> 
            <input class="txt2" type="text" name="username" placeholder="Enter username" required>
            <br><br>

            <label>Password</label>
            <input class="txt2" type="password" name="password" placeholder="Enter password" required>

            <br><br><br>
            <button type="submit" name="submit">Sign In</button>
            <br><br>

        </form>
        
        </section>

        <!-- Login form ends here-->

    </div>

</body>
</html>

<?php
// Check wether the submit button is click or not
if(isset($_POST['submit'])){
    //Process for login
    //get the data from login form
    //$username = $_POST['username'];
    //$password = md5($_POST['password']);
    
    $username = mysqli_real_escape_string($conn, $_POST['username']); // Protect the data from sql injection
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    //sql query to check wether username and password exist or not
    $sql = "SELECT * FROM tbl_admin WHERE username= '$username' AND password='$password'";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check wether the user exist or not
    $count = mysqli_num_rows($res);

    if($count==1){
        //User available
        $_SESSION['login'] = "<div class='success'>Login Successful</div>";
        $_SESSION['user'] = $username; //to check wether the user is login or not

        //redirect to home page/Dasboard
        header("location:".SITEURL.'admin/');

    }
    else{
        //user not available
        $_SESSION['login'] = "<div class='error text-center'>Username or Password does not match</div>";
        //redirect to home page/Dasboard
        header("location:".SITEURL.'admin/login.php');
    }
}


?>