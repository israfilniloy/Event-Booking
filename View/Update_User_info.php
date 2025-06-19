<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['AdminLoginstatus']) || $_SESSION['AdminLoginstatus'] !== true) {
    header('location: login.php');
    exit();
}
require_once '../Model/Users.php';
$_SESSION["selected_user_id"]=$_GET['id'];

if (isset($_GET['search'])) {
  $searchTerm = $_GET['search'];
  $searchResults = searchUserById($searchTerm);
  if (!empty($searchResults)) {
    $userInfo = $searchResults[0];
  }
}
else if(empty($_GET['id'])){
  header('location: Users.php');
  exit();
} else {
  $userInfo = getCustomerById($_SESSION["selected_user_id"]);
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
  <link rel="stylesheet" href="../Asset/CSS/Style_UpdateUserInfo.Css" />
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

      <div>
        <form action="" method="GET" onsubmit="return isValid()">
          <div id="Search_bar_container">
            <input
              type="number"
              id="Search_bar"
              placeholder="Search Users by ID" name="search" />
            <button>Search <i class="ri-search-line"></i></button>
          </div>
          <p id="Search_bar_error" class="error_message"></p>
        </form>
      </div>
      <div id="UpdateformContainer">

        <!-- User Info Section -->
        <div class="user-info-card">
          <h2>User Information</h2>

          <?php if (!empty($userInfo)): ?>
            <div class="info-row">
              <span class="info-label">ID:</span>
              <span class="info-value"><?php echo $userInfo['U_Id']; ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">First Name:</span>
              <span class="info-value"><?php echo $userInfo['U_FirstName']; ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Last Name:</span>
              <span class="info-value"><?php echo $userInfo['U_LastName']; ?></span>
            </div>
            <div class="info-row">
              <span class="info-label">Email:</span>
              <span class="info-value"><?php echo $userInfo['U_Email']; ?></span>
            </div>
            <?php if (isset($_SESSION['UpdateStatus'])): ?>
              <div style="display: <?php echo $_SESSION['UpdateStatus'] ? 'block' : 'none'; ?>; color: green; font-weight: bold; margin-top: 10px;">
                <?php
                echo $_SESSION['UpdateStatus'] ? 'Updated Successfully' : 'Update Failed';
                unset($_SESSION['UpdateStatus']);
                ?>
              </div>
            <?php endif; ?>

          <?php else: ?>
            <p>User not found.</p>
          <?php endif; ?>

        </div>

        <!-- Update Form -->
        <form action="../Controller/UpdateUserController.php" method="POST" class="update-profile-form" onsubmit="return isValidInput()">
          <h3>Edit Profile</h3>
          <input type="hidden" name="user_id" value="<?php echo $userInfo['U_Id']; ?>">
          <div class="form-group">

            <label for="name">First Name</label>
            <input
              type="text"
              id="name"
              name="firstname"
              placeholder="Enter First name" />
            <div class="error" id="nameError"></div>
          </div>
          <div class="form-group">
            <label for="lastName">Last Name</label>
            <input
              type="text"
              id="lastName"
              name="lastName"
              placeholder="Enter Last name" />
            <div class="error" id="lastNameError"></div>
          </div>

          <div class="form-group">
            <label for="email">Email Address</label>
            <input
              type="email"
              id="email"
              name="email"
              placeholder="Enter email" />
            <div class="error" id="emailError"></div>
          </div>

          <div class="form-group">
            <label for="password">New Password (optional) </label>
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Enter new password" />
            <div class="error" id="passwordError"></div>
          </div>

          <button type="submit" class="update-btn" name="UpdateBtn">Update Profile</button>
          <p id="ErrorMsg_Update_Form"></p>
        </form>
      </div>
    </section>
  </main>
  <script src="../Asset/js/UpdateUserInfo.js"></script>
</body>

</html>