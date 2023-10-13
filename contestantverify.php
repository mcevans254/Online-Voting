<?php
// Assuming you have established a database connection earlier in your application
// Replace the following with your actual database credentials
$host = "localhost";
$username = "root";
$password = "";
$database = "university e-voting system";

// Create a MySQLi connection
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$voterID= isset($_POST['VoterID']);
$postID= isset($_POST['postID']);
// Check if the voterID is provided in the POST request
if (isset($_POST['voterID'])) {
    // Prepare and execute an SQL query to check if the voter exists in the voters table
    $sql = "SELECT COUNT(*) AS count FROM voters WHERE VoterID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $voterID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check the count to determine if the voter is already registered
    if ($row['count'] > 0) {
        // Voter is already registered
        $error_message = "You are a voter";
    } else {
        // Voter is not registered
        $error_message = "you are not a registered vote";
    }
} else {
    // Handle the case where voterID is not provided in the POST request
    echo "your voter id is not found kindly ensure that you are registered voter before trying again";
}
$statement="insert into contestants values ('$voterID','$postID')";
// Close the database connection
$conn->close();
