<?php
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
    $postID = $_POST["postID"];
    $Post_name = $_POST["Post_name"];

    // You should perform additional validation and sanitation here before inserting data into the database.

    // Insert the new student into the database
    $sql = "INSERT INTO posts (postID, Post_name) VALUES ('$postID', '$Post_name')";

    // Close the database connection
    $conn->close();

