<?php
session_start();

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rules - Kean University eSports Arena</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Rules</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="availability.php">Computer Availability</a></li>
            <li><a href="OperationHours.php">Operation Hours</a></li>
            <li><a href="Download_Request_Form.php">Game Download Request</a></li>
            <li><a href="#reservation">Main Stage Reservation</a></li>
            <li><a href="FAQ.php">FAQ</a></li>
            <?php echo $dailyLogOption; ?>
            <?php echo $logoutOption; ?>
        </ul>
    </nav>
    <main>
        <h2>Rules for Open Play</h2>
        <p>Here are the rules for open play at the Kean University eSports Arena:</p>
        <ul>
            <li>Respect other players and staff.</li>
            <li>No food or drinks at the gaming stations.</li>
            <li>Use equipment responsibly.</li>
            <li>If using your own equipment, make sure to replug everything back in.</li>
        </ul>
        
        <h2>Rules for Competitive Spectating</h2>
        <p>For competitive spectating, please follow these rules:</p>
        <ul>
            <li>Respectful behavior in the spectating area.</li>
            <li>No distracting the players during matches</li>
            <li>Do not interrupt or distract the casters during game time.</li>
            <li>Follow staff instructions at all times.</li>
        </ul>
    </main>
</body>
</html>
