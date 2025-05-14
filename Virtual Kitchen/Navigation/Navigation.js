document.addEventListener("DOMContentLoaded", function () {
  // Check if the user is logged in (through PHP session)
  const isUserLoggedIn = checkUserLoggedIn();
  
  // The navigation bar with conditional authentication buttons
  const navigationHTML = `
    <nav>
      <a href="../Home/Home.php" id="home-link">Home</a>
      <a href="../Recipe/Recipe.php" id="recipe-link">Recipes</a>
      <a href="../Contact/Contact.php" id="contact-link">Contact</a>
      ${isUserLoggedIn ? 
        `<a href="../Login/Logout.php" id="logout-link" class="login-btn">Logout</a>
         <a href="../Profile/ProfilePage.php" id="logout-link" class="login-btn">Profile</a>` : 
        `<a href="../Login/LoginPage.php" id="login-link" class="login-btn">Login</a>
         <a href="../Register/RegisterPage.php" id="register-link" class="login-btn">Register</a>`
      }
    </nav>
  `;

  document.getElementById("navigation-placeholder").innerHTML = navigationHTML;

  // Highlight current page
  const currentPage = window.location.pathname;
  const navLinks = document.querySelectorAll("nav a");

  navLinks.forEach((link) => {
    if (currentPage.includes(link.getAttribute("href"))) {
      link.classList.add("active");
    }
  });
  
  // Function to check if user is logged in
  function checkUserLoggedIn() {
    const loginStatusElement = document.getElementById("user-login-status");
    return loginStatusElement && loginStatusElement.value === "logged-in";
  }
});