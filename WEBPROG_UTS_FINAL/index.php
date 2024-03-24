<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "admin & nasabah bank";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$error = "";

if(isset($_POST['login'])) {
    if($_POST['captcha'] != $_SESSION['captcha']) {
        $error = "Captcha salah!";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt_user = $conn->prepare("SELECT * FROM users WHERE email = ? AND BINARY password = ?");
        $stmt_admin = $conn->prepare("SELECT * FROM admin WHERE email = ? AND BINARY password = ?");
        $stmt_user->bind_param("ss", $email, $password);
        $stmt_admin->bind_param("ss", $email, $password);

        $stmt_user->execute();
        $result_user = $stmt_user->get_result();

        $stmt_admin->execute();
        $result_admin = $stmt_admin->get_result();

        if ($result_user->num_rows == 1) {
            $row = $result_user->fetch_assoc();

            if ($row['verified'] == 1) {
                $_SESSION['email'] = $email;
                header("Location: home.php");
                exit();
            } else {
                $error = "Akun belum diverifikasi.";
            }
        } elseif ($result_admin->num_rows == 1) {
            $row = $result_admin->fetch_assoc();

            $_SESSION['email'] = $email;
            header("Location: admin-home.php");
            exit();
        } else {
            $error = "Username/email atau password salah.";
        }

        $stmt_user->close();
        $stmt_admin->close();
    }
}

function generateCaptcha($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $captcha = '';
    for ($i = 0; $i < $length; $i++) {
        $captcha .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $captcha;
}

$captcha = generateCaptcha();
$_SESSION['captcha'] = $captcha;
?>

<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: lightblue;">
    <div class="container text-center">
        <h1 class="title">PUSKESMAS ONLINE</h1>
        <h2>Login</h2>
        <?php if(isset($error) && $error != "") { ?>
            <div style="color: red;"><?php echo $error; ?></div>
        <?php } ?>
        <form method="post">
            <input type="text" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="text" name="captcha" placeholder="Enter Captcha: <?php echo $captcha; ?>" required><br>
            <small>Belum punya akun? <a href="register.php">Sign up!</a></small><br>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>
