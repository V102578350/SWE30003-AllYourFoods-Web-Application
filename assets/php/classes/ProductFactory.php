<?php

include_once 'FreshProduce.php';
include_once 'AnimalProduct.php';
include_once 'Beverage.php';
include_once 'PackagedFood.php';

class ProductFactory {
    public static function create($id, $name, $category, $attributes, $price, $stock, $disabled): Product {
        switch ($category) {
            case 'Fresh Produce':
                return new FreshProduce($id, $name, $category, $attributes['color'], $attributes['weight'], $attributes['origin'], $price, $stock, $disabled);
            case 'Animal Product':
                return new AnimalProduct($id, $name, $category, $attributes['animalType'], $attributes['cut'], $attributes['weight'], $price, $stock, $disabled);
            case 'Beverage':
                return new Beverage($id, $name, $category, $attributes['size'], $attributes['flavor'], $attributes['sugarContent'], $price, $stock, $disabled);
            case 'Packaged Food':
                return new PackagedFood($id, $name, $category, $attributes['expiryDate'], $attributes['ingredients'], $attributes['weight'], $price, $stock, $disabled);
            default:
                throw new Exception("Invalid product type.");
        }
    }
}
