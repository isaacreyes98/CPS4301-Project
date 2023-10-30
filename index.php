<?php
session_start();

if (isset($_SESSION['username'])) {
    $dailyLogOption = '<li><a href="DailyLog.html">Daily Log</a></li>';
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
    <title>Kean University eSports Arena</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Kean University eSports Arena</h1>
    </header>
    <nav>
        <ul>
            <li><a href="login.php">Login</a></li>
            <li><a href="OperationHours.html">Operation Hours</a></li>
            <li><a href="#download">Game Download Request</a></li>
            <li><a href="#reservation">Main Stage Reservation</a></li>
            <li><a href="Rules.html">Rules</a></li>
            <li><a href="#faq">FAQ/Support</a></li>
            <?php echo $dailyLogOption; ?>
            <?php echo $logoutOption; ?>
        </ul>
    </nav>
    <main>
        
    </main>
</body>
</html>
