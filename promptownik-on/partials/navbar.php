
<?php 
include './db/db.php';
session_start();


// if(isset($_SESSION['user_name'])) {
//     if($_SESSION['user_name']) {
//         // echo "you have access to stay on this page";
//     }
//     else{
//         echo "access is blocked" . '<a href="../auth/login.php">Back to login</a>';
//     }
// } else {
//     header("Location: ../auth/login.php");
// }

//         if(isset($_SESSION['user_name'])) {
//             $u_name = $_SESSION['user_name']; 
//         }

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
  <script src="https://kit.fontawesome.com/049c2c6974.js" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles/navb.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</head>
<body>

<?php if(!isset($_SESSION['user_name'])){?>
  <nav class="navbar navbar-expand-md" aria-label="Fourth navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="./uploads/logoo.png" alt="logo"/></a>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse " id="navbarsExample04">
     
      <ul class="navbar-nav me-auto mb-2 mb-md-0 mx-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="search_test.php?query=search">Find prompts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./auth/login.php">Purchased</a>
          </li>
          </ul>

          <div class=" dropdown" >
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"  >
                <li><a class="dropdown-item" href="./auth/login.php">Profile</a></li>
                <li><a class="dropdown-item" href="./auth/login.php">Login</a></li>
            </ul>
            </div>
  
        </li>
      </div>
    </div>
  </nav>

<?php } else{?>
  <nav class="navbar navbar-expand-md " aria-label="Fourth navbar example">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="./uploads/logoo.png" alt="logo"/></a>
    <li class="nav-item">
            <p class="h4 logo-text">Promptownik</p>
        </li>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarsExample04">
        <ul class="navbar-nav me-auto mb-2 mb-md-0 mx-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="search_test.php?query=search">Find prompts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./user/purchased.php">Purchased</a>
          </li>
          </ul>
        <div class="dropdown" >
          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <!-- <i class="fas fa-user"></i> -->
              <img class="avatar-nav" src="./uploads/avatar.png" />
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1"  >
              <li><a class="dropdown-item" href="./user/user_dashboard.php">Dashboard</a></li>
              <li><a class="dropdown-item" href="?action=logout">Logout</a></li>
          </ul>
          </div>

      </li>
    </div>
  </div>
</nav>
<?php } ?>
 

 

</body>
</html> 