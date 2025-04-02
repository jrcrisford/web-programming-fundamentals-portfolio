const form = document.forms.registrationForm;
if (form) {
    form.addEventListener('submit', validateForm);
} else {
    console.error('Unable to find the registration form. No validation will be performed.');
}

function validateForm(e) {
    e.preventDefault(); // Prevent form submission for validation
    
    const firstName = document.getElementById('firstName');
    const lastName = document.getElementById('lastName');
    const event = document.getElementById('event');
    const ageGroup = document.getElementById('ageGroup');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');

    let error = false;

    if (firstName.value === '') {
        showError(firstName, 'First name is required.');
        error = true;
    }

    if (lastName.value === '') {
        showError(lastName, 'Last name is required.');
        error = true;
    }
}

function showError(element, message) {
    element.style.border = '2px solid red';
    element.setCustomValidity(message);
    element.reportValidity();
}
