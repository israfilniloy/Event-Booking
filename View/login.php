<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="../Asset/CSS/login 1.css" />
</head>

<body>
  <div class="container">
    <i
      class="fas fa-arrow-left back-btn"
      onclick="window.location.href='../index.php'"></i>
    <h2>LOGIN PAGE</h2>

    <form class="login-form" id="loginForm" onsubmit="return validateLogin()" method="POST" action="../Controller/loginController.php">
      <div>
        <input type="email" placeholder="Email address" id="email" name="email" />
        <div id="emailError" class="error"></div>
      </div>

      <div class="password-field">
        <input type="password" placeholder="Password" id="password" name="password" />
        <span class="toggle-eye" onclick="togglePassword()">👁️</span>
      </div>
      <div id="passwordError" class="error"></div>


      <div id="LoginError" class="error">
        <?php
        if (isset($_SESSION["LoginError"])) {
          echo $_SESSION["LoginError"];
          unset($_SESSION["LoginError"]);
        }
        ?>



      </div>

      <div class="actions">
        <label><input type="checkbox" /> Remember me</label>
        <a href="#">Forgot password?</a>
      </div>

      <button type="submit" class="login-btn">login</button>

      <p class="signup-link">
        Don't have an account? <a href="./signUp.php">Sign up</a>
      </p>
    </form>
  </div>

  <script src="../Asset/js/login 1.js"></script>
</body>

</html>