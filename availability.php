<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "justin";
$password = "justin";
$dbname = "cps4301";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";

// Process the login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["username"];
    $password = $_POST["password"];

    // TODO: Perform a query to verify the user's credentials
    // Example:
    $sql = "SELECT * FROM workers WHERE email = '$login' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Successful login, set a session variable to remember the user
        $_SESSION['username'] = $login;

        // Redirect to index.html
        header("Location: index.php");
        exit();
    } else {
        // Invalid credentials, display an error message
        $error_message = "Invalid username or password.";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kean University eSports Arena</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Kean University eSports Arena</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>
    <main>
        <div id="computer-availability">
            <h2>Computer Availability</h2>
            <ul>
                <?php
                for ($computerNumber = 1; $computerNumber <= 30; $computerNumber++) {
                    $availability = isset($computerAvailability[$computerNumber]) ? $computerAvailability[$computerNumber] : "Available";
                    $availabilityClass = ($availability == "Not Available") ? "not-available" : "available";
                    echo "<li class='$availabilityClass'>Computer $computerNumber: $availability</li>";
                }
                ?>
            </ul>
        </div>
        <p><a href="index.php">Refresh</a>
    </main>
</body>
</html>

