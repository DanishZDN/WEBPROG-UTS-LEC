<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$dsn = "mysql:host=localhost;dbname=admin & nasabah bank";
$kunci = new PDO($dsn, "root", "");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        // Delete data from database
        $sql = "DELETE FROM users WHERE email = ?";
        $stmt = $kunci->prepare($sql);
        $stmt->execute([$_SESSION['email']]);
        
        // Destroy session
        session_unset();
        session_destroy();
        
        // Redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        // Form Data
        $newUsername = $_POST['new_username'];
        $newName = $_POST['new_name']; // Added new name field
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Find user's ID
        $sql = "SELECT user_id FROM users WHERE email = ?";
        $stmt = $kunci->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_id = $row['user_id'];

        // File Upload
        if (!empty($_FILES['profile_pic']['name'])) {
            $filename = $_FILES['profile_pic']['name'];
            $temp_file = $_FILES['profile_pic']['tmp_name'];
            $file_type = $_FILES['profile_pic']['type'];

            $allowed_types = array('image/jpeg', 'image/png', 'image/gif');

            if (in_array($file_type, $allowed_types)) {
                // Move uploaded file to folder
                $upload_dir = "uploads/";
                if (move_uploaded_file($temp_file, $upload_dir . $filename)) {
                    echo "File uploaded successfully.";
                    // Update data in database
                    $sql = "UPDATE users SET username = ?, name = ?, password = ?, photo_path = ? WHERE user_id = ?";
                    $stmt = $kunci->prepare($sql);
                    $stmt->execute([$newUsername, $newName, $password, $upload_dir . $filename, $user_id]);
                    // Redirect to prevent resubmission
                    header("Location: home.php");
                    exit();
                } else {
                    echo "Error uploading file. Please try again.";
                }
            } else {
                echo "Only image files (JPEG, PNG, GIF) are allowed.";
            }
        } else {
            // Update data in database without changing the photo
            $sql = "UPDATE users SET username = ?, name = ?, password = ? WHERE user_id = ?";
            $stmt = $kunci->prepare($sql);
            $stmt->execute([$newUsername, $newName, $password, $user_id]);
            // Redirect to prevent resubmission
            header("Location: home.php");
            exit();
        }
    }
}

// Ambil informasi pengguna dari database
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $kunci->prepare($sql);
$stmt->execute([$email]);

if ($stmt->rowCount() > 0) {
    // Ambil data pengguna
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $username = $row["username"];
    $name = $row["name"]; // Added name field
    $email = $row["email"];
    $password = $row["password"];
    // Anda dapat mengambil informasi lainnya dari kolom yang sesuai di tabel users
} else {
    // Jika pengguna tidak ditemukan, beri pesan kesalahan
    $error = "Informasi pengguna tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Puskesmas Online</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
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
        /* Form Styles */
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="file"] {
            margin-bottom: 20px;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        /* Error Styles */
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <?php if (!empty($row['photo_path'])) { ?>
                <img src="<?php echo $row['photo_path']; ?>" alt="Profile Picture" style="width: 150px; height: 150px; border-radius: 50%;">
            <?php } ?>
            <h1>Profile - <?php echo $username; ?></h1>
        </header>
        <?php if(isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <form method="POST" enctype="multipart/form-data">
            <label for="new_username">New Username:</label>
            <input type="text" id="new_username" name="new_username" value="<?php echo $username; ?>" required>
            <label for="new_name">New Name:</label> <!-- Added new name field -->
            <input type="text" id="new_name" name="new_name" value="<?php echo $name; ?>" required> <!-- Added new name field -->
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $password; ?>" required>
            <label for="profile_pic">Upload Profile Picture:</label>
            <input type="file" id="profile_pic" name="profile_pic">
            <button type="submit">Save Changes</button>
        </form><br> </br>
        <form action="home.php" method="GET">
            <button type="submit">Back to Home</button>
        </form><br> </br>
        <form action="profile.php" method="POST">
            <input type="submit" name="delete" value="Delete Account" onclick="return confirm('Are you sure you want to delete your account?');" action="index.php">
        </form>
    </div>
</body>
</html>
