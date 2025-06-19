function validateOTP() {
    const otpInputs = document.querySelectorAll('.otp-field');
    const otpError = document.getElementById('otpError');
    let isValid = true;
    let errorMessage = '';

    
    for (let i = 0; i < otpInputs.length; i++) {
        const value = otpInputs[i].value.trim();
        if (value === '') {
            errorMessage = 'All OTP fields are required';
            isValid = false;
            break;
        }
        if (value.length !== 1 || !'0123456789'.includes(value)) {
            errorMessage = `Field ${i + 1} must be a single digit (0-9)`;
            isValid = false;
            break; 
        }
    }

    if (!isValid) {
        otpError.innerHTML = errorMessage;
        otpError.style.color = 'red';
        otpError.style.display = 'block'; 
        return false;
    } else {
        otpError.innerHTML = '';
        otpError.style.display = 'none';
        alert('OTP verified successfully!'); 
        return true;
    }
}

document.querySelectorAll('.otp-field').forEach((input, index, inputs) => {
    input.addEventListener('input', () => {
        if (input.value.length === 1 && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });

    input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && input.value === '' && index > 0) {
            inputs[index - 1].focus();
        }
    });
});