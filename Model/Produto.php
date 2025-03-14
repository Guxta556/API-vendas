<?php

namespace App\Model;

use Conexao;

class Produto {
    private $id;
    private $nome;
    private $quantidade;
    private $valor;

    // Construtor
    public function __construct($nome = null, $quantidade = null, $valor = null, $id = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->quantidade = $quantidade;
        $this->valor = $valor;
    }

    // Métodos Getter e Setter
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    // Método para salvar produto no banco (Create ou Update)
    public function save() {
        if ($this->id) {
            // Atualiza um produto existente
            $sql = "UPDATE produtos SET nome = :nome, quantidade = :quantidade, valor = :valor WHERE id = :id";
            $stmt = Conexao::getConn()->prepare($sql);
            $stmt->bindValue(':id', $this->id);
        } else {
            // Insere um novo produto
            $sql = "INSERT INTO produtos (nome, quantidade, valor) VALUES (:nome, :quantidade, :valor)";
            $stmt = Conexao::getConn()->prepare($sql);
        }

        $stmt->bindValue(':nome', $this->nome);
        $stmt->bindValue(':quantidade', $this->quantidade);
        $stmt->bindValue(':valor', $this->valor);
        $stmt->execute();
    }

    // Método para excluir um produto
    public static function delete($id) {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    // Método para buscar um produto pelo ID
    public static function findById($id) {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $produto = $stmt->fetchObject(Produto::class);
        return $produto ? $produto : null;
    }

    // Método para buscar todos os produtos
    public static function all() {
        $sql = "SELECT * FROM produtos";
        $stmt = Conexao::getConn()->prepare($sql);
        $stmt->execute();

        $produtos = $stmt->fetchAll(\PDO::FETCH_CLASS, Produto::class);
        return $produtos;
    }
}
