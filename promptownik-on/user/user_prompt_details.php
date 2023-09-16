<?php 
include '../db/db.php';

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


$id = $_GET['id'];
if(isset($id)){
    $sql = "SELECT * FROM `prompts` WHERE id='$id'";
    $results = $mysqli->query($sql);
}else{
    header("location: ../auth/index.php");
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <!-- styles -->
    <link rel="stylesheet" href="../styles/detailss.css">
    <title> Promptownik - Prompt <?php echo $id ?></title>
</head>
<body>
 
  <!-- nav -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark" aria-label="Fourth navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="dashboard.php"><img src="../uploads/logo.png" alt="logo"/></a>
      <li class="nav-item">
              <p class="h4 logo-text">USER - Dashboard</p>
        </li>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse " id="navbarsExample04">
        <ul class="navbar-nav me-auto mb-2 mb-md-0 mx-auto">
          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="../index.php#prompts">
              Prompts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./purchased.php">Purchased</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./sell.php">Sell</a>
          </li>
          </ul>

      </div>
      <a href="?action=logout"><button type="button" class="btn btn-danger">LOG OUT</button></a>
    </div>
  </nav>


<!-- <div class="col-md-2"></div> -->
<div class="container">
        <?php 
            while($prompt = mysqli_fetch_assoc($results)):
        ?>
            <h3>Prompt <span class="prompttitle"><?php echo $prompt['title'];  ?></span></h3>
            <hr class="divider"/>
            <div class="part-1">
              <img src="<?= $prompt['image'];?>" alt="<?= $prompt['title']; ?>" width="200px" height="200px"/>
            </div>
            <div class="part-2">
                <h4><?= $prompt['title']; ?></h4>
                <p><b>Description: </b><?= $prompt['description']; ?></p>
                <p><b>Instructions: </b> <?= $prompt['instructions']; ?></p>
                <p><b>Type: </b><?= $prompt['type']; ?></p>
                <p><b>Posted at: </b><?= $prompt['posted']; ?></p>
                <p><b>Posted by: </b><?= $prompt['postedby']; ?></p>
         
                <div class="btn-con">
                    <?php if($prompt['featured'] == 1): ?>
                        <button type="button" class="btn btn-info">Featured</button>
                    <?php endif ?>
                    <?php if($prompt['popular'] == 1): ?>
                        <button type="button" class="btn btn-warning">Popular</button>
                    <?php endif ?>
                </div>
                <button type="button" class="btn btn-success">$ <?= $prompt['Price'] ?></button>
                
                <a class="link" href="#"><button type="button" class="btn btn-dark">Buy Prompt</button></a>

            </div>
        <?php endwhile; ?>
    </div>


</body>
</html>