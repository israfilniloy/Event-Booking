
  
    function fNameValidation() {
      const firstName = document.getElementById('firstName').value.trim();
      const firstNameError = document.getElementById('firstNameError');
      if (firstName === '') {
        firstNameError.innerHTML = 'First name required';
        firstNameError.style.color = 'red';
        return false;
      } else {
        firstNameError.innerHTML = '';
        return true;
      }
    }

    function lNameValidation() {
      const lastName = document.getElementById('lastName').value.trim();
      const lastNameError = document.getElementById('lastNameError');
      if (lastName === '') {
        lastNameError.innerHTML = 'Last name required';
        lastNameError.style.color = 'red';
        return false;
      } else {
        lastNameError.innerHTML = '';
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

    function passwordValidation() {
      const password = document.getElementById('password').value.trim();
      const passwordError = document.getElementById('passwordError');
      const passwordConfirm = document.getElementById('confirmPassword').value.trim();
      const confirmPasswordError = document.getElementById('confirmPasswordError');

      if (password === '') {
        passwordError.innerHTML = 'Password is required';
        passwordError.style.color = 'red';
        return false;
      }
      if (password.length < 8) {
        passwordError.innerHTML = 'Password must be at least 8 characters';
        passwordError.style.color = 'red';
        return false;
      } else {
        passwordError.innerHTML = '';
      }

      if (passwordConfirm === '') {
        confirmPasswordError.innerHTML = 'Confirm password required';
        confirmPasswordError.style.color = 'red';
        return false;
      }
      if (password !== passwordConfirm) {
        confirmPasswordError.innerHTML = 'Passwords do not match';
        confirmPasswordError.style.color = 'red';
        return false;
      } else {
        confirmPasswordError.innerHTML = '';
        return true;
      }
    }

    function validationVerification() {
      const isValid = fNameValidation() &&
        lNameValidation() && 
       emailValidation() && 
       passwordValidation();
      return isValid;
    }

 
    function togglePassword(id) {
      const input = document.getElementById(id);
      input.type = input.type === 'password' ? 'text' : 'password';
    }
  