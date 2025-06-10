// Validate Mobile Number (10 digits)
function validatePhoneNumber(input) {
    // Allow only numeric characters
    input.value = input.value.replace(/\D/g, '');
    
    // Ensure the input does not exceed 10 digits
    if (input.value.length > 10) {
        input.value = input.value.slice(0, 10);  // Truncate to 10 digits
    }
}

// Validate PIN Code (6 digits)
function validatePinCode(input) {
    // Allow only numeric characters
    input.value = input.value.replace(/\D/g, '');
    
    // Ensure the input does not exceed 6 digits
    if (input.value.length > 6) {
        input.value = input.value.slice(0, 6);  // Truncate to 6 digits
    }
}

const form = document.getElementById('addressForm');

form.addEventListener('submit', function (event) {
    let isValid = true;
    const inputs = form.querySelectorAll('.form-control');
    inputs.forEach(input => {
        const errorMessage = input.parentElement.querySelector('.error-message');
        if (!input.value.trim()) {
            input.style.borderColor = 'red';
            errorMessage.style.display = 'block';
            isValid = false;
        } else {
            input.style.borderColor = '';
            errorMessage.style.display = 'none';
        }
    });

    if (!isValid) {
        event.preventDefault(); // Prevent form submission if invalid
    }
});

const addAlternateText = document.getElementById('addAlternateText');
const alternateNumberContainer = document.getElementById('alternateNumberContainer');
const alternateNumberInput = document.getElementById('alternateNumber');

addAlternateText.addEventListener('click', () => {
    // Show the alternate number input field
    alternateNumberContainer.style.display = 'block';

    // Hide the "+ Add Alternate Phone Number" text
    addAlternateText.style.display = 'none';

    // Focus on the alternate input when it appears
    alternateNumberInput.focus();
});

alternateNumberInput.addEventListener('blur', () => {
    // Check if the input is empty
    if (alternateNumberInput.value.trim() === '') {
        // Hide the alternate number container
        alternateNumberContainer.style.display = 'none';

        // Show the "+ Add Alternate Phone Number" text again
        addAlternateText.style.display = 'block';
    }
});

const locationButton = document.getElementById('locationButton');
const spinner = document.getElementById('spinner');
const buttonText = document.getElementById('buttonText');
const errorMessage = document.getElementById('errorMessage');
const locationIcon = document.getElementById('locationIcon');

locationButton.addEventListener('click', () => {
    // Start loading
    spinner.style.display = 'inline-block';
    locationIcon.style.display = 'none';
    buttonText.textContent = 'Loading...';
    locationButton.style.pointerEvents = 'none'; // Disable further clicks

    // Simulate a delay (2 seconds)
    setTimeout(() => {
        // Stop loading and show error message
        spinner.style.display = 'none';
        locationIcon.style.display = 'inline-block';
        buttonText.textContent = 'Use my location';
        locationButton.style.pointerEvents = 'auto'; // Re-enable clicks
        errorMessage.style.display = 'block';
    }, 2000);
});

// JavaScript to handle active state
const buttons = document.querySelectorAll('.btn');

buttons.forEach(button => {
    button.addEventListener('click', () => {
        // Remove active class from all buttons
        buttons.forEach(btn => btn.classList.remove('active'));

        // Add active class to clicked button
        button.classList.add('active');
    });
});