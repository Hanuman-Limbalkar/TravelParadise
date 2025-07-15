<?php
include 'config.php'; // Database connection

$sql = "SELECT * FROM destinations";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Destinations</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        title{
            color:black;
        }
        html {
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h2 {
            text-align: center;
            margin-top: 30px;
            color: white;
            font-size: 2em;
        }

        .container {
            display: flex;
            flex-direction: column;
            gap: 25px;
            padding: 30px;
            max-width: 1000px;
            margin: auto;
        }

        .city {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .city:hover {
            transform: scale(1.01);
        }

        .city img {
            width: 300px;
            height: 100%;
            object-fit: cover;
        }

        .content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .city h3 {
            margin: 0 0 10px;
            font-size: 1.5em;
            color: #ff7e5f;
        }

        .experience {
            font-size: 0.95em;
            color: #444;
            margin-bottom: 10px;
            max-height: 100px;
            overflow-y: auto;
        }

        .experience::-webkit-scrollbar {
            width: 6px;
        }

        .experience::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 5px;
        }

        .city p {
            margin: 5px 0;
        }

        @media (max-width: 768px) {
            .city {
                flex-direction: column;
                align-items: center;
            }

            .city img {
                width: 100%;
                height: 200px;
            }

            .content {
                padding: 15px;
            }

            nav {
                flex-direction: column;
                align-items: flex-start;
            }
            .name-display {
        margin-top: auto;
        text-align: right;
        font-style: italic;
        color: #888;
        font-size: 14px;
            }

        }
    </style>
</head>
<body>

<nav>
    <div class="logo">
        <h1>Travel Paradise</h1>
    </div>
    <ul>
    <li><a href="index.php">Home</a></li>
            <li><a href="destination.html">Destinations</a></li>
            <li> <a href="display.php">Feedbacks</a></li>
            <li><a href="explore.html">Explore</a></li>
            <li><a href="index1.html">Weather</a></li>
            <li><a href="book.html">Book Hotels</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<h2>Explore Destinations</h2>

<div class="container">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="city">
                    <img src="'.$row['image'].'" alt="'.$row['destination'].'">
                    <div class="content">
                        <h3>'.$row['destination'].'</h3>
                        <div class="experience">'.$row['experience'].'</div>
                        <p><strong>Budget:</strong> ₹ '.$row['budget'].'</p>
                        <p><strong>Rating:</strong> '.$row['rating'].'/5</p>
                        <p class="name-display">— '.$row['name'].'</p>
                    </div>
                </div>';
        }
    } else {
        echo "<p>No destinations found.</p>";
    }
    mysqli_close($conn);
    ?>
</div>

</body>
</html>
