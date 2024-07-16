<?php
$servername = "localhost";
$username = "root";
$password = ""; // Replace with a strong password!
$dbname = "book_rental";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data (if form is submitted)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"]; // Update to use email
    $password = $_POST["password"];

    // Prepared statement to prevent SQL injection
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "s", $email);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            // Verify password (no hashing)
            if ($password === $user["password"]) {
                // Start session
                session_start();
                // Store user email in session
                $_SESSION['user_email'] = $email;
                // Redirect to the page to fetch books
                header("Location: fetch_books.php");
                exit; // Terminate script execution after redirection
            } else {
                echo "Invalid password";
            }
        } else {
            echo "Email not found";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
