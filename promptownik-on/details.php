<?php 
@include './partials/navbar.php';
include './db/db.php';

$id = $_GET['id'];
if(isset($id)){
    $sql = "SELECT * FROM `prompts` WHERE id='$id'";
    $results = $mysqli->query($sql);
}else{
    header("location: index.php");
}


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
    <link rel="stylesheet" href="./styles/detailssss.css">
    <title> Promptownik - Prompt <?php echo $id ?></title>
</head>
<body>

<!-- <div class="col-md-2"></div> -->
<div class="con">
        <?php 
            while($prompt = mysqli_fetch_assoc($results)):
        ?>
            <!-- <h3>Prompt <span class="prompttitle"><?php echo $prompt['title'];  ?></span></h3> -->
            <hr class="divider"/>
            <div class="part-1">
              <img src="<?= $prompt['image'];?>" alt="<?= $prompt['title']; ?>" width="200px" height="200px"/>
            </div>
            <div class="part-2">
                <h4><?= $prompt['title']; ?></h4>
                <p><b>Posted by: </b><?= $prompt['postedby']; ?></p>
                <hr/>
                <button type="button" class="btn btn-dark">$ <?= $prompt['Price'] ?></button>
                <?php if(!isset($_SESSION['user_name'])){?>
                    <a class="link" href="./auth/login.php"><button type="button" class="btn btn-success">Buy Prompt</button></a>
                <?php } else { ?>
                    <a class="link" href="./checkout.php"><button type="button" class="btn btn-success">Buy Prompt</button></a>
                <?php } ?>
                <hr/>
                <p><b>Description: </b><?= $prompt['description']; ?></p>
                <p><b>Instructions: </b> <?= $prompt['instructions']; ?></p>
                <p><b>Made with: </b><?= $prompt['type']; ?></p>
                <p><b>Uploaded: </b><?= $prompt['posted']; ?></p>
         
                <div class="btn-con">
                    <?php if($prompt['featured'] == 1): ?>
                        <button type="button" class="btn btn-info">Featured</button>
                    <?php endif ?>
                    <?php if($prompt['popular'] == 1): ?>
                        <button type="button" class="btn btn-warning">Popular</button>
                    <?php endif ?>
                </div>
                
            </div>
        <?php endwhile; ?>
    </div>

    <?php @include './partials/footer.php' ?>

</body>
</html>