<?php include("../config/constants.php");?>

<?php
//check wether the user is login or not
if(!isset($_SESSION['user'])) //if user session is not set
{
    //user is not login
    //redirect to login page with message
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin panel</div>";
    //redirect to login page
    header("location:".SITEURL.'admin/login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kpatama Pharmaceutical Company Limited</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
   <!-- Menu section start-->
   <div class="menu text-center">
    <div class="wrapper">
    <ul>
        <li><a href="index.php">Dashboard</a></li>
        <li><a href="manage-admin.php">Admin</a></li>
        <li><a href="manage-category.php">Category</a></li>
        <li><a href="manage-food.php">Medicine</a></li>
        <li><a href="manage-order.php">Order</a></li>
        <li><a href="manage-contact.php">Contact</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
    </div>
   </div>
   </nav>
   <!-- Menu section end-->