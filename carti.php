
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="add_to_cart.php" method="POST">
    <!-- Display item details directly instead of using hidden fields -->
    <div>
        <label>Product Image:</label>
        <img src="images\ambur1-biryani.jpg" alt="Item Image" style="width:100px;">
    </div>
    
    <div>
        <label>Product Name:</label>
        <p>Item Name</p>
        <!-- Add an input field for the name to pass it to PHP -->
        <input type="hidden" name="name" value="biryani">
    </div>
    
    <div>
        <label>Price:</label>
        <p>$100</p>
        <!-- Add an input field for the price to pass it to PHP -->
        <input type="hidden" name="price" value="100">
    </div>
    
    <!-- Quantity field -->
    <div>
        <label>Quantity:</label>
        <input type="number" name="quantity" value="1" min="1" required>
    </div>
    
    <!-- Submit button -->
    <input type="submit" value="Add to Cart">
</form>


</body>
</html>