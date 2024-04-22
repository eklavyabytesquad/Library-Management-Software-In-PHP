<?php
// Include database connection
include 'conn.php';
require_once 'navbar.php';
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $bookid = $_POST['bookid'];
    $pub_name = $_POST['pub_name'];

    // Prepare SQL statement to insert data into publishers table
    $sql = "INSERT INTO publishers (bookid, pub_name)
            VALUES ('$bookid', '$pub_name')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "New publisher added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Publisher</title>
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
        input[type="number"],
        input[type="text"] {
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
        <h2>Add New Publisher</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="bookid">Book ID:</label>
            <input type="number" id="bookid" name="bookid" required>

            <label for="pub_name">Publisher Name:</label>
            <input type="text" id="pub_name" name="pub_name" required>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
