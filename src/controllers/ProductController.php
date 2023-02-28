<?php

namespace src\controllers;

use src\config\Database;
use src\config\Render;
use src\models\Product;
use src\models\ProductType\DVD;

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
        $errors=array();
        $db = new Database();
        $product = new Product([]);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $productData = [];
            foreach ($_POST as $key => $value) {
                $productData[$key] = $value;
            }
            
            $db = new Database();
            // $product = new $_POST['type']($productData);
            $cname = "src\\models\\ProductType\\" . $_POST['type'];
            if (class_exists($cname)) 
                $product = new $cname($productData);
            $product->validateData($productData);
            $errors[] = $product->validateSku($product->sku);
            
            if(count($errors)==1){
                $db->createProduct($product);
                header('Location: /scandiweb-test/');
                exit;
            }    
        }
        Render::view('add-product', [
            'product' => $product,
            'errors' => $errors,
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
    public static function getSku()
    {
        header('Content-Type: application/json');
        $db = new Database();
        echo json_encode($db->getProduct($_POST['sku']));
    }
}
