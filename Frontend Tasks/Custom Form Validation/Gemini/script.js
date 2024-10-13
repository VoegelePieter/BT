function validateForm() {
    // Get form elements
    const email = document.getElementById("email");
    const password = document.getElementById("password");
    const number = document.getElementById("number");
    const date = document.getElementById("date");
    const url = document.getElementById("url");
    const agree = document.getElementById("agree");
  
    // Email validation (basic check)
    if (!isValidEmail(email.value)) {
      alert("Invalid email address.");
      return false;
    }
  
    // Password strength validation (adjust requirements as needed)
    if (!isValidPassword(password.value)) {
      alert("Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number.");
      return false;
    }
  
    // Number range validation (adjust range as needed)
    if (number.value < 1 || number.value > 100) {
      alert("Number must be between 1 and 100.");
      return false;
    }
  
    // Date validation (check if it's a valid date format)
    if (!isValidDate(date.value)) {
      alert("Invalid date format.");
      return false;
    }
  
    // URL validation (basic check)
    if (!isValidURL(url.value)) {
      alert("Invalid URL.");
      return false;
    }
  
    // Checkbox validation
    if (!agree.checked) {
      alert("Please agree to the terms and conditions.");
      return false;
    }
  
    // If all validations pass, submit the form
    return true;
  }
  function isValidEmail(email) {
    // Use a regular expression for more robust validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
  
  function isValidPassword(password) {
    // Adjust password requirements as needed
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    return passwordRegex.test(password);
  }
  
  function isValidDate(date) {
    // Check if the date can be parsed
    const parsedDate = new Date(date);
    return !isNaN(parsedDate);
  }
  
  function isValidURL(url) {
    // Use a regular expression for basic URL validation
    const urlRegex = /^(?:(?:https?|ftp):\/\/)?(?:(?:[a-z0-9\-]+\.)+[a-z0-9]+|(?:[0-9]{1,3}\.){3}[0-9]{1,3})(?:[^\s#]+)?$/i;
    return urlRegex.test(url);
  }
  document.getElementById("myForm").addEventListener("submit", function (event) {
    if (!validateForm()) {
      event.preventDefault(); // Prevent form submission
    }
  });