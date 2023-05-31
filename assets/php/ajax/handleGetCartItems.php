<?php
session_start();

include '../classes/DatabaseConnector.php';
include '../classes/Authentication.php';

$database = new DatabaseConnector("localhost", "root", "", "ayhf_db");
$authentication = new Authentication($database);

$result = [
    'status' => 1,
    'message' => ''
];

$current_user = $authentication->getCurrentUser();

if($current_user !== null) {

    try {
        $result['cart'] = $current_user->cart->getCartItems();
    } catch (Exception $e) {
        $result = [
            'status' => 0,
            'message' => 'An error occured: ' . $e->getMessage()
        ]; 
    }

}

echo json_encode($result);