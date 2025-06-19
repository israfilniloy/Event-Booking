function fNameValidation() {
    const fullName = document.getElementById('fullname').value.trim();
    const fullNameError = document.getElementById('fullNameError');
    if (fullName === '') {
        fullNameError.innerHTML = 'Full name is required';
        fullNameError.style.color = 'red';
        return false;
    } else {
        fullNameError.innerHTML = '';
        return true;
    }
}

function emailValidation() {
    const email = document.getElementById('email').value.trim();
    const emailError = document.getElementById('emailError');
    if (email === '') {
        emailError.innerHTML = 'Email is required';
        emailError.style.color = 'red';
        return false;
    } else if (!(email.includes('@') && email.includes('.'))) {
        emailError.innerHTML = 'Invalid email';
        emailError.style.color = 'red';
        return false;
    } else {
        emailError.innerHTML = '';
        return true;
    }
}

function subjectValidation() {
    const subject = document.getElementById('subject').value.trim();
    const subjectError = document.getElementById('subjectError');
    if (subject === '') {
        subjectError.innerHTML = 'Subject is required';
        subjectError.style.color = 'red';
        return false;
    } else {
        subjectError.innerHTML = '';
        return true;
    }
}

function messageValidation() {
    const message = document.getElementById('message').value.trim();
    const messageError = document.getElementById('messageError'); 
    if (message === '') {
        messageError.innerHTML = 'Message is required';
        messageError.style.color = 'red';
        return false;
    } else {
        messageError.innerHTML = '';
        return true;
    }
}

function validationContact() {
    const isValid =
        fNameValidation() &&
        emailValidation() &&
        subjectValidation() &&
        messageValidation();
    return isValid;
}