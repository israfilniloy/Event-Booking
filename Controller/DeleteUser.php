<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['AdminLoginstatus']) || $_SESSION['AdminLoginstatus'] !== true) {
    header('location: login.php');
    exit();
} else {
    require_once('../Model/Users.php');
    if (isset($_POST["DeleteUser_Btn"])) {
        DeleteUser($_SESSION["selected_user_For_Action"]);
        $_SESSION['delete_success'] = true;
        header("Location: ../View/Users.php");
        exit();
    }
}
