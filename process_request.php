<?php
require "C:\Program Files\Ampps\www\cps4301\PHPMailer-master\src\PHPMailer.php";
require "PHPMailer-master/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $game = $_POST["game"];
    $pc_platform = $_POST["pc_platform"];

    // Insert the request data into a SQL database (replace with your database details)
    $db = new PDO("mysql:host=localhost;dbname=cps4301", "justin", "justin");
    $stmt = $db->prepare("INSERT INTO game_requests (email, game, pc_platform, request_time) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$email, $game, $pc_platform]);

    // Create a PHPMailer instance
    $mail = new PHPMailer;

    // Set your SMTP server and authentication details
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'Indemnity992@gmail.com';
    $mail->Password = 'fppf lffg fxnh lmuu';
    $mail->SMTPSecure = 'ssl'; // Use 'ssl' or 'tls' based on your SMTP server's requirements
    $mail->Port = 465; // Use the appropriate port

    // Set the "From" address
    $mail->setFrom('esports@example.com', 'Esports');

    // Send confirmation email to the user
    $mail->addAddress($email);
    $mail->Subject = "Game Download Request Received";
    $mail->Body = "Thank you for your game download request. We have received the following information:\n\n";
    $mail->Body .= "Email: $email\nGame: $game\nPC Platform: $pc_platform\nRequest Time: " . date("Y-m-d H:i:s");

    if (!$mail->send()) {
        $message = "Error: " . $mail->ErrorInfo;
    } else {
        $message = "Request submitted successfully!\n\nA receipt has been to sent to your email.";
    }

    // Send email to the website owner
    $mail->clearAddresses();
    $mail->addAddress('justinpeters992@gmail.com');
    $mail->Subject = "New Game Download Request";
    $mail->Body = "A new game download request has been submitted:\n\n";
    $mail->Body .= "Email: $email\nGame: $game\nPC Platform: $pc_platform\nRequest Time: " . date("Y-m-d H:i:s");

    if (!$mail->send()) {
        echo "Error: " . $mail->ErrorInfo;
    }
} else {
    echo "Invalid request method.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Download Request Form - Kean University eSports Arena</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Game Download Request Form</h1>
    </header>
    <main>
        <?php
        if (!empty($message)) {
            echo '<p>' . $message . '</p>';
        }
        ?>
    </main>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="availability.php">Computer Availability</a></li>
            <li><a href="OperationHours.php">Operation Hours</a></li>
            <li><a href="#reservation">Main Stage Reservation</a></li>
            <li><a href="Rules.php">Rules</a></li>
            <li><a href="FAQ.php">FAQ</a></li>
            <?php echo $dailyLogOption; ?>
            <?php echo $logoutOption; ?>
        </ul>
    </nav>
        </ul>
    </nav>
