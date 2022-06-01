<?php
require_once '../controller/criamensagem.controller.php';

function trataErro($mensagem) {
    criaErro($mensagem);
    header('location:../view/completar-perfil.php');
}

if (isset($_POST['nome-completo']) && isset($_POST['cpf']) && isset($_POST['tipoconta'])) {
    $nomeCompleto = ucwords(strtolower($_POST['nome-completo']));
    $cpf = $_POST['cpf'];
    $tipoConta = strtoupper($_POST['tipoconta']);

    $nomeValido = strlen($nomeCompleto) <= 50;

    if (empty($nomeCompleto)) {
        trataErro('Preencha o nome!');
    } else if (!$nomeValido) {
        trataErro('O nome deve possuir menos de ? caracteres!');
    } else if (empty($cpf)) {
        trataErro('Preencha o seu CPF!');
    } else if (empty($tipoConta)) {
        trataErro('Selecione o tipo da sua conta!');
    } else if ($tipoConta != 'D' && $tipoConta != 'A') {
        trataErro('Selecione um tipo de conta válido!');
    } else {
        require_once '../model/conta.class.php';
        require_once '../model/usuario.class.php';
        require_once '../repository/usuario.repository.php';

        $usuario = new Usuario();
        $usuario->nomeCompleto = $nomeCompleto;
        $usuario->tipoConta = $tipoConta;
        $usuario->cpf = $cpf;

        $conta = unserialize($_SESSION['auth']);

        $usuario->idConta = $conta->id;

        $usuarioRepository = new UsuarioRepository();
        $resultado = $usuarioRepository->criaUsuario($usuario);

        if ($resultado) {
            header('location:../view/home.php');
        } else {
            trataErro('Não foi possível criar seu usuário.');
        }
    }
} else {
    header('location:../view/completar-perfil.php');
}