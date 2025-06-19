<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once('./Model/featureEvents.php');
$result = getFeaturedEvents();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Eventify</title>
  <link rel="stylesheet" href="./Asset/CSS/style_Index.css?v18.0" />
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet" />
</head>

<body>
  <!-- header Starts -->
  <header>
    <div>
      <span class="logo">Eventify</span>
    </div>
    <nav>
      <ul>
        <a href="./Model/Events.php"></a>
        <li><a class="ActivePage" href="./index.php">Home</a></li>
        <li><a href="./View/EventCalendar.php">Events</a></li>
        <li><a href="./View/contactUs.php">Contact Us</a></li>
      </ul>
    </nav>
    <div id="LogSing" style="display: <?php if (isset($_SESSION["CustomerLoginstatus"])) {
                                        echo "none";
                                      } ?>;">
      <a class="Blacktxt" href="./View/login.php">Login</a>
      <a href="./View/signUp.php" id="sgnUp">Sign Up</a>
    </div>
    <div style="display: <?php if (!isset($_SESSION["CustomerLoginstatus"])) {
                            echo "none";
                          } ?>;">
      <span><a href="./Controller/logoutController.php">Logout</a></span>
    </div>
  </header>
  <!-- header Ends -->
  <main>
    <!-- Hero Section -->
    <section id="hero">
      <div class="hero-container" class="HeroSec-Div">
        <div id="hero-text" class="HeroSec-Div">
          <h1>Discover Extraordinary Events Near You</h1>
        </div>
        <p id="hero-description">
          From concerts to workshops, find and book tickets for the best
          events happening around you.
        </p>
        
      </div>
    </section>

    

    <!-- Category Section -->
    <section id="Category-Section">
      <div id="Category-Description">
        <h2>Browse by Category</h2>
        <p>Discover events that match your interests and passions</p>
      </div>

      <div class="Category-Container">
        <a href="./View/EventsByCategory.php?Category=music">
          <div class="Icon-Background" id="BgColor-Music-icon">
            <i class="ri-music-line" class="Icon-Properties"></i>
          </div>
          <h3 class="Category-h">Music</h3>
          <p class="Category-P">324 Events</p>
        </a>
        <a href="./View/EventsByCategory.php?Category=sports">
          <div class="Icon-Background" id="BgColor-Sports-icon">
            <i class="ri-basketball-line"></i>
          </div>
          <h3 class="Category-h">Sports</h3>
          <p class="Category-P">156 Events</p>
        </a>
        <a href="./View/EventsByCategory.php?Category=theatre">
          <div class="Icon-Background" id="BgColor-Theatre-icon">
            <i class="ri-movie-line"></i>
          </div>
          <h3 class="Category-h">Theatre</h3>
          <p class="Category-P">89 Events</p>
        </a>
        <a href="./View/EventsByCategory.php?Category=education">
          <div class="Icon-Background" id="BgColor-Education-icon">
            <i class="ri-book-open-line"></i>
          </div>
          <h3 class="Category-h">Education</h3>
          <p class="Category-P">412 Events</p>
        </a>
        <a href="./View/EventsByCategory.php?Category=food">
          <div class="Icon-Background" id="BgColor-FoodDriks-icon">
            <i class="ri-restaurant-line"></i>
          </div>
          <h3 class="Category-h">Food & Drinks</h3>
          <p class="Category-P">412 Events</p>
        </a>
        <a href="./View/EventsByCategory.php?Category=networking">
          <div class="Icon-Background" id="BgColor-Networking-icon">
            <i class="ri-community-line"></i>
          </div>
          <h3 class="Category-h">Networking</h3>
          <p class="Category-P">255 Events</p>
        </a>
        <a href="./View/EventsByCategory.php?Category=art">
          <div class="Icon-Background" id="BgColor-ArtCrafts-icon">
            <i class="ri-paint-brush-line"></i>
          </div>
          <h3 class="Category-h">Art & Crafts</h3>
          <p class="Category-P">412 Events</p>
        </a>
        <a href="./View/EventsByCategory.php?Category=health">
          <div class="Icon-Background" id="BgColor-HealthWellness-icon">
            <i class="ri-heart-line"></i>
          </div>
          <h3 class="Category-h">Health & Wellness</h3>
          <p class="Category-P">412 Events</p>
        </a>
      </div>
    </section>

    <!-- Featured Events Section -->
    <section id="Featured-Events">
      <div id="Featured-Events-Description">
        <span>
          <h2>Featured Events</h2>
          <p>Discover the most popular events this month</p>
        </span>
        <span>
          <a href="./View/EventCalendar.php" id="ViewAll" class="ViewAll-button">View All <i class="ri-arrow-right-line"></i></a>
        </span>
      </div>
      <div id="Featured-cards-container">
        <!-- Featured Events PHP -->
        <?php
        foreach ($result as $event) {
        ?>


          <div id="F1" class="Featured-cards">
            <div class="Featured-img-container">
              <img
                src="./Asset/Image/<?php echo $event["Thumbnail"]; ?>"
                class="Featured-img"
                alt="<?php echo $event["Thumbnail"]; ?>" />
            </div>
            <div class="Featured-text-1">
              <div class="Featured-tag">
                <?php
                switch ($event["E_Category"]) {
                  case "music":
                    $tagId = "music-tag";
                    break;
                  case "sports":
                    $tagId = "sports-tag";
                    break;
                  case "entertainment":
                    $tagId = "theatre-tag";
                    break;
                  case "education":
                    $tagId = "education-tag";
                    break;
                  case "food":
                    $tagId = "food-tag";
                    break;
                  case "social":
                    $tagId = "networking-tag";
                    break;
                  case "art":
                    $tagId = "art-tag";
                    break;
                  case "health":
                    $tagId = "health-tag";
                    break;
                  default:
                    $tagId = "";
                }
                ?>
                <span class="Tag" id="<?php echo $tagId; ?>"><?php echo $event["E_Category"]; ?></span>
                <span class="price"><?php echo $event["E.Price"]; ?>$</span>
              </div>
              <div class="Featured-below-tag">
                <h3 class="Featured-h3"><?php echo $event["E_Name"]; ?></h3>
                <span><i class="ri-map-pin-line"></i> <?php echo $event["E_Location"]; ?></span>
                <span><i class="ri-calendar-line"></i> <?php echo $event["E_Date"]; ?> • <?php echo date("h:i A", strtotime($event["E_Time"])); ?></span>
                <a href="./View/EventDetails.php?id=<?php echo $event["E_ID"]; ?>" id="BookNowBtn_1" class="Featured-button">
                  View Details
                </a>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
        <!-- Feature Events End here -->
      </div>
    </section>

    

    
    <!-- Newsletter Section -->
    <section id="Newsletter-Section">
      <div id="Newsletter-Header">
        <h2>Stay Updated with Eventify</h2>
        <p class="Newsletter-Description">
          Subscribe to our newsletter for the latest events and exclusive
          offers.
        </p>
      </div>
      <div class="Newsletter-Container">
        <div>
          <form action="" onsubmit="return isValidEmail()">
            <input
              type="email"
              placeholder="Enter your email address"
              id="newsletter-input" />
            <button id="newsletter-button">Subscribe</button>
          </form>
        </div>

        <div id="newsletter-privacy">
          <p class="Newsletter-Description">
            By subscribing, you agree to our Privacy Policy and consent to
            receive updates from us.
          </p>
          <p id="EmailError" class="error-message"></p>
        </div>
      </div>
    </section>
  </main>
  <!-- Footer Section -->
  <footer id="Footer-Section">
    <div class="footer-container">
      <div class="footer-brand">
        <h3>Eventify</h3>
        <p>Your gateway to unforgettable events and experiences.</p>
      </div>
      <div class="footer-links">
        <div class="footer-column">
          <h4>Company</h4>
          <ul>
            <li><a href="./View/contactUs.php">Contact</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h4>Support</h4>
          
        </div>
        <div class="footer-column">
          <h4>Follow Us</h4>
          <div class="social-icons">
            <a href="#"><i class="ri-facebook-fill"></i></a>
            <a href="#"><i class="ri-twitter-x-line"></i></a>
            <a href="#"><i class="ri-instagram-line"></i></a>
            <a href="#"><i class="ri-youtube-line"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2025 Eventify. All rights reserved.</p>
    </div>
  </footer>
  <script src="./Asset/js/LandingPage.js?v6.05"></script>
</body>

</html>