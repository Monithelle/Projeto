<?php
require_once 'model/DatabaseModel.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $create = [
        "nome" => $_POST["nome"],
        "email" => $_POST["email"],
        "telefone" => $_POST["telefone"],
        "cidade" => $_POST["cidade"]
    ];

    $crud = new Crud();
    
    if ($crud->create($create)) { 
        $_SESSION["mensagem"] = "Usuário cadastrado com sucesso!";
        $_SESSION["tipo_mensagem"] = "sucesso";
        header("Location: ../index.php");
        exit;
    } else {
        $_SESSION["mensagem"] = "Erro ao cadastrar usuário. Tente novamente!";
        $_SESSION["tipo_mensagem"] = "erro";
        header("Location: ../cadastrar.php");
        exit;
    }
}
?>