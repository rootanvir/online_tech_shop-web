<?php
// fetch_notices.php
include 'db_connection.php';

// Fetch all notices
$sql = "SELECT * FROM notice";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $notices = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $notices[] = $row;
    }
    echo json_encode($notices); 
} else {
    echo json_encode([]);
}

// Close the connection
mysqli_close($conn);
?>
