<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['AdminLoginstatus']) || $_SESSION['AdminLoginstatus'] !== true) {
    header('location: login.php');
    exit();
} else {
    require_once('../Model/Users.php');
    if (isset($_POST["QuickSuspendBtn"]) && !empty($_POST["Choosed_Value"]) && !empty($_POST["UserId"])) {
        $value = $_POST["Choosed_Value"];
        $UserId = $_POST["UserId"];
        $ExpDate = getSuspentionExpDateById($UserId);
        if ($value == "remove") {
            RemoveSuspension($UserId);
            $_SESSION["QuickSuspendStatus"] = "Suspension removed successfully !!!";
            header("Location: ../View/SeeAllSuspended.php");
            exit();
        } else if ($value == "Ex_1day") {
            $newdate = date('y-m-d', strtotime($ExpDate . ' +1 day'));
            updateSuspensionDate($UserId, $newdate);
            $_SESSION["QuickSuspendStatus"] = "Suspension extended by 1 day !!!";
            header("Location: ../View/SeeAllSuspended.php");
            exit();
        } else if ($value == "Ex_3days") {
            $newdate = date('y-m-d', strtotime($ExpDate . ' +3 day'));
            updateSuspensionDate($UserId, $newdate);
            $_SESSION["QuickSuspendStatus"] = "Suspension extended by 3 days !!!";
            header("Location: ../View/SeeAllSuspended.php");
            exit();
        } else if ($value == "Re_1day") {
            $newdate = date('y-m-d', strtotime($ExpDate . ' -1 day'));
            updateSuspensionDate($UserId, $newdate);
            $_SESSION["QuickSuspendStatus"] = "Suspension reduced by 1 day !!!";
            header("Location: ../View/SeeAllSuspended.php");
            exit();
        } else if ($value == "Re_3days") {
            $newdate = date('y-m-d', strtotime($ExpDate . ' -3 day'));
            updateSuspensionDate($UserId, $newdate);
            $_SESSION["QuickSuspendStatus"] = "Suspension reduced by 3 days !!!";
            header("Location: ../View/SeeAllSuspended.php");
            exit();
        }
    } else {
        $_SESSION["QuickSuspendStatus"] = "Failed";
        header("Location: ../View/SeeAllSuspended.php");
        exit();
    }
}
