<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddUser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body style="background-image: url(https://img.freepik.com/free-vector/gradient-blur-pink-blue-abstract-background_53876-117324.jpg?w=740&t=st=1710478849~exp=1710479449~hmac=c1b2c5635922a7aaf7cef296aa08fd60ee84c8f446efb780c0951b07b2b7289a);">


    <div class="container" style="margin-top: 20px; width: 40%; ">
        <div>
            <h3 style="margin-bottom: 20px; margin-top: 20px;" class="px-3">CRUD OPERATION-ADD USER</h3>
        </div>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="errorhandling.php"> <!-- Change action to your PHP script -->

                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <h6>Name</h6>
                        </label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Your Name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">
                            <h6>Email</h6>
                        </label>
                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter Your Email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">
                            <h6>Country</h6>
                        </label>
                        <input type="text" class="form-control" name="country" placeholder="Enter Your Country">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">
                            <h6>Password</h6>
                        </label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="d-grid gap-2">
                       <a href="read.php"><button type="text" class="btn btn-primary mt-2 ">Cancel</button></a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">You Have Some Errors</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="errorText"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Check if there are errors passed from add_user.php
    if (isset($_GET['error'])) {
        $errors = explode(',', $_GET['error']);
        echo "<script>
                var errorText = '" . implode('<br>', $errors) . "';
                document.getElementById('errorText').innerHTML = errorText;
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
              </script>";
    }
    ?>
</body>

</html>