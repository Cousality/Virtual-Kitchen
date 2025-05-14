<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Navigation/Navigation.css">
    <link rel="stylesheet" href="./Contact.css">
	<link rel="stylesheet" href="../Login/Auth.css">
</head>
<body>
    <div id="navigation-placeholder"></div>
    <div class="auth-container">
        <form action="./Register.php" method="post">
            <h2>Register</h2>
            <label>Username</label>
            <input type="text" name="username" placeholder="username"><br>
            <label>Password</label>
            <input type="password" name="password" placeholder="password"><br>
            <label>Email</label>
            <input type="text" name="email" placeholder="email"><br>

            <button type="submit">submit</button>
        </form>
    </div>
    <script src="../Navigation/Navigation.js"></script>

</body>