<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <link rel="stylesheet" href="../Asset/CSS/Contactus.css" />
  </head>
  <body>
    <div class="contact-container" id="form-container">
      <i
        class="fas fa-arrow-left back-icon"
        onclick="window.location.href='../index.php'"
      ></i>
      <h2>Contact Us</h2>
      <p>
        We’d love to hear from you! Fill out the form below and we’ll get back
        to you as soon as possible.
      </p>
      <div id="error" class="error" style="display: none"></div>
      <form class="contact-form" id="contact-form" method="post" onsubmit="return validationContact()">
        <div class="input-group">
          <input type="text" name="name" placeholder="Full Name" id="fullname"/>
          <div id="fullNameError" class="error"></div>
        </div>
        <div class="input-group">
          <input type="email" name="email" placeholder="Email Address" id="email" />
          <div id="emailError" class="error"></div>
        </div>
        <div class="input-group">
          <input type="text" name="subject" placeholder="Subject" id="subject"/>
          <div id="subjectError" class="error"></div>
        </div>
        <div class="input-group">
          <textarea
            name="message"
            id="message"
            rows="5"
            placeholder="Your Message"
          ></textarea>
          <div id="messageError" class="error"></div> 
        </div>
        <button type="submit" class="submit-btn">Send Message</button>
      </form>
    </div>

    <script src="../Asset/js/contactUs.js"></script>
  </body>
</html>