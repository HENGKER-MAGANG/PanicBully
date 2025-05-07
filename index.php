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
    <title>Panic Bully</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tagesschrift&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>
<body>

<div class="header">⚡ SMAKDA Emergency System</div>

<div class="card">
    <h2 id="tlt">Laporkan Bullying</h2>
    <p id="txt">
        Jika kamu merasa tidak aman atau sedang dibully, tekan tombol di bawah
        untuk meminta bantuan secepatnya.
    </p>

    <div class="container">
    <button id="panic-btn" class="btn" onclick="getLocation()">Panic</button>
        <div class="response" id="response">
            <?php echo $responseDetail; ?>
        </div>
    </div>
</div>

    <div class="footer">
        <p>&copy; 2025 Community Programmer | Ikhsan Pratama SMKN2PINRANG</p>
    </div>

    </body>
</html>
