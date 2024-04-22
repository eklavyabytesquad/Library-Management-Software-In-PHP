<?php
// Include database connection
include 'conn.php';
require_once 'navbar.php';

// Check if form is submitted for updating publisher details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $publisherid = $_POST['publisherid'];
    $bookid = $_POST['bookid'];
    $pub_name = $_POST['pub_name'];

    // Prepare and execute SQL statement to update publisher details
    $sql_update = "UPDATE publishers SET bookid=?, pub_name=? WHERE publisherid=?";
    $stmt = $conn->prepare($sql_update);
    if ($stmt === false) {
        echo "Error preparing SQL statement: " . $conn->error;
    } else {
        $stmt->bind_param("isi", $bookid, $pub_name, $publisherid);
        if ($stmt->execute()) {
            echo "Publisher details updated successfully";
            header("Location: showpublishers.php");
            exit();
        } else {
            echo "Error updating publisher details: " . $stmt->error;
        }
    }
}

// Fetch publisher details based on the provided publisher ID
if (isset($_GET['publisherid'])) {
    $publisherid = $_GET['publisherid'];
    // Retrieve publisher details from the database based on the publisher ID
    $sql = "SELECT * FROM publishers WHERE publisherid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $publisherid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $publisher = $result->fetch_assoc();
    } else {
        echo "Publisher not found";
        exit();
    }
} else {
    echo "Publisher ID not provided";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Publisher</title>
</head>
<body>
    <h2>Edit Publisher</h2>
    <form method="post">
        <input type="hidden" name="publisherid" value="<?php echo $publisher['publisherid']; ?>">
        <label for="bookid">Book ID:</label><br>
        <input type="number" id="bookid" name="bookid" value="<?php echo $publisher['bookid']; ?>"><br>
        <label for="pub_name">Publisher Name:</label><br>
        <input type="text" id="pub_name" name="pub_name" value="<?php echo htmlspecialchars($publisher['pub_name']); ?>" required><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>