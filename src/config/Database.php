<?php

namespace src\config;

use PDO;
use src\models\Product;

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
                "CREATE DATABASE scandiweb_db;USE scandiweb_db;
                CREATE TABLE `products` (
                    `sku` varchar(255) COLLATE utf8_bin NOT NULL,
                    `name` varchar(255) COLLATE utf8_bin NOT NULL,
                    `price` float NOT NULL,
                    `type` varchar(255) COLLATE utf8_bin NOT NULL,
                    `value` varchar(255) COLLATE utf8_bin NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
                INSERT INTO `products` (`sku`, `name`, `price`, `type`, `value`) VALUES
                    ('IJSC7687', 'PHP Best Practice', 250, 'Book', 'Weight: 1 KG'),
                    ('IUEWC765', 'WEB Deveolpment DISC', 20, 'DVD', 'Size: 1024 MB'),
                    ('UYG7834', 'System Design', 15, 'Book', 'Size: 0.9 KG'),
                    ('CASD756', 'Soft Skills DISC', 30, 'DVD', 'Size: 800 MB'),
                    ('oiefjr233', 'Table', 40, 'Furniture', 'Dimensions: 200x150x100 CM');
                ALTER TABLE `products`
                    ADD PRIMARY KEY (`sku`);
                COMMIT;"
            );
            $statement->execute();
            $statement->closeCursor();
        }
        $this->pdo->query("USE scandiweb_db;");
    }

    public function getProducts()
    {
        $statement = $this->pdo->prepare('SELECT * FROM products ORDER BY sku');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteProduct($sku)
    {
        $statement = $this->pdo->prepare('DELETE FROM products WHERE sku = :sku');
        $statement->bindValue(':sku', $sku);

        return $statement->execute();
    }
    public function createProduct(Product $product)
    {
        $statement = $this->pdo->prepare("INSERT INTO products (sku, name, price, type, value)
                VALUES (:sku, :name, :price, :type, :value)");
        $statement->bindValue(':sku', $product->sku);
        $statement->bindValue(':name', $product->name);
        $statement->bindValue(':price', $product->price);
        $statement->bindValue(':type', $product->type);
        $statement->bindValue(':value', $product->value);
        $statement->execute();
    }
}
