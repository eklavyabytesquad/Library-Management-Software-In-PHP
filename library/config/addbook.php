<?php
// Include database connection
include 'conn.php';
require_once 'navbar.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisherid = $_POST['publisherid'];
    $published_year = $_POST['published_year'];
    $category = $_POST['category'];

    // Prepare SQL statement to insert data into books table
    $sql = "INSERT INTO books (title, author, publisherid, published_year, category)
            VALUES ('$title', '$author', '$publisherid', '$published_year', '$category')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo '<div class="success-msg"><i class="fas fa-check-circle"></i> New book added successfully</div>';
    } else {
        echo '<div class="error-msg"><i class="fas fa-exclamation-circle"></i> Error: ' . $sql . "<br>" . $conn->error . '</div>';
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Book</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .success-msg {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .error-msg {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .fas {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Book</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>

            <label for="publisherid">Publisher ID:</label>
            <input type="number" id="publisherid" name="publisherid" required>

            <label for="published_year">Published Year:</label>
            <input type="number" id="published_year" name="published_year" required>

            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
