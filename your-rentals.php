<?php
// Start the session
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the user is logged in
if(isset($_SESSION['user_email'])) {
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "book_rental";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the user's email from the session
    $user_email = $_SESSION['user_email'];
    
    // Debugging: Check if the email is correctly retrieved
    echo "User Email: " . htmlspecialchars($user_email) . "<br>";

    // Fetch all rented books for the user
    $sql = "SELECT book_title, full_name, rental_duration, created_at FROM bookings WHERE email = ?";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Debugging: Check if the query returns any rows
    if ($result === false) {
        die("Execute failed: " . $stmt->error);
    } else {
        echo "Number of rows: " . $result->num_rows . "<br>";
    }
} else {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Rentals</title>
    <style>
        /* Your CSS styles here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
    </style>
</head>
<body>
    <!-- Your HTML content here -->
    <div class="container">
        <h1>Your Rental History</h1>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>Title</th>
                        <th>Full Name</th>
                        <th>Rental Duration</th>
                        <th>Created At</th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row["book_title"]) . "</td>
                        <td>" . htmlspecialchars($row["full_name"]) . "</td>
                        <td>" . htmlspecialchars($row["rental_duration"]) . "</td>
                        <td>" . htmlspecialchars($row["created_at"]) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>You have not rented any books yet.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
