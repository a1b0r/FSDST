<!-- register.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <!-- Include Bootstrap CSS for styling -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    >
</head>

<body>

<div class="container mt-5">
    <h2 class="text-center">Register</h2>
    <!-- Registration Form -->
    <form id="registerForm">
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
        <!-- Confirm Password Field -->
        <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input
              type="password"
              class="form-control"
              id="confirmPassword"
              name="confirmPassword"
              required
            >
        </div>
        <!-- Register Button -->
        <button type="submit" class="btn btn-primary" id="registerBtn">Register</button>
    </form>

    <!-- Message Display -->
    <div id="message" class="mt-3"></div>
</div>

<!-- Include jQuery and Bootstrap JS for AJAX and interactivity -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// JavaScript/jQuery code to handle form submission via AJAX
$(document).ready(function(){
    $('#registerForm').submit(function(event){
        event.preventDefault(); // Prevent default form submission

        // Get form data
        var email = $('#email').val();
        var password = $('#password').val();
        var confirmPassword = $('#confirmPassword').val();

        // Simple client-side validation
        if(password !== confirmPassword){
            $('#message').html(
              '<div class="alert alert-danger">Passwords do not match.</div>'
            );
            return;
        }

        $.ajax({
            url: '/api/controller.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'register',
                email: email,
                password: password
            },
            success: function(response){
                if(response.status == 'ok'){
                    $('#message').html(
                      '<div class="alert alert-success">' + response.message + '</div>'
                    );
                    // Redirect to login page after successful registration
                    setTimeout(function(){
                        window.location.href = '/index.php';
                    }, 2000);
                } else {
                    $('#message').html(
                      '<div class="alert alert-danger">' + response.message + '</div>'
                    );
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                $('#message').html(
                  '<div class="alert alert-danger">An error occurred: ' + textStatus + '</div>'
                );
                console.log('Error details:', textStatus, errorThrown);
                console.log('Response:', jqXHR.responseText);
            }
        });
    });
});
</script>

</body>
</html>
