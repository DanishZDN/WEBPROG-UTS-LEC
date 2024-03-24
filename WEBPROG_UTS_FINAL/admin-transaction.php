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

    $sql = "SELECT * FROM transactions WHERE status='pending'";
    $result = $conn->query($sql);
}

if(isset($_POST['verify'])) {
    $transaction_id = $_POST['transaction_id'];

    $stmt = $conn->prepare("UPDATE transactions SET status='verified' WHERE transaction_id = ?");
    $stmt->bind_param("i", $transaction_id);
    $stmt->execute();
    $stmt->close();
}

if(isset($_POST['reject'])) {
    $transaction_id = $_POST['transaction_id'];

    $stmt = $conn->prepare("UPDATE transactions SET status='rejected' WHERE transaction_id = ?");
    $stmt->bind_param("i", $transaction_id);
    $stmt->execute();
    $stmt->close();
}

if(isset($_POST['delete'])) {
    $transaction_id = $_POST['transaction_id'];

    $stmt = $conn->prepare("DELETE FROM transactions WHERE transaction_id = ?");
    $stmt->bind_param("i", $transaction_id);
    $stmt->execute();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Transaction Verification</title>
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
        }
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .button:hover {
            background-color: #45a049;
        }
        .button-delete {
            background-color: #ff0000;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .button-delete:hover {
            background-color: #cc0000;
        }
        .button-reject {
            background-color: #808080;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .button-reject:hover {
            background-color: #666666;
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
        td.amount {
            width: 20%;
        }
        td.actions {
            text-align: right;
        }
        .actions-form {
            display: flex;
            justify-content: flex-end;
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
        <a href="admin-home.php">Home</a>
        <a href="admin-userlist.php">Userlist</a>
        <a href="admin-history.php">History</a>
        <a href="admin-transaction.php">Transactions</a>
        <a href="admin-verify.php">Verify</a>
        <a href="index.php">Logout</a> 
    </div>

    <div class="container">
        <header class="header">
            <h1>Admin Transaction Verification</h1>
        </header>

        <?php
        if ($result->num_rows > 0) {
            echo "<table>
            <tr>
            <th>Transaction ID</th>
            <th>User ID</th>
            <th class='amount'>Amount</th>
            <th class='actions-form actions'>Action‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ </th>
            </tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['transaction_id'] . "</td>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td class='amount'>Rp. " . number_format($row['amount'], 2) . "</td>";
                echo "<td class='actions'>
                <form class='actions-form' method='post'>
                <input type='hidden' name='transaction_id' value='" . $row['transaction_id'] . "'>
                <button class='button' type='submit' name='verify'>Verify</button>
                <button class='button-reject' type='submit' name='reject'>Reject</button>
                <button class='button-delete' type='submit' name='delete'>Delete</button>
                </form>
                </td>";
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
