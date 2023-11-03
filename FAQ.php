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
    <title>FAQ - Kean University eSports Arena</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Frequently Asked Questions</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="availability.php">Computer Availability</a></li>
            <li><a href="OperationHours.php">Operation Hours</a></li>
            <li><a href="Download_Request_Form.php">Game Download Request</a></li>
            <li><a href="#reservation">Main Stage Reservation</a></li>
            <li><a href="Rules.php">Rules</a></li>
            <?php echo $dailyLogOption; ?>
            <?php echo $logoutOption; ?>
        </ul>
    </nav>
    <main>
        <ul class="faq-list">
            <li>
                <h3>Are we allowed to bring our own equipment?</h3>
                <p>Yes. Everyone is allowed to bring their own equipment, but you are responsible for ensuring that the equipment doesn't cause an issue with the existing hardware or software. Anything you unplug should be plugged back in after your session is over.</p>
            </li>
            <li>
                <h3>Who is allowed to be in the main stage area?</h3>
                <p>Only the students who are currently on one of our eSports teams are allowed in the main stage. All are welcome to be spectators during game time.</p>
            </li>
            <li>
                <h3>How can I get onto one of the teams?</h3>
                <p>Tryouts are held at the beginning of each semester. Tryouts for each game are announced on the program's Discord channel.</p>
            </li>
            <li>
                <h3>Can I work at the arena? If so, how do I apply?</h3>
                <p>Yes! Students are always welcome to apply as arena workers. If you are a graduate, we are also looking for nighttime arena managers and coaches. To start the process, email the program director, Joseph Sarnoski. </p>
            </li>
            <li>
                <h3>What games are offered for competitive play?</h3>
                <p>We offer a wide range of games for competitive play such as Valorant, League of Legends, Overwatch 2, Rocket League, Rainbow Six Siege, Super Smash Bros, EA Sports FC, NBA 2K, Madden, and Heartstone. </p>
            </li>
        </ul>
    </main>
</body>
</html>
