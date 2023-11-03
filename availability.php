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
    <title>Computer Availability - Kean University eSports Arena</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Computer Availability</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
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
        <div id="computer-availability">
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
