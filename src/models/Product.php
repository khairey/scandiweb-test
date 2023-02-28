<?php

namespace src\models;

use src\config\Database;

class Product
{
    public static array $types = ['DVD', 'Book', 'Furniture'];
    public string $sku;
    public string $name;
    public float $price;
    public string $type;
    public string $value;
    public array $data;

    public function __construct($input)
    {
        $this->data = $input;
    }

    public function validateData()
    {
        if($this->data['sku']) {
            $this->sku = $this->data['sku'];
        }
        if($this->data['name']) {
            $this->name = $this->data['name'];
        }
        if($this->data['price']) {
            $this->price = $this->data['price'];
        }
        if($this->data['type']) {
            $this->type = $this->data['type'];
        }
        if ($this->validateValue()) {
            $errors[] = $this->validateValue();
        }
        return $errors;
    }

    public function validateSku()
    {
        if(!$this->data['sku']) {
            return "SKU was not provided!";
        }

        $db = new Database();
        if ($db->getProduct($this->data['sku'])) {
            return "SKU already taken!";
        }

        $this->sku = $this->data['sku'];
        return "";
    }
    protected function  validateValue(){}

}
