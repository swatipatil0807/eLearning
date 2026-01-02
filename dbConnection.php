<?php
$db_host = "localhost";  // localhost:3306 लिहायची गरज नाही
$db_user = "root";
$db_password = "root";
$db_name = "elearning_db";

// Create Connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check Connection
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// else {
//     echo "connected";
// }
?>
