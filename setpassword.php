<?php
session_start();

// Check if the reset_email session variable is set
if (!isset($_SESSION['reset_email'])) {
    // If not set, redirect back to forgot_password.php
    header("Location: forgotpassword.php");
    exit();
}

// Database connection parameters
$host = 'localhost'; // or your database host
$dbname = 'cruddb';
$username = 'root';
$password = '';

// Attempt database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Display error message if connection fails
    die("ERROR: Could not connect. " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate new password
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    if ($newPassword === $confirmPassword) {
        // Update password in the database
        $email = $_SESSION['reset_email'];
        $hashedPassword = md5($newPassword);

        $sql = "UPDATE userdetails SET password = :password WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['password' => $hashedPassword, 'email' => $email]);

        // Redirect to a password reset success page or login page
        header("Location: index.php");
        exit();
    } else {
        $error = "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-image: url(https://img.freepik.com/free-vector/gradient-blur-pink-blue-abstract-background_53876-117324.jpg?w=740&t=st=1710478849~exp=1710479449~hmac=c1b2c5635922a7aaf7cef296aa08fd60ee84c8f446efb780c0951b07b2b7289a);">

    <div class="container" style="width: 60%;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg p-4 mb-5 bg-white rounded mx-auto" style="width: 100%; margin-top: 100px;">
                    <div class="card-body">
                        <h3 class="card-title">Set New Password</h3>
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form id="setPasswordForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm new password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Set Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
