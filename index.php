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

$sql = "SELECT computer_choice, time_exit FROM daily_log";
$result = $conn->query($sql);

// Create an array to store computer availability
$computerAvailability = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $computerChoice = $row["computer_choice"];
        $timeExit = $row["time_exit"];

        // Set availability based on the presence of time_exit
        $availability = empty($timeExit) ? "Not Available" : "Available";

        $computerAvailability[$computerChoice] = $availability;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kean University eSports Arena</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap">
    <link rel="stylesheet" href="styles.css">
    <meta http-equiv="refresh" content="60"> <!-- Auto-refresh every 60 seconds -->
</head>
<body>
    <header>
        <h1>Kean University eSports Arena</h1>
    </header>
    <nav>
        <ul>
            <li><a href="login.php">Login</a></li>
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
        <h2>Welcome to Kean University eSports Arena</h2>
        <h3>Home for all things video games</h3>
        <p>Follow us on Social Media</p>
        <div class="social-icons-container">
        <a href="https://twitter.com/Kean_Esports" target="_blank">
        <img src="xlogo.png" alt="Twitter Logo" class="social-icon" width="90" height="90">
    </a>
        <a href="https://www.twitch.tv/kean_esports" target="_blank">
        <img src="twitchlogo.png" alt="Twitch Logo" class="social-icon" width="90" height="90">
    </a>
        <a href="https://www.instagram.com/kean_esports" target="_blank">
        <img src="instagram.png" alt="Instagram Logo" class="social-icon" width="90" height="90">
    </a>
    <a href="https://www.instagram.com/kean_esports" target="_blank">
        <img src="DiscordLogo.png" alt="Discord Logo" class="social-icon" width="90" height="90">
    </a>
</div>
    </main>
</body>
</html>
