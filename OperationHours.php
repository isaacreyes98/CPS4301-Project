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
    <title>Operation Hours - Kean University eSports Arena</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Operation Hours</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="availability.php">Computer Availability</a></li>
            <li><a href="Download_Request_Form.php">Game Download Request</a></li>
            <li><a href="#reservation">Main Stage Reservation</a></li>
            <li><a href="Rules.php">Rules</a></li>
            <li><a href="FAQ.php">FAQ</a></li>
            <?php echo $dailyLogOption; ?>
            <?php echo $logoutOption; ?>
        </ul>
    </nav>
    <main>
        <h2>Open Play Hours</h2>
        <p>Our eSports Arena is open during the following hours for open play:</p>
        <ul>
            <li>Monday: 12:00 PM - 6:00 PM</li>
           <li>Tuesday: 12:00 PM - 6:00 PM</li>
           <li>Wednesday: 12:00 PM - 6:00 PM</li>
           <li>Thursday: 12:00 PM - 6:00 PM</li>
           <li>Friday: 12:00 PM - 6:00 PM</li>
           <li>Saturday: CLOSED</li>
           <li>Sunday: CLOSED</li>
        </ul>

        <h2>Competitive Play Hours</h2>
        <p>Our competitive play hours for spectating are:</p>
        <ul>
            <li>Monday: 8:00 PM - 10:00 PM</li>
           <li>Tuesday: 8:00 PM - 10:00 PM</li>
           <li>Wednesday: 8:00 PM - 10:00 PM</li>
           <li>Thursday: CLOSED</li>
           <li>Friday: 8:00 PM - 10:00 PM</li>
           <li>Saturday: CLOSED</li>
           <li>Sunday: CLOSED </li>
        </ul>
    </main>
</body>
</html>
