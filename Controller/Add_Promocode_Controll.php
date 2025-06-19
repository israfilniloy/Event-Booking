<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['AdminLoginstatus']) || $_SESSION['AdminLoginstatus'] !== true) {
    header('location: login.php');
    exit();
} else {
    require_once "../Model/Promocode.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addPromoBtn"])) {
        $code = $_POST["promoCode"];
        $discount = $_POST["discount"];
        $expiryDate = $_POST["expireDate"];
        if (empty($code) || empty($discount) || empty($expiryDate)) {
            header("Location: ../View/login.php?PromoError=1");
            exit();
        } else {
            addPromocode($code, $discount, $expiryDate);
            header("Location: ../View/System.php?PromoSuccess=1");
        }
    } else {
        header("Location: ../View/System.php?PromoError=1");
    }
}
