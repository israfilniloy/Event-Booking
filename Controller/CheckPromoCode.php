<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['CustomerLoginstatus']) || $_SESSION['CustomerLoginstatus'] !== true) {
    header('location: login.php');
    exit();
} else {
    if (!isset($_SESSION['EventID'])) {
        die("EventID missing in session.");
    }

    $EventID = $_SESSION['EventID'];
    require_once '../Model/Events.php';

    $PromoCode_Input = $_POST['couponCode'] ?? '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($PromoCode_Input) && isset($_POST['applyCouponBtn'])) {
        $EventDetails = getEventByID($EventID);

        if (empty($EventDetails['PromoCode'])) {
            $_SESSION["InvalidPromoCode"] = "Wrong promo code applied for this event.";
            header("Location: ../View/Payment.php");
            exit();
        } elseif ($EventDetails["PromoCode"] === $PromoCode_Input) {
            require_once "../Model/Promocode.php";
            $promoCodeDetails = getPromocodeByCode($PromoCode_Input);
            $Discount = $promoCodeDetails['Discount'];
            $Price = $EventDetails['E.Price'] - ($EventDetails['E.Price'] * $Discount / 100);
            $_SESSION["EventPrice"] = $Price;
            $_SESSION["ValidPromoCode"] = "Promo code applied successfully.";
            header("Location: ../View/Payment.php");
            exit();
        } else {
            $_SESSION["InvalidPromoCode"] = "Invalid promo code.";
            header("Location: ../View/Payment.php");
            exit();
        }
    }
}
