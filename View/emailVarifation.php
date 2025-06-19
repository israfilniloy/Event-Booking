<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Verification</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <link rel="stylesheet" href="../Asset/CSS/emailVarifation 1.css" />
  </head>
  <body>
    <form class="emailVarifation" id="otpForm" action="login.php" onsubmit="return validateOTP()">
      <div class="verify-container">
        <i
          class="fas fa-arrow-left back-btn"
          onclick="window.location.href='signup.php'"
        ></i>

        <img
          src="https://cdn-icons-png.flaticon.com/512/561/561127.png"
          class="email-img"
          alt="Email"
        />

        <h2>Verify Your Email Address</h2>
        <p>
         <td> Please enter the 6 digit code sent to</td>
         <td>Antu348@gmail.com</td>
        </p>

        <div id="otpError" class="error"></div>

        <div class="otp-inputs">
          <input type="text" maxlength="1" class="otp-field" />
          <input type="text" maxlength="1" class="otp-field" />
          <input type="text" maxlength="1" class="otp-field" />
          <input type="text" maxlength="1" class="otp-field" />
          <input type="text" maxlength="1" class="otp-field" />
          <input type="text" maxlength="1" class="otp-field" />
        </div>

        <p class="change-email">
          Want to Change Your Email Address?
          <a href="../View/signUp.php">Change Here</a>
        </p>

        <button class="verify-btn" type="submit">Verify Email</button>

        <p class="resend-link">
          Didn't receive the code? <a href="#">Resend Code</a>
        </p>
      </div>
    </form>

    <script src="../Asset/js/emailVarifation.js"></script>
  </body>
</html>
