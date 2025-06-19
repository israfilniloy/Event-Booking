<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
require_once("../Model/Events.php");

if (isset($_GET['Search_Btn']) && !empty($_GET['Search_Input'])) {
  $SearchTerm = htmlspecialchars(trim($_GET['Search_Input']));
  $totalEvents = getTotalSearchResults($SearchTerm);
  $eventsPerPage = 12;
  $totalPages = (int)ceil($totalEvents / $eventsPerPage);
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $result = searchEventsByPage($SearchTerm, $page, $eventsPerPage);
} else if (!empty($_GET["Filter"])) {
  $SelectedOption = $_GET["Filter"];
  $totalEvents = getTotalEventsCount();
  $eventsPerPage = 12;
  $totalPages = (int)ceil($totalEvents / $eventsPerPage);
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $result = FilterEvents($SelectedOption, $page, $eventsPerPage);
} else {
  $totalEvents = getTotalEventsCount();
  $eventsPerPage = 12;
  $totalPages = (int)ceil($totalEvents / $eventsPerPage);
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $result = getEventsByPage($page, $eventsPerPage);
}
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
        <form method="GET" onsubmit="return isValidSearch()">
          <div id="srcBar-container" class="srcbar-Div">
            <input
              type="text"
              placeholder="Search for events"
              id="search-input" name="Search_Input" />
            <button id="search-button" name="Search_Btn" value="Search">Search</button>
          </div>
          <p id="errorMessage" class="error-message"></p>
        </form>
      </div>

      <div id="Filter">
        <form method="Get">
          <label for="FilterEvents">Filter:</label>
          <select name="Filter" id="FilterEvents" onchange="this.form.submit()">
            <option value="All">All Events</option>
            <option value="LowToHigh">Price Low to High</option>
            <option value="HighToLow">Price High to Low</option>
            <option value="Recent">Most Recent</option>
          </select>
        </form>
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
          <a href="<?php
                    echo '?';
                    if (isset($_GET['Search_Btn']) && !empty($_GET['Search_Input'])) {
                      echo 'Search_Input=' . urlencode($SearchTerm) . '&Search_Btn=' . urlencode($_GET['Search_Btn']) . '&';
                    } else if (!empty($_GET["Filter"])) {
                      echo 'Filter=' . urlencode($_GET["Filter"]) . '&';
                    }
                    echo 'page=' . ($page - 1);
                    ?>">&laquo;</a>
        <?php else: ?>
          <a href="" style="pointer-events: none; color: gray;">&laquo;</a>
        <?php endif; ?>

        <!-- Page Numbers -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <a href="<?php
                    echo '?';
                    if (isset($_GET['Search_Btn']) && !empty($_GET['Search_Input'])) {
                      echo 'Search_Input=' . urlencode($SearchTerm) . '&Search_Btn=' . urlencode($_GET['Search_Btn']) . '&';
                    } else if (!empty($_GET["Filter"])) {
                      echo 'Filter=' . urlencode($_GET["Filter"]) . '&';
                    }
                    echo 'page=' . $i;
                    ?>" <?php if ($i == $page) echo 'class="active"'; ?>>
            <?php echo $i; ?>
          </a>
        <?php endfor; ?>

        <!-- Next Page Arrow -->
        <?php if ($page < $totalPages): ?>
          <a href="<?php
                    echo '?';
                    if (isset($_GET['Search_Btn']) && !empty($_GET['Search_Input'])) {
                      echo 'Search_Input=' . urlencode($SearchTerm) . '&Search_Btn=' . urlencode($_GET['Search_Btn']) . '&';
                    } else if (!empty($_GET["Filter"])) {
                      echo 'Filter=' . urlencode($_GET["Filter"]) . '&';
                    }
                    echo 'page=' . ($page + 1);
                    ?>">&raquo;</a>
        <?php else: ?>
          <a href="" style="pointer-events: none; color: gray;">&raquo;</a>
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