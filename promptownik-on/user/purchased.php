<?php 
include "../db/db.php";

session_start();

if(isset($_SESSION['user_name'])) {
    if($_SESSION['user_name']) {
        // echo "you have access to stay on this page";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <!-- styles -->
    <link rel="stylesheet" href="../styles/searchh.css">
    <title>Promptownik - Prompts</title>
</head>
<body>

    <!-- nav -->
  <?php 
     include './parts/nav.php';
  ?>

    <h3>Purchased:</h3>


    <section class="prompts-list">
        <h3>There is no purchased prompt yet</h3>
    <!-- <div class="featured">
        <div class="featured-prompts">

              <?php 
                //  $sql = "SELECT * FROM `purchases` WHERE `username`='$u_name'";
                //  $rows = $mysqli->query($sql);
                //   while($prompt = mysqli_fetch_assoc($rows)):
              ?>
              <div class="prompt">
                <p>< $prompt['promptid'] ?></p>
              </div>
            
        </div>
    </div> -->
    </section>

</body>
</html>