<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Navigation/Navigation.css">
    <link rel="stylesheet" href="./Contact.css">
	<link rel="stylesheet" href="./Auth.css">
    <style>
        .success-message {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .error-message {
            color: red;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <?php
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Create hidden input field with login status
    $isLoggedIn = isset($_SESSION['username']) ? "logged-in" : "logged-out";
    echo '<input type="hidden" id="user-login-status" value="' . $isLoggedIn . '">';
    ?>
    
    <div id="navigation-placeholder"></div>
    
    <?php if(isset($_SESSION['username'])): ?>
        <div class="success-message">You are already logged in as <?php echo htmlspecialchars($_SESSION['username']); ?>!</div>
    <?php else: ?>
        <div class="auth-container">
        <form action="Login.php" method="post">
            <h2>Login</h2>
            
            <?php if(isset($_GET['error'])): ?>
                <div class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>
            
            <?php if(isset($_GET['login']) && $_GET['login'] == 'success'): ?>
                <div class="success-message">Login successful! Database connection worked.</div>
            <?php endif; ?>
            
            <label>Username</label>
            <input type="text" name="username" placeholder="username"><br>
            <label>Password</label>
            <input type="password" name="password" placeholder="password"><br>

            <button type="submit">submit</button>
        </div>
        
    <?php endif; ?>
    
    <script src="../Navigation/Navigation.js"></script>
</body>
</html>