<?php
require_once './criamensagem.controller.php';

if (isset($_SESSION['auth'])) {
    require_once '../model/conta.class.php';
    require_once '../model/usuario.class.php';
    require_once '../repository/usuario.repository.php';

    $conta = unserialize($_SESSION['auth']);

    $repository = new UsuarioRepository();
    $usuario = $repository->recuperaUsuario($conta->id);

    if ($usuario == null) {
        header('location:../view/completar-perfil.php');
    } else if (!isset($_POST['idPost'])) {
        header('location:../view/posts.php');
    } else {
        $idPost = $_POST['idPost'];

        if (!is_numeric($idPost)) {
            criaErro('Post inválido');
        } else {
            require_once '../repository/post.repository.php';

            $repository = new PostRepository();
            $resultado = $repository->deletaPost($idPost, $usuario->id);

            if ($resultado) {
                criaSucesso('Post excluído com sucesso!');
            } else {
                criaErro('Nao foi possível excluir o post.');
            }
        }

        header('location:../view/posts.php');
    }
} else {
    header('location:../view/login.php');
}