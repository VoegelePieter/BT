document.getElementById('myForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const number = parseInt(document.getElementById('number').value, 10);
    const date = document.getElementById('date').value;
    const url = document.getElementById('url').value;
    const agree = document.getElementById('agree').checked;

    // Validate email
    if (!validateEmail(email)) {
        alert('Please enter a valid email address.');
        return;
    }

    // Validate password strength
    if (!validatePassword(password)) {
        alert('Password must contain at least 8 characters, including one uppercase, one lowercase, and one number.');
        return;
    }

    // Validate number range
    if (number < 1 || number > 100) {
        alert('Number must be between 1 and 100.');
        return;
    }

    // Validate date
    if (new Date(date).toString() === "Invalid Date") {
        alert('Please enter a valid date.');
        return;
    }

    // Validate URL
    if (!validateURL(url)) {
        alert('Please enter a valid URL.');
        return;
    }

    // Validate checkbox
    if (!agree) {
        alert('You must agree to the terms.');
        return;
    }

    // If all validations pass, submit the form
    this.submit();
});

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePassword(password) {
    const re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    return re.test(password);
}

function validateURL(url) {
    const re = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;
    return re.test(url);
}
