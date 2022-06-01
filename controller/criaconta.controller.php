<?php
require_once '../controller/criamensagem.controller.php';

function trataErro($mensagem) {
    criaErro($mensagem);
    header('location:../view/cadastro.php');
}

if (isset($_POST['email']) &&
    isset($_POST['confirmar-email']) &&
    isset($_POST['senha']) &&
    isset($_POST['confirmar-senha'])) {

    $email = $_POST['email'];
    $confirmarEmail = $_POST['confirmar-email'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmar-senha'];

    $emailValido = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (empty($email)) {
        trataErro('Preencha o email!');
    } else if (strlen($email) > 50) {
        trataErro('O email deve ter até 50 caracteres!');
    } else if (empty($senha)) {
        trataErro('Preencha a senha!');
    } else if (!$emailValido) {
        trataErro('Email inválido!');
    } else if ($email != $confirmarEmail) {
        trataErro('Os emails devem ser iguais!');
    } else if ($senha != $confirmarSenha) {
        trataErro('Senhas precisam ser iguais!');
    } else {
        require_once '../model/conta.class.php';
        require_once '../repository/conta.repository.php';

        $conta = new Conta();
        $conta->email = $email;
        $conta->senha = md5('qi'.$senha.'ab');
    
        $contaRepository = new ContaRepository();
        $resultado = $contaRepository->criaConta($conta);
    
        if ($resultado) {
            criaSucesso('Cadastro finalizado com sucesso!');
            header('location:../view/login.php');
        } else {
            trataErro('Não foi possível cadastrar a conta.');
        }
    }
} else {
    header('location:../view/cadastro.php');
}