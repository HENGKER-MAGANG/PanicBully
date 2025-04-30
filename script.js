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