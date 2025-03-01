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
    <title>Cadastro de contatos</title>


    <style>
        th,
        tr,
        td {

            border: 1px solid;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            width: 48%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .save-button {
            background-color: #4CAF50;
            color: white;
        }

        .list-button {
            background-color: #2196F3;
            color: white;
        }

        .message {
            margin-top: 20px;
            color: green;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Cadastro de contatos</h1>
        <form action="..\controller\CreateController.php" method="post" id="cadastroForm">
            <label for="nome">Nome</label><br>
            <input type="text" name="nome" placeholder="Nome" id="nome" required><br>

            <label for="nome">Email</label><br>
            <input type="email" name="email" placeholder="Email" id="email" required><br>

            <label for="nome">Telefone</label><br>
            <input type="text" name="telefone" placeholder="Telefone" id="telefone" required><br>

            <label for="nome">Cidade</label><br>
            <input type="text" name="cidade" placeholder="Cidade" id="cidade" required><br>

            <button type="submit" class="save-button">Salvar novo contato</button>
            <a href="/index.php" type="button" class="list-button">Listagem</a>
        </form>

        <div id="message" class="message"></div>
    </div>

</body>

</html>