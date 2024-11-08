<?php

// Start session
session_start();

// Set response type to JSON
header('Content-Type: application/json');

// Include required files
require_once '../config/database.php';
require_once 'service.php';

// Retrieve POST data
$action = $_POST['action'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$rememberMe = $_POST['rememberMe'] ?? false;

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize UserService
$service = new UserService($db);

// Initialize response array
$response = array('status' => 'error', 'message' => 'Invalid action');

// Handle different actions
switch($action){
    case 'login':
        $result = $service->login($email, $password);
        if($result){
            $_SESSION['email'] = $email;

            // Handle "Remember Me" functionality
            if($rememberMe == 'true'){
                setcookie('email', $email, time() + (86400 * 30), "/"); // Expires in 30 days
            }

            $response['status'] = 'ok';
            $response['message'] = 'Hello User, you are logged in as ' . htmlspecialchars($email);
        } else {
            $response['message'] = 'Invalid email or password';
        }
        break;

    case 'logout':
        // Clear session data
        session_unset();
        session_destroy();

        // Clear cookies if set
        if(isset($_COOKIE['email'])){
            setcookie('email', '', time() - 3600, "/");
        }

        $response['status'] = 'ok';
        $response['message'] = 'You have been logged out';
        break;

    case 'register':
        $result = $service->register($email, $password);
        if($result === true){
            $response['status'] = 'ok';
            $response['message'] = 'Registration successful. Redirecting to login page...';
        } else {
            $response['message'] = $result; // Contains specific error message
        }
        break;

    case 'rememberMe':
        // Implement remember me logic here
        // This can be handled via cookies set during login
        $response['status'] = 'ok';
        $response['message'] = 'Remember me functionality not fully implemented.';
        break;

    default:
        $response['message'] = 'Action not recognized';
}

// Output the JSON response
echo json_encode($response);
?>
