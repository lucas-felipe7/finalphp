<?php
session_start();

function criaSucesso($mensagem) {
    $_SESSION['sucesso'] = $mensagem;
}

function criaErro($mensagem) {
    $_SESSION['erro'] = $mensagem;
}