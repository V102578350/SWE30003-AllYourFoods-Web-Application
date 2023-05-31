<?php
session_start();

include '../classes/DatabaseConnector.php';
include '../classes/Authentication.php';

$database = new DatabaseConnector("localhost", "root", "", "ayhf_db");
$authentication = new Authentication($database);

try {
    $authentication->logout();
    $result = [
        'status' => 1,
        'message' => "Logout Successful"
    ];
} catch(Exception $e) {
    $result = [
        'status' => 0,
        'message' => 'An error occurred. ' . $e->getMessage()
    ];
}

echo json_encode($result);
?>