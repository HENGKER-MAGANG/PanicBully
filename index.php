<?php
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
            'message' => "Koordinat: $mapsLink", // Send the Google Maps link
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
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .response {
            margin-top: 20px;
            font-size: 1.2em;
            color: green;
        }
        .success {
            margin-top: 20px;
            font-size: 1.5em;
            color: #155724; 
            background-color: #d4edda; 
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #c3e6cb; 
        }
    </style>
    <script>
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(sendCoordinates, showError);
        } else {
            alert("Geolocation tidak didukung oleh browser ini.");
        }
    }

    function sendCoordinates(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        // Send data to server using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById("response").innerHTML = "<div class='success'>Koordinat berhasil dikirim! Terima kasih!</div>";
                document.getElementById("getLocationButton").style.display = "none";
            }
        };
        // Send coordinates to the server
        xhr.send("latitude=" + latitude + "&longitude=" + longitude);
    }


    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                alert("Pengguna menolak permintaan untuk mendapatkan lokasi.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Lokasi tidak tersedia.");
                break;
            case error.TIMEOUT:
                alert("Permintaan untuk mendapatkan lokasi telah timeout.");
                break;
            case error.UNKNOWN_ERROR:
                alert("Terjadi kesalahan yang tidak diketahui.");
                break;
        }
    }
</script>
</head>
<body>


<div class="container">
    <h1>Dapatkan Titik Koordinat</h1>
    <button id="getLocationButton" onclick="getLocation()">Dapatkan Koordinat</button>
    <div class="response" id="response">
        <?php echo $responseDetail; ?>
    </div>
</div>

<footer>
    <p>&copy; 2025 COM SMAKDA. All rights reserved. | <a class="footer">Ikhsan Pratama</a>
</html>