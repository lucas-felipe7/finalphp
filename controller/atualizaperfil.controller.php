<?php
require_once '../controller/criamensagem.controller.php';

function trataErro($mensagem)
{
    criaErro($mensagem);
    header('location:../view/perfil.php');
}

$erro;
$sucesso;

if (
    isset($_POST['senha-antiga']) &&
    isset($_POST['nova-senha']) &&
    isset($_POST['confirmar-senha']) &&
    isset($_POST['nome-completo']) &&
    isset($_POST['cpf'])
) {

    $senhaAntiga = $_POST['senha-antiga'];
    $novaSenha = $_POST['nova-senha'];
    $confirmaSenha = $_POST['confirmar-senha'];
    $nomeCompleto = ucwords(strtolower($_POST['nome-completo']));
    $cpf = $_POST['cpf'];

    if (!empty($senhaAntiga) && !empty($novaSenha) && !empty($confirmaSenha)) {
        if ($novaSenha == $confirmaSenha) {
            require_once '../model/conta.class.php';

            $senhaAntiga = md5('qi' . $senhaAntiga . 'ab');

            $conta = unserialize($_SESSION['auth']);

            if ($senhaAntiga == $conta->senha) {
                require_once '../repository/conta.repository.php';

                $novaSenha = md5('qi' . $novaSenha . 'ab');
                $repository = new ContaRepository();

                $resultado = $repository->atualizaConta($conta->id, $novaSenha);

                if ($resultado) {
                    $conta->senha = $novaSenha;
                    $_SESSION['auth'] = serialize($conta);
                } else {
                    $erro = 'Nao foi possível alterar a senha';
                }
            } else {
                $erro = 'Senha antiga inválida';
            }
        } else {
            $erro = 'As senhas precisam ser iguais';
        }
    }

    if ($erro != null) {
        trataErro($erro);
        return;
    }

    if (!empty($nomeCompleto) && !empty($cpf)) {
        if (strlen($nomeCompleto) > 50) {
            $erro = 'Preencha o nome corretamente';
        } else if (strlen($cpf) != 11) {
            $erro = 'Preencha o CPF corretamente';
        } else {

            require_once '../repository/usuario.repository.php';

            $repository = new UsuarioRepository();

            $resultado = $repository->atualizaUsuario(
                $nomeCompleto,
                $tipoConta,
                $cpf,
                $conta->id
            );

            if (!$resultado) {
                $erro = 'Nao foi possível atualizar os seus dados.';
            }
        }
    }

    if ($erro == null) {
        criaSucesso('Dados atualizados!');
        header('location:../view/perfil.php');
    } else {
        trataErro($erro);
    }
} else {
    header('location:../view/perfil.php');
}
