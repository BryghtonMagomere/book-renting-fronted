<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_rental";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data (if form is submitted)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $raw_password = $_POST["password"]; // Get the raw password

    // Validate input (you can add more validation checks here)
    if (empty($email) || empty($firstname) || empty($lastname) || empty($raw_password)) {
        echo "Please fill in all fields.";
    } else {
        // Prepare SQL statement (prevent SQL injection)
        $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $raw_password);

        // Execute statement and handle success/failure
        if (mysqli_stmt_execute($stmt)) {
            echo "Registration successful! You can now log in.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}

mysqli_close($conn);
?>
