<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['AdminLoginstatus']) || $_SESSION['AdminLoginstatus'] !== true) {
  header('location: login.php');
  exit();
} else {
  require_once('../Model/Users.php');
  if (isset($_POST["SuspendControll_Btn"])) {
    RemoveSuspension($_SESSION["selected_user_For_Action"]);
    header("Location: ../View/TakeAction.php");
    $_SESSION["Suspention_Status"] = "Suspension removed successfully";
    exit();
  }
}
