<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Navigation/Navigation.css">
    <link rel="stylesheet" href="./Contact.css">
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

    <div class="booking-container">
        <h2>Book an Appointment</h2>
        <form id="bookingForm">
            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" id="name" required>
                <div id="nameError" class="error">Please enter your name</div>
            </div>

            <div class="form-group">
                <label>Contact Method:</label>
                <div class="contact-method">
                    <input type="radio" id="emailMethod" name="contactMethod" value="email" checked>
                    <label for="emailMethod">Email</label>
                    <input type="radio" id="phoneMethod" name="contactMethod" value="phone">
                    <label for="phoneMethod">Phone</label>
                </div>
            </div>

            <div class="form-group" id="emailGroup">
                <label for="email">Email:</label>
                <input type="email" id="email">
                <div id="emailError" class="error">Please enter a valid email ending with @aston.ac.uk</div>
            </div>

            <div class="form-group" id="phoneGroup" style="display: none;">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" pattern="[0-9]{11}">
                <div id="phoneError" class="error">Please enter a valid 11-digit phone number</div>
            </div>

            <div class="form-group">
                <label for="date">Select Date:</label>
                <input type="date" id="date" required>
                <div id="dateError" class="error">Please select a date</div>
            </div>

            <div class="form-group">
                <label for="time">Select Time Slot:</label>
                <select id="time" required>
                    <option value="">Choose a time slot</option>
                </select>
                <div id="timeError" class="error">Please select a time slot</div>
            </div>

            <button type="submit">Book Appointment</button>
        </form>

        <div id="confirmation" class="confirmation">
            <h3>Booking Confirmation</h3>
            <p>Name: <span id="confirmName"></span></p>
            <p>Contact: <span id="confirmContact"></span></p>
            <p>Date: <span id="confirmDate"></span></p>
            <p>Time: <span id="confirmTime"></span></p>
        </div>
    </div>
    <script src="../Navigation/Navigation.js"></script>
    <script src="Contact.js"></script>
</body>
</html>