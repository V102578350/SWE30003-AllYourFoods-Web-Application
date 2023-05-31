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

if(isset($_POST['itemId']) && isset($_POST['qty'])) {
    $current_user = $authentication->getCurrentUser();

    if($current_user !== null) {

        try {
            $result = $current_user->cart->removeCartItem(
                intval($_POST['itemId']),
                intval($_POST['qty'])
            );
        } catch (Exception $e) {
            $result = [
                'status' => 0,
                'message' => 'An error occured: ' . $e->getMessage()
            ]; 
        }

    } else {
        $result = [
            'status' => 0,
            'message' => 'User not logged in. Please log in before modifying cart state.'
        ]; 
    }
}

echo json_encode($result);