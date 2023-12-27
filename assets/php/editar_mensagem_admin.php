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
    // Evite SQL Injection usando declarações preparadas
    $mensagem_id = mysqli_real_escape_string($conn, $_POST['id_mensagem']);
    $mensagem = mysqli_real_escape_string($conn, $_POST['mensagem']);
    $nome_aluno = mysqli_real_escape_string($conn, $_POST['nome_aluno']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Crie a consulta SQL para atualizar a mensagem
    $sql = "UPDATE MENSAGENS SET nomeAluno = ?, mensagem = ?, status = ? WHERE id = ?";
    
    // Use uma declaração preparada
    $stmt = mysqli_prepare($conn, $sql);

    // Verifique se a preparação da declaração foi bem-sucedida
    if ($stmt) {
        // Associe os parâmetros
        mysqli_stmt_bind_param($stmt, "sssi", $nome_aluno, $mensagem, $status, $mensagem_id);

        // Execute a declaração preparada
        if (mysqli_stmt_execute($stmt)) {
            // Se a atualização for bem-sucedida, redirecione para a página de mensagens
            header("Location: ../../views/admin/mensagens.php");
            exit();
        } else {
            // Se houver um erro na atualização, exiba uma mensagem de erro
            echo "Erro ao atualizar a mensagem: " . mysqli_stmt_error($stmt);
        }

        // Feche a declaração preparada
        mysqli_stmt_close($stmt);
    } else {
        // Se houver um erro na preparação da declaração, exiba uma mensagem de erro
        echo "Erro na preparação da declaração: " . mysqli_error($conn);
    }

    // Feche a conexão com o banco de dados
    mysqli_close($conn);
}
?>