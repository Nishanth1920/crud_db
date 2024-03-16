<?php
// Start session
session_start();

// Check if name and password are set
if(isset($_POST['name']) && isset($_POST['password'])) {
    // Get input data
    $name = $_POST['name'];
    $cpassword = $_POST['password'];

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = ""; // Your database password
    $dbname = "cruddb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute SQL query to check user credentials
    $sql = "SELECT * FROM userdetails WHERE name='$name' AND password='$cpassword'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        // Login successful
        $_SESSION['loggedin'] = true;
        $_SESSION['name'] = $name;
        echo "success";
    } else {
        // Login failed
        echo "Invalid name or password";
    }

    // Close connection
    $conn->close();
} else {
    // Handle case if name or password are not set
    echo "Please enter both name and password";
}
?>
