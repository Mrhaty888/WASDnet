<?php

session_start();

if (isset($_GET['excluir'])){
    $id_apagado = $_GET['excluir'];

    unset($_SESSION['Lista de usuarios'][$id_apagado]);
    header("Location: Loginteste.php");
    exit();
}

if (isset($_POST['usuario'])) {
    $nome = $_POST['usuario'];
    $editado = $_POST['id_editar'];
    if ($id_editar !== '') {
        $_SESSION['Lista de usuarios'][$editado] = $nome;
    } else {
        $_SESSION['Lista de usuarios'][] = $nome;
    }

    header("Location: Loginteste.php");
    exit();
}


?>
<form method="POST" action="Loginteste.php">
    <input type="hidden" name="id_editar" value="<?php echo(isset($_GET['editar'])) ? $_GET['editar'] : ''; ?>"> 
    <input type="text" name="usuario" value="<?php echo (isset($_GET['editar']) && isset($_SESSION['Lista de usuarios'][$_GET['editar']])) ? $_SESSION['Lista de usuarios'][$_GET['editar']] : ''; ?>" required>
    <button type="submit">Enviar</button>
</form>
<h2>Usuarios salvos:</h2>
<ul>
    <?php
    if (isset($_SESSION['Lista de usuarios'])) {
        foreach ($_SESSION['Lista de usuarios'] as $id => $nome) {
            echo "<li>".$nome. "
                <a href='Loginteste.php?editar=". $id . "'>[Editar]</a> 
                <a href='Loginteste.php?excluir=". $id . "'>[X] Excluir</a>
            </li>";
        }
    }
    ?>
</ul>