<?php
session_start();
include 'config.php'; // Include your database connection

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.html"); // Redirect to login page if user is not logged in
    exit();
}

$user_email = $_SESSION['email'];
$booking_type = $_POST['booking_type'];
$from_location = $_POST['from_location'];
$to_location = $_POST['to_location'];
$travel_date = $_POST['travel_date'];
$amount = $_POST['amount'];
$payment_method = $_POST['payment_method'];
$details = "Booking details for $booking_type"; // Customize this as needed

// Insert booking data into the database
$sql = "INSERT INTO bookings (user_email, booking_type, from_location, to_location, travel_date, amount, payment_method, details) 
        VALUES ('$user_email', '$booking_type', '$from_location', '$to_location', '$travel_date', '$amount', '$payment_method', '$details')";

if (mysqli_query($conn, $sql)) {
    echo "Booking successful!";
    header("Location: book.php"); // Redirect to booking page to show history
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
