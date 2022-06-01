<?php
session_start();

$temSucesso = isset($_SESSION['sucesso']);
$temErro = isset($_SESSION['erro']);

if ($temSucesso) {
    $sucesso = $_SESSION['sucesso'];
    unset($_SESSION['sucesso']);
} else if ($temErro) {
    $erro = $_SESSION['erro'];
    unset($_SESSION['erro']);
}