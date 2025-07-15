<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hotel_name = $_POST['hotel_name'];
    $address = $_POST['address'];
    $rate = $_POST['rate'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Connect to DB
    $conn = new mysqli("localhost", "root", "", "travel");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, hotel_name, address, rate) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $phone, $hotel_name, $address, $rate);

    if ($stmt->execute()) {
        echo "<div style='text-align:center;margin-top:40px;'>
                <h2>Booking Confirmed!</h2>
                <p>Thank you, $name. We’ve saved your booking for <strong>$hotel_name</strong>.</p>
                <a href='index.php'> Back to Home</a>
              </div>";
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- HTML Booking Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Booking</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">📝 Book Your Stay</h2>

    <form method="POST" action="booking.php" class="card p-4 shadow">
        <input type="hidden" name="hotel_name" value="<?php echo $_GET['hotel_name'] ?? ''; ?>">
        <input type="hidden" name="address" value="<?php echo $_GET['address'] ?? ''; ?>">
        <input type="hidden" name="rate" value="₹3000 / night"> <!-- default rate -->

        <div class="form-group">
            <label>Your Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="form-group">
            <label>Email ID</label>
            <input type="email" class="form-control" name="email" required>
        </div>

        <div class="form-group">
            <label>Phone No.</label>
            <input type="tel" class="form-control" name="phone" required>
        </div>

        <div class="form-group">
            <label>Rate</label>
            <input type="text" class="form-control" value="₹3000 / night" disabled>
        </div>

        <button type="submit" class="btn btn-success btn-block">Confirm Booking</button>
    </form>
</div>
</body>
</html>
