<?php
// Start session 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
include "DB_connect.php";

// Check if recipe ID or name is provided in URL
if (isset($_GET['rid'])) {
    $recipeId = $_GET['rid'];
    $sql = "SELECT * FROM recipes WHERE rid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipeId);
} elseif (isset($_GET['name'])) {
    $recipeName = $_GET['name'];
    $sql = "SELECT * FROM recipes WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $recipeName);
} else {
    // Redirect to recipes page if no identifier is provided
    header("Location: Recipe.php");
    exit();
}

// Execute query
$stmt->execute();
$result = $stmt->get_result();

// Check if recipe exists
if ($result->num_rows === 0) {
    echo "<p>Recipe not found</p>";
    exit();
}

// Fetch recipe data
$recipe = $result->fetch_assoc();

// Parse ingredients from JSON
$ingredients = json_decode($recipe["ingredients"], true);

// Close statement
$stmt->close();
$conn->close();

// Create hidden input field with login status
$isLoggedIn = isset($_SESSION['username']) ? "logged-in" : "logged-out";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipe["name"]); ?> - VirtualKitchen</title>
    <link rel="stylesheet" href="../Navigation/Navigation.css">
    <link rel="stylesheet" href="./allrecipes.css">
</head>

<body>
    <input type="hidden" id="user-login-status" value="<?php echo $isLoggedIn; ?>">
    <div id="navigation-placeholder"></div>

    <div class="recipe-container">
        <header class="recipe-header">
            <h1><?php echo htmlspecialchars($recipe["name"]); ?></h1>
            <p class="recipe-description"><?php echo htmlspecialchars($recipe["description"]); ?></p>
            
            <div class="recipe-meta">
                <div class="meta-item">
                    <span class="meta-label">Type:</span>
                    <span class="meta-value"><?php echo htmlspecialchars(ucfirst($recipe["type"])); ?></span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Cooking Time:</span>
                    <span class="meta-value"><?php echo htmlspecialchars($recipe["Cookingtime"]); ?> mins</span>
                </div>

            </div>
        </header>

        <div class="recipe-content">
            <div class="recipe-image-container">
                <img src="../images/<?php echo htmlspecialchars($recipe["image"]); ?>" alt="<?php echo htmlspecialchars($recipe["name"]); ?>" class="recipe-full-image">
            </div>

            <section class="ingredients-section">
                <h2>Ingredients</h2>
                <ul class="ingredients-list">
                    <?php if (is_array($ingredients) && count($ingredients) > 0): ?>
                        <?php foreach ($ingredients as $ingredient): ?>
                        <li><?php echo htmlspecialchars($ingredient); ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>No ingredients listed</li>
                    <?php endif; ?>
                </ul>
            </section>

            <section class="instructions-section">
                <h2>Instructions</h2>
                <div class="instructions-content">
                    <?php echo nl2br(htmlspecialchars($recipe["instructions"])); ?>
                </div>
            </section>
            
        </div>
    </div>

    <script src="../Navigation/Navigation.js"></script>
</body>
</html>