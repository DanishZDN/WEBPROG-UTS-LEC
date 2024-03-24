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
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['email'] = $email;
        header("Location: home.php");
        exit();
    } else {
        $error = "Username/email atau password salah.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
<div style="width: 100%; height: 100%; position: relative">
<div style="width: 100%; height: 100%; padding-top: 190px; padding-bottom: 190.55px; padding-left: 471px; padding-right: 472px; background: #7DC8B6; justify-content: center; align-items: center; display: inline-flex">
    <div style="width: 497px; height: 643.45px; position: relative">
        <div style="width: 497px; height: 643.45px; left: 0px; top: 0px; position: absolute; background: white; border-radius: 95px"></div>
        <div style="width: 320.89px; height: 66.62px; left: 110.89px; top: 98.31px; position: absolute; color: black; font-size: 30px; font-family: Staatliches; font-weight: 400; line-height: 20px; letter-spacing: 0.25px; word-wrap: break-word">PUSKESMAS ONLINE</div>
        <div style="width: 319.67px; height: 59.03px; left: 94.11px; top: 134.93px; position: absolute; background: #57D572; border-radius: 101px"></div>
        <div style="left: 140px; top: 154px; position: absolute; color: black; font-size: 24px; font-family: Staatliches; font-weight: 400; line-height: 20px; letter-spacing: 0.25px; word-wrap: break-word">Create an account today!</div>
        <div style="width: 319.67px; height: 59.03px; left: 94.11px; top: 209.99px; position: absolute; background: #BEBEBE; border-radius: 101px"></div>
        <div style="width: 227.11px; height: 60.72px; left: 135.33px; top: 532px; position: absolute; background: #45A5EB; border-radius: 101px; border: 1px rgba(0, 0, 0, 0) solid"></div>
        <div style="left: 193px; top: 551.95px; position: absolute; color: white; font-size: 36px; font-family: Staatliches; font-weight: 400; line-height: 20px; letter-spacing: 0.25px; word-wrap: break-word">LOGIN</div>
        <div style="width: 165.67px; height: 0px; left: 57.56px; top: 299.38px; position: absolute; border: 1px black solid"></div>
        <div style="width: 164.89px; height: 0px; left: 285.44px; top: 299.38px; position: absolute; border: 1px black solid"></div>
        <div style="width: 392.78px; height: 66.62px; left: 57.56px; top: 334.80px; position: absolute; background: rgba(217, 217, 217, 0); border: 1px black solid"></div>
        <div style="width: 392.78px; height: 66.62px; left: 57.56px; top: 411.54px; position: absolute; background: rgba(217, 217, 217, 0); border: 1px black solid"></div>
        <?php if(isset($error) && $error != "") { ?>
            <div style="color: red;"><?php echo $error; ?></div>
        <?php } ?>
        <form method="post">
            <input type="text" name="email" placeholder="Email" required ><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <small>Belum punya akun? <a href="register.php">Sign up!</a></small><br> 
            <div style="width: 70px; height: 14px; left: 224px; top: 351px; position: absolute; color: rgba(119.41, 119.41, 119.41, 0.20); font-size: 25px; font-family: Staatliches; font-weight: 400; line-height: 20px; letter-spacing: 0.25px; word-wrap: break-word">Email </div>
            <div style="width: 143px; height: 13px; left: 208px; top: 437px; position: absolute; color: rgba(119.41, 119.41, 119.41, 0.20); font-size: 25px; font-family: Staatliches; font-weight: 400; line-height: 20px; letter-spacing: 0.25px; word-wrap: break-word">Password</div>
            <button type="submit" name="login">Login</button>
        </form>
        <div style="width: 157px; height: 19px; left: 47px; top: 478px; position: absolute"><span style="color: black; font-size: 15px; font-family: Staatliches; font-weight: 400; line-height: 20px; letter-spacing: 0.25px; word-wrap: break-word">forgot your </span><span style="color: #2155DA; font-size: 15px; font-family: Staatliches; font-weight: 400; line-height: 20px; letter-spacing: 0.25px; word-wrap: break-word">password?</span></div>
        <div style="left: 161px; top: 230px; position: absolute; color: white; font-size: 24px; font-family: Staatliches; font-weight: 400; line-height: 20px; letter-spacing: 0.25px; word-wrap: break-word">... more coming soon!</div>
        <img style="width: 86px; height: 78px; left: 209px; top: 10px; position: absolute; border-radius: 174px" src="https://via.placeholder.com/86x78" />
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>