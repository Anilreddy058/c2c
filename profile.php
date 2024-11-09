<?php
// Start the session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection file
include('db_connect.php');

// Get the logged-in user's email from the session
$email = $_SESSION['username'];
$user_type = $_SESSION['user_type']; // This will tell whether it's a student or faculty

// Fetch user details from the database
if ($user_type === 'student') {
    $query = "SELECT full_name, rollno, academic_year, email FROM students WHERE email = '$email'";
} elseif ($user_type === 'faculty') {
    $query = "SELECT full_name, faculty_id, email FROM faculty WHERE email = '$email'";
}

$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Fetch the user details
    $user = $result->fetch_assoc();
} else {
    echo "No user found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="sidebar.css">
    <!-- Link to FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
   
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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

    <script src="sidebar.js"></script>
    
    
    <div class="profile-container">
        <h1>Welcome to Your Profile, <?php echo htmlspecialchars($user['full_name']); ?>!</h1>

        <!-- Display student details -->
        <?php if ($user_type === 'student'): ?>
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
            <p><strong>Roll Number:</strong> <?php echo htmlspecialchars($user['rollno']); ?></p>
            <p><strong>Academic Year:</strong> <?php echo htmlspecialchars($user['academic_year']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        
        <!-- Display faculty details -->
        <?php elseif ($user_type === 'faculty'): ?>
            <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
            <p><strong>Faculty ID:</strong> <?php echo htmlspecialchars($user['faculty_id']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <?php endif; ?>

        
    </div>
</body>
</html>
