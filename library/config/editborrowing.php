<?php
// Include database connection
include 'conn.php';
require_once 'navbar.php';

// Check if form is submitted for updating borrowing details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $bookid = $_POST['bookid'];
    $memberid = $_POST['memberid'];
    $date = $_POST['date'];
    $due_date = $_POST['due_date'];

    // Prepare and execute SQL statement to update borrowing details
    $sql_update = "UPDATE borrowings SET date=?, due_date=? WHERE bookid=? AND memberid=?";
    $stmt = $conn->prepare($sql_update);
    if ($stmt === false) {
        echo "Error preparing SQL statement: " . $conn->error;
    } else {
        $stmt->bind_param("ssii", $date, $due_date, $bookid, $memberid);
        if ($stmt->execute()) {
            echo "Borrowing details updated successfully";
            header("Location: showborrowing.php");
            exit();
        } else {
            echo "Error updating borrowing details: " . $stmt->error;
        }
    }
}

// Fetch borrowing details based on the provided bookid and memberid
if (isset($_GET['bookid']) && isset($_GET['memberid'])) {
    $bookid = $_GET['bookid'];
    $memberid = $_GET['memberid'];

    // Retrieve borrowing details from the database based on bookid and memberid
    $sql = "SELECT * FROM borrowings WHERE bookid = ? AND memberid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $bookid, $memberid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $borrowing = $result->fetch_assoc();
    } else {
        echo "Borrowing not found";
        exit();
    }
} else {
    echo "Book ID or Member ID not provided";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Borrowing</title>
</head>
<body>
    <h2>Edit Borrowing</h2>
    <form method="post">
        <input type="hidden" name="bookid" value="<?php echo $borrowing['bookid']; ?>">
        <input type="hidden" name="memberid" value="<?php echo $borrowing['memberid']; ?>">
        <label for="date">Borrowing Date:</label><br>
        <input type="date" id="date" name="date" value="<?php echo $borrowing['date']; ?>" required><br>
        <label for="due_date">Due Date:</label><br>
        <input type="date" id="due_date" name="due_date" value="<?php echo $borrowing['due_date']; ?>" required><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>