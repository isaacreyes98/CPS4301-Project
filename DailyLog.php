<?php
// Place your session handling code here to ensure users are logged in.
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

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database (use your database credentials)
    $conn = new mysqli("localhost", "justin", "justin", "cps4301");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the "edit_time_exit" form is submitted
    if (isset($_POST['edit_time_exit'])) {
        // Retrieve and update "Time Exit"
        $edited_time_exit = mysqli_real_escape_string($conn, $_POST['new_time_exit']);
        $row_id = intval($_POST['row_id']); // Assuming it's an integer.
        
        // Update the "Time Exit" for the specified row in the database.
        $update_sql = "UPDATE daily_log SET time_exit = '$edited_time_exit' WHERE id = $row_id";
        
        if ($conn->query($update_sql) === TRUE) {
            // Data updated successfully
        } else {
            // Handle the error
            $error_message = "Error updating data: " . $conn->error;
        }
    } else {
        // This part handles new record insertion
        // Sanitize user inputs (you can add more validation)
        $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
        $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
        $computer_choice = mysqli_real_escape_string($conn, $_POST["computer_choice"]);
        $time_entered = mysqli_real_escape_string($conn, $_POST["time_entered"]); // Use VARCHAR
        $student_id = mysqli_real_escape_string($conn, $_POST["student_id"]);

        // Insert data into the database
        $sql = "INSERT INTO daily_log (first_name, last_name, computer_choice, time_entered, student_id) VALUES ('$first_name', '$last_name', $computer_choice, '$time_entered', $student_id)";

        if ($conn->query($sql) === TRUE) {
            // Data inserted successfully
            // You can update computer availability here
        } else {
            // Handle the error
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

<!-- HTML form for user input -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Log - Kean University eSports Arena</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Daily Log</h1>
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
            <li><a href="FAQ.php">FAQ</a></li>
            <?php echo $logoutOption; ?>
        </ul>
    </nav>
<body>
    <!-- Add your header and navigation links here -->
    <main>
        <div id="daily-log-form">
            <form action="DailyLog.php" method="post">
                <br>
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
                <br><br>
                <label for="last_name">Last Name:</label>
                <input type= "text" id="last_name" name="last_name" required>
                <br><br>
                <label for="computer_choice">Computer Choice:</label>
                <input type="number" id="computer_choice" name="computer_choice" required>
                <br><br>
                <label for="time_entered">Time Entered:</label>
                <input type="text" id="time_entered" name="time_entered" required>
                <br><br>
                <label for="student_id">Student ID:</label>
                <input type="number" id="student_id" name="student_id" required>
                <br><br>
                <input type="submit" value="Submit">
            </form>
            <br>
            <div id="error_message"><?php echo $error_message; ?></div>
        </div>

        <!-- Display the Daily Log table -->
        <?php
        // Connect to the database to fetch daily log data
        $conn = new mysqli("localhost", "justin", "justin", "cps4301");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM daily_log";
        $result = $conn->query($sql);

$entries_per_page = 10; // Number of entries to display per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get the current page from the URL parameter

if ($result->num_rows > 0) {
    echo "<h2>Daily Log Table</h2>";
    echo "<table class='daily-log-table'>";
    echo "<tr>
              <th>ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Computer Choice</th>
              <th>Time Entered</th>
              <th>Time Exit</th>
              <th>Student ID</th>
          </tr>";

    $offset = ($page - 1) * $entries_per_page; // Calculate the offset

    $query = "SELECT * FROM daily_log LIMIT $offset, $entries_per_page";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["first_name"] . "</td>";
            echo "<td>" . $row["last_name"] . "</td>";
            echo "<td>" . $row["computer_choice"] . "</td>";
            echo "<td>" . $row["time_entered"] . "</td>";

            if (!isset($_GET['edit']) || $_GET['edit'] != $row["id"]) {
                // Display the "Time Exit" as text
                echo "<td>";
                echo $row["time_exit"];
                echo " <a href='?edit=" . $row["id"] . "'>Edit</a>";
                echo "</td>";
            } else {
                // Display an input field for editing and a Save button
                echo "<td>
                          <form method='post' action='DailyLog.php'>
                              <input type='text' name='new_time_exit' value='" . $row["time_exit"] . "'>
                              <input type='hidden' name='row_id' value='" . $row["id"] . "'>
                              <input type='submit' name='edit_time_exit' value='Save'>
                              <a href='DailyLog.php'>Cancel</a>
                          </form>
                      </td>";
            }
            echo "<td>" . $row["student_id"] . "</td>";
            echo "</tr>";
    }
    echo "</table>";

    // Pagination links
    $query = "SELECT COUNT(*) AS total_entries FROM daily_log";
    $result = $conn->query($query);
    $total_entries = $result->fetch_assoc()['total_entries'];
    $total_pages = ceil($total_entries / $entries_per_page);

    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            echo "<span class='current-page'>$i</span>";
        } else {
            echo "<a href='?page=$i'>$i</a>";
        }
    }
    echo "</div>";
}

        $conn->close();
        ?>
    </main>
</body>
</html>
