<?php
require_once '../controller/exibemensagem.controller.php';

$estaLogado = isset($_SESSION['auth']);

if ($estaLogado) {
    require_once '../model/conta.class.php';
    require_once '../model/usuario.class.php';
    require_once '../repository/usuario.repository.php';

    $conta = unserialize($_SESSION['auth']);

    $repository = new UsuarioRepository();
    $usuario = $repository->recuperaUsuario($conta->id);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu pefil</title>
    <link type="text/css" rel="stylesheet" href="../css/materialize.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <link rel="stylesheet" href="../css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>

<body class="container-fluid p-0">
    <nav>
        <div class="nav-wrapper teal darken-4">
            <a href="#" class="brand-logo center">Bem-vindo, <?= explode(' ', $usuario->nomeCompleto)[0] ?>!</h2></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="./home.php"> Home</a></li>
                <li><a href="./posts.php">Meus posts</a></li>
                <li><a href="./perfil.php">Meu perfil</a></li>
                <li><a href="../controller/logout.controller.php">Sair</a></li>
                <li><a href="https://api.whatsapp.com/send?phone=51992573993&text=Gostaria de saber quais animais estão disponíveis!">Contato</a></li>
            </ul>
        </div>
    </nav>
    <main class="container-fluid">
        <div class="col px-3">
            <section>
                <h2>Perfil</h2>
                <?php if ($temErro) { ?>
                    <div class="mt-2 alert alert-danger" role="alert"><?= $erro ?></div>
                <?php } else if ($temSucesso) { ?>
                    <div class="mt-2 alert alert-success" role="alert"><?= $sucesso ?></div>
                <?php } ?>
                <form action="../controller/atualizaperfil.controller.php" method="post">
                    <div class="form-group center">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" disabled value="<?= $conta->email ?>">
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="senha-antiga" class="form-label">Senha atual</label>
                            <input type="password" name="senha-antiga" id="senha-antiga" class="form-control">
                        </div>
                        <div class="col">
                            <label for="nova-senha" class="form-label">Nova senha</label>
                            <input type="password" name="nova-senha" id="nova-senha" class="form-control">
                        </div>
                        <div class="col">
                            <label for="confirmar-senha" class="form-label">Confirme sua nova senha</label>
                            <input type="password" name="confirmar-senha" id="confirmar-senha" class="form-control">
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="nome-completo" class="form-label">Nome completo</label>
                        <input type="text" name="nome-completo" id="nome-completo" class="form-control" required maxlength="50" value="<?= $usuario->nomeCompleto ?>">
                    </div>
                    <div class="form-group mt-2">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" required minlength="11" maxlength="11" value="<?= $usuario->CPF ?>">
                    </div>

                  

                    <div class="form-group mt-4">
                        <input type="submit" class="btn btn-primary" value="Atualizar">
                    </div>
                </form>
            </section>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>