<?php
include_once 'Product.php';

class PackagedFood implements Product {
    private $id;
    private $name;
    private $category;
    private $expiryDate;
    private $ingredients;
    private $weight;
    private $price;
    private $stock;
    private $disabled;

    public function __construct($id, $name, $category, $expiryDate, $ingredients, $weight, $price, $stock, $disabled) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->expiryDate = $expiryDate;
        $this->ingredients = $ingredients;
        $this->weight = $weight;
        $this->price = $price;
        $this->stock = $stock;
        $this->disabled = $disabled;
    }

    public function getID() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getDetails() {
        $details = [];
        if(!empty($this->ingredients)) {
            $details['ingredients'] = $this->ingredients;
        }

        if(!empty($this->weight)) {
            $details['weight'] = $this->weight;
        }

        if(!empty($this->expiryDate)) {
            $details['expiry_date'] = "Expiry: " . $this->expiryDate;
        }

        return $details;
    }

    public function isDisabled() {
        return $this->disabled;
    }
}
