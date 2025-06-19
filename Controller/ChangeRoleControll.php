<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['AdminLoginstatus']) || $_SESSION['AdminLoginstatus'] !== true) {
    header('location: login.php');
    exit();
} else {
    require_once('../Model/Users.php');
    if (isset($_POST["cngRoleBtn"]) && !empty($_POST["newRole"])) {
        $Role = $_POST["newRole"];
        echo $Role;
        ChangeRole($_SESSION["selected_user_For_Action"], $Role);
        $_SESSION["CngRoleStatus"] = "Role Changed Successfully";
        header("Location: ../View/TakeAction.php");
        exit();
    }
    else{
        $_SESSION["CngRoleStatus"] = "Changing role was failed !";
        header("Location: ../View/TakeAction.php");
        exit();
    }
}
