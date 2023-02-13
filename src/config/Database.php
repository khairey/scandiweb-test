<?php

namespace src\config;

use PDO;

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . DB_HOST . ';port=3306;', DB_USER, DB_PASSWORD);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // check if scandiweb_db found
        $statement = $this->pdo->query("
        SELECT COUNT(*) 
        FROM INFORMATION_SCHEMA.SCHEMATA WHERE 
        SCHEMA_NAME = 'scandiweb_db';");
        if (!$statement->fetchColumn()) {
            // create scandiweb_db and add values
            $statement = $this->pdo->prepare(
                "CREATE DATABASE scandiweb_db;USE scandiweb_db;"
            );
            $statement->execute();
            $statement->closeCursor();
        }
        $this->pdo->query("USE scandiweb_db;");
    }
}
