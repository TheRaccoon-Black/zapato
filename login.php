<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <title>login | zapato.com </title>
</head>

<body id="bg-login">
    <div class="box-login" style="border-radius:10px;">
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="text" name="user" placeholder="Username" class="input-control">
            <input type="password" name="pass" placeholder="password" class="input-control">
            <input type="submit" name="submit" value="Login" class="btn">
        </form>
        <?php
        if (isset($_POST['submit'])) {
            include "db.php";
            session_start();
            $user = $_POST['user'];
            $pass = $_POST['pass'];

            $cek = mysqli_query($conn, "select * from tb_admin where username = '" . $user . "' and password = '" . $pass . "'");
            if (mysqli_num_rows($cek) > 0) {
                $d = mysqli_fetch_object($cek);
                $_SESSION['status_login'] = true;
                $_SESSION['a_global'] = $d;
                $_SESSION['id'] = $d->admin_id;
                echo "<script>alert('login berhasil')</script>";
                header("Location: dashboard.php");
            } else {
                echo "<script type='text/javascript'>alert('username atau password salah!!!')</script>";
            }
        }
        ?>
    </div>
</body>

</html>