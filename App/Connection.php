<?php

namespace App;

class Connection {

    public static function getDb(){
        try {
            $conn = new \PDO(
                "mysql:host=localhost;dbname=orcamento_pessoal;charset=utf8",
                "root",
                "admin"
            );

            return $conn;
        } catch (\PDOException $e) {
            $e;
        }
    }

}


?>