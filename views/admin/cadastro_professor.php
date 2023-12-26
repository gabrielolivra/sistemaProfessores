<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/cadastro_professor.css">
    <title>Cadastro professor</title>
</head>
<body>
    <header>
        <ul>
            <a href="../../views/admin/home.php"><li>Home</li></a>
            <a href="../../views/admin/cadastro_professor.php"><li>Cadastro de professor</li></a>
            <a href="../../views/admin/mensagens.php"><li>Lista de Mensagens</li></a>
            <a href="../../assets/php/logout.php"><li>Sair</li></a>
        </ul>
    </header>
    <h1>Home - cadastro professor</h1>
    <form method="post" action="../../assets/php/cadastro_usuario_normal.php">
            <input type="text" placeholder="Digite o nome do usuario" name="nome" required>
            <input type="text" placeholder="Digite o login do usuario" name="login" required>
            <input type="password" placeholder="Digite a senha do usuario" name="senha" required>
            <input type="tel" placeholder="Digite o numero do whatsapp do usuario" name="tel" required>
            <input type="hidden" name="admin" value="0">
            <input type="submit" value="Cadastrar">
        </form>
</body>
</html>
<?php
session_start();
require '../../assets/php/conexao.php';
require '../../assets/php/verificaAdmin.php';
$conn = conectarAoBanco();

// Verifique se o usuário é um administrador
if (!isAdmin()) {
    header("Location: ../../views/autenticado/home.php");
    exit();
}
?>