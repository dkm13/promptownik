<?php 
include '../db/db.php';
session_start();

if(isset($_SESSION['admin_access'])) {
    if($_SESSION['admin_access']) {
        
    }
    else{
        echo "access is blocked" . '<a href="../auth/login.php">Back to login</a>';
    }
} else {
    header("Location: ../auth/login.php");
}

        if(isset($_SESSION['user_name'])) {
            $u_name = $_SESSION['user_name']; 
        }

// logout code
if(isset($_GET['action'])) {
    if($_GET['action'] === "logout") {
        # delete sessions
        unset($_SESSION['user_email']);
        unset($_SESSION['is_logged_in']);
        session_destroy();

        # delete cookies
        setcookie("user_email", null, -1);
        setcookie("is_logged_in", null, -1);

        header("Location: ../auth/login.php");
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
    <link rel="stylesheet" href="../styles/adminstyles.css">
    <title>Promptownik</title>
</head>
<body>

   <?php include './parts/nav.php' ?>

   <h3 id="h3stats">All-time stats:</h3>
   <section class="stats">
      <div class="prompts box">
        <p>Total Prompts:</p>
        <h3 style="color: black !important"><?php 
                 $sql = "SELECT COUNT(*) FROM prompts";
                 $result = $mysqli->query($sql);
                 $count = mysqli_fetch_assoc($result)['COUNT(*)'];
                 echo $count;
        ?></h3>
      </div>
      <div class="users box">
        <p>Total users:</p>
        <h3 style="color: black !important"><?php 
                 $sql = "SELECT COUNT(*) FROM users";
                 $result = $mysqli->query($sql);
                 $count = mysqli_fetch_assoc($result)['COUNT(*)'];
                 echo $count;
        ?></h3>
      </div>
      <div class="solds box">
        <p>Total buy/sell:</p>
        <h3 style="color: black !important">0</h3>
      </div>
      <div class="solds box">
        <p>Total value:</p>
        <h3 style="color: black !important">$ 0</h3>
      </div>
   </section>

   <h3>Your account's details:</h3>
   <section class="account">

        <?php 

            $sql = "SELECT * FROM `users` WHERE `username` LIKE '%$u_name%'";
            $rows = $mysqli->query($sql);
             while($prompt = mysqli_fetch_assoc($rows)):
        ?>
          <div class="user-details">
            <p>Your email: <?= $prompt['email'];?></p>
            <p>Your password: <?= $prompt['password'];?></p>
          </div>
        <?php endwhile; ?>
        Change:
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "promptownik";

            

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }

            if(isset($_POST['change_btn'])){ 
                $email = $_POST['email'];
               $pass = $_POST['password'];
                $sql = "UPDATE `users` SET `email`='$email', `password`='$pass' WHERE `users`.`username`='$u_name'";

                if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
                } else {
                echo "Error updating record: " . $conn->error;
                }

                $conn->close();
            }
            
        ?>

    <form class="change-form" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
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


        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4" name="change_btn">Change</button>

    </form>

   </section>
    
    <!-- payments -->

    <!-- <h3>Payment details:</h3>
   <section class="account">

        <?php 

            // $sql = "SELECT * FROM `users` WHERE `username` LIKE '%$u_name%'";
            // $rows = $mysqli->query($sql);
            //  while($prompt = mysqli_fetch_assoc($rows)):
        ?>
          <div class="user-details">
            <p>Your API key: <$prompt['payment_key'];?></p>
          </div>
        < ?>
        Change:
        <?php
            // $servername = "localhost";
            // $username = "root";
            // $password = "";
            // $dbname = "promptownik";

            

            // // Create connection
            // $conn = new mysqli($servername, $username, $password, $dbname);
            // // Check connection
            // if ($conn->connect_error) {
            // die("Connection failed: " . $conn->connect_error);
            // }

            // if(isset($_POST['change_payment_btn'])){ 
            //     $API_key = $_POST['api_key'];
            //     $sql = "UPDATE `users` SET `payment_key`='$API_key' WHERE `users`.`username`='$u_name'";

            //     if ($conn->query($sql) === TRUE) {
            //     echo "Record updated successfully";
            //     } else {
            //     echo "Error updating record: " . $conn->error;
            //     }

            //     $conn->close();
            // }
            
        ?>

    <form class="change-form" method="POST" action="< $_SERVER['PHP_SELF'] ?>">
         Email input -->
        <!-- <div class="form-outline mb-4">
            <input type="text" id="form2Example1" name="api_key" class="form-control" />
            <label class="form-label" for="form2Example1">API key</label>
        </div> -->


        <!-- Submit button -->
        <!-- <button type="submit" class="btn btn-primary btn-block mb-4" name="change_payment_btn">Change</button>

    </form> -->

   </section>

</body>
</html>