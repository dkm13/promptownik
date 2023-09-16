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
    
<h3>All Prompts</h3>


<section class="prompts-list">
        <div class="featured-prompts">

              <?php 
                 $sql = "SELECT * FROM `prompts` ORDER by id DESC LIMIT 20";
                 $rows = $mysqli->query($sql);
                  while($prompt = mysqli_fetch_assoc($rows)):
              ?>
            <div class="prompt">
                <!-- <a href="?id=<?= $prompt['id'] ?>"> -->
                
                   <img src="<?= $prompt['image'] ?>" />
                  <h4><?= $prompt['title'];?></h4>
                  <p>$ <?= $prompt['Price'];?></p>
                    
                  <!-- <a href="?id=<?= $prompt['id'] ?>"><button type="button" class="btn btn-danger">Delete</button></a> -->
                  <a href="./admin_prompt.php?id=<?= $prompt['id'] ?>"><button type="button" class="btn btn-success">View</button></a>
              <!-- </a> -->
           </div>
                <?php endwhile; ?>
         </div>
    </section>
</body>
</html>