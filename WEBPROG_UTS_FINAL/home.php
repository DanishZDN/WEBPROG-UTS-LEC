<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
} else {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "admin & nasabah bank";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT 
                SUM(CASE WHEN category = 'pokok' THEN amount ELSE 0 END) AS total_pokok,
                SUM(CASE WHEN category = 'wajib' THEN amount ELSE 0 END) AS total_wajib,
                SUM(CASE WHEN category = 'sukarela' THEN amount ELSE 0 END) AS total_sukarela,
                SUM(amount) AS total_all
            FROM transactions
            WHERE status = 'verified'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_pokok = $row['total_pokok'];
    $total_wajib = $row['total_wajib'];
    $total_sukarela = $row['total_sukarela'];
    $total_all = $row['total_all'];
    $email = $_SESSION['email'];
    $sql = "SELECT username FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row["username"];
    } else {
        $username = "Pengguna";
    }
}
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
            justify-content: center;
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
        
        .product-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .product {
            width: 45%;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .product img {
            width: 100%;
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

        .card {
            background-color: #f2f2f2;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card p {
            margin: 0;
        }

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
        <a href="pembayaran.php">Pembayaran</a>
        <a href="history.php">History</a>
        <a href="profile.php">Profile</a>
        <a href="index.php">Logout</a> 
    </div>

    <div class="container">
        <header class="header">
            <h1>Puskesmas Online - Homepage</h1>
            <p>Selamat datang, <?php echo $username; ?>!</p>
        </header>

        <section class="generic-content">
            <h2>Latest News</h2>
            <div class="news-post">
                <img src="source/news1.jpg" alt="News 1">
                <p>WEBPROGRAMING MID TERMS IS CLOSING IN DON'T FORGET TO SUBMIT YOUR WEBSITE ON E-LEARNING!</p>
            </div><br/>
        </section>
        <br/>

<section class="products">
    <div class="product-row">
        <div class="product">
            <img src="source/product1.jpg" alt="beras">
            <div class="details">
                <div class="name">Beras</div>
                <div class="price">Rp.10.990</div>
                <button onclick="goToShop()">Details</button>
            </div>
        </div>
        <div class="product">
            <img src="source/product2.jpg" alt="ayam">
            <div class="details">
                <div class="name">Ayam</div>
                <div class="price">Rp.45.990</div>
                <button onclick="goToShop()">Details</button>
            </div>
        </div>
    </div>
    <div class="product-row">
        <div class="product">
            <img src="source/product3.jpg" alt="Aqua">
            <div class="details">
                <div class="name">Aqua Galon 19L</div>
                <div class="price">Rp.20.990</div>
                <button onclick="goToShop()">Details</button>
            </div>
        </div>
        <div class="product">
            <img src="source/product4.jpg" alt="Coming Soon">
            <div class="details">
                <div class="name">Check Out the our other product instead!</div>
                <div class="price">Rp. 0</div>
                <button onclick="goToShop()">Details</button>
            </div>
        </div>
    </div>
    
    <div class="card-row">
        <div class="card">
            <h2>Pokok</h2>
            <p class="bold">Rp. <?php echo number_format($total_pokok, 2); ?></p>
        </div>

        <div class="card">
            <h2>Wajib</h2>
            <p class="bold">Rp. <?php echo number_format($total_wajib, 2); ?></p>
        </div>
    </div>

    <div class="card-row">
        <div class="card">
            <h2>Sukarela</h2>
            <p class="bold">Rp. <?php echo number_format($total_sukarela, 2); ?></p>
        </div>

        <div class="card">
            <h2>Total</h2>
            <p class="bold">Rp. <?php echo number_format($total_all, 2); ?></p>
        </div>
    </div>
</section>

    </div>

    <script>
        function goToShop() {
            window.location.href = "shop.php";
        }
    </script>
</body>
</html>
