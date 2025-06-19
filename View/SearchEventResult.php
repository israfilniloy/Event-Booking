<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("../Model/Events.php");


$totalEvents = getTotalEventsCount();

$eventsPerPage = 12;
$totalPages = (int)ceil($totalEvents / $eventsPerPage);

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;


$result = getEventsByPage($page, $eventsPerPage);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Eventify</title>
  <link rel="stylesheet" href="../Asset/CSS/Style_EventCalender.css?v15.0" />
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet" />
</head>

<body>
  <!-- Header Starts -->
  <?php
  $_SESSION["Active"] = "ActivePage";
  include("../View/Header.php");
  ?>
  <!-- Header Ends -->

  <!-- Main Starts -->
  <main id="Main-Section">
    <div id="AllEventsHeader">
      <h1>All Events</h1>
      <p>Explore a variety of events happening near you.</p>
    </div>
    <!-- Search bar -->
    <div id="SrcBar_filters">
      <div id="SrcBar">
        <form action="" onsubmit="return isValidSearch()">
          <div id="srcBar-container" class="srcbar-Div">
            <input
              type="text"
              placeholder="Search for events"
              id="search-input" />
            <button id="search-button">Search</button>
          </div>
          <p id="errorMessage" class="error-message"></p>
        </form>
      </div>

      <div id="Filter">
        <label for="FilterEvents">Filter:</label>
        <select name="Filter" id="FilterEvents">
          <option value="All">All Events</option>
          <option value="LowToHigh">Price Low to High</option>
          <option value="HighToLow">Price High to Low</option>
          <option value="Recent">Most Recent</option>
          <option value="Week">This Week</option>
          <option value="Month">This Month</option>
          <option value="Year">This Year</option>
        </select>
      </div>
    </div>

    <!-- Events start -->
    <div id="EventCardContainer">

      <?php
      if (empty($result)) {
        echo "<h2>No Events Found.</h2>";
      } else {
        foreach ($result as $row) {
      ?>
          <div class="eventCards">
            <img src="../Asset/Image/<?php echo htmlspecialchars($row['Thumbnail']); ?>" alt="Event Thumbnail">
            <div class="EventDescription">
              <div id="EventTagContainer">
                <span class="EventTag" id="music-tag"><?php echo htmlspecialchars($row["E_Category"]); ?></span>
                <span class="price"><?php echo htmlspecialchars($row["E.Price"]); ?>$</span>
              </div>
              <h2><?php echo htmlspecialchars($row["E_Name"]); ?></h2>
              <p><?php echo htmlspecialchars($row["short_description"]); ?></p>
              <p>
                <span><i class="ri-calendar-line"></i></span>Date: <?php echo htmlspecialchars($row["E_Date"]); ?>
              </p>
              <p>
                <span><i class="ri-time-line"></i></span> <?php echo date("h:i A", strtotime($row["E_Time"])); ?>
              </p>
              <p>
                <span><i class="ri-map-pin-line"></i></span><?php echo htmlspecialchars($row["E_Location"]); ?>
              </p>
              <a href="EventDetails.php?id=<?php echo (int)$row["E_ID"]; ?>">View Details</a>
            </div>
          </div>
      <?php
        }
      }
      ?>


    </div>

    <!-- Pagination -->
    <div id="PaginationContainer">
      <div class="pagination">
        <!-- Previous Page Arrow -->
        <?php if ($page > 1): ?>
          <a href="?page=<?php echo $page - 1; ?>">&laquo;</a>
        <?php else: ?>
          <a href="#" style="pointer-events: none; color: gray;">&laquo;</a>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>>
            <?php echo $i; ?>
          </a>
        <?php endfor; ?>

        <!-- Next Page Arrow -->
        <?php if ($page < $totalPages): ?>
          <a href="?page=<?php echo $page + 1; ?>">&raquo;</a>
        <?php else: ?>
          <a href="#" style="pointer-events: none; color: gray;">&raquo;</a>
        <?php endif; ?>
      </div>
    </div>

    <!-- Event Container Ends -->
  </main>

  <!-- main Ends -->

  <?php
  include("../View/Footer.php");
  ?>

  <script src="../Asset/js/EventCalendar.js?v10.0"></script>
</body>

</html>