<?php
include_once 'Product.php';

class Beverage implements Product {
    private $id;
    private $name;
    private $category;
    private $size;
    private $flavor;
    private $sugarContent;
    private $price;
    private $stock;
    private $disabled;

    public function __construct($id, $name, $category, $size, $flavor, $sugarContent, $price, $stock, $disabled) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->size = $size;
        $this->flavor = $flavor;
        $this->sugarContent = $sugarContent;
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
        if(!empty($this->size)) {
            $details['size'] = $this->size;
        }

        if(!empty($this->flavor)) {
            $details['flavor'] = $this->flavor;
        }

        if(!empty($this->sugarContent)) {
            $details['sugar_content'] = $this->sugarContent;
        }

        return $details;
    }

    public function isDisabled() {
        return $this->disabled;
    }
}
