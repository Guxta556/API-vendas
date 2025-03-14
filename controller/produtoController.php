<?php

namespace App\Controller;

use App\Model\Produto;
use \PDOException;

class ProdutoController {

    // Função para criar um novo produto (POST)
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? null;
            $quantidade = $_POST['quantidade'] ?? null;
            $valor = $_POST['valor'] ?? null;

            $produto = new Produto($nome, $quantidade, $valor);
            $produto->save();

            echo "Produto criado com sucesso!";
        }
    }

    // Função para listar todos os produtos (GET)
    public function read() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $produtos = Produto::all();
            foreach ($produtos as $produto) {
                echo "ID: " . $produto->getId() . " | Nome: " . $produto->getNome() . " | Quantidade: " . $produto->getQuantidade() . " | Valor: " . $produto->getValor() . "<br>";
            }
        }
    }

    // Função para atualizar um produto (PUT)
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            parse_str(file_get_contents("php://input"), $input);
            $nome = $input['nome'] ?? null;
            $quantidade = $input['quantidade'] ?? null;
            $valor = $input['valor'] ?? null;

            $produto = Produto::findById($id);
            if ($produto) {
                $produto->setNome($nome);
                $produto->setQuantidade($quantidade);
                $produto->setValor($valor);
                $produto->save();
                echo "Produto atualizado com sucesso!";
            } else {
                echo "Produto não encontrado!";
            }
        }
    }

    // Função para excluir um produto (DELETE)
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            Produto::delete($id);
            echo "Produto excluído com sucesso!";
        }
    }
}
