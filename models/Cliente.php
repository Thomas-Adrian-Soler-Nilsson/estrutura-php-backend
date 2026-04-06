<?php
include_once 'Conn.php';

class Cliente {
    private $id;
    private $nome;
    private $email;
    private $conn;

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; return $this; }

    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; return $this; }

    public function getEmail() { return $this->email; }

    public function setEmail($email) { $this->email = $email; return $this; }

    public function salvar() {
        try {
            $this->conn = new Conn();
            // Ajustado para sp_salvar_cliente
            $sql = "CALL sp_salvar_cliente(?, ?, ?)";
            $executar = $this->conn->prepare($sql);
            $executar->bindValue(1, $this->id ?? 0);      
            $executar->bindValue(2, mb_strtoupper($this->nome));
            $executar->bindValue(3, mb_strtoupper($this->email));
            
            return $executar->execute();
        } catch(PDOException $erro) {
            return "Erro: " . $erro->getMessage();
        }
    }
}