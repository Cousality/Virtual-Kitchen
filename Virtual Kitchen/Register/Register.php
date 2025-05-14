<?php
session_start();
include "DB_connect.php";
// trims strips and removes special characters
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $email = validate($_POST['email']);
    // check if it is empty 
    if (empty($username) || empty($password) || empty($email)) {
        header("Location: RegisterPage.php?error=Both fields are required");
        exit();
    }

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: RegisterPage.php?error=Invalid email format");
        exit();
    }

    // Check if username already exists
    $check_sql = "SELECT * FROM users WHERE username = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if ($result->num_rows > 0) {
        header("Location: RegisterPage.php?error=Username already exists");
        exit();
    }
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Use prepared statement to prevent SQL injection
    $insert_sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("sss", $username, $hashed_password, $email);
    
    if ($insert_stmt->execute()) {
        echo "Registration successful!";
        echo "<br><a href='../Login/LoginPage.php'>Login now</a>";
    } else {
        echo "Error: " . $conn->error;
        echo "<br><a href='RegisterPage.php'>Try again</a>";
    }
}

$conn->close();
?>