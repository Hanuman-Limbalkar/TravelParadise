<?php
$location = $_GET['location'] ?? 'Goa'; // default fallback

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://travel-advisor.p.rapidapi.com/locations/search?query=" . urlencode($location) . "&lang=en_US&units=km",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: travel-advisor.p.rapidapi.com",
        "X-RapidAPI-Key: 3d554ddf30msha162a88c8aa4fb6p15bb69jsnc582c6fb8148"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

$hotels = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">🏨 Hotels in "<?php echo htmlspecialchars($location); ?>"</h2>

    <div class="row">
    <?php
if (isset($hotels['data']) && is_array($hotels['data'])) {
    foreach ($hotels['data'] as $item) {
        if (
            isset($item['result_type']) && 
            $item['result_type'] === 'lodging' &&
            isset($item['result_object']['name'])
        ) {
            $name = $item['result_object']['name'];
            $address = $item['result_object']['address_obj']['address_string'] ?? 'No address available';
            $rating = $item['result_object']['rating'] ?? 'N/A';

            echo '<div class="col-md-4 mb-4">
                    <div class="card h-100 shadow">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($name) . '</h5>
                            <p class="card-text">' . htmlspecialchars($address) . '</p>
                            <p class="card-text">Rating: ' . htmlspecialchars($rating) . '</p>
                            <a href="booking.php" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                  </div>';
        }
    }
} else {
    echo "<div class='col-12'><div class='alert alert-warning'>⚠️ No hotels found for this location.</div></div>";
}
?>

    </div>

    <a href="book.html" class="btn btn-secondary mt-4">Search Again</a>
</div>
</body>
</html>
