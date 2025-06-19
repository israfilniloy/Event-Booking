<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Account</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <link rel="stylesheet" href="../Asset/CSS/signup 2.css" />
  </head>
  <body>
    <div class="container">
      <i
        class="fas fa-arrow-left back-btn"
        onclick="window.location.href='../index.php' "
      ></i>
      <h2>Registration</h2>
      <p>Sign up now and get full access to our Event</p>
      <br />

      <form
        class="signup-form"
        id="signupForm" method="POST" action="../Controller/signUpController.php"
        onsubmit="return validationVerification()"
      >
        <div class="name-fields">
          <input type="text" placeholder="First name" id="firstName" name="firstName"/>
          <div id="firstNameError" class="error"></div>

          <input type="text" placeholder="Last name" id="lastName" name="lastName"/>
          <div id="lastNameError" class="error"></div>
        </div>

        <input type="email" placeholder="Email address" id="email" name="email"/>
        <div id="emailError" class="error"></div>

        <div class="password-field">
          <input type="password" placeholder="Password" id="password" name="password" />
          <span class="toggle-eye" onclick="togglePassword('password')"
            >👁️</span
          >
        </div>
        <div id="passwordError" class="error"></div>

        <div class="password-field">
          <input
            type="password"
            placeholder="Confirm Password"
            id="confirmPassword" name="confirmPassword"
          />
          <span class="toggle-eye" onclick="togglePassword('confirmPassword')"
            >👁️</span
          >
        </div>
        <div id="confirmPasswordError" class="error"></div>

        <button class="signup-btn" name="submit" type="submit">Sign up</button>

        <p class="terms">
          By clicking "Sign up", you agree to EventBookings
          <a href="#">Terms & Conditions</a> and have read the
          <a href="#">Privacy Policy</a>.
        </p>

        <p class="login">
          Already have an account? <a href="./login.php">Log In</a>
        </p>
      </form>
    </div>

     <script src="../Asset/js/signUp 2.js"></script>
  </body>
</html>
