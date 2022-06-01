<?
require_once '../controller/exibemensagem.controller.php';
require_once '../controller/auth.controller.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela inicial</title>
    <link type="text/css" rel="stylesheet" href="../css/materialize.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <link rel="stylesheet" href="../css/home.css">
</head>

<body class="container-fluid p-0">
    <nav>
        <div class="nav-wrapper teal darken-4">
            <a href="#" class="brand-logo center">Abrigo de Animais</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="./home.php"> Home</a></li>
                <li><a href="./posts.php">Meus posts</a></li>
                <li><a href="./perfil.php">Meu perfil</a></li>
                <li><a href="../controller/logout.controller.php">Sair</a></li>
                <li><a href="https://api.whatsapp.com/send?phone=51992573993&text=Gostaria de saber quais animais estão disponíveis!">Contato</a></li>
            </ul>
        </div>
    </nav>
    <main class="container-fluid center">
        <div class="col px-3">
            <section>
                <h2>Homepage</h2>
                <form action="../controller/criapost.controller.php" method="post">
                    <div class="center">
                        <label class="form-label" for="post">O que você está procurando?</label>
                        <textarea name="post" id="post" rows="16" class="form-control" required></textarea>
                    </div>

                    <p>
                        <label>
                            <input name="group1" type="radio" value="cachorro" />
                            <span>Cachorro</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input name="group1" type="radio" value="gato" checked />
                            <span>Gato</span>
                        </label>
                    </p>


                    <div class="center">
                        <input type="submit" value="Enviar" name="btn" class="waves-effect waves-light btn">
                    </div>
                </form>
            </section>
            <div class="col px-3">
                <h2>Animais </h2>
                <?php
                require_once '../controller/timeline.controller.php';

                foreach ($posts as $post) {
                ?>
                    <div class="row">
                        <div class="col s12 m7">
                            <div class="card">
                                <p class="card-title">
                                    <strong><?= $post->nomeCompleto ?></strong>
                                </p>
                                <div class="card-image">
                                    <img src="https://i.kym-cdn.com/photos/images/original/001/741/230/b06.jpg">
                                </div>
                                <div class="card-content">
                                    <?= $post->conteudo ?>
                                </div>
                                <div class="card-action">
                                    <p class="card-subtitle text-muted mb-3">
                                        <?= $post->dataHora ?>
                                    </p>

                                    <a href="../controller/curtir.controller.php?id=<?= $post->id ?>" class="btn">❤</a>
                                    <span class="link-secondary"><?= $post->curtidas ?></span>
                                    <a href="https://api.whatsapp.com/send?phone=51992573993">Quero adotar</a>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                </section>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="js/materialize.min.js"></script>
</body>

</html>