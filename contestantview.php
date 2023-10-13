<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "university e-voting system";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// SQL query
$sql = "SELECT
    `student_table`.`admn` AS `Admission Number`,
    `student_table`.`Fname` AS `First_Name`,
    `student_table`.`Sname` AS `Second_Name`,
    `contestants`.`contestantid` AS `contestant_ID`,
    `contestants`.`voterid` AS `voter_ID`,
    `posts`.`Post_name` AS `Post_name`
FROM
    `posts`
JOIN
    `contestants`
ON
    `posts`.`postID` = `contestants`.`postid`
JOIN
    `student_table`
ON
    `contestants`.`voterid` = `student_table`.`admn`
";

// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    echo "
<link rel='stylesheet' href='body.css'>;
<link rel='stylesheet' href='main.css'>;
<table>
            <tr>
                <th>Admission Number</th>
                <th>First Name</th>
                <th>Second Name</th>
                <th>Contestant ID</th>
                <th>Voter ID</th>
                <th>Post Name</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["Admission Number"] . "</td>
                <td>" . $row["First_Name"] . "</td>
                <td>" . $row["Second_Name"] . "</td>
                <td>" . $row["contestant_ID"] . "</td>
                <td>" . $row["voter_ID"] . "</td>
                <td>" . $row["Post_name"] . "</td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();

