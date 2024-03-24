<!DOCTYPE html>
<html>
<head>
    <title>Puskesmas Online - SHOP</title>
    <style>
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
            position: relative;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            color: #333;
        }
    .navbar {
        background-color: #333;
        overflow: hidden;
        display: flex;
        justify-content: center;
    }
    .navbar a {
        float: none;
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
        .product {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .product:hover {
            transform: translateY(-5px);
        }
        .product img {
            width: 100px;
            height: 100px;
            margin-right: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .product .details {
            flex-grow: 1;
        }
        .product .name {
            font-weight: bold;
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
        }
        .product .price {
            font-size: 16px;
            color: #888;
        }
        .product button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 8px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-left: 10px;
            cursor: pointer;
        }
        .product button:hover {
            background-color: #45a049;
        }
        .payment-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }
        .payment-button button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
        }
        .payment-button button:hover {
            background-color: #45a049;
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
            <h1>Puskesmas Online - SHOP</h1>
        </header>
        <section class="products">
            <?php
                $products = [
                    [
                        'name' => 'Beras',
                        'image' => 'product1.jpg',
                        'price' => 'Rp.10.990'
                    ],
                    [
                        'name' => 'Ayam',
                        'image' => 'product2.jpg',
                        'price' => 'Rp.45.990'
                    ],
                    [
                        'name' => 'Aqua Galon 19L',
                        'image' => 'product3.jpg',
                        'price' => 'Rp.20.990'
                    ]
                ];

                foreach ($products as $product) {
                    echo '<div class="product">';
                    echo '<img src="source/' . $product['image'] . '" alt="' . $product['name'] . '">';
                    echo '<div class="details">';
                    echo '<div class="name">' . $product['name'] . '</div>';
                    echo '<div class="price">' . $product['price'] . '</div>';
                    echo '</div>';
                    echo '<button onclick="addToCart(\'' . $product['name'] . '\', \'' . $product['price'] . '\')">Add to Cart</button>';
                    echo '</div>';
                }
            ?>
        </section>
    </div>

    <div class="payment-button">
        <button onclick="goToPayment()">Request pembayaran</button>
    </div>

    <script>
        function goToPayment() {
            window.location.href = "pembayaran.php";
        }
        
        function addToCart(name, price) {
            var cartItems = JSON.parse(sessionStorage.getItem('cart')) || [];
            var newItem = { name: name, price: price };
            cartItems.push(newItem);
            sessionStorage.setItem('cart', JSON.stringify(cartItems));
            alert('Feature is coming soon!, ' + name + ' will not be added to cart!');
        }
    </script>
</body>
</html>