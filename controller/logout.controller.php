<?php
require_once './criamensagem.controller.php';

unset($_SESSION['auth']);
criaSucesso('Logout realizado com sucesso!');
header('location:../view/login.php');
