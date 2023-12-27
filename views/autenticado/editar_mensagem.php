
<?php
session_start();
require '../../assets/php/conexao.php';
require '../../assets/php/usuarioLogado.php';
$conn = conectarAoBanco();
$user = verificarUsuarioLogado();
$usuario_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/minhas_mensagens.css">
    <script src="../../assets/js/funcoes.js"></script>
    <title>Editar mensagem</title>
</head>
<body>
<header>
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <ul class="menu">
            <a href="../../views/autenticado/home.php"><li>Home</li></a>
            <a href="../../views/autenticado/minhas_mensagens.php"><li>Minhas mensagens</li></a>
            <a href="../../assets/php/logout.php"><li>Sair</li></a>
        </ul>
    </header>
    <h1>Editar mensagem</h1>
    <section>
    <?php 
    $id = $_GET['id'];
    $sql = "SELECT  m.nomeAluno, u.nome, m.mensagem, m.dtEnvio, m.id,
    CASE 
    WHEN m.status = 0 THEN 'Pendente'
    WHEN m.status = 1 THEN 'Respondido'
    ELSE m.status
    END AS status_descricao
    FROM mensagens m INNER JOIN usuarios u ON  m.idProfessor = u.id  WHERE idProfessor = $usuario_id and is_admin = 0 and m.id = $id order by m.dtEnvio desc ";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()){
        $nomeAluno =  $row['nomeAluno'];
        $mensagem = $row['mensagem'];
    }
    ?>
    <form action="../../assets/php/editar_mensagem.php" method="post">
        <input type="text" name="nome_aluno" id="" value="<?php echo $nomeAluno; ?>">
        <input type="text" name="mensagem" id="" value="<?php echo $mensagem?>">
        <input type="hidden" name="id_mensagem" value ="<?php echo $id ?>">
        <select name="status" id="">
            <option value="0"> Pendente</option>
            <option value="1"> Respondido</option>
        </select>
        <button type="submit">Atualizar status</button>
    </form>
    </section>
</body>
</html>
<style>
  
</style>