<?php

/**
 * Database connection class.
 */
class Database {
    private $host = "db";
    private $db_name = "app_db";
    private $username = "user";
    private $password = "password";
    public $conn;

    /**
     * Establish a database connection.
     * @return PDO|null
     */
    public function getConnection(): ?PDO {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username, 
                $this->password
            );
            // Set PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Database could not be connected: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
