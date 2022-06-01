<?php
require_once './criamensagem.controller.php';
require_once './auth.controller.php';

function trataErro($mensagem) {
    criaErro($mensagem);
    header('location:../view/home.php');
}

if ($estaLogado) {
    if ($temUsuario) {
        if (isset($_GET['id'])) {
            $post = $_GET['id'];

            require_once '../repository/post.repository.php';
            require_once '../repository/curtida.repository.php';

            $repository = new PostRepository();
            $curtidaRepository = new CurtidaRepository();

            $resultado = false;

            if ($repository->curtiuPost($usuario->id, $post)) {
                $resultado = $curtidaRepository->descurtirPost($usuario->id, $post);
            } else {
                $resultado = $curtidaRepository->curtirPost($usuario->id, $post);
            }

            if ($resultado) {
                criaSucesso('Tudo certo!');
                header('location:../view/home.php');
            } else {
                trataErro('Nao foi possivel concluir a interaçao.');
            }
        } else {
            header('location:../view/home.php');
        }
    } else {
        header('location:../view/completar-perfil.php');
    }
} else {
    header('location:../view/login.php');
}