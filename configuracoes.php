<?php
    session_start();
    $mensagem='';
    if (isset($_POST['tema'])) {
        $tema = $_POST['tema'];
        $_SESSION['tema_escolhido'] = $tema;
        $mensagem='Configuração sucedida.';
      }
      $temaAtual= isset($_SESSION['tema_escolhido']) ? $_SESSION['tema_escolhido'] : 'claro';
    ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WASDnet - Configurações</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body class="<?php echo ($temaAtual == 'escuro') ? 'tema-escuro' : ''; ?>">>
<div class="menu-lateral">
    <h1>WASDnet</h1>
    <ul>
        <li><a href="Loginteste.php">Dashboard</a></li>
        <li><a href="configuracoes.php" class="ativo">Configurações</a></li>
        <li><a href="#">Sair</a></li>
    </ul>
</div>
<div class="container">
    <h2>Configurações</h2>
    <?php if ($mensagem !== ''): ?>
        <p><?php echo htmlspecialchars($mensagem); ?></p>
    <?php endif; ?>

    <form method="POST" action="configuracoes.php">
        <label for="tema">Tema para o painel:</label>
        <select name="tema" id="tema">
            <option value="claro" <?php echo ($temaAtual == 'claro') ? 'selected': ''; ?>>Claro</option>
            <option value="escuro" <?php echo ($temaAtual === 'escuro') ? 'selected' : ''; ?>>Escuro</option>
    </select>
    <button type="submit">Salvar Configurações</button>
    </form>
</div>
</body>
</html>   