<?php
// Database connection settings
$servername = "localhost";  // Database server (usually 'localhost')
$username = "root";         // Database username (default is 'root' for XAMPP)
$password = "";             // Database password (default is empty for XAMPP)
$dbname = "flipkart";       // Database name (in your case, 'flipkart')

// Create a connection to the database using mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
