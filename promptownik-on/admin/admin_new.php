<?php 
include '../db/db.php';
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

        if(isset($_SESSION['user_name'])) {
            $u_name = $_SESSION['user_name']; 
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/adminstyles.css">
    <title>Admin</title>
</head>
<body>

   <?php include './parts/nav.php' ?>


   <h3 style="color: white">ADD new Prompt:</h3>
   <section class="account">
        <?php
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

            if(isset($_POST['add_btn'])){ 
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['Price'];
                $type = $_POST['type'];
                $instructions = $_POST['instructions'];
                $image = $_POST['image'];
                $file = $_POST['file'];
               
                $sql = "INSERT INTO 
                `prompts`( `title`, `description`, `Price`, `type`, `instructions`, `image`, `file`, `postedby`) 
                VALUES ('$title','$description','$price','$type','$instructions','$image', '', 'admin')";

                if ($conn->query($sql) === TRUE) {
                echo "Record successfully";
                } else {
                echo "Error updating record: " . $conn->error;
                }

                $conn->close();
            }
            
        ?>

    <form class="change-form" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
        <!-- Email input -->
        <div class="form-outline mb-4">
            <input type="text" id="form2Example1" name="title" class="form-control" />
            <label class="form-label" for="form2Example1">Title</label>
        </div>
        <div class="form-outline mb-4">
            <input type="text" id="form2Example1" name="description" class="form-control" />
            <label class="form-label" for="form2Example1">Description</label>
        </div>
        <div class="form-outline mb-4">
            <input type="price" min="0" max="10000" step="1" id="form2Example1" name="Price" class="form-control" />
            <label class="form-label" for="form2Example1">Price</label>
        </div>
        <div class="form-outline mb-4">
            <input type="text" id="form2Example1" name="type" class="form-control" />
            <label class="form-label" for="form2Example1">Prompt type</label>
        </div>
        <div class="form-outline mb-4">
            <input type="text" id="form2Example1" name="instructions" class="form-control" />
            <label class="form-label" for="form2Example1">Instructions</label>
        </div>
        <div class="form-outline mb-4">
            <input type="url" id="form2Example1" name="image" class="form-control" />
            <label class="form-label" for="form2Example1">Image</label>
        </div>
        <div class="form-outline mb-4">
            <input type="file" id="form2Example1" name="file" class="form-control" />
            <label class="form-label" for="form2Example1">File</label>
        </div>

        


        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4" name="add_btn">Add Prompt</button>

    </form>

   </section>
    
</body>
</html>