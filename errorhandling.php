<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $cpassword = $_POST['password'];

    // Validate form data
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
    }
    if (empty($country)) {
        $errors[] = "Country is required";
    }
    if (empty($cpassword)) {
        $errors[] = "Password is required";
    }

    // If there are validation errors, redirect back to index.php with errors
    if (!empty($errors)) {
        $errorString = implode(',', $errors);
        header("Location: adduser.php?error=$errorString");
        exit();
    } else {
        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cruddb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to insert data into the table
        $insert = "INSERT INTO userdetails (name, email, country, password)
                VALUES ('$name', '$email', '$country', '$cpassword')";

        // Execute SQL statement
        if ($conn->query($insert) === TRUE) {
            // echo "New record created successfully";
            header("Location: read.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
}
?>
