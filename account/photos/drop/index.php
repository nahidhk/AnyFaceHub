<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID is missing");
}
require_once('../../../php/configer.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM photos WHERE id = $id";
$result = $conn->query($sql);  

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();  
    $stmt = $conn->prepare("INSERT INTO `delete` (userid, file , photoid) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $row['userid'], $row['photo'], $row['photoid']);
    if ($stmt->execute()) {
        echo "ok";
    } else {
        echo "Error inserting into delete_photo.";
    }
    $sql = "DELETE FROM photos WHERE id = $id;";
    if ($conn->query($sql) === TRUE) {
        echo "<script> window.history.back();</script>";
    } else {
        echo "Error deleting photo.";
    }
    $stmt->close();
} else {
    echo "<script>window.location.href='/error/?code=105';</script>";
}
$conn->close();
?>
