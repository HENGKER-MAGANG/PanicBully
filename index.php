<?php
// PHP code to handle form submission and API request
$token = "3eMwembPzZKCzJfVzgdr"; 
$target = "6282261325895,6282349273941,6285241419991"; 
$responseDetail = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['latitude']) && isset($_POST['longitude'])) {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Create Google Maps link
    $mapsLink = "https://www.google.com/maps?q=$latitude,$longitude";

    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => array(
            'target' => $target,
            'message' => "Tolong Saya Kena Bully, Lokasi Saya Di Sini $mapsLink",
        ),
        CURLOPT_HTTPHEADER => array(
            "Authorization: $token"
        ),
    ));

    // Execute cURL request and get response
    $response = curl_exec($curl);
    curl_close($curl);

    // Decode response
    $responseDecoded = json_decode($response, true);
    $responseDetail = isset($responseDecoded['detail']) ? $responseDecoded['detail'] : 'No response available';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Response</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>
<body>

<header>
    <h1 style="color: white;">PanicBully SMKN2PINRANG</h1>
</header>

<div class="container">
    <button id="getLocationButton" onclick="getLocation()">HelpMe!!!</button>
    <div class="response" id="response">
        <?php echo $responseDetail; ?>
    </div>
</div>

<footer style="text-align: center; margin-top: 20px; color: white;">
    <p>&copy; 2025 COM SMAKDA. All rights reserved. | <a class="footer-link" href="https://www.instagram.com/iksan24_?igsh=NzBnMHFnaXdxdjkz">Ikhsan Pratama</a></p>
</footer>

</body>
</html>