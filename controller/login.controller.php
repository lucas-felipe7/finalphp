<?php
require_once '../controller/criamensagem.controller.php';

function trataErro($mensagem) {
    criaErro($mensagem);
    header('location:../view/login.php');
}

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $emailValido = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (empty($email)) {
        trataErro('Preencha o email!');
    } else if (!$emailValido) {
        trataErro('Email inválido!');
    } else if (empty($senha)) {
        trataErro('Preencha a senha!');
    } else {
        require_once '../model/conta.class.php';
        require_once '../repository/conta.repository.php';

        $conta = new Conta();
        $conta->email = $email;
        $conta->senha = md5('qi'.$senha.'ab');

        $contaRepository = new ContaRepository();
        $contaLogada = $contaRepository->recuperaConta($conta);

        if ($contaLogada == null) {
            trataErro("Usuário ou senha inválidos.");
        } else {
            require_once '../model/usuario.class.php';
            require_once '../repository/usuario.repository.php';

            $_SESSION['auth'] = serialize($contaLogada);

            $usuarioRepository = new UsuarioRepository();
            $usuario = $usuarioRepository->recuperaUsuario($contaLogada->id);

            if ($usuario == null) {
                header('location:../view/completar-perfil.php');
            } else {
                header('location:../view/home.php');
            }
        }
    }
} else {
    header('location:../view/login.php');
}