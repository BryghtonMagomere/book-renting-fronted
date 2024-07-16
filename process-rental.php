<?php
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

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookTitle = $conn->real_escape_string($_POST['bookTitle']);
    $fullName = $conn->real_escape_string($_POST['fullName']);
    $email = $conn->real_escape_string($_POST['email']);
    $rentalDuration = $conn->real_escape_string($_POST['rentalDuration']);

    // Insert data into bookings table
    $sql = "INSERT INTO bookings (book_title, full_name, email, rental_duration) VALUES ('$bookTitle', '$fullName', '$email', '$rentalDuration')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        // Optionally, you can redirect to a success page
        header("Location: success.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
