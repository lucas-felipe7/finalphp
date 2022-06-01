<?php

class Conexao extends PDO {

    private static $instancia;

    private function __construct() {
        $dsn = 'mysql:host=localhost;dbname=abrigoanimais';
        $usuario = 'root';
        $senha = '';

        parent::__construct($dsn, $usuario, $senha);
    }

    public static function getInstancia() {
        if (self::$instancia == null) {
            self::$instancia = new Conexao();
        }

        return self::$instancia;
    }
}