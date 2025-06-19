<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    require_once "../Model/DataBase.php";
    function addPromocode($code, $discount, $expiryDate)
    {
        global $conn;
        $query = "INSERT INTO `promocodes` (`Code`, `Discount`, `Pro_Exp-date`) VALUES ('$code', '$discount', '$expiryDate')";
        if (mysqli_query($conn, $query)) {
            return true;
        } else {
            return false;
        }
    }
    function getPromocodes()
    {
        global $conn;
        $query = "SELECT * FROM `promocodes`";
        $result = mysqli_query($conn, $query);
        $promocodes = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $promocodes[] = $row;
        }
        return $promocodes;
    }
    function getPromocodeByCode($code)
    {
        global $conn;
        $query = "SELECT * FROM `promocodes` WHERE `Code` = '$code'";
        $result = mysqli_query($conn, $query);
        return mysqli_fetch_assoc($result);
    }
