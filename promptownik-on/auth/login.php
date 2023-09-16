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

if(isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    if( isset($email) && !empty($email) && isset($password) && !empty($password) ) {
        if(is_email($email)) {
            $sql = "SELECT * FROM `users` WHERE `email`='$email'";
            if($result = $mysqli->query($sql)) {
                if($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                   
                     if($password === $row['password']) {
                       
                        if($row['role'] == 1){
                            $_SESSION['user_name'] = $row['username'];
                            $_SESSION['admin_access'] = true;
                            setcookie("user_name", $_SESSION['user_name'], time()+900);
                            setcookie("admin_access", $_SESSION['admin_access'], time()+900);
                            header("Location: ../admin/dashboard.php");
                        } else{
                            $_SESSION['user_name'] = $row['username'];
                            $_SESSION['user_access'] = true;
                            setcookie("user_name", $_SESSION['user_name'], time()+900);
                            setcookie("user_access", $_SESSION['admin_access'], time()+900);
                            header("Location: ../index.php");
                        }
                    } else {
                        $errors[] = "Password is incorrect!";
                    }
                } else {
                    $errors[] = "User doesn't exist!";
                }
            } else {
                $errors[] = "Login faild!";
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
    <link rel="stylesheet" href="../styles/autht.css"/>>
    <title>Promptownik - Login</title>
</head>
<body>
    <h2> Promptownik - Login</h2>
    <img src="../uploads/logoo.png" alt="logo" />


<form class="login-form" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" id="form2Example1" name="email" class="form-control" />
    <label class="form-label" for="form2Example1">Email address</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" id="form2Example2" name="password" class="form-control" />
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

  <!-- 2 column grid layout for inline styling -->
  <div class="row mb-4">
    <div class="col d-flex justify-content-center">
      <!-- Checkbox -->
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="form2Example31"/>
        <label class="form-check-label" for="form2Example31"> Remember me </label>
      </div>
    </div>
  </div>

  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4" name="login_btn">Sign in</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a member? <a href="./register.php">Register</a></p>
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
        <button name="login_btn" type="submit">Register</button>
        <a href="register.php">Register</a>
    </form> -->
</body>
</html>