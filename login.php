<?php
include "config.php";
session_start();

if(isset($_SESSION["username"])) {
    header('Location: home.php');
}

if(isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    if($msg == 'invalid') echo '<script>alert("Usuário ou senha incorretos")</script>';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RedeM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 400px;
            width: 90%;
            padding: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #667eea;
            font-size: 32px;
            margin-bottom: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Nunito', sans-serif;
        }
        input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 20px;
        }
        .form-footer {
            text-align: center;
            margin-top: 20px;
            color: #999;
            font-size: 14px;
        }
        .form-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏥 RedeM</h1>
        </div>

        <form action="auth_login.php" method="POST">
            <div class="form-group">
                <label>Usuário ou Email</label>
                <input type="text" name="username" placeholder="seu usuário" required>
            </div>

            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="password" placeholder="sua senha" required>
            </div>

            <button type="submit">Entrar</button>
        </form>

        <div class="form-footer">
            Não tem conta? <a href="index.php">Cadastre-se</a>
        </div>
    </div>
</body>
</html>