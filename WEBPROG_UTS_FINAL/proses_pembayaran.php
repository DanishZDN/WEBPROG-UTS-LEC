<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kategori_simpanan = $_POST['kategori_simpanan'];
    $tanggal_transfer = $_POST['tanggal_transfer'];
    $jumlah_transfer = $_POST['jumlah_transfer'];

    $file_name = $_FILES['file_bukti_transfer']['name'];
    $file_tmp = $_FILES['file_bukti_transfer']['tmp_name'];
    $file_error = $_FILES['file_bukti_transfer']['error'];

    if ($file_error === 0) {
        $upload_dir = "bayar/";

        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            $user_id = $_SESSION['user_id'];

            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "admin & nasabah bank";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $stmt = $conn->prepare("INSERT INTO transactions (user_id, category, transaction_date, amount, proof_path, status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $user_id, $kategori_simpanan, $tanggal_transfer, $jumlah_transfer, $file_name, $status);

            $status = 'pending';

            if ($stmt->execute()) {
                echo "Pembayaran berhasil dikirim.";
                header("Location: home.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "File upload error.";
        }
    } else {
        echo "Error uploading file.";
    }
}
?>
