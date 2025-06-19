<?php 

require_once './Model/DataBase.php';


function getFeaturedEvents()
{
    global $conn;
    $query = "SELECT * FROM events ORDER BY E_ID DESC LIMIT 4;";
    $result = mysqli_query($conn, $query);
    $featuredEvents = [];
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $featuredEvents[] = $row;
        }
    }
    return $featuredEvents;
}
?>