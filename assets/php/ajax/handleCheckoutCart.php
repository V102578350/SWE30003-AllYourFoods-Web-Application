<?php
session_start();

include '../classes/DatabaseConnector.php';
include '../classes/Authentication.php';
include '../classes/Order.php';

$database = new DatabaseConnector("localhost", "root", "", "ayhf_db");
$order = new Order($database);

// Create a default result array with a failure state
$result = [
    'status' => 0,
    'message' => 'An error occurred.'
];

try {
    // Process the checkout
    $checkoutResult = $order->checkout();
    $result = $checkoutResult;
} catch(Exception $e) {
    $result = [
        'status' => 0,
        'message' => 'An error occurred. ' . $e->getMessage()
    ];
}

// Output the result as a JSON string
echo json_encode($result);
?>