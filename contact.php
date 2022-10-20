<?php include("partials-front/menu.php");?>

 <!-- fOOD order Section Starts Here -->
 <section>
        <div class="container">
    
            <form action="" method="POST" class="contact">
    
                <fieldset>
                    <legend>Contact Us</legend>
                    
                    <input type="text" name="first-name" placeholder="First Name" class="contact-input" required>
                    
                    <input type="text" name="last-name" placeholder="Last Name" class="contact-input" required>
                   
                    <input type="tel" name="contact" placeholder="Phone Number" class="contact-input" required>
                    
                    <input type="email" name="email" placeholder="Email" class="contact-input" >

                    <input type="address" name="address" placeholder="Address" class="contact-input" required>

                    <textarea name="message" rows="10" placeholder="Type your message here" class="contact-input" required></textarea>

                    <input type="submit" name="submit" value="Send" class="btn btn-primary">
                </fieldset>

            </form>
            <h3 class="text-center text-pink">Please allow 24-48 business hours for an email respond. <br> Thank you.</h3>
        </div>
</section>
<!-- fOOD order Section Starts Here -->
<?php include("partials-front/footer.php");?>

<?php
     // process the value from form and save it in the database
    //check wether the submit button is click or not
    if(isset($_POST['submit'])){
        //button clicked
        //echo"button clicked";

        //get the data from our form
        $first_name = $_POST['first-name'];
        $last_name = $_POST['last-name'];
        $phone_number = $_POST['contact'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $message = $_POST['message'];

        //sql quary to save the data in database
        $sql = "INSERT INTO tbl_contact SET
            First_Name = '$first_name',
            Last_Name = '$last_name',
            Phone_Number = '$phone_number',
            Email = '$email',
            Address = '$address',
            Message = '$message'
        ";
        
         //Executing quary and saving data in database
         $res = mysqli_query($conn, $sql) or die(mysqli_error());

         //check wether the quary is executed data is inserted or notand display apporate message

        if($res==TRUE){
            //data inserted
            //echo "data inserted";
            //create a session varable to display message
            $_SESSION['contact'] = "<div class='success'>Thank you for contacting us</div>";
            //Redirect page to Manage admin
            header("location:".SITEURL);
        }
        else{
            //failed to insert data
            //echo "fail to insert data";
             //create a session varable to display message
             $_SESSION['contact'] = "<div class='error'>Contact Failed</div>";
             //Redirect page to Add admin
             header("location:".SITEURL.'index.php');
        }

    }
?>