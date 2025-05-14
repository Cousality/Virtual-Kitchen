<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Navigation/Navigation.css">
   
</head>
<body>
    <?php
		// Start session 
		if (session_status() === PHP_SESSION_NONE) {
    		session_start();
		}

		// Create hidden input field with login status
		$isLoggedIn = isset($_SESSION['username']) ? "logged-in" : "logged-out";
		echo '<input type="hidden" id="user-login-status" value="' . $isLoggedIn . '">';
	?>

    <div id="navigation-placeholder"></div>
    <script src="../Navigation/Navigation.js"></script>
    <a href="./CreateRecipesPage.php" id="home-link">Create Recipe</a><br>
    <a href="../Home/Home.php" id="home-link">Edit Recipe</a><br>
    <a href="../Home/Home.php" id="home-link">Delete Recipe</a>
    <a href="../Home/Home.php" id="home-link">Delete Account</a>
</body>