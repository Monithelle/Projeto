<?php
require_once "controller\ListagemController.php";

$controller = new ListagemController();

$filtros = [
    'nome' => isset($_GET['nome']) ? $_GET['nome'] : "",
    'email' => isset($_GET['email']) ? $_GET['email'] : "",
    'cidade' => isset($_GET['cidade']) ? $_GET['cidade'] : "",
    'telefone' => isset($_GET['telefone']) ? $_GET['telefone'] : "",
];

$registros = $controller->listar($filtros);
?>

<?php session_start(); ?>
<?php if (isset($_SESSION["mensagem"])): ?>
    <div style="padding: 10px; background-color: <?php echo $_SESSION["tipo_mensagem"] === "sucesso" ? 'lightgreen' : 'lightcoral'; ?>; color: black;">
        <?php echo $_SESSION["mensagem"]; ?>
    </div>
    <?php unset($_SESSION["mensagem"], $_SESSION["tipo_mensagem"]); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Registros</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .search-box { margin-bottom: 10px; }
        .search-box input { padding: 8px; width: 200px; margin-right: 5px; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 3px; }
        .btn-edit { background-color: #4CAF50; }
        .btn-delete { background-color: #F44336; }
    </style>
</head>
<body>

    <h2>Lista de Registros</h2>

    <form method="GET" class="search-box">
        <input type="text" name="nome" placeholder="Nome" value="<?php echo htmlspecialchars($filtros['nome']); ?>">
        <input type="text" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($filtros['email']); ?>">
        <input type="text" name="cidade" placeholder="Cidade" value="<?php echo htmlspecialchars($filtros['cidade']); ?>">
        <input type="text" name="telefone" placeholder="Telefone" value="<?php echo htmlspecialchars($filtros['telefone']); ?>">
        <button type="submit">Pesquisar</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Cidade</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($registros)): ?>
                <?php foreach ($registros as $registro): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($registro['nome']); ?></td>
                        <td><?php echo htmlspecialchars($registro['email']); ?></td>
                        <td><?php echo htmlspecialchars($registro['cidade']); ?></td>
                        <td><?php echo htmlspecialchars($registro['telefone']); ?></td>
                        <td>
                            <a href="views\editar.php?id=<?php echo $registro['id']; ?>" class="btn btn-edit">Editar</a>
                            <a href="controller\DeleteController.php?id=<?php echo $registro['id']; ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhum registro encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table><br>
<a href="views\cadastro.php" class="btn btn-edit">Cadastrar</a>
</body>
</html>