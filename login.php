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

if (isset($_SESSION['username'])) {
    $dailyLogOption = '<li><a href="DailyLog.php">Daily Log</a></li>';
    $logoutOption = '<li><a href="logout.php">Logout</a></li>';
} 
else {
    $dailyLogOption = '';
    $logoutOption = '';
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
        <h1>Login</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="availability.php">Computer Availability</a></li>
            <li><a href="OperationHours.php">Operation Hours</a></li>
            <li><a href="Download_Request_Form.php">Game Download Request</a></li>
            <li><a href="#reservation">Main Stage Reservation</a></li>
            <li><a href="Rules.php">Rules</a></li>
            <li><a href="FAQ.php">FAQ</a></li>
            <?php echo $dailyLogOption; ?>
            <?php echo $logoutOption; ?>
        </ul>
    </nav>
    <main>
        <div id="login-form">
            <br>
            <form action="login.php" method="post">
                <label for="username">Username:</label>
                <input type="email" id="username" name="username" required>
                <br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br><br>
                <input type="submit" value="Login">
            </form>
            <br>
            <div id="error_message"><?php if (!empty($error_message)) echo "<font color='red'>$error_message</font>" ?></div>
            </div>
        </div>
    </main>
</body>
</html>

