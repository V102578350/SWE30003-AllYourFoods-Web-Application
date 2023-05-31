<?php

include 'Cart.php';

class User {
    public $id;
    public $firstname;
    public $lastname;
    public $email;
    public $address;
    public $username;
    public $status;
    public $cart;

    public function __construct($id, $firstname, $lastname, $email, $address, $username, $status) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->address = $address;
        $this->username = $username;
        $this->status = $status;
        $this->cart = new Cart();
    }
}
