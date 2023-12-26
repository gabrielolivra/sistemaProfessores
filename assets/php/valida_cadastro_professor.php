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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $tel = $_POST['tel'];
    $admin = $_POST['admin'];

    // Conecta ao banco de dados (substitua com suas configurações)
    $conn = conectarAoBanco();

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Verifica se o e-mail já está cadastrado
    $checkEmailQuery = "SELECT * FROM usuarios WHERE email = ?";
    $checkEmailStmt = $conn->prepare($checkEmailQuery);
    $checkEmailStmt->bind_param("s", $login);
    $checkEmailStmt->execute();
    $checkEmailResult = $checkEmailStmt->get_result();

    if ($checkEmailResult->num_rows > 0) {
        echo '
        <script>
            Swal.fire({
                icon: "error",
                title: "Erro ao cadastrar o Usuário",
                text: "E-mail já cadastrado. Por favor, escolha outro e-mail.",
                showConfirmButton: false,
                timer: 2500
            }).then(() => {
                window.location.href = "../../views/admin/cadastro_professor.php";
            });
        </script>';
    } else {
        // E-mail não cadastrado, proceder com a inserção

        // Criptografa a senha
        $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO usuarios (nome, email, senha, whatsapp, is_admin) VALUES (?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sssss", $nome, $login, $hashedPassword, $tel, $admin);

        if ($insertStmt->execute()) {
            echo '
            <script>
                Swal.fire({
                    icon: "success",
                    title: "Professor cadastrado com sucesso!",
                    showConfirmButton: false,
                    timer: 2500
                }).then(() => {
                    window.location.href = "../../views/admin/lista_professores.php";
                });
            </script>';
        } else {
            echo '
            <script>
                Swal.fire({
                    icon: "error",
                    title: "Erro ao cadastrar Professor",
                    showConfirmButton: false,
                    timer: 2500
                }).then(() => {
                    window.location.href = "../../views/admin/cadastro_professor.php";
                });
            </script>';
        }
    }

    // Fecha as conexões com o banco de dados
    $checkEmailStmt->close();
    $insertStmt->close();
    $conn->close();
}
?>