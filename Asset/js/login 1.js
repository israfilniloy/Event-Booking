
    function emailValidation() {
      const email = document.getElementById('email').value.trim();
      const emailError = document.getElementById('emailError');
      if (email === '') {
        emailError.innerHTML = 'Email is required';
        return false;
      } else if (!(email.includes('@') && email.includes('.'))) {
        emailError.innerHTML = 'Invalid email';
        return false;
      } else {
        emailError.innerHTML = '';
        return true;
      }
    }

    function passwordValidation() {
      const password = document.getElementById('password').value.trim();
      const passwordError = document.getElementById('passwordError');
      if (password === '') {
        passwordError.innerHTML = 'Password is required';
        return false;
      } else {
        passwordError.innerHTML = '';
        return true;
      }
    }

    function roleValidation() {
      const roles = document.getElementsByName('role');
      const roleError = document.getElementById('roleError');
      let isSelected = false;

      for (const role of roles) {
        if (role.checked) {
          isSelected = true;
          break;
        }
      }

      if (!isSelected) {
        roleError.innerHTML = 'Role selection required';
        return false;
      } else {
        roleError.innerHTML = '';
        return true;
      }
    }

    function validateLogin() {
      const isValid = emailValidation() &&
       passwordValidation() && 
       roleValidation();
      return isValid;
    }

    function togglePassword() {
      const passwordInput = document.getElementById('password');
      passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
    }
  