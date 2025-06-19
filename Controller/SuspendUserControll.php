<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['AdminLoginstatus']) || $_SESSION['AdminLoginstatus'] !== true) {
    header('location: login.php');
    exit();
} else {
    require_once('../Model/Users.php');
    if (isset($_POST["SuspendControll_Btn"]) && !empty($_POST["Suspend_Expire"])) {
        $Duration = $_POST["Suspend_Expire"];
        // echo $Duration;
        SuspendUser($_SESSION["selected_user_For_Action"], $Duration);
        header("Location: ../View/TakeAction.php");
        $_SESSION["Suspention_Status"] = "Suspended successfully";
        exit();
    } else {
        header("Location: ../View/TakeAction.php");
        $_SESSION["Suspention_Status"] = "Suspended failed !";
        exit();
    }
}
