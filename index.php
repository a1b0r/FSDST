<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <!-- Include Bootstrap CSS for styling -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    >
</head>

<body>

<div class="container mt-5">
    <h2 class="text-center">Login</h2>
    <!-- Login Form -->
    <form id="loginForm">
        <!-- Email Field -->
        <div class="form-group">
            <label for="email">Email address</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              required
            >
        </div>
        <!-- Password Field -->
        <div class="form-group">
            <label for="password">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
              required
            >
        </div>
        <!-- Remember Me Checkbox -->
        <div class="form-check">
            <input
              type="checkbox"
              class="form-check-input"
              id="rememberMe"
              name="rememberMe"
            >
            <label class="form-check-label" for="rememberMe">Remember Me</label>
        </div>
        <!-- Login Button -->
        <button type="submit" class="btn btn-primary" id="loginBtn">Login</button>
    </form>

    <!-- Registration Link -->
    <p class="mt-3">
        Don't have an account? <a href="register.php">Register here</a>.
    </p>

    <!-- Message Display -->
    <div id="message" class="mt-3"></div>
</div>

<!-- Include jQuery and Bootstrap JS for AJAX and interactivity -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// JavaScript/jQuery code to handle form submission via AJAX
$(document).ready(function(){
    $('#loginForm').submit(function(event){
        event.preventDefault(); // Prevent default form submission

        $.ajax({
            url: '/api/controller.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'login',
                email: $('#email').val(),
                password: $('#password').val(),
                rememberMe: $('#rememberMe').is(':checked')
            },
            success: function(response){
                if(response.status == 'ok'){
                    $('#message').html(
                      '<div class="alert alert-success">' + response.message + '</div>'
                    );
                    // Redirect to the dashboard or home page
                    setTimeout(function(){
                        window.location.href = 'home.php';
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
