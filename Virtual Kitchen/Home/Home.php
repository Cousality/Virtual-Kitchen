<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>VirtualKitchen-Contact</title>
        <link rel="stylesheet" href="../Navigation/Navigation.css">
        <link rel="stylesheet" href="./Home.css">
		
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
        <main>
            <h1>Welcome to <em>Woley's</em> Kitchen</h1>
            
            <div class="business-info">
                <h2>Business Information</h2>
                <p>
                    <strong>Name:</strong> Woley's Kitchen<br>
                    <strong>Address:</strong> 123 Lake Shore Drive<br>
                    Lake Mobius, MW 12345
                </p>
            </div>

            <div class="history">
                <h2>Short History of <em>Woley's</em> Kitchen</h2>
                <p>
                    Long before Woley's Kitchen became a world renowned restaurant, it was but a humble wooden shack nestled on the shores of Lake Mobius, 
                    a mysterious lake famous for housing the remainder of humanity. Legend has it that the founder, Bartholomew "Woley" Woolington, 
                    opened the eatery in 1869 after a prophetic dream in which a talking Pink Fairy Armadillo told him, "The world needs more recipes."
                </p>
                <blockquote>
                    "Some say Woley's recipes saved humanity. Others say they simply made the end of the world more delicious." - Unknown Historian that reccommends that you play outer wilds
                </blockquote> 
                    
            </div>
        </main>
        
        <footer>
            <div class="contact">
                <h2>Contact Information</h2>
                <p>
                    <strong>Owner:</strong> Cole Bailey<br>
                    <strong>Email:</strong> <a href="mailto:230107571@aston.ac.uk">230107571@aston.ac.uk</a><br>
                    <strong>StudentNo.:</strong> 230107571
                </p>
            </div>
        </footer>
        <script src="../Navigation/Navigation.js"></script>
    </body>
</html>
                    