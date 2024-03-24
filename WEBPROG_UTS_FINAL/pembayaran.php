<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Nasabah</title>
    <style>
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
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            font-weight: bold;
        }
        select, input[type="date"], input[type="text"], input[type="file"], button[type="submit"] {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
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
        .back-button {
            text-align: center;
            margin-top: 20px;
        }
        .back-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ccc;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Form Pembayaran</h1>
        </header>
        <form action="proses_pembayaran.php" method="post" enctype="multipart/form-data">
            <label for="kategori_simpanan">Kategori Simpanan:</label>
            <select name="kategori_simpanan" id="kategori_simpanan">
                <option value="Wajib">Wajib</option>
                <option value="Sukarela">Sukarela</option>
            </select>
            <label for="tanggal_transfer">Tanggal Transfer:</label>
            <input type="date" name="tanggal_transfer" id="tanggal_transfer" required>
            <label for="jumlah_transfer">Jumlah Transfer:</label>
            <input type="text" name="jumlah_transfer" id="jumlah_transfer" required pattern="^\$?\s?\d{1,3}(?:,?\d{3})*(?:\.\d{2})?$" title="Please enter a valid currency amount" placeholder="Rp 10.000">
            <label for="file_bukti_transfer">File Upload Bukti Transfer:</label>
            <input type="file" name="file_bukti_transfer" id="file_bukti_transfer" required>
            <button type="submit">Kirim Pembayaran</button>
        </form>
        <div class="back-button">
            <a href="home.php">Back to Home</a>
        </div>
    </div>
</body>
</html>
