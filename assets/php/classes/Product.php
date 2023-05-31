<?php
interface Product {
    public function getID();
    public function getName();
    public function getCategory();
    public function getPrice();
    public function getStock();
    public function getDetails();
    public function isDisabled();
}