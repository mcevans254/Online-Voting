<html>
<link rel="stylesheet" href="logout.css">
<body>
<form>
    <h1>Thank you for voting</h1>
    <?php
    session_start(); // Start a PHP session (if not already started)

    // Check if the user is logged in
    if (isset($_SESSION["username"])) {
        // Unset all session variables
        session_unset();

        // Destroy the session
        session_destroy();
    }

    // Redirect to the login page after logout
    header("location: index.php");
    exit();
    ?>
</form>
</body>
</html>
