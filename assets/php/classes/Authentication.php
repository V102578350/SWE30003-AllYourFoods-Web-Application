<?php

class Authentication {
    private $databaseConnector;
    private $loggedInUser;

    public function __construct(DatabaseConnector $databaseConnector) {
        $this->databaseConnector = $databaseConnector;
        $this->loggedInUser = null;
    }

    public function register($username, $password) {
        // Check if the username is already taken
        $query = "SELECT COUNT(*) as count FROM users WHERE username = ?";
        $result = $this->databaseConnector->executeQuery($query, [$username]);
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            throw new Exception("Username already exists. Please choose a different username.");
        }

        // Create a new user
        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->databaseConnector->executeQuery($query, [$username, $hashedPassword]);

        // Optionally, you can log in the user after successful registration
        $this->login($username, $password);
    }

    public function login($username, $password) {
        // Check if the user exists
        $query = "SELECT * FROM users WHERE username = ?";
        $result = $this->databaseConnector->executeQuery($query, [$username]);
        $row = $result->fetch_assoc();

        if ($row && password_verify($password, $row['password'])) {
            // Set the logged-in user
            $this->loggedInUser = new User($row['username'], $row['password']);
            // Start the user session or perform any other necessary operations
            session_start();
            $_SESSION['username'] = $username;
        } else {
            throw new Exception("Invalid username or password.");
        }
    }

    public function logout() {
        // Clear the logged-in user and end the session
        $this->loggedInUser = null;
        session_destroy();
    }

    public function getLoggedInUser() {
        return $this->loggedInUser;
    }
}
