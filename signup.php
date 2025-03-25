<?php

// Database connection
$conn = new mysqli("sql8.freesqldatabase.com", "sql8769522", "", "sql8769522");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email already exists
    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email already registered.";
    } else {
        // Insert user into database
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful. <a href='login.html'>Log in here</a>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$conn->close();
?>
