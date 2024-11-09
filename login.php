
<?php
// Include the database connection file
require('db_connect.php');

// Start session to store user info
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_type = $_POST['user_type']; // Added user type

    // Get the submitted form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Prepare a query to check the user's credentials based on type
    $query = "";
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
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: "poppins",san serifs;
}
body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height:100vh;
  background-image:url("images/loginimage.jpg");
  background-size:cover;
    background-position: center;
}
.wrapper
{
    width:450px;
    background:transparent;
    border:2px solid rgba(255,255,255,.2);
    backdrop-filter: blur(20px);
    box-shadow: 0 0 10px rgba(0,0,0,.2);
    color:#fff;
    border-radius: 10px;
    padding: 30px 40px;
}
.wrapper h1{
    font-size: 30px;
    text-align: center;
}
.wrapper .input-box
{
    width:100%;
    height:50px;
    margin:30px 0px;
}
.input-box input{
    width:100%;
    height:100%;
    background:transparent;
    border:none;
    outline:none;
    border:2px solid rgb(0, 255, 208);
    border-radius: 5rem;
    font-size: 16px;
    color:#fff;
    padding:20px 45px 20px 20px;

     
}
.input-box input::placeholder{
    color:#fff;
}
.input-box #one{
    position:absolute;
    right: 60px;
    top:25%;
    transform: translateY(-50%);
    font-size: 20px;
}
.input-box #two{
    position:absolute;
    right: 60px;
    top: 41%;
    transform: translateY(-50%);
    font-size: 20px;
}
.wrapper .remember
{
display: flex;
justify-content: space-between;
font-size: 15px;
margin: -15px 0 15px;
}
.remember label input
{
color:#fff;
margin-right:3px;
}
.remember a:hover{
    text-decoration:underline;
}
.wrapper .btn
{
 width:100%;
 height:45px;
 background: #fff;
 border:none;
 outline:none;
 border-radius:10rem ;
 box-shadow: 0 0 10px rgb(0,0,0,.1) ;
 cursor:pointer;
 font-size: 16px;
 color:#333;
 font-weight: 600;
}
.wrapper .register-link
{
    font-size: 15px;
    text-align: center;
    margin:20px 0 15px;
}
.register-link p a
{
    color: #fff;
    text-decoration: none;
    font-weight: 600;
}
.register-link p a:hover{
    text-decoration: underline;
}
.remember a{
    color:#fff;
}
/* Reset margins */
body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    font-family: 'Arial', sans-serif; /* Choose your preferred font */
}

/* Splash Screen */
#splash-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background-color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

/* Logo Container */
#logo-container {
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Logo */
#logo {
    width: 700px;
    height: 500px;
    border-radius:50%;
    animation: bloom 2s forwards; /* Bloom animation */
}

/* Site Name */
#site-name {
    font-size: 2.5em;
    opacity: 0;
    animation: fadeIn 2s forwards 1.5s; /* Fade-in with delay */
    margin-top: 20px;
}

/* Main Content */


/* Bloom Animation */
@keyframes bloom {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    150% {
        transform: scale(1.1); /* Slightly enlarge */
        opacity: 1;
    }
    200% {
        transform: scale(1); /* Return to normal size */
    }
}

/* Fade In Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}





    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <script>// Wait for 2 seconds then hide splash screen and show login content
window.addEventListener('load', function() {
    setTimeout(function() {
        // Fade out splash screen
        const splashScreen = document.getElementById('splash-screen');
        splashScreen.style.animation = 'fadeOut 1s forwards'; // Apply fade out animation

        // Show login content after the splash screen fades out
        setTimeout(function() {
            splashScreen.style.display = 'none'; // Hide the splash screen
            document.getElementByClassName('wrapper').style.display = 'block'; // Show the login content
        }, 1000); // Wait for the fade out animation to complete
    }, 2000); // 2000 milliseconds = 2 seconds
});

</script>
<<div id="splash-screen">
        <div id="logo-container">
            <img src="images/logoimage.jpg" alt="C2C Logo" id="logo">
            <h1 id="site-name">canteen2campus</h1>
        </div>
    </div>

    <div class="wrapper">
        <form action="login.php" method="POST">
            <h1>LOGIN</h1>
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class="fa-solid fa-user" id="one"></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fa-solid fa-lock" id="two"></i>
            </div>
            <div class="input-box">
                <select name="user_type" required>
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
