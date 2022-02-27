<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- google fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=K2D&family=Prompt:wght@200;400;500&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <!-- jquery จาก https://developers.google.com/speed/libraries -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>index</title>

    <style>
        body {
            font-family: 'K2D', sans-serif;
        }
    </style>
</head>

<body>
    <?php
        session_start();
        require("connection/connectdb.php");

        // check login 
        if(!isset($_SESSION['login_email']) || !isset($_SESSION['login_name'])){
            header("Location: login.php");
            exit();
        }
        
    ?>
    <div class="container">
        <?php
        require("components/navbar.php");
        
        if (isset($_GET['pt'])) {
            $page = $_GET['pt'];
            if ($page == "insert_data") {
                require("components/insert_data.php");
            } else if ($page == "list_data") {
                require("components/list_data.php");
            } else {
                require("components/list_data.php");
            }
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>