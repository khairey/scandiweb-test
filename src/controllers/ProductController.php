<?php

namespace src\controllers;

use src\config\Database;
use src\config\Render;

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
        Render::view('add-product');
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
