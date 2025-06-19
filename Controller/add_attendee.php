<?php
include('../Model/DataBase.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name      = $_POST['a_name'] ?? '';
    $email     = $_POST['a_email'] ?? '';
    $check     = $_POST['a_Check'] ?? '';
    $status    = $_POST['a_Status'] ?? '';
    $eventName = $_POST['a_Event_Name'] ?? '';
    $eventID   = $_POST['a_EventID'] ?? 0;

    // Basic validation
    if (!$name || !$email || !$check || !$status || !$eventName || $eventID <= 0 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../View/attendee-list.php?error=Invalid input");
        exit;
    }

    // Direct SQL (not secure)
    $sql = "INSERT INTO attendance (a_name, a_email, a_Check, a_Status, a_Event_Name, a_EventID)
            VALUES ('$name', '$email', '$check', '$status', '$eventName', $eventID)";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../View/attendee-list.php?success=Added");
    } else {
        header("Location: ../View/attendee-list.php?error=Database error");
    }

    mysqli_close($conn);
} else {
    header("Location: ../View/attendee-list.php?error=Invalid request");
}
