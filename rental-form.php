<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rental Form</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      line-height: 1.6;
      color: #333;
      background-color: #f4f4f4;
      padding: 20px;
    }
    .nav-bar {
      overflow: hidden;
      padding-top: 0;
    }
    .nav-bar a {
      float: right;
      display: block;
      font-weight: bold;
      color: #030303;
      text-align: center;
      padding: 10px 40px;
      text-decoration: none;
      transition: color 0.3s;
    }
    .nav-bar a:hover {
      color: #e8491d;
    }
    .container {
      width: 80%;
      margin: auto;
      overflow: hidden;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      text-align: center;
      color: #333;
    }
    form {
      width: 100%;
      padding: 20px;
    }
    label {
      display: block;
      margin-bottom: 5px;
      color: #333;
    }
    input[type="text"],
    input[type="email"],
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    button[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #333;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button[type="submit"]:hover {
      background-color: #555;
    }
  </style>
</head>
<body>
  <div class="nav-bar">
    <a href="contact.html">Contact us</a>
    <a href="About.html">About</a>
    <a href="catalog.html">Catalog</a>
    <a href="index.html">Home</a>
  </div>
  <div class="container">
    <h1>Book Rental Form</h1>
    <form id="rentalForm" action="process-rental.php" method="post">
      <label for="bookTitle">Book Selected:</label>
      <input type="text" id="bookTitle" name="bookTitle" readonly>
      
      <label for="fullName">Full Name:</label>
      <input type="text" id="fullName" name="fullName" required>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      
      <label for="rentalDuration">Rental Duration:</label>
      <select id="rentalDuration" name="rentalDuration" required>
        <option value="1 week">1 Week</option>
        <option value="2 weeks">2 Weeks</option>
        <option value="1 month">1 Month</option>
        <option value="3 months">3 Months</option>
      </select>
      
      <button type="submit">Submit Rental Request</button>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Retrieve the book title from local storage
      var selectedBook = localStorage.getItem('selectedBook');
      // Set the book title to the form field
      document.getElementById('bookTitle').value = selectedBook;
    });

    // Function to handle form submission
    document.getElementById('rentalForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the default form submission

      // Here you can perform any form validation if needed

      // Submit the form data using fetch
      fetch(this.action, {
        method: this.method,
        body: new FormData(this)
      })
      .then(response => {
        if (response.ok) {
          // Display success message
          alert('Book rented successfully!');
          // Redirect to the next page
          window.location.href = 'index.html';
        } else {
          // Display error message if the submission failed
          alert('you have succefully booked the book.');
        }
      })
      .catch(error => {
        // Display error message if there was a network error
        alert('Failed to rent the book due to a network error.');
      });
    });
  </script>
</body>
</html>
