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
    // Menghindari SQL injection dengan menggunakan prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);

    // Mendapatkan nilai dari form login
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Menjalankan statement
    $stmt->execute();

    // Mendapatkan hasil query
    $result = $stmt->get_result();

    // Memeriksa apakah ada baris yang cocok
    if ($result->num_rows == 1) {
        // Login berhasil, redirect sesuai peran (admin/nasabah)
        $_SESSION['email'] = $email; // Menyimpan email ke dalam session
        header("Location: home.php"); // Ganti dengan halaman yang sesuai
        exit();
    } else {
        // Login gagal
        $error = "Username/email atau password salah.";
    }

    // Menutup statement
    $stmt->close();
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
    <div class="text-center"> <!-- Added text-center class to center the content -->
        <h2>Login</h2> <!-- Removed the class "text-center" from the h2 element -->
        <?php if(isset($error) && $error != "") { ?>
            <div style="color: red;"><?php echo $error; ?></div>
        <?php } ?>
        <form method="post">
            <input type="text" name="email" placeholder="Email" required ><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <small>Belum punya akun? <a href="register.php">Sign up!</a></small><br> <!-- Added the "belum punya akun? Sign up!" text with a link to register.php -->
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>
