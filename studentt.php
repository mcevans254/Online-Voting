<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data and sanitize it
    $admn = isset($_POST["admn"]) ? $_POST["admn"] : "";
    $Fname = isset($_POST["Fname"]) ? $_POST["Fname"] : "";
    $Sname = isset($_POST["Sname"]) ? $_POST["Sname"] : "";
    $Course = isset($_POST["Course"]) ? $_POST["Course"] : "";
    $dob = isset($_POST["dob"]) ? $_POST["dob"] : "";

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "university e-voting system"; // Update to match your actual database name

    // Create a new MySQLi connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO student_table (admn, Fname, Sname, Course,Date_Of_Admission) 
            VALUES ('$admn', '$Fname', '$Sname', '$Course','$dob')";
    echo "saved successfully";
    header("location: student.html");
    // Close the database connection
    $conn->close();
} else {
    echo "Form not submitted.";
}