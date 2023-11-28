<?php
// Funkcija za dobijanje korisnikove IP adrese
function getUserIP() {
    // Provera da li je korisnik iza proxy-ja
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Funkcija za dobijanje države na osnovu IP adrese
function getCountryByIP($ip) {
    $url = "https://ipinfo.io/{$ip}/json";
    $data = file_get_contents($url);
    $details = json_decode($data);
    return $details->country;
}

// Provera za Hrvatsku i redirekcija
$userIP = getUserIP();
$userCountry = getCountryByIP($userIP);

if ($userCountry === "HR") {
    header("Location: https://iptv-plex.carrd.co/");
    exit();
}

// Ako korisnik nije iz Hrvatske, možete postaviti alternativni sadržaj ili redirekciju
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blokiran si</title>
</head>
<body>
    <h1>Vi nemate dozvolu za pristup ovim informacijama</41>
    
</body>
</html>
