<!-- <?php
session_start();
include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            echo "<script>alert('Login Successful!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Incorrect password!'); window.location='login.html';</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.location='login.html';</script>";
    }
}
?> -->
<?php
session_start();
include 'config.php';  // Database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Query to fetch the user details by username
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Check if the password matches
        if (password_verify($password, $row['password'])) {
            // Set session variables for the logged-in user
            $_SESSION['username'] = $username;
            $_SESSION['user_email'] = $row['email']; // Optionally store the email in session
            
            // Redirect to the home page (index.php) after successful login
            echo "<script>alert('Login Successful!'); window.location='index.php';</script>";
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect password!'); window.location='login.html';</script>";
        }
    } else {
        // User not found
        echo "<script>alert('User not found!'); window.location='login.html';</script>";
    }
}
?>
