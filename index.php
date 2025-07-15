<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Paradise</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

    <nav>
        <div class="logo">
            <h1>Travel Paradise</h1>
        </div>
        <ul>
            <?php if (isset($_SESSION['username'])): ?>
                <li><a href="index.php">Home</a></li>
            <li><a href="destination.html">Destinations</a></li>
            <li> <a href="display.php">Feedbacks</a></li>
            <li><a href="explore.html">Explore</a></li>
            <li><a href="index1.html">Weather</a></li>
            <li><a href="book.html">Book Hotels</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.html">Login</a></li>
                <li><a href="signup.html">Sign Up</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
    <div class="hero-content">
        <h2>Discover Your Next Adventure</h2>
        <p>Explore the world like never before with our curated travel packages.</p>
        <?php if (isset($_SESSION['username'])): ?>
            <a href="explore.html" class="btn">Explore Now</a>
        <?php else: ?>
            <a href="#" class="btn" onclick="alert('Please log in to access Explore!');">Explore Now</a>
        <?php endif; ?>
    </div>
</section>

    <!-- Featured Destinations -->
    <section class="destinations">
        <h2>Top Destinations</h2>
        <div class="destination-grid">
            <div class="destination">
                <img src="paris.jpg" alt="Paris">
                <div class="destination-overlay">
                    <h3>Paris</h3>
                    <p>The city of love, art, and culture awaits you.</p>
                </div>
            </div>
            <div class="destination">
                <img src="new.jpg" alt="New York">
                <div class="destination-overlay">
                    <h3>New York</h3>
                    <p>The iconic city that never sleeps, full of energy.</p>
                </div>
            </div>
            <div class="destination">
                <img src="bali.jpg" alt="Bali">
                <div class="destination-overlay">
                    <h3>Bali</h3>
                    <p>A tropical paradise to unwind and explore.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2025 Travel Paradise | All Rights Reserved</p>
            <div class="social-icons">
                <a href="https://www.instagram.com" target="_blank" class="social-icon instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.facebook.com" target="_blank" class="social-icon facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.linkedin.com" target="_blank" class="social-icon linkedin">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="mailto:hglimbalkar@gmail.com" class="social-icon email">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>
            <p>Contact us: <a href="mailto:hglimbalkar@gmail.com">hglimbalkar@gmail.com</a></p>
        </div>
    </footer>
    
</body>
</html>