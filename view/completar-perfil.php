<?php
require_once '../controller/exibemensagem.controller.php';
?>
<link rel="stylesheet" href="../css/cadastro.css">
<?php
$estaLogado = isset($_SESSION['auth']);

if ($estaLogado) {
    require_once '../model/conta.class.php';
    require_once '../model/usuario.class.php';
    require_once '../repository/usuario.repository.php';

    $conta = unserialize($_SESSION['auth']);

    $usuarioRepository = new UsuarioRepository();
    $usuario = $usuarioRepository->recuperaUsuario($conta->id);

    if ($usuario != null) {
        header('location:./home.php');
    }
} else {
    header('location:./login.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completar perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="container-fluid p-0">
    <main>
        <h2 class="text-center mt-2">Conclua o cadastro</h2>
        <div class="row m-0 justify-content-center">
            <?php if ($temErro) { ?>
                <div class="col-8 mt-2 alert alert-danger" role="alert"><?= $erro ?></div>
            <?php } ?>
            <!-- TODO: Só pode ver essa tela se estiver logado E não tiver usuário -->
            <section id="form-perfil" class="m-2 col-8">
                <form action="../controller/criausuario.controller.php" method="post">
                    <div class="form-group mt-2">
                        <label for="nome-completo" class="form-label">Nome completo</label>
                        <input type="text" name="nome-completo" id="nome-completo" class="form-control" required maxlength="50">
                    </div>
                    <div class="form-group mt-2">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="number" name="cpf" id="cpf" class="form-control" required maxlength="11" minlength="11">
                    </div>
                    <div class="form-group mt-2">
                        <p>Tipo de conta</p>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="tipoconta" id="a" value="A" class="form-check-input" required>
                            <label for="a" class="form-check-label">Quero adotar</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="tipoconta" id="d" value="D" class="form-check-input">
                            <label for="d" class="form-check-label">Quero doar</label>
                        </div>
                        <div class="form-check form-check-inline">
                        </div>
                    </div>
                    <div class="form-group mt-4 text-center">
                        <input type="submit" class="btn btn-primary" value="Finalizar cadastro">
                    </div>
                </form>
            </section>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>