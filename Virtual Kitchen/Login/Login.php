<?php 
session_start();
include "DB_connect.php";

function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username) || empty($password)) {
        header("Location: LoginPage.php?error=Both fields are required");
        exit();
    }

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify the password against the stored hash
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: LoginPage.php?login=success");
            exit();
        } else {
            header("Location: LoginPage.php?error=Invalid credentials");
            exit();
        }
    } else {
        header("Location: LoginPage.php?error=Invalid credentials");
        exit();
    }
} else {
    header("Location: LoginPage.php");
    exit();
}
?>