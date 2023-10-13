<?php
session_start();
$admn = isset($_POST["admn"]) ? $_POST["admn"] : "";

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university e-voting system";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the Admission Number is provided in the POST request
if (isset($_POST['admn'])) {
    // Prepare and execute an SQL query to check if the student exists in the student_table
    $sql = "SELECT COUNT(*) AS count FROM student_table WHERE admn = $admn";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $admn);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Check the count to determine if the student is registered
    if ($row['count'] > 0) {
        // Student is registered, proceed to insert voter data
        $insertSql = "INSERT INTO voters (admn) VALUES ($admn)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("s", $admn);
        if ($insertStmt->execute()) {
            // Insertion was successful
            $response = "Successfully Registered as a voter. Your VoterID is: " . $admn;
        } else {
            // Insertion failed
            $response = "Voter registration failed. Please try again later.";
        }
    } else {
        // Student is not registered
        $response = "Your Admission number is not found. Kindly ensure that you are registered as a student before trying again.";
    }
    }
else {
    echo "Please fill in the admission number";
}

