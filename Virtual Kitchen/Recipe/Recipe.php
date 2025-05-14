<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>VirtualKitchen-Recipes</title>
        <link rel="stylesheet" href="../Navigation/Navigation.css">
        <link rel="stylesheet" href="./Recipe.css">
    </head>
    <body>
        <?php
        // Start session 
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Include database connection
        include "DB_connect.php";

        // Create hidden input field with login status
        $isLoggedIn = isset($_SESSION['username']) ? "logged-in" : "logged-out";
        echo '<input type="hidden" id="user-login-status" value="' . $isLoggedIn . '">';
        ?>

        <div id="navigation-placeholder"></div>

        <div class="content-wrapper">
            <aside class="sidebar">
                <h2>Filter by Meal</h2>
                <div class="filter-options">
                    <label class="filter-option">
                        <input type="checkbox" name="meal" value="French">
                        French
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="meal" value="Indian">
                        Indian
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="meal" value="Italian">
                        Italian
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="meal" value="Chinese">
                        Chinese
                    </label>
                </div>
            </aside>

            <div class="recipe-grid">
                <?php
                // Query to fetch recipes from database
                $sql = "SELECT rid, name, image, type FROM recipes";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row as a recipe card
                    while ($row = $result->fetch_assoc()) {
                        $recipeId = htmlspecialchars($row["rid"]);
                        $recipeName = htmlspecialchars($row["name"]);
                        $imageFile = htmlspecialchars($row["image"]);
                        $mealType = htmlspecialchars($row["type"]);
                        
                        // Image path
                        $imagePath = "../images/" . $imageFile;
                        
                        echo '<div class="recipe-card" data-meal="' . $mealType . '">
                                <img src="' . $imagePath . '" alt="' . $recipeName . '" class="recipe-image">
                                <a href="./RecipeDisplay.php?rid=' . $recipeId . '" class="recipe-title">' . $recipeName . '</a>
                              </div>';
                    }
                } else {
                    echo "<p>No recipes found</p>";
                }
                
                // Close the database connection
                $conn->close();
                ?>
            </div>
        </div>
        <script src="../Navigation/Navigation.js"></script>
        <script src="RecipeFilter.js"></script>
    </body>
</html>