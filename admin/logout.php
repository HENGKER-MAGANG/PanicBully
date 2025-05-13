<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Logout...</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
        Swal.fire({
            title: 'Berhasil Logout!',
            text: 'Kamu telah keluar dari sistem.',
            icon: 'success',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didClose: () => {
                window.location.href = "login.php";
            }
        });
    </script>
</body>
</html>
