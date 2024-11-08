<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <!-- Include Bootstrap CSS for styling -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    >
</head>

<body>

<div class="container mt-5">
    <h2 class="text-center">Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></h2>
    <!-- Logout Button -->
    <form id="logoutForm">
        <button type="submit" class="btn btn-danger mt-3">Logout</button>
    </form>
    <!-- Message Display -->
    <div id="message" class="mt-3"></div>
</div>

<!-- Include jQuery and Bootstrap JS for AJAX and interactivity -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// JavaScript/jQuery code to handle logout via AJAX
$(document).ready(function(){
    $('#logoutForm').submit(function(event){
        event.preventDefault(); // Prevent default form submission

        $.ajax({
            url: '/api/controller.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'logout'
            },
            success: function(response){
                if(response.status == 'ok'){
                    $('#message').html(
                      '<div class="alert alert-success">' + response.message + '</div>'
                    );
                    // Redirect to login page
                    setTimeout(function(){
                        window.location.href = 'index.php';
                    }, 2000);
                } else {
                    $('#message').html(
                      '<div class="alert alert-danger">' + response.message + '</div>'
                    );
                }
            },
            error: function(){
                $('#message').html(
                  '<div class="alert alert-danger">An error occurred.</div>'
                );
            }
        });
    });
});
</script>

</body>
</html>
