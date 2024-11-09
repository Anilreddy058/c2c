
<?php
// Include database connection
include('db_connect.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $faculty_id = mysqli_real_escape_string($conn, $_POST['faculty_id']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    
    // Basic validation
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    // Insert data into the database
    $query = "INSERT INTO faculty (full_name, faculty_id, email, password) VALUES ('$full_name', '$faculty_id', '$email', '$hashed_password')";
    
    if ($conn->query($query) === TRUE) {
        echo "Registration successful!";
        header("Location: login.php"); // Redirect to login page
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
