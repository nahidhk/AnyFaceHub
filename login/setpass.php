<?php 
require_once('../php/configer.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id = $_GET['id']; 
$password = $_POST['password'];
echo "Connected and URL ID = $id<br>";
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
$stmt->bind_param("si", $hashedPassword, $id);
if ($stmt->execute()) {
    echo "<script>
            window.history.back();
        </script>";
} else {
    echo "Error updating password: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
