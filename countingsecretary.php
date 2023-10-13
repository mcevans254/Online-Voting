<?php
// Database connection details
global $result;
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
$statement = "SELECT
student_table.admn,
student_table.Fname,
student_table.Sname,
contestants.contestantid,
posts.Post_name,
Count(voting.secretarygeneral) AS Total_Votes
FROM
contestants
INNER JOIN voting ON contestants.contestantid = voting.finance
INNER JOIN student_table ON student_table.admn = contestants.contestantid
INNER JOIN posts ON contestants.postid = posts.postID
GROUP BY
student_table.admn,
student_table.Fname,
student_table.Sname,
contestants.contestantid,
posts.Post_name";
// Execute the query
/**
 * @param mysqli $conn
 * @param $statement
 * @return bool|mysqli_result
 */
function getMysqli_result(mysqli $conn, $statement)
{
    $result = $conn->query($statement);
    if ($result->num_rows > 0) {
        // Output data of each row
        echo "
<link rel='stylesheet' href='body.css'>;
<link rel='stylesheet' href='main.css'>;
<table>
            <tr>
                <th>Admission Number</th>
                <th>First Name</th>
                <th>Contestant ID</th>
                <th>Voter ID</th>
                <th>Post Name</th>
                <th>Total Votes</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>" . $row['admn'] . "</td>
                <td>" . $row["Fname"] . "</td>
                <td>" . $row["Sname"] . "</td>
                <td>" . $row["contestantid"] . "</td>
                <td>" . $row["Post_name"] . "</td>
                <td>" . $row["Total_Votes"] . "</td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

// Close the database connection
    $conn->close();
    return $result;
}

$result = getMysqli_result($conn, $statement);