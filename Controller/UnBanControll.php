<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!isset($_SESSION['AdminLoginstatus']) || $_SESSION['AdminLoginstatus'] !== true) {
  header('location: login.php');
  exit();
} else {
  require_once '../Model/Users.php';
  if (isset($_POST["BanControlButton"])) {
    unbanUser($_SESSION["selected_user_For_Action"]);
    header("Location: ../View/TakeAction.php");
    $_SESSION["ReturnMsg"] = "Unbanned Successfully";
    exit();
  } else if (isset($_POST["unbanBtn_SeeAllBannedPage"]) && !empty($_POST["unbanBtn_SeeAllBannedPage"])) {
    unbanUser($_POST["unbanBtn_SeeAllBannedPage"]);
    header("Location: ../View/SeeAllBanned.php");
    $_SESSION["CommanExecutionMsg"] = "Unbanned Successfully";
    exit();
  }
  else{
    
  }
}
