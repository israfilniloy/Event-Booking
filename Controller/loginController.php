<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "../Model/Users.php";

$Email = $_POST['email'] ?? '';
$Password = $_POST['password'] ?? '';


if (empty($Email) || empty($Password)) {
    $_SESSION['status'] = false;
    $_SESSION["LoginError"] = "Email and password are required.";
    header('location: ../View/login.php');
    exit();
} else {
    $result = getUserByEmail($Email);
    if (!empty($result)) {
        if ($result["U_Email"] === $Email && $result["U_Password"] === $Password && $result["U_Type"] === "customer") {
            if ($result["isBanned"] == 1) {
                $_SESSION['CustomerLoginstatus'] = false;
                $_SESSION["LoginError"] = "Your account is banned.";
                header('location: ../View/login.php');
                exit();
            } elseif ($result["isSuspended"] != null) {
                $_SESSION['CustomerLoginstatus'] = false;
                $_SESSION["LoginError"] = "Your account is suspended.";
                header('location: ../View/login.php');
                exit();
            } else {
                $_SESSION['CustomerLoginstatus'] = true;
                $_SESSION['userID'] = $result['U_Id'];
                header('location: ../index.php');
                exit();
            }
        } elseif ($result["U_Email"] === $Email && $result["U_Password"] === $Password && $result["U_Type"] === "admin") {
            $_SESSION['AdminLoginstatus'] = true;
            $_SESSION['userID'] = $result['U_Id'];
            header('location: ../View/Dashboard.php');
            exit();
        } else {
            $_SESSION['CustomerLoginstatus'] = false;
            $_SESSION['AdminLoginstatus'] = false;
            $_SESSION["LoginError"] = "Invalid email or password.";
            header('location: ../View/login.php');
            exit();
        }
    } else {
        $_SESSION['CustomerLoginstatus'] = false;
        $_SESSION['AdminLoginstatus'] = false;
        $_SESSION["LoginError"] = "Invalid email or password.";
        header('location: ../View/login.php');
        exit();
    }
}
