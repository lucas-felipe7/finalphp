<?php

require_once '../model/conta.class.php';
require_once '../model/usuario.class.php';
require_once '../repository/usuario.repository.php';
require_once '../repository/post.repository.php';

$conta = unserialize($_SESSION['auth']);
$usuarioRepository = new UsuarioRepository();
$usuario = $usuarioRepository->recuperaUsuario($conta->id);

$postRepository = new PostRepository();
$posts = $postRepository->recuperaPostsDoUsuario($usuario->id);

foreach ($posts as $post) {
    $post->curtidas = $postRepository->contaCurtidas($post->id);
}