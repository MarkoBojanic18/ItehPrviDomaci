<?php

include 'config.php';

session_start();

error_reporting(0); 
// ova linija koda sprecava greske koje nastaju prilikom pogresnog unosa podatak prilikom logovanja.
//Tacnije kada su kredencijali netacni oni ce ostati upisani u poljima radi lakseg prepravljanja.

if(isset($_SESSION["user_id"])){
  header("Location: welcome.php");
}

if(isset($_POST["signup"])){
  $full_name = mysqli_real_escape_string($conn,$_POST["signup_full_name"]); // ako se ovaj kod ne napise moze doci do sql injection-a
  $email = mysqli_real_escape_string($conn,$_POST["signup_email"]);
  $password = mysqli_real_escape_string($conn,md5($_POST["signup_password"]));
  $cpassword = mysqli_real_escape_string($conn,md5($_POST["signup_confirm_password"])); // md5 je enkripcija za sifru

  //$check_email proverava da li u bazi postoji uneti email
$check_email = mysqli_num_rows(mysqli_query($conn,"SELECT email FROM users WHERE email='$email'"));  

  if($password !== $cpassword){
     echo "<script>alert('Password did not match.');</script>";
  }
  elseif($check_email > 0){
    echo "<script>alert('Email already exists in our database.');</script>";
  }
  else{
    $sql = "INSERT INTO users(full_name, email, password) VALUES ('$full_name','$email','$password')";
    $result = mysqli_query($conn,$sql);
    if($result){
      $_POST["signup_full_name"] = "";
      $_POST["signup_email"] = "";
      $_POST["signup_password"] = "";
      $_POST["signup_confirm_password"] = "";

      echo "<script>alert('User registration successfully');</script>";
    }
    else{
      echo "<script>alert('User registration failed');</script>";
    }
  }
}



if(isset($_POST["signin"])){
  $email = mysqli_real_escape_string($conn,$_POST["email"]);
  $password = mysqli_real_escape_string($conn,md5($_POST["password"]));


  //$check_email proverava da li u bazi postoji uneti email
$check_email = mysqli_query($conn,"SELECT id FROM users WHERE email='$email' AND password = '$password'");  

    if(mysqli_num_rows($check_email) > 0){
      $row = mysqli_fetch_assoc($check_email);
      $_SESSION["user_id"] = $row['id'];
      header("Location: welcome.php");
    }else{
      echo "<script>alert('Login details is incorrect. Please try again');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Form</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">

                <!-- sign in form -->
                <form action="" class="sign-in-form" method="post">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Email" name="email" value="<?php echo $_POST["email"]; ?>"
                            required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password"
                            value="<?php echo $_POST["password"]; ?>" required />
                    </div>
                    <input type="submit" value="Login" name="signin" class="btn solid" />
                    <p class="social-text">Or Sign in with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>


                <!-- sign up form -->
                <form action="" class="sign-up-form" method="post">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <!-- value predstavlja vrednost koja ce biti upisana u poljima nakon submitovanja forme-->
                        <input type="text" placeholder="Name" name="signup_full_name"
                            value="<?php echo $_POST["signup_full_name"]; ?>" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="signup_email"
                            value="<?php echo $_POST["signup_email"]; ?> " required />
                    </div>
                    <div class=" input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="signup_password"
                            value="<?php echo $_POST["signup_password"]; ?>" required />
                    </div>
                    <div class=" input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Confirm Password" name="signup_confirm_password"
                            value="<?php echo $_POST["signup_confirm_password"]; ?>" required />
                    </div>
                    <input type="submit" class="btn solid" name="signup" value="Sign up" />
                    <p class="social-text">Or Sign up with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
                        ex ratione. Aliquid!
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
                        laboriosam ad deleniti.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script src="app.js"></script>
</body>

</html>