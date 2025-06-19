<?php
include('../Model/DataBase.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $json = $_POST['json'] ?? '';
    $data = json_decode($json, true);

    if (!$data) {
        echo json_encode(['error' => 'Invalid JSON']);
        exit;
    }

    $filter = $data['request'] ?? 'all';

    $sql = "SELECT a_id, a_name, a_email, a_Check, a_Status, a_Event_Name, a_EventID FROM attendance";

    if ($filter == 'checked') {
        $sql .= " WHERE a_Check = 'Checked'";
    } elseif ($filter == 'unchecked') {
        $sql .= " WHERE a_Check = 'Unchecked'";
    }

    $sql .= " ORDER BY a_id DESC";

    $result = mysqli_query($conn, $sql);
    $output = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
    } else {
        $output = ['error' => 'Query failed'];
    }

    echo json_encode($output);
} else {
    echo json_encode(['error' => 'Invalid method']);
}

mysqli_close($conn);
