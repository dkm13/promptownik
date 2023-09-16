<?php 
session_start();
include "../db/db.php";

// print_r($mysqli);



function is_email($email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
        
    return true;
}

$errors = [];

if(isset($_POST['register_btn'])) {
    $email = $mysqli->escape_string($_POST['email']);
    $password = $mysqli->escape_string($_POST['password']);
    $confirm_password = $mysqli->escape_string($_POST['confirm_password']);
    $username = $mysqli->escape_string($_POST['username']);

    if(isset($email) && !empty($email) && isset($username) && !empty($username)  && isset($password) && !empty($password) && isset($confirm_password) && !empty($confirm_password) ) {
        if(is_email($email)) {
        // if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if($password === $confirm_password) {
                // $password = password_hash($password, PASSWORD_DEFAULT);
                // $confirm_password = password_hash($confirm_password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`email`, `username`, `password`, `role`) VALUES ('$email', '$username', '$password', 0)";
                if($mysqli->query($sql)) {
                    header("Location: ./login.php");
                } else {
                    $errors[] = "Registration faild!";
                }
            } else {
                $errors[] = "Password and Confirm password doesn't match!";
            }
        } else {
            $errors[] = "Email is not valid!";
        }
    } else {
        $errors[] = "All fields are required!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/autht.css"/>
    <title>Promptownik - Register</title>
</head>
<body>
    <h2>Promptownik Register</h2>
    <img src="../uploads/logoo.png" alt="logo" />


<form class="login-form" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" id="form2Example1" name="email" class="form-control" />
    <label class="form-label" for="form2Example1">Email address</label>
  </div>
  <div class="form-outline mb-4">
    <input type="text" id="form2Example1" name="username" class="form-control" />
    <label class="form-label" for="form2Example1">Username</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" id="form2Example2" name="password" class="form-control" />
    <label class="form-label" for="form2Example2">Password</label>
  </div>
  <div class="form-outline mb-4">
    <input type="password" id="form2Example2" name="confirm_password" class="form-control" />
    <label class="form-label" for="form2Example2">Password</label>
  </div>

  <?php
        echo "<ul class='ul'>"; 
        if(count($errors)) {
            foreach($errors as $error) {
                echo "<li>$error</li>";
            }
        }
        echo "</ul>";
    ?>



  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4" name="register_btn">Register</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Have an account?<a href="./login.php">Login</a></p>
  </div>
  <div class="text-center">
    <p><a href="../index.php">Back to Homepage</a></p>
  </div>
</form>


    <!-- <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
        <input type="text" name="email" placeholder="Enter your email" />
        <br /><br />
        <input type="password" name="password" placeholder="Enter your password" />
        <br /><br />
        <input type="password" name="confirm_password" placeholder="Enter your password" />
        <br /><br />
        <button name="register_btn" type="submit">Register</button>
        <a href="login.php">Login</a>
    </form> -->
</body>
</html>