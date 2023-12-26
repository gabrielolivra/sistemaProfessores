<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Mensagem</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    
</body>
</html>
<style>
     .swal2-popup {
        font-family:Roboto , sans-serif;
    }
</style>

<?php 

require '../../assets/php/conexao.php';
$conn = conectarAoBanco();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Utiliza declaração preparada para evitar injeção de SQL
    $stmt = $conn->prepare("INSERT INTO mensagens (dtEnvio, idProfessor, nomeAluno) VALUES (?, ?, ?)");

    // Vincula os parâmetros
    $stmt->bind_param("sss", $nomeAluno, $professor, $mensagem);

    // Obtém os valores do formulário e trata caracteres especiais
    $nomeAluno = htmlspecialchars($_POST["nome_aluno"], ENT_QUOTES, 'UTF-8');
    $professor = htmlspecialchars($_POST["professor"], ENT_QUOTES, 'UTF-8');
    $mensagem = htmlspecialchars($_POST["mensagem"], ENT_QUOTES, 'UTF-8');
    // Executa a declaração preparada
    if ($stmt->execute()) {
        echo '
        <script>
            Swal.fire({
                icon: "success",
                title: "Mensagem enviada com sucesso!",
                showConfirmButton: false,
                timer: 2500
            }).then(() => {
                window.location.href = "../../views/public/aluno.php";
            });
        </script>';
    } else {
        echo '
        <script>
            Swal.fire({
                icon: "error",
                title: "Erro ao enviar mensagem para o Professor",
                showConfirmButton: false,
                timer: 2500
            }).then(() => {
                window.location.href = "../../views/public/aluno.php";
            });
        </script>';
    }
    // Fecha a declaração
    $stmt->close();
}
?>
