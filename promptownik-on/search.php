<?php 
include './partials/navbar.php';
include "./db/db.php";

$searchquery = $_GET['query'];
$sort = $_GET['sortby'];
$made = $_GET['made'];

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


<section class="prompts-list">
    <div class="featured">
        <div class="featured-prompts">


           <!-- searchterm & no sort & no made -->
            <?php 
                 if($searchquery && $sort == 0 && $made == 0){
                 $sql = "SELECT * FROM `prompts` WHERE `title` LIKE '%$searchquery%'";
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

              <!-- searchterm & sort=featured & no made -->
              <?php 
                 if($searchquery && $sort && $made == 0){
                  if($sort == 'featured'){
                 $sql = "SELECT * FROM `prompts` WHERE `title` LIKE '%$searchquery%' AND `featured` = 1";
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


             <!-- searchterm & sort=popular & no made -->
             <?php 
                 if($searchquery && $sort && $made == 0){
                  if($sort == 'popular'){
                 $sql = "SELECT * FROM `prompts` WHERE `title` LIKE '%$searchquery%' AND `popular` = 1";
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


             <!-- searchterm & sort=newest & no made -->
             <?php 
                 if($searchquery && $sort && $made == 0){
                  if($sort == 'newest'){
                 $sql = "SELECT * FROM `prompts` WHERE `title` LIKE '%$searchquery%' ORDER by id DESC";
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


             <!-- searchterm & nosort & made=any -->
             <?php 
                 if($searchquery && $sort == 0 && $made){
                  if($made == 'any'){
                 $sql = "SELECT * FROM `prompts` WHERE `title` LIKE '%$searchquery%' ";
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

             <!-- searchterm & nosort &made=type -->
             <?php 
                 if($searchquery && $sort == 0 && $made){
                 $sql = "SELECT * FROM `prompts` WHERE `title` LIKE '%$searchquery%' AND `type` = '$made' ";
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
  

           <!-- search term & sort & made -->
           <!-- searchterm & sort=featured & made=any -->
  
           <?php 
                 if($searchquery && $sort && $made){
                  if($sort == 'featured' && $made){
                    if($made === 'any'){

                      $sql = "SELECT * FROM `prompts` WHERE `title` LIKE '%$searchquery%' AND `featured` = 1 ";
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
             <?php } else {
                   $sql = "SELECT * FROM `prompts` WHERE `title` LIKE '%$searchquery%' AND `featured` = 1 AND `type` = '$made' ";
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
            <?php } ?>

            <!-- searchterm & sort=popular & made=any -->
           <?php 
                 if($searchquery && $sort && $made){
                  if($sort == 'popular' && $made){
                    if($made === 'any'){

                      $sql = "SELECT * FROM `prompts` WHERE `title` LIKE '%$searchquery%' AND `popular` = 1 ";
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
             <?php } else {
                   $sql = "SELECT * FROM `prompts` WHERE `title` LIKE '%$searchquery%' AND `popular` = 1 AND `type` = '$made' ";
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
          <?php } ?>



            <!-- searchterm & nsrt=recent & made=any -->
               <!-- searchterm & sort=recent & made=any -->
               <?php 
                 if($searchquery && $sort && $made){
                  if($sort == 'newest' && $made){
                    if($made === 'any'){

                      $sql = "SELECT * FROM `prompts` WHERE `title` LIKE '%$searchquery%' ORDER by id DESC ";
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
                 <?php } else {
                      $sql = "SELECT * FROM `prompts` WHERE `title` LIKE '%$searchquery%' AND `type`='$made' ORDER by id DESC";
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
                <?php } ?>

         </div>
    </div>


    <?php include './partials/footer.php' ?>
</body>
</html>