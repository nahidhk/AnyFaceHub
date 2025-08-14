<?php
require_once('../php/config.php');
$username = explode('/', trim($_SERVER['REQUEST_URI'], '/'))[1];

// Empty username check
if (empty($username)) {
    die("⚠ No username provided.");
}

// Prepare statement
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "❌ User not found.";
    exit;
}

$row = $result->fetch_assoc();

// Safe output
echo "👤 Username: " . htmlspecialchars($row['username']) . "<br>";
echo "📛 Full Name: " . htmlspecialchars($row['full_name']) . "<br>";
echo "📧 Email: " . htmlspecialchars($row['email']) . "<br>";
echo "📞 Phone: " . htmlspecialchars($row['phone_number']) . "<br>";

$stmt->close();
$conn->close();
?>


