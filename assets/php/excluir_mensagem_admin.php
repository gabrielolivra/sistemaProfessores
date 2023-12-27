<?php
session_start();
require '../../assets/php/conexao.php';
require '../../assets/php/verificaAdmin.php';
$conn = conectarAoBanco();
if (!isAdmin()) {
    header("Location: ../../views/autenticado/home.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  

    $mensagem_id = mysqli_real_escape_string($conn, $_POST['mensagem_id']);

    $sql = "DELETE FROM mensagens WHERE id = '$mensagem_id'";

    if (mysqli_query($conn, $sql)) {

        header("Location: ../../views/admin/mensagens.php");
        exit();
    } else {

        echo "Erro ao excluir o mensagem: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
