<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL 
$password = ""; // Ganti dengan password MySQL 
$database = "admin & nasabah bank"; 

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Inisialisasi pesan error
$error = "";

// Proses login
if(isset($_POST['login'])) {
    // Mendapatkan nilai dari form login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Menghindari SQL injection dengan menggunakan prepared statement
    $stmt_user = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt_admin = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
    $stmt_user->bind_param("ss", $email, $password);
    $stmt_admin->bind_param("ss", $email, $password);

    // Menjalankan statement untuk user
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    // Menjalankan statement untuk admin
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    // Memeriksa apakah ada baris yang cocok di tabel user
    if ($result_user->num_rows == 1) {
        // Mendapatkan data user
        $row = $result_user->fetch_assoc();
        
        // Memeriksa apakah user telah diverifikasi
        if ($row['verified'] == 1) {
            // Login berhasil, redirect ke halaman user
            $_SESSION['email'] = $email; // Menyimpan email ke dalam session
            header("Location: home.php"); // Redirect ke halaman user
            exit();
        } else {
            // Akun belum diverifikasi
            $error = "Akun belum diverifikasi.";
        }
    } 
    // Memeriksa apakah ada baris yang cocok di tabel admin
    elseif ($result_admin->num_rows == 1) {
        // Mendapatkan data admin
        $row = $result_admin->fetch_assoc();
        
        // Login berhasil, redirect ke halaman admin
        $_SESSION['email'] = $email; // Menyimpan email ke dalam session
        header("Location: admin-home.php"); // Redirect ke halaman admin
        exit();
    } else {
        // Login gagal
        $error = "Username/email atau password salah.";
    }

    // Menutup statement
    $stmt_user->close();
    $stmt_admin->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Include JavaScript jika diperlukan -->
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
            <small>Belum punya akun? <a href="register.php">Sign up!</a></small><br>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>
