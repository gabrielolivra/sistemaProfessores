<?php
session_start();
require '../../assets/php/conexao.php';
require '../../assets/php/verificaAdmin.php';
$conn = conectarAoBanco();
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
    <link rel="stylesheet" href="../../assets/css/header.css">
    <link rel="stylesheet" href="../../assets/css/mensagens.css">
    <script src="../../assets/js/funcoes.js"></script>
    <title>Mensagens</title>
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
    <h1>Admin - Mensagens</h1>
    <section>
    <?php 
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $sql = "SELECT  m.nomeAluno, u.nome, m.mensagem, m.dtEnvio, m.id,
    CASE 
        WHEN m.status = 0 THEN 'Pendente'
        WHEN m.status = 1 THEN 'Respondido'
        ELSE m.status
    END AS status_descricao
     FROM mensagens m INNER JOIN usuarios u ON  m.idProfessor = u.id  WHERE  is_admin = 0 order by m.dtEnvio desc ";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $nomeAluno = $row['nomeAluno'];
        $nomeProfessor = $row['nome'];
        $mensagem = $row['mensagem'];
        $data = $row['dtEnvio'];
        $status = $row['status_descricao'];
        $id_mensagem = $row['id'];
        ?>
        <div class="container-mensagens-recebidas">
            <p>De: <?php echo $nomeAluno; ?> </p>
            <p>Para: <?php echo $nomeProfessor ?> </p>
            <p>Mensagem: <?php echo $mensagem ?></p>
            <p>Data: <?php echo $data ?></p>
            <p>Status: <?php echo $status ?></p>
            <div class="btns">
                <form action='../../assets/php/aprovar_mensagem_admin.php' method='post'>
                    <input type='hidden' name='mensagem_id' value='<?php echo $id_mensagem ?>'>
                    <button type='submit' id='aprovar' class='btn'>Aprovar</button>
                </form>
                <a href='editar_mensagem.php?id=<?php echo $id_mensagem ?>' id='editar'  class='btn'>Editar</a>
                <form action='../../assets/php/excluir_mensagem_admin.php' method='post' onsubmit='return confirm(\"Deseja realmente excluir?\")'>
                    <input type='hidden' name='mensagem_id' value='<?php echo $id_mensagem ?>'>
                    <button type='submit' id='excluir'  class='btn' >Excluir</button>
                </form>
            </div>
        </div>

    <?php
    }
    ?>
    </section>
</body>
</html>
