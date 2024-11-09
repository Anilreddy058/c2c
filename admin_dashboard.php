<?php
// Include the database connection
require('db_connect.php');

// Start the session
session_start();

// Check if the user is logged in as administrator
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'administrator') {
    header("Location: login.php"); // Redirect to login if not admin
    exit();
}

// Fetch all orders from the database
$query = "SELECT * FROM orderdetails"; // Assuming you have an 'orders' table
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - All Orders</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your own CSS here -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
        }
        table th, table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
        }
        tr:hover {background-color: #f5f5f5;}
        h1 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>All Orders</h1>
    
    <table>
        <thead>
            <tr>
                <th>user email</th>
                <th>User Name</th>
                <th>block</th>
                <th>floor</th>
                <th>room no</th>
                <th>productname</th>
                <th>quantity</th>
                <th>price</th>
                <th>totalprice</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through and display all orders
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['username'] . "</td>
                            <td>" . $row['blocks'] . "</td>
                            <td>" . $row['floor'] . "</td>
                            <td>" . $row['room'] . "</td>
                            <td>" . $row['product_name'] . "</td>
                            <td>" . $row['quantity'] . "</td>
                            <td>" . $row['price'] . "</td>
                            <td>" . $row['total_price'] . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No orders found.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
