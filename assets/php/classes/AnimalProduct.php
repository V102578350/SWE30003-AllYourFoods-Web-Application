<?php

include_once 'Product.php';

class AnimalProduct implements Product {
    private $id;
    private $name;
    private $category;
    private $animalType;
    private $cut;
    private $weight;
    private $price;
    private $stock;
    private $disabled;

    public function __construct($id, $name, $category, $animalType, $cut, $weight, $price, $stock, $disabled) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->animalType = $animalType;
        $this->cut = $cut;
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
        if(!empty($this->animalType)) {
            $details['animal_type'] = $this->animalType;
        }

        if(!empty($this->cut)) {
            $details['cut'] = $this->cut;
        }

        if(!empty($this->weight)) {
            $details['weight'] = $this->weight;
        }

        return $details;
    }

    public function isDisabled() {
        return $this->disabled;
    }
}
