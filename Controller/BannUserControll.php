<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['AdminLoginstatus']) || $_SESSION['AdminLoginstatus'] !== true) {
    header('location: login.php');
    exit();
}
require_once '../Model/Users.php';
if (isset($_POST["BanControlButton"])) {
    banUser($_SESSION["selected_user_For_Action"]);
    header("Location: ../View/TakeAction.php");
    $_SESSION["ReturnMsg"]="Banned Successfully";
    exit();
}
