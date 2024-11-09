<?php
// Include the database connection file
require('db_connect.php');

// Start session to store user info
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Check if the user is the administrator
    
    
    // Check the user type if it's not admin
    $user_type = $_POST['user_type'];

    // Prepare a query to check the user's credentials based on type
    if ($user_type === "student") {
        $query = "SELECT * FROM students WHERE email='$username'";
    } elseif ($user_type === "faculty") {
        $query = "SELECT * FROM faculty WHERE email='$username'";
    }

    $result = $conn->query($query);

    // If user exists in the database
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Store user data in the session
            $_SESSION['username'] = $row['email'];
            $_SESSION['user_type'] = $user_type;
            // Redirect to a secure page (e.g., dashboard.php)
            header("Location: attach1.html");
            exit();
        }
        elseif($username === 'administrator' && $password === '123456789'){
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = 'administrator';
            // Redirect to the admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="form.css">
    <style>
        /* Existing CSS */
        /* Add any necessary styles */
    </style>
    <script>
        // JavaScript to hide user type dropdown for administrator
        function checkAdmin() {
            const usernameInput = document.getElementById('username');
            const userTypeSelect = document.getElementById('user_type');
            if (usernameInput.value.toLowerCase() === 'administrator') {
                userTypeSelect.style.display = 'none'; // Hide user type dropdown for admin
            } else {
                userTypeSelect.style.display = 'block'; // Show it for others
            }
        }
    </script>
</head>
<body>
    <div class="wrapper">
        <form action="login.php" method="POST">
            <h1>LOGIN</h1>
            <div class="input-box">
                <input type="text" name="username" id="username" placeholder="Username" required oninput="checkAdmin()">
                <i class="fa-solid fa-user" id="one"></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fa-solid fa-lock" id="two"></i>
            </div>
            <div class="input-box" id="user_type_container">
                <select name="user_type" id="user_type" required>
                    <option value="student">Student</option>
                    <option value="faculty">Faculty</option>
                </select>
            </div>
            <div class="remember">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot password</a>
            </div>
            <button type="submit" class="btn">Login</button>
            <div class="register-link">
                <p>Do not have an account?<a href="selectform.html"> Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>
