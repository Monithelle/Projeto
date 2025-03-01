<?php
//nome variavel e função camelcase, quando nome de classe (nome do arquivo) é primeira letra de cada palavra maiuscula
require_once 'model\DatabaseModel.php';

class ListagemController{
private $db;

public function __construct()
{
    $this->db= new Crud();

}

public function listar($filtros){
    return $this->db->read($filtros);
}
}
?>
