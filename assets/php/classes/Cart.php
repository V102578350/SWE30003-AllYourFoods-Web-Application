<?php

class Cart {
    private $cartItems;

    public function __construct() {
        session_start();
        if(isset($_SESSION['user_cart_item'])) {
            $this->cartItems = $_SESSION['user_cart_item'];
        } else {
            $this->cartItems = [];
        }
    }

    public function getCartItems() {
        $result = [];

        if($this->cartItems !== null) {
            foreach($this->cartItems as $itemId => $count) {
                $result[] = ['itemId' => $itemId, 'count' => $count];
            }
        }

        return $result;
    }

    public function addCartItem($itemId, $qty) {
        $result = array("status" => 1, "message" => "", "cart" => []);
    
        if($qty > 0) {
            if(array_key_exists($itemId, $this->cartItems)) {
                $this->cartItems[$itemId] += $qty;
            } else {
                $this->cartItems[$itemId] = $qty;
            }
        } else {
            $result['status'] = 0;
            $result['message'] = "Quantity must be greater than 0.";
        }
    
        $_SESSION['user_cart_item'] = $this->cartItems;
    
        foreach($this->cartItems as $itemId => $count) {
            $result['cart'][] = ['itemId' => $itemId, 'count' => $count];
        }
    
        return $result;
    }

    public function removeCartItem($itemId, $qty) {
        $result = array("status" => 1, "message" => "");

        if($qty !== 0) {
            if($this->cartItems[$itemId]) {
                $this->cartItems[$itemId] -= $qty;
                if($this->cartItems[$itemId] <= 0) {
                    unset($this->cartItems[$itemId]);
                }
            } else {
                $result['status'] = 0;
                $result['message'] = "Item does not exist in cart.";
            }
        } else {
            $result['status'] = 0;
            $result['message'] = "Quantity must be greater than 0.";
        }

        $_SESSION['user_cart_item'] = $this->cartItems;
        $result['cart'] = $this->cartItems;
        return $result;
    }

    public function clearCart() {
        $this->cartItems = [];
        $_SESSION['user_cart_item'] = $this->cartItems;
    
        $result = [
            'status' => 1,
            'message' => 'Cart cleared successfully.',
            'cart' => $this->cartItems
        ];
    
        return $result;
    }    

}
