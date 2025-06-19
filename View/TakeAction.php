<?php
session_start();
if (!isset($_SESSION['AdminLoginstatus']) || $_SESSION['AdminLoginstatus'] !== true) {
  header('location: login.php');
  exit();
}
require_once '../Model/Users.php';
if (isset($_GET["search"])) {
  $searchTerm = $_GET['SearchedItem'];
  $searchResults = searchUserById($searchTerm);
  if (!empty($searchResults)) {
    $userInfo = $searchResults[0];
    $_SESSION["selected_user_For_Action"] = $userInfo['U_Id'];
  }
} else {
  if (empty($_SESSION["selected_user_For_Action"])) {
    $_SESSION["selected_user_For_Action"] = $_GET['id'];
  }
  $userInfo = getCustomerById($_SESSION["selected_user_For_Action"]);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>

  <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="../Asset/CSS/Style_TakeAction.css?v2.0" />
</head>

<body>
  <!--Header Section-->
  <header>
    <div id="LogoContainer">
      <span class="logo">Eventify</span>
      <span class="GrayTxt" id="AdminTxt">Admin</span>
    </div>

    <div id="ProfileContainer">
      <a href="ProfileManagement.php" id="ProfileLink">Profile <span><i class="ri-user-3-line"></i></span></a>
    </div>
  </header>
  <!--Header Section End-->

  <main>
    <!-- Side Bar Starts -->
    <section id="asideSection">
      <aside>
        <nav class="asideNav">
          <ul>
            <li>
              <span><i class="ri-dashboard-line"></i></span>
              <a href="DashBoard.php">Dashboard</a>
            </li>
            <li>
              <span><i class="ri-calendar-event-line"></i></span><a href="Add_Event.php">Add Events</a>
            </li>
            
            <li id="logout">
              <span><i class="ri-logout-circle-r-line"></i></span>
              <a href="../Controller/logoutController.php">Logout</a>
            </li>
          </ul>
        </nav>
      </aside>
    </section>
    <!-- Side Bar Ends -->

    <!-- Main Content Area Stats -->
    <section id="mainContent">
      <div id="ManageUserHeader">
        <h1>Manage All Users</h1>
        <p id="ManageUserHeaderTxt">
          Here you can manage all the registered users of Eventify. You can
          view their details and also search for specific users.
        </p>
      </div>
      <!-- Search Bar Container Starts -->
      <div>
        <form action="" onsubmit="return isValid()" method="GET">
          <div id="Search_bar_container">
            <input
              type="text"
              id="Search_bar"
              placeholder="Search Users by ID or User Name" name="SearchedItem" />
            <button type="submit" name="search">Search <i class="ri-search-line"></i></button>
          </div>
          <p id="Search_bar_error" class="error_message"></p>
        </form>
      </div>
      <!-- Search Bar Container Starts -->

      <div id="UpdateformContainer">

        <!-- User Info Section -->
        <div class="user-info-card">
          <h2>User Information</h2>
          <?php
          if (!empty($userInfo)) {

            echo '<div class="info-row">
            <span class="info-label">ID:</span>
            <span class="info-value">' . $userInfo['U_Id'] . '</span>
          </div>';
            echo '<div class="info-row">
            <span class="info-label">First Name:</span>
            <span class="info-value">' . $userInfo['U_FirstName'] . '</span>
          </div>';
            echo '<div class="info-row">
            <span class="info-label">Last Name:</span>
            <span class="info-value">' . $userInfo['U_LastName'] . '</span>
          </div>';
            echo '<div class="info-row">
            <span class="info-label">Email:</span>
            <span class="info-value">' . $userInfo['U_Email'] . '</span>
          </div>';
            echo '<div class="info-row">
            <span class="info-label">Ban Status:</span>
            <span class="info-value">' . ($userInfo['isBanned'] ? 'Banned' : 'Not Banned') . '</span>
          </div>';
            echo '<div class="info-row">
            <span class="info-label">Suspension Status:</span>
            <span class="info-value">' . ($userInfo['isSuspended'] ? 'Suspended' : 'No Suspension') . '</span>
          </div>';
          echo '<div class="info-row">
            <span class="info-label">Role:</span>
            <span class="info-value">' . ucfirst($userInfo['U_Type']) . '</span>
          </div>';
          } else {
            echo '<p class="error_message">User not found.</p>';
          }
          ?>
        </div>
        <!-- Action Grid Section -->
        <div class="action-grid" style="visibility: <?php
                                                    if (empty($userInfo)) {
                                                      echo "hidden";
                                                    }
                                                    ?>">
          <!-- Ban User -->
          <div class="action-card">
            <?php
            if ($userInfo['isBanned'] == 0) {
              echo '<h4>Ban User</h4>';
              echo '<p>Immediately ban this user from accessing the platform.</p>';
            } else {
              echo '<h4>Unban User</h4>';
              echo '<p>Immediately unban this user from accessing the platform.</p>';
            }
            ?>
            <form action="../Controller/<?php if ($userInfo['isBanned'] == 0) {
                                          echo "BannUserControll.php";
                                        } else {
                                          echo "UnBanControll.php";
                                        } ?>" method="Post">
              <button type="submit" name="BanControlButton" class="action-btn ban" style="Background-color:<?php
                                                                                                            if ($userInfo['isBanned'] == 1) {
                                                                                                              echo "Green";
                                                                                                            }
                                                                                                            ?>">
                <?php
                if ($userInfo['isBanned'] == 0) {
                  echo "Ban User";
                } else {
                  echo "Unban User";
                }

                ?>

              </button>
              <p style="color: #4f46e5; padding: 5px 5px; font-weight:600;"><?php
                                                                            if (isset($_SESSION["ReturnMsg"])) {
                                                                              echo $_SESSION["ReturnMsg"];
                                                                              $_SESSION["ReturnMsg"] = "";
                                                                            }
                                                                            ?></p>
            </form>
          </div>

          <!-- Suspend User -->
          <div class="action-card">

            <form action="../Controller/<?php
                                        if ($userInfo['isSuspended'] == null) {
                                          echo "SuspendUserControll.php";
                                        } else {
                                          echo "RemoveSuspension.php";
                                        }

                                        ?>" method="POST">

              <?php
              if ($userInfo['isSuspended'] == null) {
                echo '<h4>Suspend User</h4>';
                echo '<p>Suspend account for a set period of time.</p>';
              ?>
                <p><strong>Select Expire Date</strong> <span><input
                      style="padding: 2px 6px; border: 1px solid #ccc; border-radius: 6px; font-size: 16px; background-color: #f9f9f9; color: #333; cursor: pointer;"
                      id="SUS"
                      type="date"
                      name="Suspend_Expire"
                      min="<?php echo date('Y-m-d'); ?>" required>
                  </span></p>

              <?php
              } else {
                echo '<h4>Remove suspension</h4>';
                echo '<p>Remove suspension which was set earlier.</p>';
                echo '<p style="font-weight:600;">Expire Date: ' . $userInfo["isSuspended"] . '</p>';
              }
              ?>


              <button type="submit" name="SuspendControll_Btn" class="action-btn suspend" onclick="suspendUser()">
                <?php
                if ($userInfo['isSuspended'] == null) {
                  echo 'Suspend';
                } else {
                  echo 'Remove suspension';
                }
                ?>
              </button>
              <p style="color: #4f46e5; padding: 5px 5px; font-weight:600;"><?php
                                                                            if (isset($_SESSION["Suspention_Status"])) {
                                                                              echo $_SESSION["Suspention_Status"];
                                                                              $_SESSION["Suspention_Status"] = "";
                                                                            }
                                                                            ?></p>
            </form>
          </div>

          <!-- Delete Permanently -->
          <div class="action-card">
            <h4>Delete Permanently</h4>
            <p>
              Warning: This will remove the account and all data permanently.
            </p>
            <form action="../Controller/DeleteUser.php" method="POST">
              <button type="submit" name="DeleteUser_Btn" class="action-btn delete">
                Delete
              </button>
              <p style="color: #4f46e5; padding: 5px 5px; font-weight:600;"><?php
                                                                            if (isset($_SESSION["Suspention_Status"])) {
                                                                              echo $_SESSION["Suspention_Status"];
                                                                              $_SESSION["Suspention_Status"] = "";
                                                                            }
                                                                            ?></p>
            </form>
          </div>

          <!-- Change Role -->
          <div class="action-card">
            <h4>Change Role</h4>
            <p>Upgrade or downgrade the user's role.</p>
            <form action="../Controller/ChangeRoleControll.php" method="POST">
            <select id="changeRole" name="newRole" require>
              <option value="customer">Customer</option>
              <option value="admin">Admin</option>
            </select>
            <button class="action-btn suspend" type="submit" name="cngRoleBtn">
              Change Role
            </button>
            <p style="color: #4f46e5; padding: 5px 5px; font-weight:600;"><?php
                                                                            if (isset($_SESSION["Suspention_Status"])) {
                                                                              echo $_SESSION["Suspention_Status"];
                                                                              $_SESSION["Suspention_Status"] = "";
                                                                            }
                                                                            ?></p>
            </form>
          </div>
<!-- 
          Send Warning
          <div class="action-card">
            <h4>Send Warning</h4>
            <p>Send an official warning message to the user.</p>
            <button class="action-btn ban" onclick="sendWarning()">
              Send Warning
            </button>
          </div>

          Lock Account
          <div class="action-card">
            <h4>Lock Account</h4>
            <p>Lock the account until further verification is done.</p>
            <button class="action-btn suspend" onclick="lockAccount()">
              Lock Account
            </button>
          </div> -->
        </div>
      </div>
    </section>
  </main>
  <script src="../Asset/js/TakeAction.js?v2.0"></script>
</body>

</html>