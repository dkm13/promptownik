<?php 
include './partials/navbar.php';
include "./db/db.php";


// logout code
if(isset($_GET['action'])) {
  if($_GET['action'] === "logout") {
      # delete sessions
      unset($_SESSION['user_name']);
      unset($_SESSION['user_access']);
      session_destroy();

      # delete cookies
      setcookie("user_name", null, -1);
      setcookie("user_access", null, -1);

      header("Location: ./auth/login.php");
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <!-- styles -->
    <link rel="stylesheet" href="./styles/searchh.css">
    <title>Promptownik - Recent</title>
</head>
<body>
    <h3>Most Recently Prompts</h3>


<section class="prompts-list">
    <div class="featured">
        <div class="featured-prompts">

              <?php 
                 $sql = "SELECT * FROM `prompts` ORDER by id DESC LIMIT 20";
                 $rows = $mysqli->query($sql);
                  while($prompt = mysqli_fetch_assoc($rows)):
              ?>
              <div class="prompt">
                <a href="details.php?id=<?= $prompt['id'] ?>">
                <div class="parts">
                <div class="part-one">
                  <img src="<?= $prompt['image'];?>" alt="<?= $prompt['type']; ?>" width='200px' height='200px'/>
                </div>
                <div class="part-two">
                  <h4><?= $prompt['title'];?></h4>
                  <p>$ <?= $prompt['Price'];?></p>
                </div>
                </div>
              </a>
              </div>
                <?php endwhile; ?>
        </div>
    </div>


    <?php include './partials/footer.php' ?>
</body>
</html>