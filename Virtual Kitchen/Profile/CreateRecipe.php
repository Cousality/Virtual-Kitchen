<?php
session_start();
include "DB_connect.php";

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../Login/LoginPage.php?error=Please log in to create recipes");
    exit();
}

// Get user ID from session
$username = $_SESSION['username'];
$user_query = "SELECT uid FROM users WHERE username = ?";
$user_stmt = $conn->prepare($user_query);
$user_stmt->bind_param("s", $username);
$user_stmt->execute();
$user_result = $user_stmt->get_result();

if ($user_result->num_rows === 1) {
    $user_row = $user_result->fetch_assoc();
    $user_id = $user_row['uid'];
} else {
    echo "Error: Unable to retrieve user ID.";
    exit();
}


// Function to validate and sanitize input data
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input fields
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $type = validate($_POST['type']);
    $cooking_time = validate($_POST['cooking-time']);
    $instructions = validate($_POST['instructions']);
    
    // Validate required fields
    if (empty($name) || empty($description) || empty($type) || empty($cooking_time) || empty($instructions)) {
        echo "All fields are required";
        exit();
    }
    
    // Process ingredients array and convert to JSON
    $ingredients = [];
    if (isset($_POST['ingredients']) && is_array($_POST['ingredients'])) {
        foreach ($_POST['ingredients'] as $ingredient) {
            if (!empty(validate($ingredient))) {
                $ingredients[] = validate($ingredient);
            }
        }
    }
    $ingredients_json = json_encode($ingredients);
    
    // Handle image upload if present
    $image_path = "basicpancakes.jpg";
	if(isset($_FILES['uploaded_file']) && $_FILES['uploaded_file']['error'] == 0) {
        // Create images directory if it doesn't exist
        $upload_dir = "../images/";
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        // Get file info and generate unique filename
        $file_info = pathinfo($_FILES['uploaded_file']['name']);
        $file_ext = strtolower($file_info['extension']);
        
        // Check if file is an image
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        if(in_array($file_ext, $allowed_extensions)) {
            // Generate a unique filename to prevent overwriting
            $new_filename = uniqid('recipe_') . '.' . $file_ext;
            $destination = $upload_dir . $new_filename;
            
            // Move the uploaded file to our images directory
            if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $destination)) {
                $image_path = $new_filename;
            } else {
                echo "Error uploading file. Using default image.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG and GIF files are allowed. Using default image.";
        }
    }
    
    // Insert into database using prepared statement
    $sql = "INSERT INTO recipes (name, description, type, Cookingtime, ingredients, instructions, image, uid) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisssi", $name, $description, $type, $cooking_time, $ingredients_json, $instructions, $image_path, $user_id);
    
    if ($stmt->execute()) {
        echo "Recipe created successfully!";
    	echo "<br><a href='../Recipe/Recipe.php'>Login now</a>";
    } else {
        echo "Error: " . $stmt->error;
    	echo "<br><a href='../Profile/CreateRecipesPage.php'>Login now</a>";
    }
    
    $stmt->close();
    $conn->close();
} else {
    // If not a POST request, redirect to the form page
    header("Location: CreateRecipesPage.php");
    exit();
}
?>