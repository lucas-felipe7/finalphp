<?php

require_once '../data/conexao.class.php';
require_once '../model/post.class.php';

class PostRepository
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getInstancia();
    }

    public function recuperaPosts()
    {
        $operacao = $this->conexao->prepare(
            'SELECT usuario.nomeCompleto, DATE_FORMAT(listaanimais.dataHora, "%d/%m/%Y %H:%i:%s") AS dataHora, listaanimais.conteudo, listaanimais.id FROM usuario INNER JOIN listaanimais ON usuario.id = listaanimais.idUsuario ORDER BY listaanimais.dataHora DESC'
        );

        $resultado = $operacao->execute();

        if ($resultado) {
            $posts = $operacao->fetchAll(PDO::FETCH_CLASS, 'Post');
            return $posts;
        } else {
            return [];
        }
    }

    public function recuperaPostsDoUsuario($idUsuario)
    {
        $operacao = $this->conexao->prepare(
            'SELECT usuario.nomeCompleto, DATE_FORMAT(listaanimais.dataHora, "%d/%m/%Y %H:%i:%s") AS dataHora, listaanimais.conteudo, listaanimais.id FROM usuario INNER JOIN listaanimais ON usuario.id = listaanimais.idUsuario WHERE listaanimais.idUsuario = ? ORDER BY listaanimais.dataHora DESC'
        );

        $operacao->bindValue(1, $idUsuario);

        $resultado = $operacao->execute();

        if ($resultado) {
            $posts = $operacao->fetchAll(PDO::FETCH_CLASS, 'Post');
            return $posts;
        } else {
            return [];
        }
    }

    public function deletaPost($idPost, $idUsuario)
    {
        $operacao = $this->conexao->prepare(
            'DELETE FROM listaanimais WHERE id = ? AND idUsuario = ?'
        );

        $operacao->bindValue(1, $idPost);
        $operacao->bindValue(2, $idUsuario);

        return $operacao->execute();
    }

    public function criaPost($conteudo, $idUsuario)
    {
        $operacao = $this->conexao->prepare(
            'INSERT INTO listaanimais (conteudo, idUsuario) VALUES (?, ?)'
        );

        $operacao->bindValue(1, $conteudo);
        $operacao->bindValue(2, $idUsuario);

        return $operacao->execute();
    }

    public function contaCurtidas($idPost)
    {
        $operacao = $this->conexao->prepare(
            'SELECT COUNT(*) FROM interessado WHERE idPost = ?'
        );

        $operacao->bindValue(1, $idPost);

        $resultado = $operacao->execute();

        if ($resultado) {
            return $operacao->fetchColumn(0);
        } else {
            return 0;
        }
    }

    public function curtiuPost($idUsuario, $idPost)
    {
        $operacao = $this->conexao->prepare(
            'SELECT * FROM interessado WHERE idUsuario = ? AND idPost = ?'
        );

        $operacao->bindValue(1, $idUsuario);
        $operacao->bindValue(2, $idPost);

        if ($operacao->execute()) {
            $itens = $operacao->fetchAll(PDO::FETCH_ASSOC);
            return count($itens) > 0;
        } else {
            return false;
        }
    }
}
