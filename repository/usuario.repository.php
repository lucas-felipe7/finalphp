<?php

require_once '../data/conexao.class.php';
require_once '../model/usuario.class.php';

class UsuarioRepository {

    private $conexao;

    public function __construct() {
        $this->conexao = Conexao::getInstancia();
    }

    public function criaUsuario($usuario) {
        $operacao = $this->conexao->prepare(
            'INSERT INTO usuario (nomeCompleto, cpf, tipoConta, idConta) VALUES (?, ?, ?, ?)'
        );

        $operacao->bindValue(1, $usuario->nomeCompleto);
        $operacao->bindValue(2, $usuario->cpf);
        $operacao->bindValue(3, $usuario->tipoConta);
        $operacao->bindValue(4, $usuario->idConta);

        return $operacao->execute();
    }

    public function recuperaUsuario($idConta) {
        $operacao = $this->conexao->prepare(
            'SELECT * FROM usuario WHERE idConta = ?'
        );

        $operacao->bindValue(1, $idConta);

        $resultado = $operacao->execute();

        if ($resultado) {
            return $operacao->fetchObject('Usuario');
        } else {
            return null;
        }
    }

    public function atualizaUsuario($nomeCompleto, $tipoConta, $cpf, $idConta) {
        $operacao = $this->conexao->prepare(
            'UPDATE usuario SET nomeCompleto = ?, tipoConta = ?, cpf = ? WHERE idConta = ?'
        );

        $operacao->bindValue(1, $nomeCompleto);
        $operacao->bindValue(2, $tipoConta);
        $operacao->bindValue(3, $cpf);
        $operacao->bindValue(4, $idConta);

        return $operacao->execute();
    }
}