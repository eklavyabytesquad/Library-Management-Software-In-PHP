<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            font-size: 17px;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .navbar a.active {
            background-color: #007bff;
            color: white;
        }
        @media screen and (max-width: 600px) {
            .navbar a {
                float: none;
                display: block;
                text-align: left;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <a class="active" href="#">Library Management</a>
    <a href="addmember.php">Add Member</a>
    <a href="addborrowing.php">Add Borrowing</a>
    <a href="addbook.php">Add New Book</a>
    <a href="addpublishers.php">Add NewPublishers</a>
    <a href="showpublishers.php">Publishers</a>
    <a href="showborrowing.php">borrowings</a>
    <a href="showbooks.php">books</a>
    <a href="showmembers.php">members</a>
</div>

</body>
</html>
