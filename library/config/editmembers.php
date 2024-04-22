<?php
// Include database connection
include 'conn.php';
require_once 'navbar.php';

// Check if form is submitted for updating member details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $memberid = $_POST['memberid'];

    // Prepare and execute SQL statement to update member details
    $sql_update = "UPDATE lib_membership SET name=?, email=?, phoneno=? WHERE memberid=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("sssi", $name, $email, $phoneno, $memberid);
    if ($stmt->execute()) {
        echo "Member details updated successfully";
        header("Location: showmembers.php");
        exit();
    } else {
        echo "Error updating member details: " . $stmt->error;
    }
}

// Fetch member details based on the provided member ID
if (isset($_GET['memberid'])) {
    $memberid = $_GET['memberid'];
    // Retrieve member details from the database based on the member ID
    $sql = "SELECT * FROM lib_membership WHERE memberid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $memberid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $member = $result->fetch_assoc();
    } else {
        echo "Member not found";
        exit();
    }
} else {
    echo "Member ID not provided";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member</title>
</head>
<body>
    <h2>Edit Member</h2>
    <form method="post">
        <input type="hidden" name="memberid" value="<?php echo $member['memberid']; ?>">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($member['name']); ?>" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($member['email']); ?>" required><br>
        <label for="phoneno">Phone Number:</label><br>
        <input type="text" id="phoneno" name="phoneno" value="<?php echo $member['phoneno']; ?>" required><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>