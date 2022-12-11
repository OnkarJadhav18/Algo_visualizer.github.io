<?php

session_start();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSRT Register</title>
    <?php include 'style.php' ?>
    <?php include 'links.php' ?>
</head>
<body>
    <?php
    include 'dbcon.php';//add database to this page

    if(isset($_POST['submit'])){
        $username =    mysqli_real_escape_string($con, $_POST['username']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

        //encrept password and cpassword
        $pass = password_hash($password,PASSWORD_BCRYPT);
        $cpass= password_hash($cpassword,PASSWORD_BCRYPT);

        //making sure user entering email that is not already stored on database   
        $emailquery= "select * from registration where email='$email' ";
        $query = mysqli_query($con,$emailquery);

        //if multiple email exit then
        $emailcount = mysqli_num_rows($query);

        if($emailcount>0){
            ?>
            <script>
                alert("Email Already Exits");
            </script>
            <?php
        }
        else{
            //check password and cpassword are same or not
            if($password===$cpassword){
                //queries to insert data in database
                $insertquery ="insert into registration(username, email, mobile, password, cpassword) values( '$username','$email',
                '$mobile', '$pass','$cpass') ";

                $iquery = mysqli_query($con, $insertquery);

                if($iquery){
                    ?>
                    <script>
                        alert("Account created successfuly");
                    </script>
                    <?php
                }
                else{
                    ?>
                    <script>
                        alert("no insertion");
                    </script>
                    <?php
                
                }

            }
            else{
                ?>
                <script>
                    alert("Passwords are not matching");
                </script>
                <?php
            }
        }

    }




    ?>






    <div class="card bg -light">
        <article class="card-body mx-auto" style="max-width: 400px;">
        <h4 class="card-title mt-3 text-center">Create Account</h4>
        <p class="text-center">Get started with your free account</p>
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
                <input type="text" name="username" class="form-control" placeholder="Full name" 
                required>
            </div>
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                </div>
                <input name="email" class="form-control" placeholder="Email address"
                type="email" required>
            </div>
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                </div>
                <input name="mobile" class="form-control" placeholder="Phone number"
                type="number" required>
            </div>
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                </div>
                <input name="password" class="form-control" placeholder="Create Password"
                type="password" required>
            </div>
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                </div>
                <input name="cpassword" class="form-control" placeholder="Repeat Password"
                type="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block">
                    Create Account
                </button>
                <p class="text-center">Have an account? <a href="login.php">Log in</a></p>
            </div>
        </form>
        </article>
    </div>
</body>
</html>