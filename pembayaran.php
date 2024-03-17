<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Nasabah</title>
</head>
<body>
    <h1>Form Pembayaran</h1>
    <form action="proses_pembayaran.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="kategori_simpanan">Kategori Simpanan:</label>
            <select name="kategori_simpanan" id="kategori_simpanan">
                <option value="Wajib">Wajib</option>
                <option value="Sukarela">Sukarela</option>
            </select>
        </div>
        <div>
            <label for="tanggal_transfer">Tanggal Transfer:</label>
            <input type="date" name="tanggal_transfer" id="tanggal_transfer" required>
        </div>
        <div>
            <label for="jumlah_transfer">Jumlah Transfer:</label>
            <input type="number" name="jumlah_transfer" id="jumlah_transfer" required>
        </div>
        <div>
            <label for="file_bukti_transfer">File Upload Bukti Transfer:</label>
            <input type="file" name="file_bukti_transfer" id="file_bukti_transfer" required>
        </div>
        <div>
            <button type="submit">Kirim Pembayaran</button>
        </div>
    </form>
</body>
</html>
