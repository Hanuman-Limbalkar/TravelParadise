<?php
session_start(); // Start the session to access session variables

// Check if user is logged in (session exists)
if (!isset($_SESSION['user_email'])) {
    header("Location: login.html");
    exit();
}

$user_email = $_SESSION['user_email']; // Retrieve email from session
$conn = new mysqli("localhost", "root", "", "travel");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch booking history for the logged-in user
$stmt = $conn->prepare("SELECT name, hotel_name, address, rate, phone FROM bookings WHERE email = ?");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Booking History</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <h2 class="mb-4 text-center">📖 Your Booking History</h2>

    <?php if ($result->num_rows > 0): ?>
      <table class="table table-bordered table-hover">
        <thead class="thead-dark">
          <tr>
            <th>Name</th>
            <th>Hotel</th>
            <th>Address</th>
            <th>Rate</th>
            <th>Phone</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['hotel_name']) ?></td>
              <td><?= htmlspecialchars($row['address']) ?></td>
              <td><?= htmlspecialchars($row['rate']) ?></td>
              <td><?= htmlspecialchars($row['phone']) ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="alert alert-info text-center">No bookings found!</div>
    <?php endif; ?>

    <div class="text-center mt-4">
      <a href="book.html" class="btn btn-primary">Back to Home</a>
    </div>
  </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
