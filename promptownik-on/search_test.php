<?php 
include './partials/navbar.php';
include "./db/db.php";


$searchquery = $_GET['query'];

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
    <title>Promptownik - Search <?php echo $searchquery ?></title>
</head>
<body>

      
        <h3>Search results for: <span class="search-term"><?php echo $searchquery; ?></span></h3>

        <section class="search">
            <form class="d-flex search-form" method="GET" action="search.php">
                <input class="form-control me-2 s-bar" name="query" type="search" value="<?php echo $searchquery ?>">
                <select class="form-select" name="sortby" aria-label="Default select example" required>
                    <option  value="0" selected>Sortby:</option>
                    <option value="featured">Featured</option>
                    <option value="popular">Popular</option>
                    <option value="newest">Newest</option>
                </select>
                <select class="form-select" name="made" aria-label="Default select example" required>
                    <option value="0" selected>Made:</option>
                    <option value="any">Any</option>
                    <option value="midjourney">Midjourney</option>
                    <option value="dall-e">Dall-E</option>
                    <option value="gpt">GPT-3</option>
                    <option value="chatgpt">ChatGPT</option>
                </select>
               
                <button class="btn btn-success" name="search_btn" type="submit" onclick="submit()">Search</button>
            </form>
        </section>

    <?php 
        if(isset($_POST['search_btn'])){
          $query = $_GET['query'];
          $sortby = $_GET['sortby'];
          $made = $_GET['made'];

          if($sortby == 0 && $made == 0) {
                 $sql = "SELECT * FROM `prompts` WHERE `title` LIKE '%$query%'";
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
            <?php } ?>
            <?php } ?>




    <?php include './partials/footer.php' ?>
</body>
</html>