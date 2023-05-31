<?php
include_once 'Product.php';

class FreshProduce implements Product {
    private $id;
    private $name;
    private $category;
    private $color;
    private $weight;
    private $origin;
    private $price;
    private $stock;
    private $disabled;

    public function __construct($id, $name, $category, $color, $weight, $origin, $price, $stock, $disabled) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->color = $color;
        $this->weight = $weight;
        $this->origin = $origin;
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
        if(!empty($this->color)) {
            $details['color'] = $this->color;
        }

        if(!empty($this->weight)) {
            $details['weight'] = $this->weight;
        }

        if(!empty($this->origin)) {
            $details['origin'] = $this->origin;
        }

        return $details;
    }

    public function isDisabled() {
        return $this->disabled;
    }
}
