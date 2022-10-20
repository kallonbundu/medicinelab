<?php include("partials/menu.php"); ?>

   <!-- Main section section start-->
   <div class="main-content">

   <div class="wrapper">
    <h1>Dashboard</h1>
    <br><br>

    <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        ?>
        <br><br>

    <div class="col-4">

        <?php
            //sql query
            $sql = "SELECT * FROM tbl_category";
            //execute query
            $res = mysqli_query($conn,$sql);
            //count rows
            $count = mysqli_num_rows($res);
        ?>
        <h2><?php echo $count; ?></h2><br>
        Categories
    </div>

    <div class="col-4">

        <?php
            //sql query
            $sql2 = "SELECT * FROM tbl_food";
            //execute query
            $res2 = mysqli_query($conn,$sql2);
            //count rows
            $count2 = mysqli_num_rows($res2);
        ?>
        <h2><?php echo $count2; ?></h2><br>
       Medicines
    </div>

    <div class="col-4">
        <?php
            //sql query
            $sql3 = "SELECT * FROM tbl_order";
            //execute query
            $res3 = mysqli_query($conn,$sql3);
            //count rows
            $count3 = mysqli_num_rows($res3);
        ?>
        <h2><?php echo $count3; ?></h2><br>
        Total Order
    </div>

    <div class="col-4">
        <?php
            //sql query to get total revenue
            $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE Status='Delevered'";
            //execute query
            $res4 = mysqli_query($conn,$sql4);
            //get the values
            $row = mysqli_fetch_assoc($res4);
            //get the total revenue
            $total_revenue = $row['Total']; 
        ?>
        <h2>Le<?php echo $total_revenue; ?></h2><br>
        Revenue Generated
    </div>

    <div class="clearfix"></div>

    </div>

   </div>
   <!-- Main section section start-->

   <?php include("partials/footer.php"); ?>
