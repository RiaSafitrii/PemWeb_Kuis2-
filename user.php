<?php
include 'koneksi.php';
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pengguna</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f7fa;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .add-user {
            display: inline-block;
            margin-bottom: 20px;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
        }

        .add-user:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f0f2f5;
        }

        img {
            border-radius: 50%;
        }

        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #007BFF;
        }

        .action-links a:hover {
            text-decoration: underline;
        }

        .action-links a.delete {
            color: #dc3545;
        }

        .action-links a.delete:hover {
            color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Pengguna</h2>

        <a class="add-user" href="add.php">+ Tambah User</a>

        <table>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><img src="uploads/<?= htmlspecialchars($row['photo']) ?>" width="50" height="50" alt="Foto"></td>
                <td class="action-links">
                    <a href="edit.php">Edit</a>
                    <a href="delete.php" class="delete" onclick="return confirm('Hapus pengguna ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
