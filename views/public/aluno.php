<?php
require '../../assets/php/conexao.php';
$conn = conectarAoBanco();
// Consulta para obter os usuários
$sql = "SELECT id, nome FROM usuarios where is_admin = 0";
$result = $conn->query($sql);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/aluno.css">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <title>Aluno</title>
</head>
<body>
<header>
    <ul>
            <a href="../../index.php"><li>Home</li></a>
            <a href="professor.php"><li>Sou professor</li></a>
            <a href="aluno.php"><li>Sou aluno</li></a>
    </ul>
    </header>
    <h1>Envie sua mensagem</h1>
<form action="../../assets/php/enviar_mensagem.php" method="post">
    <div class="dados">
        <label for="nome_aluno">Digite seu nome</label>
        <input type="text" name="nome_aluno" required>
    </div>
    <div class="dados">
    <label for="usuario">Selecione um professor:</label>
    <select name="professor" id="usuario" required>
        <option value="" disabled>Selecione um professor</option>
        <?php
        // Preenche as opções do select com dados do banco de dados
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["id"] . "'>" . $row["nome"] . "</option>";
        }
        ?>
    </select>
    </div>
    <div class="dados">
        <label for="nome_aluno">Digite sua mensagem</label>
        <textarea name="mensagem" required></textarea>
    </div>
    <input type="submit" value="Enviar">
</form>

</body>
</html>
<?php
$conn->close();
?>
