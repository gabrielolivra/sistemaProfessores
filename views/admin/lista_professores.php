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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/homeAdmin.css">
    <script src="../../assets/js/funcoes.js"></script>
    <link rel="stylesheet" href="../../assets/css/header.css">
    <title>Lista de professores</title>
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
    <h1>Lista de professores</h1>
</body>
<table border="1">
            <tr>
                <th>Nome</th>
                <th>Login</th>
                <th>Numero de telefone</th>
                <th>Ação</th>
            </tr>
            <?php
     $conn = conectarAoBanco();
     $result = mysqli_query($conn, "SELECT * FROM usuarios where is_admin = 0");
     while ($row = mysqli_fetch_assoc($result)) {
         echo "<tr>";
         echo "<td>{$row['nome']}</td><td>{$row['email']}</td><td>{$row['whatsapp']}</td>";
         echo "<td class='btn-action'>";
         echo "<form method='post' action='../../views/admin/editar_professor.php'>"; 
         echo "<input type='hidden' name='usuario_id' value='{$row['id']}'>";
         echo "<input type='submit' value='Editar'   style='background:green; color:white;'>";
         echo "</form>";

         echo "<form method='post' action='../../assets/php/excluir_usuario.php' onsubmit='return confirm(\"Deseja realmente excluir o {$row['nome']}?\")'>"; // Substitua 'excluir_usuario.php' pelo script que você usará para excluir
         echo "<input type='hidden' name='usuario_id' value='{$row['id']}'>";
         echo "<input type='submit' value='Excluir' style='background:red; color:white;' >";
         echo "</form>";
         echo "</td>";
         echo "</tr>";
     }
    ?>
        </table>
</html>

<style>

table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
}

th,
td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

th {
    background-color: #f2f2f2;
}
.btn-action{
   
}
form input[type="submit"]{
    width:100px;
    height:25px;
    border-radius:5px;
    margin:5px;
    border:none;
}
</style>
