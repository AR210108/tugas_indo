<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$file = 'data_siswa.json';
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}
$siswa = json_decode(file_get_contents($file), true);

$showSuccess = false;
if (isset($_SESSION['success'])) {
    $showSuccess = true;
    unset($_SESSION['success']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Siswa - Windows 11</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #f5f7fa);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #ffffffcc;
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            width: 500px;
            text-align: center;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }
        h2 { margin-bottom: 10px; color: #1e1e1e; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #0078d7; color: white; }
        tr:nth-child(even) { background: #f3f3f3; }
        .back { display: inline-block; margin-top: 10px; text-decoration: none; color: #0078d7; font-weight: bold; }
        .logout {
            display: inline-block;
            margin-top: 12px;
            color: white;
            background: #d32f2f;
            padding: 8px 12px;
            border-radius: 8px;
            text-decoration: none;
        }
        .logout:hover { background: #9a0007; }
        .success-popup {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0,0,0,0.4);
            animation: fadeIn 0.3s ease-in-out;
        }
        .success-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            animation: scaleUp 0.3s ease-in-out;
        }
        .checkmark {
            font-size: 50px;
            color: #28a745;
            animation: pop 0.4s ease;
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes scaleUp { from { transform: scale(0.8); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        @keyframes pop { 0% { transform: scale(0); } 70% { transform: scale(1.2); } 100% { transform: scale(1); } }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Siswa</h2>

        <?php if (!empty($siswa)): ?>
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                </tr>
                <?php foreach ($siswa as $index => $s): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($s['nama']) ?></td>
                    <td><?= htmlspecialchars($s['jurusan']) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Belum ada data siswa.</p>
        <?php endif; ?>

        <a href="dashboard.php" class="back">← Kembali ke Dashboard</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <?php if ($showSuccess): ?>
    <div class="success-popup" id="popup">
        <div class="success-box">
            <div class="checkmark">✔</div>
            <p>Data berhasil ditambahkan!</p>
        </div>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById('popup').style.display = 'none';
        }, 1500);
    </script>
    <?php endif; ?>
</body>
</html>
