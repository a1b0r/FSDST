<?php

/**
 * Service class to handle business logic related to users.
 */
class UserService {
    private $conn;

    /**
     * Constructor to initialize the database connection.
     * @param PDO $db
     */
    public function __construct(PDO $db){
        $this->conn = $db;
    }

    /**
     * Authenticate the user with provided credentials.
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function login(string $email, string $password): bool {
        // Validate input parameters
        if(empty($email) || empty($password)){
            return false;
        }

        // Prepare SQL statement to fetch user
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);

        // Bind email parameter
        $stmt->bindParam(':email', $email);

        // Execute the statement
        $stmt->execute();

        // Fetch the user record
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user){
            // Verify the password
            if(password_verify($password, $user['password'])){
                return true;
            }
        }

        return false;
    }

    /**
     * Register a new user with email and password.
     * @param string $email
     * @param string $password
     * @return bool|string
     */
    public function register(string $email, string $password) {
        // Validate input parameters
        if(empty($email) || empty($password)){
            return 'Email and password are required.';
        }

        // Check if the user already exists
        $query = "SELECT id FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if($stmt->fetch(PDO::FETCH_ASSOC)){
            return 'User already exists.';
        }

        // Hash the user's password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert new user into the database
        $query = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        // Execute the insert statement
        if($stmt->execute()){
            return true;
        } else {
            return 'Registration failed. Please try again.';
        }
    }
}
?>
