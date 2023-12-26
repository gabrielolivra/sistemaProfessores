<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/img/logo-sidebar.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <title>Cadastro Clientes</title>
</head>
<body>
    
</body>
</html>
<style>
    /* Substitua 'SuaFonte' pelo nome real da sua fonte */
    .swal2-popup {
        font-family:Roboto , sans-serif;
    }
</style>
<?php
session_start();
require '../../assets/php/conexao.php';
require '../../assets/php/verificaAdmin.php';
if (!isAdmin()) {
    header("Location: ../../views/autenticado/home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = conectarAoBanco();
    $usuario_id = mysqli_real_escape_string($conn, $_POST['usuario_id']);
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $login = mysqli_real_escape_string($conn, $_POST['login']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);

    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);


    $sql = "UPDATE usuarios SET nome = '$nome', email = '$login', senha = '$senhaCriptografada', whatsapp = '$tel' WHERE id = '$usuario_id'";

    if (mysqli_query($conn, $sql)) {

        echo '
        <script>
            Swal.fire({
                icon: "success",
                title: "Professor atualizado com sucesso!",
                showConfirmButton: false,
                timer: 2500
            }).then(() => {
                window.location.href = "../../views/admin/lista_professores.php";
            });
        </script>';
        exit();
    } else {

        echo '
        <script>
            Swal.fire({
                icon: "error",
                title: "Erro ao atualizar professor",
                text: "Não foi possivel atualizar o cadastro do professor.",
                showConfirmButton: false,
                timer: 2500
            }).then(() => {
                window.location.href = "../../views/admin/lista_professores.php";
            });
        </script>';
    }

    // Feche a conexão com o banco de dados
    mysqli_close($conn);
}
?>