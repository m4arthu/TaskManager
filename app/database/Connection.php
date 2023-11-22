<?php
namespace app\database;

use PDO;

// realiza a conexão com  o  banco  de dados necessário um  env na pasta public com as 
// variáveis : DATABAE_NAME, DATABASE_USER,DATABASE_PASSWORD'
class Connection
{
    private static $connect = null;

    public static function getConnection()
    {
        if (!self::$connect) {
            self::$connect = new PDO("mysql:host=localhost;dbname={$_ENV['DATABASE_NAME']}", $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD'], [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
            ]);
        }

        return self::$connect;
    }
}