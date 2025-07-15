<?php
session_start();
include 'config.php'; // Include your database connection


// Fetch user details from session
$user_email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Travel Paradise - Booking</title>
  <link rel="stylesheet" href="style1.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav>
    <div class="logo">
        <h1>Travel Paradise</h1>
    </div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="destination.html">Destinations</a></li>
        <li><a href="display.php">Feedbacks</a></li>
        <li><a href="explore.html">Explore</a></li>
        <li><a href="index1.html">Weather</a></li>
        <li><a href="book.php">Book</a></li>
        <li><a href="contact.html">Contact</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<!-- Booking Header -->
<div class="container mt-4 text-center">
  <h2>Book Your Travel</h2>
  <p>Select a travel mode to begin booking</p>
</div>

<!-- Tabs for Booking Modes -->
<div class="container mt-4">
  <ul class="nav nav-tabs" id="bookingTabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="rental-tab" data-bs-toggle="tab" href="#rental" role="tab">Rental Vehicle</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="bus-tab" data-bs-toggle="tab" href="#bus" role="tab">Bus</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="flight-tab" data-bs-toggle="tab" href="#flight" role="tab">Flight</a>
    </li>
  </ul>

  <!-- Tab Contents -->
  <div class="tab-content p-4 border border-top-0" id="bookingTabsContent">

    <!-- Rental Vehicle -->
    <div class="tab-pane fade show active" id="rental" role="tabpanel">
      <form action="book_now.php" method="POST">
        <input type="hidden" name="booking_type" value="Rental Vehicle">
        <div class="mb-3">
          <label>Pickup Location</label>
          <input type="text" name="from_location" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Drop Location</label>
          <input type="text" name="to_location" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Date</label>
          <input type="date" name="travel_date" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Vehicle Type</label>
          <select name="vehicle_type" class="form-select">
            <option>Sedan</option>
            <option>SUV</option>
            <option>Bike</option>
          </select>
        </div>
        
        <!-- Payment Details -->
        <div class="mb-3">
          <label>Amount</label>
          <input type="number" name="amount" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Payment Method</label>
          <select name="payment_method" class="form-select">
            <option>Credit Card</option>
            <option>Debit Card</option>
            <option>PayPal</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Book Rental Vehicle</button>
      </form>
    </div>

    <!-- Bus Booking -->
    <div class="tab-pane fade" id="bus" role="tabpanel">
      <form action="book_now.php" method="POST">
        <input type="hidden" name="booking_type" value="Bus">
        <div class="mb-3">
          <label>From</label>
          <input type="text" name="from_location" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>To</label>
          <input type="text" name="to_location" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Travel Date</label>
          <input type="date" name="travel_date" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Seat Type</label>
          <select name="seat_type" class="form-select">
            <option>AC Sleeper</option>
            <option>Non-AC</option>
            <option>Seater</option>
          </select>
        </div>

        <!-- Payment Details -->
        <div class="mb-3">
          <label>Amount</label>
          <input type="number" name="amount" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Payment Method</label>
          <select name="payment_method" class="form-select">
            <option>Credit Card</option>
            <option>Debit Card</option>
            <option>PayPal</option>
          </select>
        </div>

        <button type="submit" class="btn btn-success">Book Bus</button>
      </form>
    </div>

    <!-- Flight Booking -->
    <div class="tab-pane fade" id="flight" role="tabpanel">
      <form action="book_now.php" method="POST">
        <input type="hidden" name="booking_type" value="Flight">
        <div class="mb-3">
          <label>From</label>
          <input type="text" name="from_location" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>To</label>
          <input type="text" name="to_location" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Departure Date</label>
          <input type="date" name="travel_date" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Flight Class</label>
          <select name="flight_class" class="form-select">
            <option>Economy</option>
            <option>Business</option>
            <option>First Class</option>
          </select>
        </div>

        <!-- Payment Details -->
        <div class="mb-3">
          <label>Amount</label>
          <input type="number" name="amount" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Payment Method</label>
          <select name="payment_method" class="form-select">
            <option>Credit Card</option>
            <option>Debit Card</option>
            <option>PayPal</option>
          </select>
        </div>

        <button type="submit" class="btn btn-danger">Book Flight</button>
      </form>
    </div>

  </div>
</div>

<!-- Display Booking History -->
<div class="container mt-5">
  <h3>Your Booking History</h3>
  <?php
  // Fetch user booking history including payment details
  $sql = "SELECT * FROM bookings WHERE user_email = '$user_email' ORDER BY booking_date DESC";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    echo '<table class="table">';
    echo '<thead><tr><th>Booking Type</th><th>From</th><th>To</th><th>Date</th><th>Amount</th><th>Payment Method</th><th>Details</th></tr></thead><tbody>';
    
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>
              <td>{$row['booking_type']}</td>
              <td>{$row['from_location']}</td>
              <td>{$row['to_location']}</td>
              <td>{$row['travel_date']}</td>
              <td>{$row['amount']}</td>
              <td>{$row['payment_method']}</td>
              <td>{$row['details']}</td>
            </tr>";
    }

    echo '</tbody></table>';
  } else {
    echo "<p>No bookings found.</p>";
  }
  ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
