<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASDnet - Painel</title>
    <!-- ESTA LINHA CONECTA O CSS: -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="menu-lateral">
    <h1>WASDnet</h1>
    <ul>
        <li><a href="Loginteste.php" class="ativo">Dashboard</a></li>
        <li><a href="#">Configurações</a></li>
        <li><a href="#">Sair</a></li>
    </ul>
</div>

<div class="container">
    <?php
    include 'conexao.php';

    session_start();

    if (isset($_GET['excluir'])){
        $id_apagado = $_GET['excluir'];

        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id_apagado]);

        header("location: Loginteste.php");
        exit();
    }

    if (isset($_POST['usuario'])) {
    $nome = $_POST['usuario'];
    $editado = $_POST['id_editar'];

    if ($editado !== '') {
        // Se já tem um ID para editar, atualiza no banco (U do CRUD)
        $stmt = $pdo->prepare("UPDATE usuarios SET nome = ? WHERE id = ?");
        $stmt->execute([$nome, $editado]);
    } else {
        // Se o ID está vazio, é um cadastro novo (C do CRUD)
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome) VALUES (?)");
        $stmt->execute([$nome]);
    }

    header("Location: Loginteste.php");
    exit();
}

$nomeEditar = '';
    if (isset($_GET['editar'])) {
        $stmt = $pdo->prepare("SELECT nome FROM usuarios WHERE id = ?");
        $stmt->execute([$_GET['editar']]);
        $nomeEditar = $stmt->fetchColumn();
    }
    ?>
    <form method="POST" action="Loginteste.php">
        <input type="hidden" name="id_editar" value="<?php echo(isset($_GET['editar'])) ? $_GET['editar'] : ''; ?>"> 
        <input type="text" name="usuario" value="<?php echo htmlspecialchars($nomeEditar); ?>" required>
    </form>
    <h2>Usuarios salvos:</h2>
    <table>
        <thead>
            <tr>
                <th>Nome do user</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Faz uma consulta para pegar todos os usuários do banco de dados
        $stmt = $pdo->query("SELECT * FROM usuarios");
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Agora o foreach lê os dados que vieram do MySQL
        foreach ($usuarios as $user) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($user['nome']) . "</td>";
            echo "<td>";
            echo "  <a href='Loginteste.php?editar=" . $user['id'] . "'>[Editar]</a> ";
            echo "  <a href='Loginteste.php?excluir=" . $user['id'] . "'>[X] Excluir</a>";
            echo "</td>";
            echo "</tr>";
        };
        ?>
        </tbody>
    </table>
</div>
</body>
</html>