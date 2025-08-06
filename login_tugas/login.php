<?php
session_start();

// Cek jika sudah login
if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}

$username = "admin";
$password = "1234";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['username'] === $username && $_POST['password'] === $password) {
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Windows 11</title>
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
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            width: 320px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #1e1e1e;
        }
        input, button {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 14px;
        }
        input:focus {
            outline: 2px solid #0078d7;
            border: none;
        }
        button {
            background: #0078d7;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
        }
        button:hover {
            background: #005a9e;
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
