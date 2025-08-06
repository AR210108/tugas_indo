<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$file = 'data_siswa.json';

// Baca data siswa dari file
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}
$siswa = json_decode(file_get_contents($file), true);

// Tambah siswa baru
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nama']) && isset($_POST['jurusan'])) {
    $siswa[] = [
        'nama' => $_POST['nama'],
        'jurusan' => $_POST['jurusan']
    ];

    // Simpan ke file JSON
    file_put_contents($file, json_encode($siswa));

    // Set notifikasi sukses
    $_SESSION['success'] = true;

    // Redirect ke siswa.php
    header("Location: siswa.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Windows 11</title>
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
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            width: 400px;
            text-align: center;
        }
        h2 { margin-bottom: 15px; color: #1e1e1e; }
        input, button {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 14px;
        }
        input:focus { outline: 2px solid #0078d7; border: none; }
        button {
            background: #0078d7;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
        }
        button:hover { background: #005a9e; }
        .link { display: block; margin-top: 10px; text-decoration: none; color: #0078d7; font-weight: bold; }
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Siswa</h2>

        <form method="post">
            <input type="text" name="nama" placeholder="Nama Siswa" required>
            <input type="text" name="jurusan" placeholder="Jurusan" required>
            <button type="submit">Tambah</button>
        </form>

        <a href="siswa.php" class="link">Lihat Daftar Siswa</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
