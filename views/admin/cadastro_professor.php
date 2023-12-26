<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/cadastro_professor.css">
    <script src="../../assets/js/funcoes.js"></script>
    <title>Cadastro professor</title>
</head>
<body>
<header>
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <ul class="menu">
            <a href="../../views/admin/home.php"><li>Home</li></a>
            <a href="../../views/admin/cadastro_professor.php"><li>Cadastro de professor</li></a>
            <a href="../../views/admin/lista_professores.php"><li>Lista de professores</li></a>
            <a href="../../views/admin/mensagens.php"><li>Lista de Mensagens</li></a>
            <a href="../../assets/php/logout.php"><li>Sair</li></a>
        </ul>
    </header>
    <h1>Home - cadastro professor</h1>
    <form method="post" action="../../assets/php/valida_cadastro_professor.php">
            <input type="text" placeholder="Digite o nome do professor" name="nome" required>
            <input type="text" placeholder="Digite o email de acesso do professor" name="login" required>
            <input type="password" placeholder="Digite a senha" name="senha" required>
            <input type="tel" placeholder="Digite o numero do whatsapp " name="tel" required>
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