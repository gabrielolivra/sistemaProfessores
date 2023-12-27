<?php
session_start();
require '../../assets/php/conexao.php';
require '../../assets/php/usuarioLogado.php';
$conn = conectarAoBanco();
$user = verificarUsuarioLogado();



// Verifique se o usuário é um administrador

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  

    // Evite SQL Injection usando declarações preparadas
    $usuario_id = mysqli_real_escape_string($conn, $_POST['usuario_id']);

    // Crie a consulta SQL para excluir o usuário
    $sql = "DELETE FROM usuarios WHERE id = '$usuario_id'";

    if (mysqli_query($conn, $sql)) {
        // Se a exclusão for bem-sucedida, redirecione para a página de lista de usuários
        header("Location: ../../views/admin/lista_professores.php");
        exit();
    } else {
        // Se houver um erro na exclusão, exiba uma mensagem de erro
        echo "Erro ao excluir o mensagem: " . mysqli_error($conn);
        header("Location: ../../views/admin/lista_professores.php");
        exit();
    }

    // Feche a conexão com o banco de dados
    mysqli_close($conn);
}
?>
