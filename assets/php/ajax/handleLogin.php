<?php
session_start();

include '../classes/DatabaseConnector.php';
include '../classes/Authentication.php';

$database = new DatabaseConnector("localhost", "root", "", "ayhf_db");
$authentication = new Authentication($database);

// Get the form data
$username = $_POST['username'];
$password = $_POST['password'];

// Create a result array with a default failure state

try {
    $loginResult = $authentication->login($username, $password);
    $result = $loginResult;
} catch(Exception $e) {
    $result = [
        'status' => 0,
        'message' => 'An error occurred. ' . $e->getMessage()
    ];
}

echo json_encode($result);
?>