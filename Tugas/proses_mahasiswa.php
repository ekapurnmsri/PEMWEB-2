<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $panjang = isset($_POST["panjang"]) ? floatval($_POST["panjang"]) : 0;
    $lebar = isset($_POST["lebar"]) ? floatval($_POST["lebar"]) : 0;
    $tinggi = isset($_POST["tinggi"]) ? floatval($_POST["tinggi"]) : 0;
    
    $volume = $panjang * $lebar * $tinggi;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hitung Volume Balok</title>
    <style>
        .container {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .scene {
            width: 300px;
            height: 300px;
            perspective: 800px;
            margin: auto;
        }
        .balok {
            width: <?php echo isset($panjang) ? $panjang * 10 : 100; ?>px;
            height: <?php echo isset($tinggi) ? $tinggi * 10 : 100; ?>px;
            position: relative;
            transform-style: preserve-3d;
            transform: rotateX(45deg) rotateY(45deg);
            margin: auto;
        }
        .balok div {
            position: absolute;
            background: rgba(255, 165, 0, 0.8);
            border: 2px solid #000;
        }
        .balok .top {
            width: <?php echo isset($panjang) ? $panjang * 10 : 100; ?>px;
            height: <?php echo isset($lebar) ? $lebar * 10 : 100; ?>px;
            transform: rotateX(90deg) translateZ(<?php echo isset($tinggi) ? $tinggi * 5 : 50; ?>px);
        }
        .balok .front {
            width: <?php echo isset($panjang) ? $panjang * 10 : 100; ?>px;
            height: <?php echo isset($tinggi) ? $tinggi * 10 : 100; ?>px;
            transform: translateZ(<?php echo isset($lebar) ? $lebar * 5 : 50; ?>px);
        }
        .balok .side {
            width: <?php echo isset($lebar) ? $lebar * 10 : 100; ?>px;
            height: <?php echo isset($tinggi) ? $tinggi * 10 : 100; ?>px;
            transform: rotateY(90deg) translateZ(<?php echo isset($panjang) ? $panjang * 5 : 50; ?>px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulir Perhitungan Volume Balok</h2>
        <form method="post">
            <label for="panjang">Panjang:</label>
            <input type="number" name="panjang" required><br>
            
            <label for="lebar">Lebar:</label>
            <input type="number" name="lebar" required><br>
            
            <label for="tinggi">Tinggi:</label>
            <input type="number" name="tinggi" required><br>
            
            <input type="submit" value="Hitung">
        </form>
        
        <?php if (isset($volume)): ?>
            <h3>Hasil Perhitungan:</h3>
            <p>Volume Balok: <?php echo $volume; ?> satuan kubik</p>
            <div class="scene">
                <div class="balok">
                    <div class="top"></div>
                    <div class="front"></div>
                    <div class="side"></div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
