<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['AdminLoginstatus']) || $_SESSION['AdminLoginstatus'] !== true) {
    header('location: login.php');
    exit();
} else {
    require_once '../Model/venue.php';
    if (isset($_POST["addVenueBtn"])) {
        $Vname = $_POST["venueName"];
        $Vcapacity = $_POST["capacity"];
        $Vlocation = $_POST["location"];
        if ($Vname == "" || $Vcapacity == "" || $Vlocation == "") {
            header("location: ../View/System.php?error=emptyfields");
        } else {
            addVenues($Vname, $Vcapacity, $Vlocation);
            header("location: ../View/System.php?success=venueadded");
        }
    }
}
