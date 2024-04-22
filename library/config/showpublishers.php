<?php
// Include database connection
include 'conn.php';
require_once 'navbar.php';
// Fetch all data from the publishers table
$sql = "SELECT * FROM publishers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Publishers</title>
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
    </style>
</head>
<body>

<h2>Publishers</h2>

<table>
    <thead>
        <tr>
            <th>Publisher ID</th>
            <th>Book ID</th>
            <th>Publisher Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["publisherid"] . "</td>";
                echo "<td>" . $row["bookid"] . "</td>";
                echo "<td>" . $row["pub_name"] . "</td>";
                echo "<td class='action-buttons'><a href='editpublishers.php?publisherid=" . $row['publisherid'] . "'><button>Edit</button></a> </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No publishers found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
