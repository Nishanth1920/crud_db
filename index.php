<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<div class="container mt-5" style="width: 60%;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Login</h5>
                </div>
                <div class="card-body">
                    <div id="alert" class="alert alert-danger d-none" role="alert"></div>
                    <form id="loginForm" method="post" >
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                            <div class="invalid-feedback">Name is required</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                            <div class="invalid-feedback">Password is required</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#loginForm').submit(function(e) {
            e.preventDefault();
            var name = $('#name').val();
            var password = $('#password').val();
            // console.log(name);
            // console.log(password);
            
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

            // Send AJAX request for login
            $.ajax({
                type: 'POST',
                url: 'login.php',
                data: $(this).serialize(),
                success: function(response) {
                    if (response === 'success') {
                        window.location.href = 'read.php';
                    } else {
                        $('#alert').removeClass('d-none').text(response);
                    }
                }
            });
        });
    });
</script>

</body>
</html>
