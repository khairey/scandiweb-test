<?php

namespace src\controllers;

use src\config\Database;
use src\config\Render;
use src\models\Product;

class ProductController
{
    public static function index()
    {
        $db = new Database();
        Render::view('home', [
            'products' => $db->getProducts()
        ]);
    }
    public static function addProduct()
    {
        $db = new Database();
        $product = new Product;
        Render::view('add-product', [
            'product' => $product
        ]);
    }
    public static function deleteProducts()
    {
        if ($_POST) {
            $db = new Database();
            foreach ($_POST as $key => $value) {
                $db->deleteProduct($key);
            }
        }
        header('Location: /scandiweb-test');
    }
}
