<?php
session_start();
include 'config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']); // ✅ NEW
    $startPoint = mysqli_real_escape_string($conn, $_POST['start_point']);
    $destination = mysqli_real_escape_string($conn, $_POST['destination']);
    $budget = mysqli_real_escape_string($conn, $_POST['budget']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);

    $uploadDir = "uploads/";
    $imageName = basename($_FILES["image"]["name"]);
    $imageTmpName = $_FILES["image"]["tmp_name"];
    $imageType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    $allowedTypes = array("jpg", "jpeg", "png", "gif");

    if (!in_array($imageType, $allowedTypes)) {
        die("Only JPG, JPEG, PNG, and GIF files are allowed.");
    }

    $newFileName = uniqid("IMG_", true) . "." . $imageType;
    $targetFile = $uploadDir . $newFileName;

    if (move_uploaded_file($imageTmpName, $targetFile)) {
        $sql = "INSERT INTO destinations (name, start_point, destination, image, budget, experience, rating) 
                VALUES ('$name', '$startPoint', '$destination', '$targetFile', '$budget', '$experience', '$rating')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Destination added successfully!'); window.location='display.php';</script>";
        } else {
            echo "Database Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error uploading image.";
    }
}
?>
