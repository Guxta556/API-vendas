<?php

class Conexao {
    public static function getConn() {
        try {
            $conn = new \PDO('mysql:host=localhost;dbname=estoque_vendas', 'root', '123');
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (\PDOException $e) {
            echo 'Erro de conexão: ' . $e->getMessage();
            exit;
        }
    }
}
