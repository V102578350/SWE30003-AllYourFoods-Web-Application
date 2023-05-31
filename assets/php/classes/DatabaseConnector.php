<?php

class DatabaseConnector
{
    private $server;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct($server, $username, $password, $database)
    {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->connect();
    }

    private function connect()
    {
        $this->connection = new mysqli($this->server, $this->username, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function executeQuery($query, $params = [])
    {
        if (empty($query)) {
            throw new InvalidArgumentException('Query string cannot be empty.');
        }

        $stmt = $this->connection->prepare($query);

        if ($stmt === false) {
            throw new RuntimeException('Query preparation failed: ' . $this->connection->error);
        }

        if (!empty($params)) {
            $types = '';
            $params_ref = [];

            foreach ($params as $key => $value) {
                $types .= $this->getParamType($value);
                $params_ref[] = &$params[$key];
            }

            $bind_params = array_merge([$types], $params_ref);

            if (!call_user_func_array([$stmt, 'bind_param'], $bind_params)) {
                throw new RuntimeException('Binding parameters failed: ' . $stmt->error);
            }
        }

        if (!$stmt->execute()) {
            throw new RuntimeException('Query execution failed: ' . $stmt->error);
        }

        return $stmt->get_result();
    }

    public function getLastInsertId() {
        return $this->connection->insert_id;
    }

    private function getParamType($value)
    {
        switch (gettype($value)) {
            case 'integer': return 'i';
            case 'double':  return 'd';
            case 'string':  return 's';
            default:        return 'b';
        }
    }

    public function closeConnection()
    {
        $this->connection->close();
    }
}