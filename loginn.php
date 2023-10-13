<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection settings (update these with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "university e-voting system";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve user input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // You should perform additional validation and sanitation here before inserting data into the database.

    // Insert the new student into the database
    $sql = "INSERT INTO login (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, redirect to the login page
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
