<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD-Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body style="background-image: url(https://img.freepik.com/free-vector/gradient-blur-pink-blue-abstract-background_53876-117324.jpg?w=740&t=st=1710478849~exp=1710479449~hmac=c1b2c5635922a7aaf7cef296aa08fd60ee84c8f446efb780c0951b07b2b7289a);">

    <div class="container" style="width: 60%;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4 mb-5 bg-white rounded mx-auto" style="width: 100%; margin-top: 100px;">
                    <div class="card-body">
                        <h3 class="card-title">CRUD-Login</h3><br>
                        <div id="alert" class="alert alert-warning d-none" role="alert"></div>
                        <form id="loginForm" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Username</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="@ Username">
                                <div class="invalid-feedback">Name is required</div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <div class="invalid-feedback">Password is required</div>
                            </div>
                            <!-- CAPTCHA Input -->
                            <div id="countryContainer" class="mb-3 d-none">
                                <label for="captcha" class="form-label">Country</label>
                                <input type="text" class="form-control" id="country" name="country" placeholder="What is your country?">
                                <div class="invalid-feedback">Country is required</div>
                            </div>

                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                        <!-- Forgot Password Link -->
                        <div class="mt-3">
                            <a href="forgotpassword.php">Forgot Password?</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var failedAttempts = 0;
            var maxAttempts = 3; // Maximum number of allowed failed attempts

            $('#loginForm').submit(function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var password = $('#password').val();
                var country = $('#country').val(); // Captcha input value

                // Validate inputs
                if (name.trim() === '') {
                    $('#name').addClass('is-invalid');
                    return;
                }
                $('#name').removeClass('is-invalid');

                if (password.trim() === '') {
                    $('#password').addClass('is-invalid');
                    return;
                }
                $('#password').removeClass('is-invalid');

                // Check if CAPTCHA is required
                if (failedAttempts >= maxAttempts) {
                    if (country.trim() === '') {
                        $('#country').addClass('is-invalid');
                        return;
                    }
                    $('#country').removeClass('is-invalid');
                }

                // Send AJAX request for login
                $.ajax({
                    type: 'POST',
                    url: 'login.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response === 'success') {
                            window.location.href = 'read.php';
                        } else {
                            failedAttempts++;
                            if (failedAttempts >= maxAttempts) {
                                // Display CAPTCHA if max attempts reached
                                $('#countryContainer').removeClass('d-none');
                            }
                            $('#alert').removeClass('d-none').text(response);
                        }
                    }
                });
            });
        });
    </script>



</body>

</html>