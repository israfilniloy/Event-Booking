<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['AdminLoginstatus']) || $_SESSION['AdminLoginstatus'] !== true) {
    header('location: login.php');
    exit();
}
require_once '../Model/Users.php';
if (isset($_SESSION["AdminLoginstatus"]) && $_SESSION["AdminLoginstatus"] == true && isset($_POST["UpdateBtn"])) {
    $Firstname = $_POST["firstname"] ?? "";
    $Lastname = $_POST["lastName"] ?? "";
    $EmailAddress = $_POST["email"] ?? "";
    $Newpass = $_POST["password"] ?? "";
    $UserId = $_POST["user_id"];

    if (empty($Firstname) || empty($Lastname) || empty($EmailAddress) || empty($UserId)) {
        echo "Please fillup the required input box.";
        $_SESSION['UpdateStatus'] = false;

        header('location: ../View/Update_User_info.php');
    } else {
        if (empty($Newpass)) {
            updateUserInfoNoPass($UserId, $Firstname, $Lastname, $EmailAddress);
            $_SESSION['UpdateStatus'] = true;
            header('location: ../View/Update_User_info.php?id=' . $UserId);
        } else {
            updateUserInfo($UserId, $Firstname, $Lastname, $EmailAddress, $Newpass);
            $_SESSION['UpdateStatus'] = true;
            header('location: ../View/Update_User_info.php?id=' . $UserId);
        }
    }
} else {
    header('location: ../view/login.php');
    exit();
}
