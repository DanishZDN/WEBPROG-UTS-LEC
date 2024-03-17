<?php
session_start();

// Periksa apakah pengguna telah login, jika tidak, arahkan kembali ke halaman login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

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

// Ambil username pengguna dari database
$email = $_SESSION['email'];
$sql = "SELECT username FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Ambil data username pengguna
    $row = $result->fetch_assoc();
    $username = $row["username"];
} else {
    $username = "Pengguna";
}

// Menutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puskesmas Online - Homepage</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            color: #333;
        }
        /* Navigation Styles */
        .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex;
            justify-content: center; /* Center the navbar horizontally */
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
       /* Product Styles */
.product-row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around; /* Distribute items with equal space around them */
    margin-bottom: 20px;
}

.product {
    width: 45%; /* Adjust width as per requirement */
    margin-bottom: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    overflow: hidden;
}

.product img {
    width: 100%; /* Ensure image fills the container */
    height: auto;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.details {
    padding: 20px;
}

.name {
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 10px;
}

.price {
    font-size: 16px;
    color: #888;
}

button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 10px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #45a049;
}

        /* Footer Styles */
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="shop.php">Shop</a>
        <a href="pemnayran.php">Pembayaran</a>
        <a href="history.php">History</a>
        <a href="profile.php">Profile</a>
        <a href="index.php">Logout</a> 
    </div>

    <div class="container">
        <header class="header">
            <h1>Puskesmas Online - Homepage</h1>
            <p>Selamat datang, <?php echo $username; ?>!</p>
        </header>

        <!-- Konten Generic -->
        <section class="generic-content">
            <h2>Latest News</h2>
            <div class="news-post">
                <img src="news1.jpg" alt="News 1">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="news-post">
                <img src="news2.jpg" alt="News 2">
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
        </section>

       <!-- Produk -->
<section class="products">
    <div class="product-row">
        <!-- Produk 1 -->
        <div class="product">
            <img src="product1.jpg" alt="Product 1">
            <div class="details">
                <div class="name">Product 1</div>
                <div class="price">$10.99</div>
                <button onclick="goToShop()">Details</button>
            </div>
        </div>
        <!-- Produk 2 -->
        <div class="product">
            <img src="product2.jpg" alt="Product 2">
            <div class="details">
                <div class="name">Product 2</div>
                <div class="price">$15.99</div>
                <button onclick="goToShop()">Details</button>
            </div>
        </div>
    </div>
    <div class="product-row">
        <!-- Produk 3 -->
        <div class="product">
            <img src="product3.jpg" alt="Product 3">
            <div class="details">
                <div class="name">Product 3</div>
                <div class="price">$8.99</div>
                <button onclick="goToShop()">Details</button>
            </div>
        </div>
        <!-- Produk 4 -->
        <div class="product">
            <img src="product4.jpg" alt="Product 4">
            <div class="details">
                <div class="name">Product 4</div>
                <div class="price">$12.99</div>
                <button onclick="goToShop()">Details</button>
            </div>
        </div>
    </div>
</section>

    </div>

    <!-- Footer -->
    <footer>
        &copy; 2024 Puskesmas Online - All Rights Reserved
    </footer>

    <!-- Script untuk redirect ke halaman shop -->
    <script>
        function goToShop() {
            window.location.href = "shop.php";
        }
    </script>
</body>
</html>
