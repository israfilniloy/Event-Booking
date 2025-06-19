<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['SCRIPT_NAME']); 
?>

<header>
  <div>
    <span class="logo">Eventify</span>
  </div>
  <nav>
    <ul>
      <li><a class="<?= $currentPage == 'index.php' ? 'ActivePage' : '' ?>" href="../index.php">Home</a></li>
      <li><a class="<?= $currentPage == 'EventCalendar.php' ? 'ActivePage' : '' ?>" href="./EventCalendar.php">Events</a></li>
      <li><a class="<?= $currentPage == 'contactUs.php' ? 'ActivePage' : '' ?>" href="./contactUs.php">Contact Us</a></li>
    </ul>
  </nav>
  


  <div id="LogSing" style="display: <?php if (isset($_SESSION["CustomerLoginstatus"])){ echo "none"; } ?>;">
    <a class="Blacktxt <?= $currentPage == 'login.php' ? 'ActivePage' : '' ?>" href="./login.php">Login</a>
    <a class="<?= $currentPage == 'signUp.php' ? 'ActivePage' : '' ?>" href="./signUp.php" id="sgnUp">Sign Up</a>
  </div>
  <div style="display: <?php if (!isset($_SESSION["CustomerLoginstatus"])){ echo "none"; } ?>;">
    <span><a href="../Controller/logoutController.php">Logout</a></span>
  </div>
</header>
