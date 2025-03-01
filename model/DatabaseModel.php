<?php
// criar conexão com o banco de dados

class Database
{

    private $host = "localhost";
    private $db_name = "projetos";
    private $username = "root";
    private $password = "admin";

    protected $conexao;

    // Construtor para estabelecer a conexão com o banco de dados
    public function __construct()
    {
        try {
            $this->conexao = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }
}

class Crud extends Database
{
    // Método para criar um novo registro
    public function create($params)
    {
        //trocando os valores 
        $query = "INSERT INTO cadastros (nome, email, telefone, cidade) VALUES (:nome, :email, :telefone, :cidade)";
        $stmt = $this->conexao->prepare($query);

        //atualiza os valores
        return $stmt->execute([
            'nome' => $params['nome'],
            'email' => $params['email'],
            'telefone' => $params['telefone'],
            'cidade' => $params['cidade']
        ]);
    }
    
    
    // Método para ler os registros 
    public function read($filtros)
    {

        $query = "SELECT * FROM cadastros WHERE 1=1";
        $params = [];

        if (!empty($filtros['nome'])) {
            $query .= " AND nome LIKE :nome";
            $params[':nome'] = "%{$filtros['nome']}%";
        }

        if (!empty($filtros['email'])) {
            $query .= " AND email LIKE :email";
            $params[':email'] = "%{$filtros['email']}%";
        }

        if (!empty($filtros['telefone'])) {
            $query .= " AND telefone LIKE :telefone";
            $params[':telefone'] = "%{$filtros['telefone']}%";
        }
        if (!empty($filtros['cidade'])) {
            $query .= " AND cidade LIKE :cidade";
            $params[':cidade'] = "%{$filtros['cidade']}%";
        }

        //STMT ENCAPSULAR dados que é requerido ele executa

        $stmt = $this->conexao->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // Método para atualizar um registro existente
    public function update($params)
    {
        $query = "UPDATE cadastros SET nome = :nome, email = :email, telefone = :telefone, cidade = :cidade WHERE id = :id";
        $stmt = $this->conexao->prepare($query);

        return $stmt->execute([
            'id' => $params['id'],
            'nome' => $params['nome'],
            'email' => $params['email'],
            'telefone' => $params['telefone'],
            'cidade' => $params['cidade']
        ]);
    }
    // Método para excluir um registro
    public function delete($id)
    {
        $query = "DELETE FROM cadastros WHERE id = :id";
        $stmt = $this->conexao->prepare($query);

        return $stmt->execute(['id' => $id]);
    }
    public function getCadastro($id) {
        $stmt = $this->conexao->prepare("SELECT * FROM cadastros WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarCadastro($id, $nome, $email, $cidade, $telefone) {
        $stmt = $this->conexao->prepare("UPDATE cadastros SET nome = ?, email = ?, cidade = ?, telefone = ? WHERE id = ?");
        return $stmt->execute([$nome, $email, $cidade, $telefone, $id]);
    }

    public function excluirCadastro($id) {
        $stmt = $this->conexao->prepare("DELETE FROM cadastros WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
