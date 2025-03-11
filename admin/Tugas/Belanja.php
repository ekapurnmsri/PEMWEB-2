<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Belanja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Belanja Online</h2>
        <form action="output.php" method="post">
            <div class="form-group">
                <label for="customer">Customer:</label>
                <input type="text" class="form-control" id="customer" name="customer" required>
            </div>

            <div class="form-group">
                <label>Pilih Produk:</label><br>
                <input type="radio" name="produk" value="TV" required> TV<br>
                <input type="radio" name="produk" value="KULKAS"> KULKAS<br>
                <input type="radio" name="produk" value="MESIN CUCI"> MESIN CUCI
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah:</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>

            <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>
</body>
</html>
