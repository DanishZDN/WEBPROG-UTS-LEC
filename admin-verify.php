<?php
session_start();

// Check if the user is logged in and is an admin, otherwise redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
} else {
    $email = $_SESSION['email'];
    $servername = "localhost";
    $username = "root"; // Change to your MySQL username
    $password = ""; // Change to your MySQL password
    $database = "admin & nasabah bank";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL statement to fetch user role
    $stmt = $conn->prepare("SELECT role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($role);
    $stmt->fetch();
    $stmt->close();

}

// Process verification
if(isset($_POST['verify'])) {
    $user_id = $_POST['user_id'];
    $verified = $_POST['verified'];

    // Update user's verification status
    $stmt = $conn->prepare("UPDATE users SET verified = ? WHERE user_id = ?");
    $stmt->bind_param("ii", $verified, $user_id);
    $stmt->execute();
    $stmt->close();
}

// Process delete
if(isset($_POST['delete'])) {
    $user_id = $_POST['user_id'];

    // Delete user's request
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Verification</title>
    <!-- Include CSS -->
    <style>
        /* CSS Styles from the provided code */
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
        /* Table Styles */
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
        /* Button Styles */
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
        .button-delete {
            background-color: #f44336;
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
        <a href="admin-userlist.php">Userlist</a>
        <a href="admin-history.php">History</a>
        <a href="profile.php">Profile</a>
        <a href="admin-verify.php">Verify</a>
        <a href="index.php">Logout</a> 
    </div>

    <div class="container">
        <header class="header">
            <h1>Admin Verification</h1>
        </header>

        <!-- Table for unverified users -->
        <?php
        // Fetch unverified users
        $sql = "SELECT * FROM users WHERE verified = 0";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>
            <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
            </tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>
                    <form method='post'>
                        <input type='hidden' name='user_id' value='" . $row['user_id'] . "'>
                        <input type='hidden' name='verified' value='1'>
                        <button class='button' type='submit' name='verify'>Verify</button>
                    </form>
                </td>";
                echo "<td>
                    <form method='post' onsubmit='return confirm(\"Are you sure you want to delete this request?\")'>
                        <input type='hidden' name='user_id' value='" . $row['user_id'] . "'>
                        <button class='button button-delete' type='submit' name='delete'>Delete</button>
                    </form>
                </td>";
                echo "</tr>";
            }
            echo "</table>";
            } else {
                echo "No unverified users found.";
            }

        // Close database connection
        $conn->close();
        ?>

        <br>
        <a href="home.php">Back to Home</a>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2024 Puskesmas Online - All Rights Reserved
    </footer>
</body>
</html>
