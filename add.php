<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Upload foto
    $photo_name = basename($_FILES["photo"]["name"]);
    $target = "uploads/" . $photo_name;
    move_uploaded_file($_FILES["photo"]["tmp_name"], $target);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, photo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $pass, $photo_name);
    $stmt->execute();

    header("Location: user.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 15px;
            font-size: 18px;
            color: #333;
        }

        label {
            margin-top: 10px;
            display: block;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            font-size: 14px;
            cursor: pointer;
        }

        .back-link {
            text-align: center;
            margin-top: 10px;
            font-size: 13px;
        }

        .back-link a {
            text-decoration: none;
            color: #007BFF;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambah User</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <label for="photo">Foto</label>
            <input type="file" name="photo" id="photo" required>

            <button type="submit">Simpan</button>
        </form>
        <div class="back-link">
            <a href="user.php">← Kembali</a>
        </div>
    </div>
</body>
</html>
