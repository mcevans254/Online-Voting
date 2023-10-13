<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="body.css"/>
    <link rel="stylesheet" href="main.css"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
    <nav>

        <div class="heading">

            <h4> UNIVERSITY E-VOTING SYSTEM </h4>

        </div>

        <ul class="nav-links">

            <li><a href="home.html">Home</a></li>

            <li><a href="about.html">About</a></li>

            <li><a href="contact.html">Contact</a></li>
            <li><a href="result.php">Result</a></li>

        </ul>

    </nav>
    <br/>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="post">
        <input id="username" type="text" name="username" placeholder="Username" required/>
        <input id="password" type="password" name="password" placeholder="Password" required/>
        <input id="submit" type="submit" value="submit"/>
        <?php
        $error_message = ""; // Initialize the error message
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

            // Retrieve user input
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Sanitize input (to prevent SQL injection, consider using prepared statements)
            $username = mysqli_real_escape_string($conn, $username);
            $password = mysqli_real_escape_string($conn, $password);

            // Perform user authentication
            $sql = "SELECT * FROM login WHERE Username= '$username' AND password= '$password'";
            $result = $conn->query($sql);

            if (!$result) {
                // Display the MySQL error
                echo "Record Not Saved";
                die("MySQL Error: " . $conn->error);
            }

            if ($result->num_rows == 1) {
                // Authentication successful, set user session
                $_SESSION["username"] = $username;
                header("location: loading.html"); // Redirect to a welcome page
                exit(); // Terminate the script after redirect
            } else {
                // Authentication failed, set an error message
                $error_message = "Invalid username or password. Please try again.";
            }
            $stmt = "SELECT * FROM login WHERE Username= 'admin' AND password= '$password'";
            $result = $conn->query($stmt);

            if (!$result) {
                // Display the MySQL error

                die("MySQL Error: " . $conn->error);
            }

            if ($result->num_rows == 1) {
                // Authentication successful, set user session
                $_SESSION["username"] = $username;
                header("location: loading.html"); // Redirect to a welcome page
                exit(); // Terminate the script after redirect
            } else {
                // Authentication failed, set an error message
                $error_message = "Invalid username or password. Please try again.";
            }

            // Close the database connection
            $conn->close();
        }

        // Check if the user is logged in
        if (isset($_SESSION["username"])) {
            // Unset all session variables
            session_unset();

            // Destroy the session
            session_destroy();
        }
        ?>
        <!-- Display the error message if it's not empty -->
        <p style="color: red;"><?php echo $error_message; ?></p>
    </form>
</div>
</body>
</html>
