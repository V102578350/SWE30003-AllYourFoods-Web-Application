<?php
session_start();

include '../classes/DatabaseConnector.php';
include '../classes/Authentication.php';

$database = new DatabaseConnector("localhost", "root", "", "ayhf_db");
$authentication = new Authentication($database);

// Get the form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$address = $_POST['address'];
$username = $_POST['username'];
$password = $_POST['password'];

// Try to register
try {
    $registerResult = $authentication->register($firstname, $lastname, $email, $address, $username, $password);
    $result = $registerResult;
} catch(Exception $e) {
    $result = [
        'status' => 0,
        'message' => 'An error occurred. ' . $e->getMessage()
    ];
}

echo json_encode($result);
?>
