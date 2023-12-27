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

// Verifique se o usuário é um administrador
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario_id = mysqli_real_escape_string($conn, $_POST['usuario_id']);

    $sqlExcluirUsuario = "DELETE FROM usuarios WHERE id = ?";
    $sqlExcluirMensagens = "DELETE FROM mensagens WHERE idProfessor = ?";

    mysqli_begin_transaction($conn);

    try {

        $stmtExcluirUsuario = mysqli_prepare($conn, $sqlExcluirUsuario);
        mysqli_stmt_bind_param($stmtExcluirUsuario, "i", $usuario_id);
        mysqli_stmt_execute($stmtExcluirUsuario);

        $stmtExcluirMensagens = mysqli_prepare($conn, $sqlExcluirMensagens);
        mysqli_stmt_bind_param($stmtExcluirMensagens, "i", $usuario_id);
        mysqli_stmt_execute($stmtExcluirMensagens);

        mysqli_commit($conn);

        header("Location: ../../views/admin/lista_professores.php");
        exit();
    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Erro ao excluir usuário e mensagens: " . $e->getMessage();
        header("Location: ../../views/admin/lista_professores.php");
        exit();
    } finally {
        mysqli_stmt_close($stmtExcluirUsuario);
        mysqli_stmt_close($stmtExcluirMensagens);

        mysqli_close($conn);
    }
}
?>
