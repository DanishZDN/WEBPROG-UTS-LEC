<?php
$error = "";

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "admin & nasabah bank";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Proses registrasi
if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    $registration_date = date('Y-m-d');
    $verified = 0;

    if(empty($username) || empty($email) || empty($password) || empty($role) || empty($name) || empty($address) || empty($gender) || empty($birthdate)) {
        $error = "Semua field harus diisi.";
    } elseif($_POST['password'] != $_POST['confirm_password']) {
        $error = "Password dan konfirmasi password tidak sesuai.";
    } else {
        // Check if username or email already exists
        $check_sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $check_result = mysqli_query($conn, $check_sql);
        if(mysqli_num_rows($check_result) > 0) {
            $error = "ERROR: Username or email already exists.";
        } else {
            // Insert data into database
            $sql = "INSERT INTO users (username, email, password, role, name, address, gender, birthdate, registration_date, verified) VALUES ('$username', '$email', '$password', '$role', '$name', '$address', '$gender', '$birthdate', '$registration_date', '$verified')";

            if (mysqli_query($conn, $sql)) {
                $success_msg = "Registrasi berhasil. Silakan tunggu verifikasi dari admin.";
            } else {
                $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <!-- Include CSS kalo perlu -->
    <link rel="stylesheet" href="style.css">
    <!-- Include JavaScript kalo perlu -->
    <script src="script.js"></script>
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: lightblue;">
    <div class="text-center">
        <h2>Registrasi</h2>
        <?php if(isset($error) && $error != "") { ?>
            <div style="color: red;"><?php echo $error; ?></div>
        <?php } ?>
        <?php if(isset($success_msg) && $success_msg != "") { ?>
            <?php if(isset($error) && $error != "") { ?>
                <div style="color: red;"><?php echo $error; ?></div>
            <?php } else { ?>
                <div style="color: green;"><?php echo $success_msg; ?></div>
            <?php } ?>
        <?php } ?>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Username" required><br></br>
            <input type="email" name="email" placeholder="Email" required><br></br>
            <input type="password" name="password" placeholder="Password" required><br></br>
            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required><br></br>
            <input type="text" name="role" placeholder="Kerjaan" required><br></br>
            <input type="text" name="name" placeholder="Nama" required><br></br>
            <input type="text" name="address" placeholder="Alamat" required><br></br>
            <select name="gender">
                <option value="male">Laki-laki</option>
                <option value="female">Perempuan</option>
            </select><br></br>
            <input type="date" name="birthdate" required><br></br>
            <button type="submit" name="register" value="index.php">Register</button>
        </form>
    </div>
</body>
</html>
