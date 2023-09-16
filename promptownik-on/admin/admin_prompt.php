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

$id = $_GET['id'];
if(isset($id)){
    $sql = "SELECT * FROM `prompts` WHERE id='$id'";
    $results = $mysqli->query($sql);
}else{
    header("location: index.php");
}


if(isset($_POST['delete'])) {
    $ids = $_GET['id'];
    $sql = "DELETE FROM `prompts` WHERE `id`=?";
    $stmt = $mysqli->prepare($sql);
    $stmt->execute([$ids]);
    
    if($stmt->execute([$ids])) {
        header("Location: ./dashboard.php");
    } else {
        header("Location: admin_prompts.php");
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
    <link rel="stylesheet" href="../styles/details.css">
    <title> Promptownik - Prompt <?php echo $id ?></title>
</head>
<body>

<!-- <div class="col-md-2"></div> -->
<div class="container" style="margin: auto; margin-bottom: 50px;">
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
                <p style="color: white"><b>Description: </b><?= $prompt['description']; ?></p>
                <p style="color: white"><b>Instructions: </b> <?= $prompt['instructions']; ?></p>
                <p style="color: white"><b>Type: </b><?= $prompt['type']; ?></p>
                <p style="color: white"><b>Posted at: </b><?= $prompt['posted']; ?></p>
                <p style="color: white"><b>Posted by: </b><?= $prompt['postedby']; ?></p>
         
                <div class="btn-con">
                    <?php if($prompt['featured'] == 1): ?>
                        <button type="button" class="btn btn-info">Featured</button>
                    <?php endif ?>
                    <?php if($prompt['popular'] == 1): ?>
                        <button type="button" class="btn btn-warning">Popular</button>
                    <?php endif ?>
                </div>
                <button type="button"  class="btn btn-success">$ <?= $prompt['Price'] ?></button>
                <form method="POST">
                    <br/>
                     <a href="?id=<?= $prompt['id'] ?>"><button type="submit" name="delete" class="btn btn-danger">Delete</button></a>
                </form>
               

            </div>
        <?php endwhile; ?>
    </div>


</body>
</html>