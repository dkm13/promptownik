<?php 
include '../admin/parts/nav.php';
include "../db/db.php";

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

            if(isset($_GET['id'])){ 
                $ids = $_GET['id'];
                $role = 1;
                $sql = "UPDATE `users` SET `role`='$role' WHERE `users`.`id`='$ids'";

                if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
                } else {
                echo "Error updating record: " . $conn->error;
                }

                $conn->close();
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
    <title>Admin</title>
</head>
<body>
    
<h3>All users</h3>


<section class="prompts-list">
        <div class="featured-prompts">

              <?php 
                 $sql = "SELECT * FROM `users` ORDER by id DESC LIMIT 20";
                 $rows = $mysqli->query($sql);
                  while($prompt = mysqli_fetch_assoc($rows)):
              ?>
            <div class="prompt">
                <!-- <a href="?id=<?= $prompt['id'] ?>"> -->
                
                
                  <h4><?= $prompt['email'];?></h4>
                  <p>Username: <?= $prompt['username'];?></p>
                    
                  <a href="?id=<?= $prompt['id'] ?>"><button type="button" class="btn btn-success">Change role-> Admin</button></a>
                
              <!-- </a> -->
           </div>
                <?php endwhile; ?>
         </div>
    </section>
</body>
</html>