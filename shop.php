<!DOCTYPE html>
<html>
<head>
    <title>Puskesmas Online - SHOP</title>
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
            position: relative;
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
        float: none; /* Remove the float property */
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
        .product {
            display: flex;
            align-items: center;
            justify-content: space-between; /* Align items to start and end */
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
            background-color: #4CAF50; /* Green */
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

        /* Proceed to Payment Button */
        .payment-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
        }
        .payment-button button {
            background-color: #4CAF50; /* Green */
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
            <!-- Add your PHP code here to fetch and display the products -->
            <?php
                // Example code to fetch and display products
                $products = [
                    [
                        'name' => 'Product 1',
                        'image' => 'product1.jpg',
                        'price' => '$10.99'
                    ],
                    [
                        'name' => 'Product 2',
                        'image' => 'product2.jpg',
                        'price' => '$15.99'
                    ],
                    [
                        'name' => 'Product 3',
                        'image' => 'product3.jpg',
                        'price' => '$8.99'
                    ]
                ];

                foreach ($products as $product) {
                    echo '<div class="product">';
                    echo '<img src="images/' . $product['image'] . '" alt="' . $product['name'] . '">';
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

    <!-- Payment Button -->
    <div class="payment-button">
        <button onclick="goToPayment()">Proceed to Payment</button>
    </div>

    <script>
        function goToPayment() {
            // Redirect to payment.php
            window.location.href = "pembayaran.php";
        }
        
        function addToCart(name, price) {
            // Get existing cart items from session storage or initialize an empty array
            var cartItems = JSON.parse(sessionStorage.getItem('cart')) || [];

            // Add the selected item to the cart
            var newItem = { name: name, price: price };
            cartItems.push(newItem);

            // Save the updated cart items back to session storage
            sessionStorage.setItem('cart', JSON.stringify(cartItems));

            // Alert the user that the item has been added to the cart (You can customize this part)
            alert('Added ' + name + ' to cart!');
        }
    </script>
</body>
</html>
