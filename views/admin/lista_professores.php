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
    <link rel="stylesheet" href="../../assets/css/list_professores.css">
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
        $result = mysqli_query($conn, "SELECT * FROM usuarios where is_admin = 0");
        while ($row = mysqli_fetch_assoc($result)) {
        $nomeProfessor = $row['nome'];
        $email = $row['email'];
        $whatsapp = $row['whatsapp'];
        $id_usuario = $row['id'];
         ?>

        <tr>
         <td><?php echo $nomeProfessor ?></td>
         <td><?php echo $email ?></td>
         <td><?php echo $whatsapp ?></td>
         <td class='btn-action'>
         <form method='post' action='../../views/admin/editar_professor.php'>
         <input type='hidden' name='usuario_id' value='<?php echo $id_usuario?>'>
         <input type='submit' value='Editar'   style='background:green; color:white;'>
         </form>
         <form method='post' action='../../assets/php/excluir_professor.php' onsubmit='return confirm("Deseja realmente excluir o <?php echo $nomeProfessor?>?")'>
         <input type='hidden' name='usuario_id' value='<?php echo $id_usuario?>'>
         <input type='submit' value='Excluir' style='background:red; color:white;' >
         </form>
         </td>
         </tr>

    <?php } ?>
        </table>
</html>
