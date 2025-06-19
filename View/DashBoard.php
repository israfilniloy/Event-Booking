<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['AdminLoginstatus']) || $_SESSION['AdminLoginstatus'] !== true) {
  header('location: login.php');
  exit();
} else {
  require_once '../Model/Events.php';
  require_once '../Model/Users.php';
  $TotalEvents = totalEvents();
  $TotalUsers = TotalCustomers();
  if (isset($_GET["Search_Btn"]) && !empty($_GET["Search_Input"])) {
   $SearchTerm = $_GET["Search_Input"];
    echo $SearchTerm;
    $users = searchUserById($SearchTerm);
  }
  else{
    $users = GetRecentUsers();
  }
  if (!empty($_SESSION["selected_user_For_Action"])) {
    unset($_SESSION["selected_user_For_Action"]);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="../Asset/CSS/Style_DashBoard.css?v2.0" />
  <!-- <link rel="stylesheet" href="../Asset/CSS/Style_Users.css" /> -->
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet" />
</head>

<body>
  <!--Header Section-->
  <header>
    <div id="LogoContainer">
      <span class="logo">Eventify</span>
      <span class="GrayTxt" id="AdminTxt">Admin</span>
    </div>

    
  </header>
  <!--Header Section End-->

  <!--Main Section-->
  <main>
    <!-- Side Bar Starts -->
    <section id="asideSection">
      <aside>
        <nav class="asideNav">
          <ul>
            <li id="Selected_Page">
              <span><i class="ri-dashboard-line"></i></span>
              <a href="./DashBoard.php">Dashboard</a>
            </li>
            <li>
              <span><i class="ri-calendar-event-line"></i></span><a href="./Add_Event.php">Add Events</a>
            </li>
            <li id="logout">
              <span><i class="ri-logout-circle-r-line"></i></span>
              <a href="../Controller/logoutController.php">Logout</a>
            </li>
          </ul>
        </nav>
      </aside>
    </section>
    <!-- Side bar Ends -->

    <!-- Main Content Area -->
    <section id="mainContent">
      <!-- Dashboard starts -->
      <div class="contentHeader">
        <h1>Dashboard Overview</h1>
        <p>Welcome back! Here's what's happening with your events.</p>
      </div>
      <!-- Dashboard cards starts -->
      <div class="DashboardCards">
        
        <!-- Card 2 Active Events -->
        <div class="card">
          <div class="cardLogo_Percent">
            <span id="Active_Event_BG" class="card_icon_BG"><i class="ri-calendar-event-line"></i></span>
            <span id="Active_event_percent" class="Dashboard_cards_Percent">+12.5%
            </span>
          </div>
          <h3><?php echo htmlspecialchars($TotalEvents); ?></h3>
          <p>Total Events</p>
        </div>

        

        <!-- Card 4 Total User -->
        <div class="card">
          <div class="cardLogo_Percent">
            <span id="Total_User_icon_BG" class="card_icon_BG"><i class="ri-user-line"></i></span>
            <span id="Total_user_percent" class="Dashboard_cards_Percent">+12.5%
            </span>
          </div>
          <h3><?php echo htmlspecialchars($TotalUsers); ?></h3>
          <p>Total User</p>
        </div>
      </div>
      <!-- Dashboard Cards End -->

      <!-- Revenue stats & Sales Trend Starts -->
      <div id="RevenueStats_SalesTrend_Container">
        <!-- Revenue Stats Start -->
        <!-- <div id="RevenueStatsContainer" class="RevenueStats_SalesTrendsCards">
          <div id="RevenueStatsContainer_header">
            <h3><i class="ri-bar-chart-line"></i> Revenue Stats</h3>
            <span id="RevenueStatsContainer_header_links_Container">
              <span class="RevenueStatsContainer_header_links"><a href="#">Week</a></span>
              <span class="RevenueStatsContainer_header_links"><a href="#">Year</a></span>
              <span class="RevenueStatsContainer_header_links"><a href="#">Month</a></span>
            </span>
          </div>

          <div>
            <img
              src="../Asset/Image/Trends.jpg"
              alt=""
              id="RevenueStatsContainer_img" />
          </div>
        </div> -->
        <!-- Revenue Stats Ends -->

        <!-- Sales Trends Start -->
        <!-- <div id="Sale_Trends_Container" class="RevenueStats_SalesTrendsCards">
          <div id="RevenueStatsContainer_header">
            <h3><i class="ri-line-chart-line"></i> Sales Trends</h3>
            <span id="RevenueStatsContainer_header_links_Container">
              <span class="RevenueStatsContainer_header_links"><a href="#">Week</a></span>
              <span class="RevenueStatsContainer_header_links"><a href="#">Year</a></span>
              <span class="RevenueStatsContainer_header_links"><a href="#">Month</a></span>
            </span>
          </div>

          <div>
            <img
              src="../Asset/Image/Sale_Trends.webp"
              alt=""
              id="RevenueStatsContainer_img" />
          </div> -->
        </div>
        <!-- Sales Trends Ends -->
      </div>
      <!-- Revenue stats & Sales Trend Starts -->

      <!-- Recent User Starts -->
      <div id="RecentUserContainer">
        <div id="ManageUserHeader">
          <h1>Recently Registered Users</h1>
          <p id="ManageUserHeaderTxt">
            Manage the registered users of Eventify. You can view their
            details and also search for specific users.
          </p>
        </div>
        <!-- Search & Filter Starts -->
        <div>
          <form method="GET" onsubmit="return isValid()">
            <div id="Search_bar_container">
              <input
                type="text"
                id="Search_bar"
                placeholder="Search Users by ID or User Name" name="Search_Input" />
              <button type="submit" name="Search_Btn">Search <i class="ri-search-line"></i></button>
            </div>
            <p id="Search_bar_error" class="error_message"></p>
          </form>
        </div>

        <div id="RecentUser">
          <div id="RecentUserHeader">
            <h3>Recently Registered Users</h3>
            <!-- <span>
               <label for="genderFilter">Filter by Gender: </label>
              <select id="genderFilter">
                <option value="">All</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </span> -->
          </div>
          <!-- Search & FIlter Ends -->

          <!-- Recent User Table Starts -->
          <table id="RecentUserTable" border="1">
            <thead>
              <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Update</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php

              if (!empty($users)) {
                foreach ($users as $user) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($user['U_Id']) . "</td>";
                  echo "<td>" . htmlspecialchars($user['U_FirstName']) . "</td>";
                  echo "<td>" . htmlspecialchars($user['U_LastName']) . "</td>";
                  echo "<td>" . htmlspecialchars($user['U_Email']) . "</td>";
                  echo '<td><a href="./Update_User_info.php?id=' . urlencode($user['U_Id']) . '">Edit</a></td>';
                  echo '<td><a class="Action" href="./TakeAction.php?id=' . urlencode($user['U_Id']) . '">Action</a></td>';
                  echo "</tr>";
                }
              } else {
                echo '<p style="color:red; font-weight:600;">No User Found.</p>';
              }
              ?>
            </tbody>
          </table>
          <!-- Recent User Table Ends -->
          
        </div>
      </div>
      <!-- Recent User Ends -->
    </section>
  </main>
  <script src="../Asset/js/AddUsers.js"></script>
</body>

</html>