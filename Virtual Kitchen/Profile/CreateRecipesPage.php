<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Navigation/Navigation.css">
	<link rel="stylesheet" href="CreateRecipe.css">
    <title>Create Recipe</title>
    
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

    <h1>Create New Recipe</h1>
    
    <form id="recipe-form" action="./CreateRecipe.php" method="post" enctype="multipart/form-data">
        <label for="name">Recipe Name</label>
        <input type="text" id="name" name="name" placeholder="Enter recipe name" required> <br>
        
        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="Enter a detailed description of the recipe" required></textarea> <br>
        
        <label for="type">Type</label>
        <select id="type" name="type" required>
            <option value="">Select a meal type</option>
            <option value="French">French</option>
            <option value="Indian">Indian</option>
            <option value="Italian">Italian</option>
            <option value="Chinese">Chinese</option>
        </select> <br>
        
        <label for="cooking-time">Cooking Time (minutes)</label>
        <input type="number" id="cooking-time" name="cooking-time" min="1" placeholder="Enter cooking time in minutes" required> <br>
        
        <label>Ingredients</label>
        <div id="ingredients-container" class="ingredient-list">
            <input type="text" name="ingredients[]" placeholder="Enter ingredient (e.g., 1 cup flour)">
        </div>
        <button type="button" class="add-ingredient" onclick="addIngredientField()">+ Add Another Ingredient</button> <br>
        
        <label for="instructions">Instructions</label>
        <textarea id="instructions" name="instructions" placeholder="Enter step-by-step instructions" required></textarea> <br>
        <label for="image" >Image</label>
        <input type="file" name="uploaded_file"><br>
        
        
        <button type="submit">Create Recipe</button>
    </form>

    <script>
        function addIngredientField() {
            const container = document.getElementById('ingredients-container');
            const newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'ingredients[]';
            newInput.placeholder = 'Enter ingredient (e.g., 2 eggs)';
            container.appendChild(newInput);
        }
    </script>
</body>
</html>