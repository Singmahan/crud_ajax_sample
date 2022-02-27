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
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = stripslashes($_REQUEST['email']);
        $email = mysqli_real_escape_string($condb, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($condb, $password);

        if ($email != '' && $password != '') {
            $sql = "SELECT
            `login_email`,
            `login_password`,
            `login_name`,
            `login_status`
        FROM
            `login`
        WHERE
            `login_email` = '$email' AND `login_password` = '$password'";
            $query = $condb->query($sql);
            $check = mysqli_num_rows($query);
            if ($check > 0) {
                $auth = $query->fetch_assoc();
                $_SESSION['login_email'] = $auth['login_email'];
                $_SESSION['login_name'] = $auth['login_name'];
                header("Location: index.php?pt=list_data");
            }else{
                echo "<script>Swal.fire({
                    icon: 'error',
                    title: 'ผิดพลาด',
                    text: 'ไม่มีข้อมูลนี้ในระบบ'
                })</script>";
            }
        } else {
            echo "<script>Swal.fire({
            icon: 'error',
            title: 'ผิดพลาด',
            text: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง'
        })</script>";
        }
    }
    ?>
    <div class="d-flex align-items-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">
                        <h5 class="card-header text-center">login</h5>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="">Email address</label>
                                        <input type="email" name="email" class="form-control" placeholder="Email address">
                                    </div>
                                    <div class="col-12">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="w-100 btn btn-success form-control">login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>