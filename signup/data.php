<?php
require_once('../php/configer.php');
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("poblem: " . mysqli_connect_error());
}
echo "Conn test ok";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$username = $_POST['username'];
$bath = $_POST['bath'];
$useremail = $_POST['email'];
$userphone = $_POST['phone'];
$password = $_POST['password'];
$photo = 'usericon.png';
$verifay = '';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (username, bath, email, phone, photo, verifay, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $username, $bath, $useremail, $userphone, $photo, $verifay, $hashedPassword);
if ($stmt->execute()) {
    echo "<script>window.location.href='/';</script>";
} else {
    echo "তথ্য সংরক্ষণ করতে সমস্যা হয়েছে: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
