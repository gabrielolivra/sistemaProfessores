
<?php
session_start();
require '../../assets/php/conexao.php';
require '../../assets/php/usuarioLogado.php';
$conn = conectarAoBanco();
$user = verificarUsuarioLogado();
$usuario_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/homeAdmin.css">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <script src="../../assets/js/funcoes.js"></script>
    <title>Home</title>
</head>
<body>
<header>
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <ul class="menu">
        <a href="../../views/autenticado/home.php"><li>Home</li></a>
            <a href="../../views/autenticado/minhas_mensagens.php"><li>Minhas mensagens</li></a>
            <a href="../../assets/php/logout.php"><li>Sair</li></a>
        </ul>
    </header>
    <h1>Home - professor</h1>

    <section>


    </section>
</body>
</html>
