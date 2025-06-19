<?php
require_once '../Model/DataBase.php';
function addEvent($EName, $EDate, $ETime, $ELocation, $EDescription, $ESDescription, $EThumbnail, $ECategory, $ETicketPrice, $EVenueID, $PromoCode)
{
    global $conn;
    $query = "INSERT INTO `events` (`E_ID`, `E_Name`, `E_Location`, `E_Date`, `E_Time`, `E_Description`, `E_Category`, `E.Price`, `short_description`, `Thumbnail`, `venue_ID`, `PromoCode`) VALUES (NULL, '$EName', '$ELocation', '$EDate', '$ETime', '$EDescription', '$ECategory', '$ETicketPrice', '$ESDescription', '$EThumbnail', '$EVenueID', '$PromoCode')";
    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        return false;
    }
}

function totalEvents()
{
    global $conn;
    $query = "SELECT COUNT(*) AS total FROM events";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    } else {
        return 0;
    }
}
function geteventDetails($eventID)
{
    global $conn;
    $query = "SELECT * FROM events WHERE E_ID = '$eventID'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}
function getEventByID($eventID)
{
    global $conn;
    $query = "SELECT * FROM events WHERE E_ID = '$eventID'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}
function getEventsByCategory($category)
{
    global $conn;

    $query = "SELECT * FROM events WHERE E_Category = '$category'";
    $result = mysqli_query($conn, $query);
    $events = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }
    }

    return $events;
}
function getAllEvents()
{
    global $conn;
    $query = "SELECT * FROM events";
    $result = mysqli_query($conn, $query);
    $events = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }
    }

    return $events;
}
function getTotalEventsCount()
{
    global $conn;
    $sql = "SELECT COUNT(*) AS total FROM events";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total'];
    }
    return 0;
}

function getEventsByPage($page = 1, $eventsPerPage = 12)
{
    global $conn;
    $offset = ($page - 1) * $eventsPerPage;
    $sql = "SELECT * FROM events LIMIT $eventsPerPage OFFSET $offset"; //Starts from $offset and skips $eventsPerPage events
    $result = mysqli_query($conn, $sql);
    $events = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }
    }
    return $events;
}

function searchEventsByPage($searchTerm, $page = 1, $eventsPerPage = 12)
{
    global $conn;
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm);
    $offset = ($page - 1) * $eventsPerPage;
    $query = "SELECT * FROM events WHERE E_Name LIKE '%$searchTerm%' OR E_Description LIKE '%$searchTerm%' OR E_Location LIKE '%$searchTerm%' LIMIT $eventsPerPage OFFSET $offset";
    $result = mysqli_query($conn, $query);
    $events = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }
    }
    return $events;
}
function getTotalSearchResults($searchTerm)
{
    global $conn;
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm);
    $query = "SELECT COUNT(*) AS total FROM events WHERE E_Name LIKE '%$searchTerm%' OR E_Description LIKE '%$searchTerm%' OR E_Location LIKE '%$searchTerm%'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total'];
    }
    return 0;
}
function FilterEvents($Choice, $page = 1, $eventsPerPage = 12)
{
    global $conn;
    $offset = ($page - 1) * $eventsPerPage;

    switch ($Choice) {
        case "LowToHigh":
            $query = "SELECT * FROM events ORDER BY `E.Price` ASC LIMIT $eventsPerPage OFFSET $offset";
            break;

        case "HighToLow":
            $query = "SELECT * FROM events ORDER BY `E.Price` DESC LIMIT $eventsPerPage OFFSET $offset";
            break;

        case "Recent":
            $query = "SELECT * FROM events ORDER BY `E_Date` ASC LIMIT $eventsPerPage OFFSET $offset";
            break;
        case "":
        case "All":
        default:
            $query = "SELECT * FROM events ORDER BY `E_Date` DESC LIMIT $eventsPerPage OFFSET $offset";
            break;
    }

    $result = mysqli_query($conn, $query);
    $events = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }
    }

    return $events;
}
