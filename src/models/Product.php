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
        $errors = [];
        if ($this->validateSku()) {
            $errors[] = $this->validateSku();
        }
        if ($this->validateName()) {
            $errors[] = $this->validateName();
        }
        if ($this->validatePrice()) {
            $errors[] = $this->validatePrice();
        }
        if ($this->validateType()) {
            $errors[] = $this->validateType();
        }
        if ($this->validateValue()) {
            $errors[] = $this->validateValue();
        }
        return $errors;
    }

    private function validateName()
    {
        if(!$this->data['name']) {
            return "Name was not provided!";
        }

        if (trim($this->data['name']) === '') {
            return "Invalid name!";
        }

        $this->name = $this->data['name'];
        return "";
    }
    private function validateType()
    {
        if(!$this->data['type']) {
            return "Type was not provided!";
        }

        if(!in_array($this->data['type'], $this::$types)){
            return "Invalid type!";
        }

        $this->type = $this->data['type'];
        return "";
    }

    private function validatePrice()
    {
        if(!$this->data['price']) {
            return "Price was not provided!";
        }

        if (!filter_var($this->data['price'], FILTER_VALIDATE_FLOAT) || !(strlen($this->data['price']) > 0) || !(floatval($this->data['price']) >= 0)) {
            return "Invalid price!";
        }
        
        $this->price = floatval($this->data['price']);
        return "";
        
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
