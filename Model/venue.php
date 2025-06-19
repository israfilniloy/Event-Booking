<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    require_once '../Model/DataBase.php';
    function addVenues($V_name, $V_Capacity, $V_Lo)
    {
        global $conn;

        $query = "INSERT INTO `venues` (`V_Id`, `V_Name`, `V_Capacity`, `V_Location`) VALUES (NULL, '$V_name', '$V_Capacity', '$V_Lo')";

        if (mysqli_query($conn, $query)) {
            return true;
        } else {
            return false;
        }
    }
    function getVenues()
    {
        global $conn;
        $query = "SELECT * FROM `venues`";
        $result = mysqli_query($conn, $query);
        $venues = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $venues[] = $row;
            }
        }
        return $venues;
    }

