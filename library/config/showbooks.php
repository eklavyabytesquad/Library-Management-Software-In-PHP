<?php
// Include database connection
include 'conn.php';
require_once 'navbar.php';
// Fetch all data from the books table
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Books</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #ddd;
        }
        .action-buttons {
            display: flex;
            justify-content: space-around;
        }
        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .edit-btn {
            background-color: #007bff;
            color: #fff;
        }
        .edit-btn:hover {
            background-color: #0056b3;
        }
        .delete-btn {
            background-color: #dc3545;
            color: #fff;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<h2>Books</h2>

<table>
    <thead>
        <tr>
            <th>Book ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Publisher ID</th>
            <th>Published Year</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                    echo "<td>" . $row["bookid"] . "</td>";
                    echo "<td>" . $row["title"] . "</td>";
                    echo "<td>" . $row["author"] . "</td>";
                    echo "<td>" . $row["publisherid"] . "</td>";
                    echo "<td>" . $row["published_year"] . "</td>";
                    echo "<td>" . $row["category"] . "</td>";
                    echo "<td><a href='editbooks.php?bookid=" . $row['bookid'] . "'>Edit</a></td>";
                    echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No books found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
