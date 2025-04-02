const form = document.forms.registrationForm;

if (form) {
    form.addEventListener('submit', validateForm);
} else {
    console.error('Unable to find the registration form. No validation will be performed.');
}

function validateForm(e) {
    e.preventDefault(); // Prevent form submission for validation
    
    clearErrors(); // Clear previous error messages
    let isValid = true;

    const requiredFields = [
        { id: 'firstName', message: 'Please enter your first name'},
        { id: 'lastName', message: 'Please enter your last name.'},
        { id: 'event', message: 'Please select and event.'},
        { id: 'ageGroup', message: 'Please select your age group.'},
        { id: 'email', message: 'Please enter your email address.'},
        { id: 'password', message: 'Please enter your password.'},
        { id: 'confirmPassword', message: 'Please confirm your password.'}
    ];

    requiredFields.forEach(field => {
        const input = document.getElementById(field.id);
        if (!input.value.trim()) {
            showError(input, field.message);
            isValid = false;
        }
    });

    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');

    if (password.value.length < 6) {
        showError(password, 'Password must be atleast 6 characters.')
        isValid = false;
    } else if (password.value && confirmPassword.value && password.value !== confirmPassword.value) {
        showError(confirmPassword, 'Passwords do not match.');
        isValid = false;
    }

    if (isValid) {
        // Submit the form
        console.log('Form is valid');
    }
}

function showError(field, message) {
    const errorSpan = document.getElementById(field.id + '-error');
    if (errorSpan) {
        errorSpan.textContent = message;
    }
    field.classList.add('input-error');
}

function clearErrors() {
    const errorSpans = document.querySelectorAll('.error-message');
    errorSpans.forEach(span => span.textContent = '');

    const errorFields = document.querySelectorAll('.input-error');
    errorFields.forEach(field => field.classList.remove('input-error'));
}
