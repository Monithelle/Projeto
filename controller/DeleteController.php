<?php
require_once "model\DatabaseModel.php";

$db = new Crud();
$id = $_GET['id'] ?? null;

if ($id) {
    $db->excluirCadastro($id);
}

header("Location: ..\index.php");
exit;
?>