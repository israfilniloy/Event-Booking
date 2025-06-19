function isValid() {
    input = document.getElementById("Search_bar").value;
    if (input === "") {
      document.getElementById("Search_bar_error").innerHTML =
        "Search box cannot be empty";
      return false;
    } else {
      return true;
    }
  }
  function isValidInput() {
    let isValid = true;
  
    // Get elements
    const firstName = document.getElementById("name");
    const lastName = document.getElementById("lastName");
    const email = document.getElementById("email");
    const password = document.getElementById("password");
  
    const firstNameError = document.getElementById("nameError");
    const lastNameError = document.getElementById("lastNameError");
    const emailError = document.getElementById("emailError");
    const passwordError = document.getElementById("passwordError");
    const generalError = document.getElementById("ErrorMsg_Update_Form");
  
    // Clear all errors
    firstNameError.innerText = "";
    lastNameError.innerText = "";
    emailError.innerText = "";
    passwordError.innerText = "";
    generalError.innerText = "";
  
    // Validate First Name
    if (firstName.value.trim() === "") {
      firstNameError.innerText = "First name is required.";
      isValid = false;
    } else if (firstName.value.trim().length < 2) {
      firstNameError.innerText = "First name must be at least 2 characters.";
      isValid = false;
    }
  
    // Validate Last Name
    if (lastName.value.trim() === "") {
      lastNameError.innerText = "Last name is required.";
      isValid = false;
    } else if (lastName.value.trim().length < 2) {
      lastNameError.innerText = "Last name must be at least 2 characters.";
      isValid = false;
    }
  
    // Validate Email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email.value.trim() === "") {
      emailError.innerText = "Email is required.";
      isValid = false;
    } else if (!emailPattern.test(email.value.trim())) {
      emailError.innerText = "Enter a valid email address.";
      isValid = false;
    }
  
    // Validate Password (optional)
    if (password.value.trim() !== "" && password.value.trim().length < 6) {
      passwordError.innerText = "Password must be at least 6 characters.";
      isValid = false;
    }
  
    // If not valid, show a general error
    if (!isValid) {
      generalError.innerText = "Please correct the errors above and try again.";
      generalError.style.color = "red";
    }
  
    return isValid;
  }
  