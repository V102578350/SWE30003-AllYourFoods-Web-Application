<?php
include 'User.php';

class Authentication {
    private $databaseConnector;
    private $loggedInUser;

    public function __construct(DatabaseConnector $databaseConnector) {
        $this->databaseConnector = $databaseConnector;
        $this->loggedInUser = $this->checkCurrentUser();
    }

    public function register($firstname, $lastname, $email, $address, $username, $password) {
        $result = array("status" => 1, "message" => "");
    
        // Check if the username or email is already taken
        $query = "SELECT COUNT(*) as count FROM users WHERE username = ? OR email = ?";
        $queryResult = $this->databaseConnector->executeQuery($query, [$username, $email]);
        $row = $queryResult->fetch_assoc();
    
        if ($row['count'] > 0) {
            // Update result array for failure
            $result["status"] = 0;
            $result["message"] = "Username or email already exists. Please choose a different username or email.";
            return $result;
        }
    
        // Create a new user
        $query = "INSERT INTO users (firstname, lastname, email, address, username, password) VALUES (?, ?, ?, ?, ?, ?)";
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->databaseConnector->executeQuery($query, [$firstname, $lastname, $email, $address, $username, $hashedPassword]);
    
        // login user after successfull registration
        $this->login($username, $password);
    
        return $result;
    }
    

    public function login($username, $password) {
        $result = array("status" => 1, "message" => "");
    
        // Check if the user exists
        $query = "SELECT * FROM users WHERE username = ?";
        $queryResult = $this->databaseConnector->executeQuery($query, [$username]);
        $row = $queryResult->fetch_assoc();
    
        if ($row && password_verify($password, $row['password'])) {
            $this->loggedInUser = new User($row['id'], $row['firstname'], $row['lastname'], $row['email'], $row['address'], $row['username'], $row['status']);
            session_start();
            $_SESSION['user_id'] = $row['id'];
        } else {
            // Update result array for failure
            $result["status"] = 0;
            $result["message"] = "Invalid username or password.";
            return $result;
        }
    
        return $result;
    }
    

    public function logout() {
        $this->loggedInUser = null;

        session_start();
        $_SESSION = array();
        session_destroy();
    }

    public function getCurrentUser() {
        return $this->loggedInUser;
    }

    private function checkCurrentUser() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            // Fetch the user's information by their id
            $query = "SELECT * FROM users WHERE id = ?";
            $result = $this->databaseConnector->executeQuery($query, [$_SESSION['user_id']]);
            $row = $result->fetch_assoc();
    
            if ($row) {
                return new User($row['id'], $row['firstname'], $row['lastname'], $row['email'], $row['address'], $row['username'], $row['status']);
            }
        }
    
        return null;
    }
    
}
