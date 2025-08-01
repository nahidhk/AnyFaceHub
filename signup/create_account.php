<?php
require_once('../php/config.php');

// Input Collection
$fullName = $_POST['FullName'] ?? '';
$dateOfBirth = $_POST['DateOfBirth'] ?? '';
$gender = $_POST['Gender'] ?? '';
$phoneOrEmail = $_POST['phoneoremail'] ?? '';
$password = $_POST['password'] ?? '';

// Username generate
$username = strtolower($fullName);
$username = preg_replace('/\s+/', '_', $username);
$username = preg_replace('/[^a-z0-9_]/', '', $username);
$username .= rand(100, 999);

// Phone or Email validation
if (empty($phoneOrEmail)) {
    echo "Error: ফোন নম্বর বা ইমেইল দিতে হবে।";
    exit;
} elseif (filter_var($phoneOrEmail, FILTER_VALIDATE_EMAIL)) {
    echo "ইমেইল ভ্যালিড।<br>"; // এখানে <br> যোগ করলাম
} elseif (preg_match('/^\+?[0-9]{10,15}$/', $phoneOrEmail)) {
    echo "ফোন নম্বর ভ্যালিড।<br>";
} else {
    echo "ইমেইল বা ফোন নম্বর সঠিক নয়।";
    exit;
}


// Device detection
require_once '../vendor/autoload.php';
use Detection\MobileDetect;

$detect = new MobileDetect;

if ($detect->isMobile()) {
    $deviceType = "Mobile";
} elseif ($detect->isTablet()) {
    $deviceType = "Tablet";
} else {
    $deviceType = "Desktop";
}

// User Agent based OS & Browser detect
function detectOS($userAgent) {
    $osArray = [
        '/windows nt 10/i' => 'Windows 10',
        '/android/i' => 'Android',
        '/linux/i' => 'Linux',
        '/iphone/i' => 'iOS',
        '/macintosh|mac os x/i' => 'Mac OS',
    ];
    foreach ($osArray as $regex => $value) {
        if (preg_match($regex, $userAgent)) return $value;
    }
    return 'Unknown OS';
}

function detectBrowser($userAgent) {
    $browserArray = [
        '/msie/i' => 'Internet Explorer',
        '/firefox/i' => 'Firefox',
        '/chrome/i' => 'Chrome',
        '/safari/i' => 'Safari',
        '/opera/i' => 'Opera',
        '/edge/i' => 'Edge',
    ];
    foreach ($browserArray as $regex => $value) {
        if (preg_match($regex, $userAgent)) return $value;
    }
    return 'Unknown Browser';
}

$userAgent = $_SERVER['HTTP_USER_AGENT'];

echo "<br>OS: " . detectOS($userAgent);
echo "<br>Browser: " . detectBrowser($userAgent) . "<br><br>";

// Final Output
echo "Full Name: $fullName <br>";
echo "Date of Birth: $dateOfBirth <br>";
echo "Gender: $gender <br>";
echo "Phone or Email: $phoneOrEmail <br>";
echo "Password: $password <br>";
echo "Username: $username <br>";
echo "<br>Device Type: $deviceType <br>";
echo "User Agent: $userAgent <br>";
?>
