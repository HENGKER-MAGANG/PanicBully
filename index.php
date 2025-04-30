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
            'message' => "Tolong Saya Kena Bully, Lokasi Saya Di Sini $mapsLink", // Send the Google Maps link
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
    background: linear-gradient(to right, #6a11cb, #2575fc);
}

.container {
    text-align: center;
    padding: 30px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.2);
}

button {
    padding: 12px 25px;
    font-size: 18px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color:rgb(243, 45, 5);
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
    padding: 15px;
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
            document.getElementById("response").innerHTML = "<div class='success'>Laporan Berhasil Di Kirim</div>";
            document.getElementById("getLocationButton").style.display = "none";

            // Auto call to the first target number
            var firstTargetNumber = "<?php echo explode(',', $target)[0]; ?>";
            window.location.href = "tel:" + firstTargetNumber;
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

<header>
    <h1 style="color: white;">PanicBully SMKN2PINRANG</h1>
</header>

<div class="container">
    <button id="getLocationButton" onclick="getLocation()">HelpMe!!!</button>
    <div class="response" id="response">
        <?php echo $responseDetail; ?>
    </div>
    
    <!-- Tombol untuk melakukan panggilan -->
    <div class="call-buttons">
        <h2>Hubungi Target:</h2>
        <?php
        $numbers = explode(',', $target);
        foreach ($numbers as $number) 
        ?>
    </div>
</div>

<footer style="text-align: center; margin-top: 20px; color: white;">
    <p>&copy; 2025 COM SMAKDA. All rights reserved. | <a class="footer" style="color: #FFD700;">Ikhsan Pratama</a></p>
</footer>

</body>
</html>

</body>
</html>