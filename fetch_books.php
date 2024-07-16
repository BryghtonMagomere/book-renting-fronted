<?php
// Database connection settings
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

// Fetch books from the book_shelf table
$sql = "SELECT book_image_link, book_title, author FROM book_shelf";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    $books = array();
    while($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
} else {
    $books = array();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Haven - Book Rental Catalog</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-image: url('OIP (2).jpeg'); /* Replace with your background image */
            background-size: cover;
            background-repeat: no-repeat;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.5); /* Add a semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
        }
        header {
            background: #50b3a2;
            color: white;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #e8491d 3px solid;
        }
        header a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin-right: 20px;
            transition: color 0.3s;
        }
        header a:hover {
            color: #e8491d;
        }
        header ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        header li {
            display: inline;
        }
        header #branding {
            float: left;
        }
        header #branding h1 {
            margin: 0;
        }
        header nav {
            float: right;
            margin-top: 10px;
        }
        .catalog {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Adjust the number of columns as needed */
            grid-gap: 20px;
            margin-top: 20px;
        }
        .book {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .book img {
            width: 100px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }
        .book h3 {
            color: #e8491d;
            font-size: 1.2em;
            margin: 10px 0;
        }
        .book p {
            font-size: 0.9em;
            margin: 5px 0;
        }
        .book button {
            display: block;
            width: 100%;
            padding: 10px;
            background: #50b3a2;
            color: white;
            border: 0;
            border-radius: 5px;
            cursor: pointer;
        }
        .book button:hover {
            background: #e8491d;
        }
        footer {
            background: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
    <script>
        // Function to handle the "Rent Now" button click
        function rentBook(bookTitle) {
            // Store the book title in local storage
            localStorage.setItem('selectedBook', bookTitle);
            // Redirect to the rental form page
            window.location.href = 'rental-form.php';
        }
    </script>
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1><span class="highlight">Book</span> Online Book Rental </h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.html" class="current">Home</a></li>
                    <li><a href="your-rentals.php">Your Rental</a></li>
                    <li><a href="About.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <br><br>
    <div class="container">
        <section class="catalog">
            <?php foreach ($books as $book): ?>
            <div class="book">
                <img src="<?php echo $book['book_image_link']; ?>" alt="<?php echo $book['book_title']; ?> Cover">
                <h3><?php echo $book['book_title']; ?></h3>
                <p>by <?php echo $book['author']; ?></p>
                <button onclick="rentBook('<?php echo addslashes($book['book_title']) . ' by ' . addslashes($book['author']); ?>')">Rent Now</button>
            </div>
            <?php endforeach; ?>
        </section>
    </div>
    <br><br><br>
    <footer>
        <p>Book Rental © 2024</p>
    </footer>
</body>
</html>
