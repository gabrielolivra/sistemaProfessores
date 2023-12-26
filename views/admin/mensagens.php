<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <title>Mensagens</title>
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
    <h1>Home - Mensagens</h1>
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