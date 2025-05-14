// Get form elements
const form = document.getElementById("bookingForm");
const timeSelect = document.getElementById("time");
const dateInput = document.getElementById("date");
const confirmation = document.getElementById("confirmation");
const emailGroup = document.getElementById("emailGroup");
const phoneGroup = document.getElementById("phoneGroup");
const contactMethodRadios = document.getElementsByName("contactMethod");

const today = new Date().toISOString().split("T")[0];
dateInput.min = today;

// Handle contact method switch
contactMethodRadios.forEach((radio) => {
  radio.addEventListener("change", function () {
    if (this.value === "email") {
      emailGroup.style.display = "block";
      phoneGroup.style.display = "none";
      document.getElementById("phone").value = "";
    } else {
      emailGroup.style.display = "none";
      phoneGroup.style.display = "block";
      document.getElementById("email").value = "";
    }
  });
});

// Generate time slots
function generateTimeSlots() {
  for (let i = 9; i <= 17; i++) {
    const option = document.createElement("option");
    option.value = `${i}:00 - ${i + 1}:00`;
    option.textContent = `${i}:00 - ${i + 1}:00`;
    timeSelect.appendChild(option);
  }
}

// verify form
function verifyForm() {
  const name = document.getElementById("name").value;
  const contactMethod = document.querySelector(
    'input[name="contactMethod"]:checked'
  ).value;
  const email = document.getElementById("email").value;
  const phone = document.getElementById("phone").value;
  const date = document.getElementById("date").value;
  const time = document.getElementById("time").value;

  let isValid = true;

  // Reset error messages
  document
    .querySelectorAll(".error")
    .forEach((error) => (error.style.display = "none"));
  // check if a name is entered
  if (!name) {
    document.getElementById("nameError").style.display = "block";
    isValid = false;
  }
  //check if email button is pressed then checks if it is a university email
  if (contactMethod === "email") {
    if (!email || !email.includes("@aston.ac.uk")) {
      document.getElementById("emailError").style.display = "block";
      isValid = false;
    }
  }
  //check if email is not pressed then checks if it is a valid number using regular expression
  if (contactMethod !== "email") {
    if (!phone || !/^[0-9]{11}$/.test(phone)) {
      document.getElementById("phoneError").style.display = "block";
      isValid = false;
    }
  }
  // checks date
  if (!date) {
    document.getElementById("dateError").style.display = "block";
    isValid = false;
  }
  // checks time slot
  if (!time) {
    document.getElementById("timeError").style.display = "block";
    isValid = false;
  }

  return isValid;
}

// does the confirmation
form.addEventListener("submit", function (e) {
  e.preventDefault();

  if (verifyForm()) {
    const contactMethod = document.querySelector(
      'input[name="contactMethod"]:checked'
    ).value;
    const contactValue =
      contactMethod === "email"
        ? document.getElementById("email").value
        : document.getElementById("phone").value;

    // Show confirmation detets
    document.getElementById("confirmName").textContent =
      document.getElementById("name").value;
    document.getElementById("confirmContact").textContent = contactValue;
    document.getElementById("confirmDate").textContent =
      document.getElementById("date").value;
    document.getElementById("confirmTime").textContent =
      document.getElementById("time").value;

    // Make confirmation visible
    confirmation.style.display = "block";

    // Wait a moment before resetting the form
    setTimeout(() => {
      form.reset();
      // Reset display of contact method groups
      emailGroup.style.display = "block";
      phoneGroup.style.display = "none";
    }, 100);
  }
});

// Initialize time slots
generateTimeSlots();
