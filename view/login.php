<?php
require_once '../controller/exibemensagem.controller.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/cadastro.css">
</head>

<body class="container-fluid p-0">
    <main>
        <h2 class="text-center mt-2">Faça login</h2>
        <div class="row m-0 justify-content-center">
            <?php if ($temSucesso) { ?>
                <div class="col-8 mt-2 alert alert-success" role="alert"><?= $sucesso ?></div>
            <?php } else if ($temErro) { ?>
                <div class="col-8 mt-2 alert alert-danger" role="alert"><?= $erro ?></div>
            <?php } ?>
            <!-- TODO: Só pode ver essa tela se não estiver logado -->
            <section id="form-login" class="m-2 col-8">
                <form action="../controller/login.controller.php" method="post">
                    <div class="form-group">
                        <label for="login" class="form-label">Login</label>
                        <input type="email" name="email" id="email" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="senha" id="senha" required class="form-control">
                    </div>
                    <div class="form-group mt-4 text-center">
                        <input type="submit" class="btn btn-primary" value="Entrar">
                        <a href="./cadastro.php" class="btn btn-outline-primary">Criar conta</a>
                    </div>
                </form>
            </section>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>