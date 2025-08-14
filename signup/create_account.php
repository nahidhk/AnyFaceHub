<?php
require_once('../php/config.php');
require_once '../vendor/autoload.php';
use Detection\MobileDetect;

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
$email = '';
$phonenum = '';

if (empty($phoneOrEmail)) {
    echo "❌ Error: ফোন নম্বর বা ইমেইল দিতে হবে।";
    exit;
} elseif (filter_var($phoneOrEmail, FILTER_VALIDATE_EMAIL)) {
    $email = $phoneOrEmail;
    echo "✅ ইমেইল ভ্যালিড।<br>";
} elseif (preg_match('/^\+?[0-9]{10,15}$/', $phoneOrEmail)) {
    $phonenum = preg_replace('/\D/', '', $phoneOrEmail);
    echo "✅ ফোন নম্বর ভ্যালিড।<br>";
} else {
    echo "❌ ইমেইল বা ফোন নম্বর সঠিক নয়।";
    exit;
}

// Device detection
$detect = new MobileDetect;
$deviceType = $detect->isTablet() ? 'Tablet' : ($detect->isMobile() ? 'Mobile' : 'Desktop');

// User Agent
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';

// OS detect
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

// Browser detect
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

$os = detectOS($userAgent);
$browser = detectBrowser($userAgent);
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Current Timestamp
$createdAt = $updatedAt = date('Y-m-d');


// SQL INSERT
$stmt = $conn->prepare("INSERT INTO users (
    full_name, date_of_birth, gender, phone_or_email, password, username,
    phone_number, email, os, browser, device_type, created_at, updated_at
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssssssssss", $fullName, $dateOfBirth, $gender, $phoneOrEmail, $hashedPassword,
$username, $phonenum, $email, $os, $browser, $deviceType, $createdAt, $updatedAt);

if ($stmt->execute()) {
    // call profile 
    header("Location: /af/$username");
   
} else {
    echo "<br><br>❌ Error inserting data: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
