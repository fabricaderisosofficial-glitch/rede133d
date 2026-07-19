<?php
include "config.php";
session_start();

if(isset($_SESSION["username"])) {
    header('Location: home.php');
}

if(isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    if($msg == 'user_exists') echo '<script>alert("Usuário já existe")</script>';
    if($msg == 'success') echo '<script>alert("Cadastro realizado com sucesso")</script>';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RedeM - Plataforma de Saúde</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
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
            max-width: 500px;
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
            margin-bottom: 10px;
        }
        .header p {
            color: #999;
            font-size: 14px;
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
        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Nunito', sans-serif;
            transition: border-color 0.3s;
        }
        input:focus, select:focus {
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
            transition: transform 0.2s;
        }
        button:hover {
            transform: translateY(-2px);
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
        .form-footer a:hover {
            text-decoration: underline;
        }
        .user-type-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 15px;
        }
        .user-type-grid label {
            display: flex;
            align-items: center;
            margin: 0;
            cursor: pointer;
        }
        .user-type-grid input[type="radio"] {
            width: auto;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏥 RedeM</h1>
            <p>Sua Plataforma de Saúde</p>
        </div>

        <form action="register.php" method="POST">
            <div class="form-group">
                <label>Tipo de Usuário</label>
                <div class="user-type-grid">
                    <label><input type="radio" name="user_type" value="patient" required> Paciente</label>
                    <label><input type="radio" name="user_type" value="doctor" required> Médico</label>
                    <label><input type="radio" name="user_type" value="clinic" required> Clínica</label>
                    <label><input type="radio" name="user_type" value="pharmacy" required> Farmácia</label>
                </div>
            </div>

            <div class="form-group">
                <label>Nome</label>
                <input type="text" name="firstname" placeholder="Seu nome" required>
            </div>

            <div class="form-group">
                <label>Sobrenome</label>
                <input type="text" name="lastname" placeholder="Seu sobrenome" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="seu@email.com" required>
            </div>

            <div class="form-group">
                <label>Usuário</label>
                <input type="text" name="username" placeholder="Escolha um usuário" required>
            </div>

            <div class="form-group">
                <label>Senha</label>
                <input type="password" name="password" placeholder="Senha forte" required>
            </div>

            <button type="submit">Criar Conta</button>
        </form>

        <div class="form-footer">
            Já tem conta? <a href="login.php">Faça login</a>
        </div>
    </div>
</body>
</html>