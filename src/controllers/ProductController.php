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
}
