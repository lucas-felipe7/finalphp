<?php
require_once './criamensagem.controller.php';

function trataErro($erro) {
    criaErro($erro);
    header('location:../view/home.php');
}

if (isset($_SESSION['auth'])) {
    require_once '../model/conta.class.php';
    require_once '../model/usuario.class.php';
    require_once '../repository/usuario.repository.php';

    $conta = unserialize($_SESSION['auth']);
    $usuarioRepository = new UsuarioRepository();

    $usuario = $usuarioRepository->recuperaUsuario($conta->id);

    if ($usuario == null) {
        header('location:../view/completar-perfil.php');
    } else {
        if (isset($_POST['post'])) {
            $conteudo = $_POST['post'];
            if (empty($conteudo)) {
                trataErro('Preencha o conteúdo do post');
            } else {
                require_once '../repository/post.repository.php';

                $postRepository = new PostRepository();
                $resultado = $postRepository->criaPost($conteudo, $usuario->id);
    
                if ($resultado) {
                    criaSucesso('Post enviado!');
                    header('location:../view/home.php');
                } else {
                    trataErro('Nao foi possível enviar o post');
                }
            }
        } else {
            header('location:../view/home.php');
        }
    }
} else {
    header('location:../view/login.php');
}