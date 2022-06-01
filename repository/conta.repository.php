<?php

require_once '../data/conexao.class.php';
require_once '../model/conta.class.php';

class ContaRepository {

    private $conexao;

    public function __construct() {
        $this->conexao = Conexao::getInstancia();
    }

    public function criaConta($conta) {
        $operacao = $this->conexao->prepare(
            'INSERT INTO conta (email, senha) VALUES (?, ?)'
        );

        $operacao->bindValue(1, $conta->email);
        $operacao->bindValue(2, $conta->senha);

        return $operacao->execute();
    }

    public function recuperaConta($conta) {
        $operacao = $this->conexao->prepare(
            'SELECT * FROM conta WHERE email = ? AND senha = ?'
        );

        $operacao->bindValue(1, $conta->email);
        $operacao->bindValue(2, $conta->senha);

        $resultado = $operacao->execute();

        if ($resultado) {
            return $operacao->fetchObject('Conta');
        } else {
            return null;
        }
    }

    public function atualizaConta($id, $senha) {
        $operacao = $this->conexao->prepare(
            'UPDATE conta SET senha = ? WHERE id = ?'
        );

        $operacao->bindValue(1, $senha);
        $operacao->bindValue(2, $id);

        return $operacao->execute();
    }
}