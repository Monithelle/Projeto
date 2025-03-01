<?php
require_once 'model\DatabaseModel.php';

$db = new Crud();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cidade = $_POST['cidade'];
    $telefone = $_POST['telefone'];

    $db->atualizarCadastro($id, $nome, $email, $cidade, $telefone);
    header("Location: ..\index.php");
    exit;
}

$id = $_GET['id'] ?? null;
$registro = $db->getCadastro($id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
</head>
<body>
    <h2>Editar Registro</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $registro['id']; ?>">
        Nome: <input type="text" name="nome" value="<?php echo $registro['nome']; ?>"><br>
        Email: <input type="email" name="email" value="<?php echo $registro['email']; ?>"><br>
        Cidade: <input type="text" name="cidade" value="<?php echo $registro['cidade']; ?>"><br>
        Telefone: <input type="text" name="telefone" value="<?php echo $registro['telefone']; ?>"><br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>