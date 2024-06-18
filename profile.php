<?php
session_start();
require 'koneksi.php';

// cek apakah pengguna sudah login
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

// ambil username dari sesi
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-card {
            max-width: 350px;
            background: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .profile-header {
            background: #007bff;
            padding: 30px 20px;
            display: flex;
            align-items: center;
        }
        .profile-header img {
            border-radius: 50%;
            margin-right: 20px;
        }
        .profile-header .name {
            color: #ffffff;
            font-size: 1.5em;
            font-weight: bold;
        }
        .profile-body {
            padding: 20px;
            text-align: center;
        }
        .profile-body .title {
            font-size: 1.25em;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .profile-body .description {
            font-size: 1em;
            color: #666;
        }
        .container-center {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .back-button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container-center">
        <div class="profile-card">
            <div class="profile-header">
                <img src="img/profile.png" alt="Profile Image" width="100" height="100">
                <div class="name"><?= htmlspecialchars($username); ?></div>
            </div>
            <div class="profile-body">
                <div class="title">Ini profile Anda</div>
                <a href="index.php" class="btn btn-primary back-button">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>
