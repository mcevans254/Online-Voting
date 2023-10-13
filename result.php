<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>RESULT PAGE</title>
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
<?php
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

// SQL query to fetch contestants and their cumulative votes for each post
$sql = "SELECT 
            p.Post_name AS Post_Name,
            c.contestantid AS Contestant_Name,
            COUNT(v.voterid) AS Total_Votes
        FROM 
            posts p
        LEFT JOIN 
            contestants c ON p.postID = c.postid
        LEFT JOIN 
            voting_table v ON c.voterid = v.voterid
        GROUP BY 
            p.Post_name, c.contestantid
        ORDER BY
            p.Post_name, Total_Votes DESC";

// Execute the query
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Contestants and Cumulative Votes</h1>";
    $currentPost = ""; // To keep track of the current post

    while ($row = $result->fetch_assoc()) {
        $postName = $row["Post_Name"];
        $contestantName = $row["Contestant_Name"];
        $totalVotes = $row["Total_Votes"];

        // Display post name when it changes
        if ($postName !== $currentPost) {
            if ($currentPost !== "") {
                echo "</table>"; // Close the previous table
            }
            echo "<h2>$postName</h2>";
            echo "<table>
                    <tr>
                        <th>Contestant ID</th>
                        <th>Total Votes</th>
                    </tr>";
            $currentPost = $postName;
        }

        // Display contestant and votes
        echo "<tr>
                <td>$contestantName</td>
                <td>$totalVotes</td>
            </tr>";
    }

    echo "</table>"; // Close the last table
} else {
    echo "No results found.";
}

// Close the database connection
$conn->close();
?>
</body>
</html>
