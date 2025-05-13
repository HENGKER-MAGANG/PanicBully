<?php
$token = "mrDCnGqnLfihKSXNbsfh";
$target = "6282261325895,6282349273941,6285241419991";

$message = "❗ BATAL LAPORAN PANIC BUTTON – Mohon abaikan laporan sebelumnya. Ini bukan keadaan darurat.";

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.fonnte.com/send',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => array(
        'target' => $target,
        'message' => $message,
    ),
    CURLOPT_HTTPHEADER => array(
        "Authorization: $token"
    ),
));
$response = curl_exec($curl);
curl_close($curl);
?>
