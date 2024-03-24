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

    $sql = "SELECT * FROM transactions";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Transaction History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            flex: 1;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .status-verified {
            color: green;
        }
        .status-rejected {
            color: red;
        }
        .status-pending {
            color: orange;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="admin-home.php">Home</a>
        <a href="admin-userlist.php">Userlist</a>
        <a href="admin-history.php">History</a>
        <a href="admin-transaction.php">Transactions</a>
        <a href="admin-verify.php">Verify</a>
        <a href="index.php">Logout</a> 
    </div>

    <div class="container">
        <header class="header">
            <h1>Admin Transaction History</h1>
        </header>

        <?php
        if ($result->num_rows > 0) {
            echo "<table>
            <tr>
            <th>Transaction ID</th>
            <th>User ID</th>
            <th>Amount</th>
            <th>Transaction Date</th>
            <th>Category</th>
            <th>Status</th>
            </tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['transaction_id'] . "</td>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>Rp. " . number_format($row['amount'], 2) . "</td>";
                echo "<td>" . $row['transaction_date'] . "</td>";
                echo "<td>" . $row['category'] . "</td>";
                echo "<td class='status-" . strtolower($row['status']) . "'>" . $row['status'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No transactions found.";
        }

        $conn->close();
        ?>

        <br>
        <a href="admin-home.php">Back to Home</a>
    </div>

</body>
</html>
