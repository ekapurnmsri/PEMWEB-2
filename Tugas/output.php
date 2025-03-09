<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Belanja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Hasil Belanja</h2>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $customer = htmlspecialchars($_POST['customer']);
            $produk = $_POST['produk'];
            $jumlah = intval($_POST['jumlah']);

            // Daftar harga produk
            $harga_produk = [
                "TV" => 5200000,
                "KULKAS" => 4700000,
                "MESIN CUCI" => 3500000
            ];

            // Hitung total belanja
            $total_belanja = $harga_produk[$produk] * $jumlah;

            echo "<ul class='list-group'>";
            echo "<li class='list-group-item'><strong>Nama Customer:</strong> $customer</li>";
            echo "<li class='list-group-item'><strong>Produk Pilihan:</strong> $produk</li>";
            echo "<li class='list-group-item'><strong>Jumlah:</strong> $jumlah</li>";
            echo "<li class='list-group-item'><strong>Total Belanja:</strong> Rp " . number_format($total_belanja, 0, ',', '.') . "</li>";
            echo "</ul>";
        } else {
            echo "<div class='alert alert-danger'>Form belum diisi dengan benar!</div>";
        }
        ?>
    </div>
</body>
</html>
