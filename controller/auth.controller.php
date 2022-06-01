<?php
if (!isset($_SESSION)) {
    session_start();
}

$estaLogado = isset($_SESSION['auth']);
$temUsuario = false;

if ($estaLogado) {
    require_once '../model/conta.class.php';
    require_once '../model/usuario.class.php';
    require_once '../repository/usuario.repository.php';

    $conta = unserialize($_SESSION['auth']);

    $repository = new UsuarioRepository();
    $usuario = $repository->recuperaUsuario($conta->id);

    if ($usuario != null) {
        $temUsuario = true;
    }
}

unset($repository);