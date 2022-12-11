<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSRT Login</title>
    <?php include 'style.php'?>
    <?php include 'links.php' ?>
</head>
<body>
    <?php

    include 'dbcon.php';


    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];


        $email_search = " select * from registration where email = '$email' ";
        $query = mysqli_query($con,$email_search);

        $email_count = mysqli_num_rows($query);
    

        if($email_count){
            $email_pass = mysqli_fetch_assoc($query);

            $db_pass= $email_pass['password'];
            $_SESSION['username'] = $email_pass['username'];
            $pass_decode = password_verify($password, $db_pass);

            if($pass_decode){
                echo "Login success";
                ?>

                <script>
                    location.replace("../home/index.html");
                </script>


                <?php




                

            }else{
                echo "pass incorrect";
            }
        }
        
            else{
                echo "Invalid email";
            }
        }
   
        
    


     ?>







<div class="card bg -light">
        <article class="card-body mx-auto" style="max-width: 400px;">
        <h4 class="card-title mt-3 text-center">Login Your Account</h4>
        <p class="text-center">Enter correct email and password</p>
        <p>
            <a href="" class="btn btn-block btn-gmail"> <i class="fa fa-google"></i>
            Login via Gmail</a>
            <a href="" class="btn btn-block btn-facebook"> <i class="fa fa-facebook"></i>
            Login via facebook</a>
        </p>
        <p class="divider-text">
            <span class="bg-light">OR</span>
        </p>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="Full name" 
                required>
            </div>
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                </div>
                <input name="password" class="form-control" placeholder="create password" value=""
                type="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block">
                    Login Now
                </button>
                <p class="text-center">Not have an account? <a href="regis.php">Sign Up Here</a></p>
            </div>
        </form>
        </article>
</div>
</body>
</html>