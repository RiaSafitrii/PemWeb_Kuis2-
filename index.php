<?php
session_start();
include '';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengguna</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        img {
            border-radius: 50%;
            margin-top: 15px;
        }
        h2 {
            color: #333;
        }
        p {
            color: #555;
        }
        a {
            display: inline-block;
            margin: 10px;
            text-decoration: none;
            color: #fff;
            background: #007BFF;
            padding: 10px 20px;
            border-radius: 6px;
            transition: background 0.3s ease;
        }
        a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Selamat datang, <?= htmlspecialchars($user['name']) ?>!</h2>
        <p>Email: <?= htmlspecialchars($user['email']) ?></p>
        <img src="uploads/<?= htmlspecialchars($user['photo']) ?>" width="100" alt="Foto Profil"><br><br>

        <a href="user.php">Manajemen User</a>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
