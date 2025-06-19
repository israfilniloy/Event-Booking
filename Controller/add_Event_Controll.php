<?php
require_once '../Model/Events.php';

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['AdminLoginstatus']) || $_SESSION['AdminLoginstatus'] !== true) {
     header('location: login.php');
     exit();
}
if (isset($_POST["AddEvent"]) && $_SESSION['AdminLoginstatus'] == true) {

    $EventName = "";
    $EventDate = "";
    $EventTime = "";
    $EventLocation = "";
    $EventDescription = "";
    $EventShortDescription = "";
    $EventThumbnail = "";
    $EventCategory = "";
    $TicketPrice = "";
    $EventVenue = "";

     
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $EventName = $_POST["eventName"] ?? "";
        $EventDate = $_POST["eventDate"] ?? "";
        $EventTime = $_POST["eventTime"] ?? "";
        $EventLocation = $_POST["eventLocation"] ?? "";
        $EventDescription = $_POST["eventDescription"] ?? "";
        $EventShortDescription = $_POST["ShortDescription"] ?? "";
        $EventCategory = $_POST["eventCategory"] ?? "";
        $TicketPrice = $_POST["eventPrice"] ?? "";
        $EventVenue = $_POST["eventVenue"] ?? "";
        $EventThumbnail = $_FILES["eventImage"]["name"] ?? "";
        $PromoCode = $_POST["PromoCode"] ?? "";
        if (
            empty($EventName) || empty($EventDate) || empty($EventTime) || empty($EventLocation) ||
            empty($EventDescription) || empty($EventCategory) ||
            empty($TicketPrice) || empty($EventVenue) ||
            !isset($_FILES["eventImage"])
        ) {
            echo "Please fill in all fields.";
        } else {
            $ThumbnailName = $_FILES["eventImage"]["name"];
            $ThumbnailTmpName = $_FILES["eventImage"]["tmp_name"];
            $ThumbnailDestination = "../Asset/Image/" . $ThumbnailName; 
            move_uploaded_file($ThumbnailTmpName, $ThumbnailDestination);
            $result = addEvent($EventName, $EventDate, $EventTime, $EventLocation, $EventDescription,$EventShortDescription, $ThumbnailName, $EventCategory, $TicketPrice, $EventVenue, $PromoCode);
            if ($result) {
                header('location: ../view/Add_Event.php?success=1');
                exit();
            } else {
                echo "Error adding event. Please try again.";
            }
        }
    }
} else {
    header('location: ../view/login.php');
    exit();
}
