<?php
session_start();
require "koneksi.php";

$user = @$_POST['username'];
$pass = @$_POST['password'];
if (isset($_POST['login'])) {
    // Cek login hanya untuk admin
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE username = '$user' AND password = MD5('$pass')");
    if (mysqli_num_rows($sql) > 0) {
        $_SESSION['status'] = "login";
        $_SESSION['username'] = "$user";
        echo "<script>document.location = 'index.php';</script>";
    } else {
        echo "<script>alert('Username atau password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    /* Reset CSS untuk menghindari konflik bawaan browser */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f0f8ff, #87cefa);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-container {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px; /* Maksimal lebar card */
        text-align: center;
    }

    h2 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

    label {
        font-size: 14px;
        color: #555;
        margin-bottom: 5px;
        display: block;
        text-align: left;
    }

    .input-container {
        position: relative;
        margin-bottom: 15px;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%; /* Pastikan lebar input mengikuti kontainer */
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        outline: none;
        border-color: #007BFF;
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #aaa;
    }

    .toggle-password:hover {
        color: #007BFF;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        font-size: 14px;
        color: #555;
        text-align: left;
    }

    button {
        width: 100%; /* Lebar tombol mengikuti kontainer */
        padding: 12px;
        background: #007BFF;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
    }

    button:hover {
        background: #0056b3;
    }

    button:active {
        transform: scale(0.98);
    }

    @media (max-width: 500px) {
        .login-container {
            padding: 20px;
            width: 90%; /* Pastikan card responsif */
        }
    }
</style>

</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Masukkan Username Anda" required>
            
            <label for="password">Password</label>
            <div class="input-container">
                <input type="password" id="password" name="password" placeholder="Masukkan Password Anda" required>
                <span class="toggle-password" onclick="togglePassword()">
                    <i class="fas fa-eye"></i>
                </span>
            </div>
            
            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat Saya</label>
            </div>
            
            <button type="submit" name="login">Login</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
