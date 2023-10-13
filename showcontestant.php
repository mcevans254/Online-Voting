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
        <li><a href="showcontestant.php">Result</a></li>
    </ul>
</nav>
<form action="showcontestant.php" method="POST">

    <fieldset>
        <legend>Vote for your preferred Candidate below</legend>
        <table>
            <tr>
                <td>VoterID: <input type="text" name="voterid" id="voterid" placeholder="Voter ID" required/></td>
            </tr>
            <tr>
                <td>President:
                    <select name="President" id="President" required/>
                    <option value="">Select President</option>

                    </select>
                </td>
            </tr>
            <tr>
                <td>Vice president:
                    <select name="Vice_president" id="Vice_president" required>
                        <option value="">Select Vice President</option>

                    </select>
                </td>
            </tr>
            <tr>
                <td>Secretary General:
                    <select name="Secretary_General" id="Secretary_General" required>
                        <option value="">Select Secretary General</option>

                    </select>
                </td>
            </tr>
            <tr>
                <td>Minister of Academics:
                    <select name="Academics" id="Academics" required>
                        <option value="">Select Minister of Academics</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Minister Of Finance:
                    <select name="Finance" id="Finance" required>
                        <option value="">Select Minister Of Finance</option>

                    </select>
                </td>
            </tr>
            <tr>
                <td>Minister Of Sports:
                    <select name="Sports" id="Sports" required>
                        <option value="">Select Minister Of Sports</option>

                    </select>
                </td>
            </tr>
            <tr>
                <td>Minister Of Education:
                    <select name="Education" id="Education" required>
                        <option value="">Select Minister Of Education</option>

                    </select>
                </td>
            </tr>
            <tr>
                <td>Minister Of Entertainment:
                    <select name="Entertainment" id="Entertainment" required>
                        <option value="">Select Minister Of Entertainment</option>

                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Submit"/></td>
            </tr>
        </table>
    </fieldset>
</form>
<?php
// Replace with your actual database connection details
$host = "localhost";
$dbname = "university e-voting system";
$username = "root";
$password = "";

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Get the selected position from the URL parameter
    $selectedPosition = $_GET[""];

    // Prepare and execute a query to fetch contestants for the selected position
    $query = "SELECT contestant_ID,First_Name FROM all_contestant_view WHERE Post_name = :position";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":position", $selectedPosition);
    $stmt->execute();

// Fetch the data as an associative array
    $contestants = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the data as JSON
    header("Content-Type: application/json");
    echo json_encode($contestants);
} catch (PDOException $e) {
// Handle database connection or query errors
    echo "Error: " . $e->getMessage();
}
?>

<script>
    // Define a function to retrieve and populate the combo boxes for different positions
    function retrieveContestants(Post_name, rowId) {
        // Make an AJAX request to fetch contestants based on the selected position
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `showcontestant.php?position=${Post_name}`, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const contestants = JSON.parse(xhr.responseText);
                const comboBox = document.getElementById(Post_name);

                // Clear existing options
                comboBox.innerHTML = "";

                // Populate options based on retrieved contestants
                contestants.forEach((contestant) => {
                    const option = document.createElement("option");
                    option.value = contestant.contestantid;
                    option.textContent = contestant.name;
                    comboBox.appendChild(option);
                });
            }
        };
        xhr.send();
    }

    // Retrieve and populate options for each position
    retrieveContestants("President", "PresidentRow");
    retrieveContestants("Vice_president", "VP");
    retrieveContestants("Secretary_general", "sg");
    retrieveContestants("Finance", "Finance");
    retrieveContestants("Academics", "Academics");
    retrieveContestants("Sports", "Sport");
    retrieveContestants("Entertainment", "Entertainment");
    // Repeat for other positions

</script>

</body>
</html>
