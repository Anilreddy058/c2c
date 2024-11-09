<?php
// Create connection
include('db_connect.php');

// Check connection<?php
// Create connection
include('db_connect.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get all orders from the database
$sql = "SELECT * FROM orderdetails";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Orders</title>
    <link rel="stylesheet" href="total_orders.css">
    <link rel="stylesheet" href="sidebar.css">
    <!-- Link to FontAwesome for icons -->
     
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
    /* General styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: lightgrey;
    margin: 0;
    padding: 20px;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    background-color: aliceblue;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    animation: fadeIn 1s ease-in-out;
}

h1 {
    text-align: center;
    color: #333;
    font-size: 2.5em;
    margin-bottom: 20px;
}

/* Table styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    animation: slideIn 1s ease-in-out;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #333;
    color: white;
    font-weight: bold;
}

td {
    color: #555;
}

/* Image styling */
td img {
    border-radius: 5px;
    transition: transform 0.3s ease;
}

td img:hover {
    transform: scale(1.1);
}

/* Hover effects */
tr:hover {
    background-color: #f1f1f1;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Button-like effect on table row */
tr {
    transition: background-color 0.3s ease, transform 0.2s ease;
}

tr:hover {
    transform: translateY(-2px);
}

/* Animation for container */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Animation for table */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    h1 {
        font-size: 1.8em;
    }

    th, td {
        font-size: 0.9em;
        padding: 10px;
    }

    td img {
        width: 80px;
    }
}
</style>
</head>
<body>
<div class="one">
    <div class="navbar">
        <div class="logo">
            <i class="fas fa-bars menu-icon"></i>
        </div>
        <ul class="nav-list">
            <li class="nav-item">
                <a href="attach1.html" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span class="link-text">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="newmen.html" class="nav-link">
                    <i class="fas fa-utensils"></i>
                    <span class="link-text">Menu</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="total_orders.php" class="nav-link">
                    <i class="fas fa-box"></i>
                    <span class="link-text">Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="cart.html" class="nav-link">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="link-text">Cart</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="delivery.html" class="nav-link">
                    <i class='bx bxs-map'></i>
                    <span class="link-text">Delivery Address</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="profile.php" class="nav-link">
                <i class="fa-solid fa-user"></i>
                    <span class="link-text">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="help.html" class="nav-link">
                    <i class="fas fa-question-circle"></i>
                    <span class="link-text">Help & Support</span>
                </a>
            </li>
            <div class="log">
            <li class="nav-item">
                <a href="logout.php" class="nav-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="link-text">Logout</span>
                </a>
            </li>
            </div>
        </ul>
    </div>
    <div class="container">
        <h1>ORDERS</h1>
        <table>
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Quantity</th> <!-- Total Quantity -->
                <th>Price per Unit</th>
                <th>total price</th>
                <th>Payment Mode</th>
                <th>order date</th>
                
            </tr>
            <?php
            $timestamp = time();
            $currentDate = gmdate('Y-m-d', $timestamp); 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><img src='" . $row['product_image'] . "' alt='Product Image' width='100'></td>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>"; // Display total quantity
                    echo "<td>₹" . $row['price'] . "</td>"; // Display price per unit
                    echo "<td>₹".$row['price']*$row['quantity']."</td>";
                    echo "<td>" . $row['payment_mode'] . "</td>";
                    echo "<td>".$currentDate."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No orders yet!</td></tr>";
            }
            ?>
        </table>
    </div>
        </div>
</body>
</html>

