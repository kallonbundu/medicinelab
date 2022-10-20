<?php include("config/constants.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kpatama Pharmaceutical Company Limited</title>

    <!-- Link menu logo -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <style>
    .success{
        padding: 2%;
        color: green;
    }
    .error{
    padding: 2%;
    color: red;
}
#admin-access a{
        color:white;
        font-size:18px;
        float:right;
    }
</style>
</head>
<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="<?php echo SITEURL; ?>index.php" title="Logo">
                    <img src="images/logo.jpg" alt="Restaurant Logo" class="img-responsive2">
                </a>
            </div>

            <div class="menu text-right">
               
                <ul>
                    <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>categories.php">Categories</a></li>
                    <li><a href="<?php echo SITEURL; ?>foods.php">Medicines</a></li>
                    <li><a href="<?php echo SITEURL;?>service.php">Our Service</a></li>
                    <li><a href="<?php echo SITEURL; ?>contact.php">Contact</a></li>
                    <i class='bx bxs-log-in-circle login-icon'><li><a href="<?php echo SITEURL;?>admin/login.php" id="admin-access">Admin</a></li></i>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->