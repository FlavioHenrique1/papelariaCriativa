<?php
namespace Models;

abstract class ClassConexao{

    protected function conectaDB()
    {
        try {

            $con = new \PDO(
                "mysql:host=" . HOST . ";dbname=" . BD . ";charset=utf8mb4",
                USER,
                PASS,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                ]
            );

            return $con;

        } catch (\PDOException $erro) {

            die("Erro na conexão: " . $erro->getMessage());

        }
    }
}