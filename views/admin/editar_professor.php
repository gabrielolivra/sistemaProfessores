<?php
session_start();
require '../../assets/php/conexao.php';
require '../../assets/php/verificaAdmin.php';

// Verifique se o usuário é um administrador
if (!isAdmin()) {
    // Se não for um administrador, redirecione para outra página ou exiba uma mensagem de erro
    header("Location: ../../views/autenticado/home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = conectarAoBanco();

    // Evite SQL Injection usando declarações preparadas
    $usuario_id = mysqli_real_escape_string($conn, $_POST['usuario_id']);

    // Consulta SQL para obter os dados do usuário a ser editado
    $sql = "SELECT * FROM usuarios WHERE id = '$usuario_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // Feche a conexão com o banco de dados
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../../assets/img/logo-sidebar.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/editar_professor.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../assets/js/funcoes.js"></script>
    <title>Editar usuario</title>
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
    <h2>Editar usuário</h2>
    <section>
    <form method='post' action='../../assets/php/atualizar_professor.php'>
        <div class="group-data">
            <label for="nome">Nome</label>
            <input type="text" name='nome' id="nome" value="<?php echo $row['nome']?>" placeholder="Digite o nome do usuario" required>
        </div>
        <div class="group-data">
            <label for="login">Login</label>
            <input type="text" name='login' id="login" value="<?php echo $row['email']?>" placeholder="Digite o login do usuario" required>
        </div>
        <div class="group-data">
            <label for="senha">Senha</label>
            <input type="password" name='senha' id="senha" placeholder="Digite a nova senha do usuario" required>
        </div>
        <div class="group-data">
            <label for="tel">WhatsApp</label>
            <input type="text" name='tel' id="tel" value="<?php echo $row['whatsapp']?>" placeholder="Digite o numero de telefone do usuario">
        </div>
        <input type='hidden' name='usuario_id' value='<?php echo $row['id']?>'>
       
            <button type="submit">Atualizar</button>
        </form>
        <a href="../../views/admin/lista_professores.php"><button class="back-btn">Voltar</button></a>
       
    
    </section>
</body>
</html>
<style>
   
    </style>