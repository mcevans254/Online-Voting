<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>STUDENT VOTING PAGE</title>
    <link rel="stylesheet" href="main.css"/>
    <link rel="stylesheet" href="body.css"/>
</head>

<body>
<nav>
    <div class="heading">
        <h4>UNIVERSITY E-VOTING SYSTEM</h4>
    </div>
    <ul class="nav-links">
        <li><a href="home.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="result.php">Result</a></li>
    </ul>
</nav>
<form action="insertvote.php" method="POST">
    <fieldset>
        <legend>Vote for your preferred Candidate below</legend>
        <table>
            <tr>
                <td>VoterID: <input type="text" name="voterid" id="voterid" placeholder="Voter ID" required/></td>
            </tr>
            <tr>
                <td>President: <input type="text" name="President" id="President" placeholder="President" required/>
                </td>
            </tr>
            <tr>
                <td>Vice president: <input type="text" name="Vice_president" id="Vice_president"
                                           placeholder="Vice President" required/></td>
            </tr>
            <tr>
                <td>Secretary General: <input type="text" name="Secretary_General" id="Secretary_General"
                                              placeholder="Secretary General" required/></td>
            </tr>
            <tr>
                <td>Minister of Academics: <input type="text" name="Academics" id="Academics"
                                                  placeholder="Minister Of Academics" required/></td>
            </tr>
            <tr>
                <td>Minister Of Finance: <input type="text" name="Finance" id="Finance"
                                                placeholder="Minister Of Finance" required/></td>
            </tr>
            <tr>
                <td>Minister Of Sports: <input type="text" name="Sports" id="Sports"
                                               placeholder="Minister Of Sports"
                                               onfocus="retrieveContestants('Sports')" required/></td>
            </tr>
            <tr>
                <td>Minister Of Entertainment: <input type="text" name="Entertainment" id="Entertainment"
                                                      placeholder="Minister Of Entertainment" required/></td>
            </tr>
            <tr>
                <td><input type="submit" value="Submit"/></td>
            </tr>
        </table>
    </fieldset>

</form>
</body>
</html>


<?php
session_start();
$error_message = "";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
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

    // Retrieve form data
    $voterID = isset($_POST["voterid"]) ? $_POST["voterid"] : "";
    $President = isset($_POST["President"]) ? $_POST["President"] : "";
    $Vice_president = isset($_POST["Vice_president"]) ? $_POST["Vice_president"] : "";
    $secretary_general = isset($_POST["Secretary_General"]) ? $_POST["Secretary_General"] : "";
    $Finance = isset($_POST["Finance"]) ? $_POST["Finance"] : "";
    $Academics = isset($_POST["Academics"]) ? $_POST["Academics"] : "";
    $Sports = isset($_POST["Sports"]) ? $_POST["Sports"] : "";
    $Entertainment = isset($_POST["Entertainment"]) ? $_POST["Entertainment"] : "";

    // SQL query to insert data into the voting table
    $sql = "INSERT INTO voting_table (voterID, president, vicepresident, secretarygeneral,
                          finance, academics, sport, entertainment)
                            VALUES ('$voterID', '$President', '$Vice_president','$secretary_general','$Finance',
                                    '$Academics','$Sports','$Entertainment')";


    // Close the prepared statement and the database connection

    $conn->close();
}
