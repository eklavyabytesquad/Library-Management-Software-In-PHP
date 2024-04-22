<?php
// Include database connection
include 'conn.php';
require_once 'navbar.php';

// Check if form is submitted for updating book details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publisherid = $_POST['publisherid'];
    $published_year = $_POST['published_year'];
    $category = $_POST['category'];
    $bookid = $_POST['bookid']; // Ensure book ID is provided

    // Prepare and execute SQL statement to update book details
    $sql_update = "UPDATE books SET title=?, author=?, publisherid=?, published_year=?, category=? WHERE bookid=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssiiss", $title, $author, $publisherid, $published_year, $category, $bookid);
    if ($stmt->execute()) {
        echo "Book details updated successfully";
        header("Location: showbooks.php");
        exit();
    } else {
        echo "Error updating book details: " . $stmt->error;
    }
}

// Fetch book details based on the provided book ID
if (isset($_GET['bookid'])) {
    $bookid = $_GET['bookid'];

    // Retrieve book details from the database based on the book ID
    $sql = "SELECT * FROM books WHERE bookid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bookid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Book not found";
        exit();
    }
} else {
    echo "Book ID not provided";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
</head>
<body>
    <h2>Edit Book</h2>
    <form method="post">
        <input type="hidden" name="bookid" value="<?php echo $book['bookid']; ?>">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required><br>

        <label for="author">Author:</label><br>
        <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required><br>

        <label for="publisherid">Publisher ID:</label><br>
        <input type="number" id="publisherid" name="publisherid" value="<?php echo $book['publisherid']; ?>" required><br>

        <label for="published_year">Published Year:</label><br>
        <input type="number" id="published_year" name="published_year" value="<?php echo $book['published_year']; ?>" required><br>

        <label for="category">Category:</label><br>
        <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($book['category']); ?>" required><br><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
