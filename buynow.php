<?php
// Connect to the database
include('db_connect.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve cart items from the cartitems table
$sql = "SELECT * FROM cartitems";
$result = $conn->query($sql);

// Remove item from cart
if (isset($_POST['remove_item'])) {
    $item_id = $_POST['item_id'];
    $delete_sql = "DELETE FROM cartitems WHERE id = $item_id";
    $conn->query($delete_sql);
    header("Location: buynow.php"); // Reload page to reflect changes
    exit();
}

// Update quantity of an item in the cart
if (isset($_POST['update_quantity'])) {
    $item_id = $_POST['item_id'];
    $new_quantity = $_POST['quantity'];
    $update_sql = "UPDATE cartitems SET quantity = $new_quantity WHERE id = $item_id";
    $conn->query($update_sql);
    header("Location: buynow.php"); // Reload page to reflect changes
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Now - Canteen2Campus</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .item-details {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin-bottom: 20px;
        }
        .item-details img {
            width: 100px;
            height: 100px;
            margin-right: 20px;
        }
        .item-details p {
            font-size: 18px;
            margin: 5px 0;
        }
        .summary {
            font-size: 20px;
            font-weight: bold;
        }
        .place-order {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
        }
        .place-order:hover {
            background-color: #218838;
        }
        form {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Cart</h1>

        <!-- Display each item in the cart -->
        <?php
        $total_cost = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $item_id = $row['id'];
                $name = $row['name'];
                $price = $row['price'];
                $quantity = $row['quantity'];
                $item_total = $price * $quantity;
                $total_cost += $item_total;
        ?>
        <div class="item-details">
            <img src="path_to_image.jpg" alt="Product Image">
            <div>
                <p><strong>Product Name:</strong> <?php echo htmlspecialchars($name); ?></p>
                <p><strong>Price:</strong> $<?php echo htmlspecialchars($price); ?></p>
                <p><strong>Quantity:</strong> 
                    <form action="buynow.php" method="POST" style="display:inline;">
                        <input type="number" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>" min="1">
                        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                        <button type="submit" name="update_quantity">Update</button>
                    </form>
                </p>
                <p><strong>Total:</strong> $<?php echo htmlspecialchars($item_total); ?></p>
            </div>
            <form action="buynow.php" method="POST">
                <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                <button type="submit" name="remove_item">Remove</button>
            </form>
        </div>
        <?php
            }
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>

        <!-- Summary of the total cost -->
        <p class="summary">Total Cost: $<?php echo htmlspecialchars($total_cost); ?></p>

        <!-- Place order button -->
        <form action="place_order.php" method="POST">
            <input type="hidden" name="total_cost" value="<?php echo htmlspecialchars($total_cost); ?>">
            <button type="submit" class="place-order">Place Order</button>
        </form>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
