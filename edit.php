<?php
include 'koneksi.php';
$id = $_GET['id'];
$user = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $photo_name = $user['photo'];
    if ($_FILES['photo']['name']) {
        $photo_name = basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $photo_name);
    }

    $sql = "UPDATE users SET name=?, email=?, photo=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $photo_name, $id);
    $stmt->execute();

    header("Location: user.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #fff;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        img {
            display: block;
            margin-top: 10px;
            width: 60px;
            border-radius: 50%;
        }

        button {
            width: 100%;
            background-color: #ffc107;
            color: black;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            margin-top: 20px;
            cursor: pointer;
        }

        button:hover {
            background-color: #e0a800;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            color: #007BFF;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Data User</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['name']) ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>

            <label for="photo">Foto (biarkan kosong jika tidak diganti)</label>
            <input type="file" name="photo" id="photo">
            <img src="uploads/<?= htmlspecialchars($user['photo']) ?>" alt="Foto User">

            <button type="submit">Update</button>
        </form>
        <div class="back-link">
            <a href="user.php">← Kembali ke daftar user</a>
        </div>
    </div>
</body>
</html>
