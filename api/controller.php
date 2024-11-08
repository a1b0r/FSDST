<?php

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
            $response['status'] = 'ok';
            $response['message'] = 'Hello User, you are logged in as ' . htmlspecialchars($email);
            // Implement session or cookie logic here if needed
        } else {
            $response['message'] = 'Invalid email or password';
        }
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

    case 'logout':
        // Implement logout logic here
        $response['status'] = 'ok';
        $response['message'] = 'You have been logged out';
        break;

    case 'rememberMe':
        // Implement remember me logic here
        $response['status'] = 'ok';
        $response['message'] = 'Remember me functionality';
        break;

    default:
        $response['message'] = 'Action not recognized';
}

// Output the JSON response
echo json_encode($response);
?>
