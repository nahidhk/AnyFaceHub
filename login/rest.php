<?php
require_once('../php/configer.php');
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $phone = mysqli_real_escape_string($conn, trim($_POST['phone']));

    $sql = "SELECT * FROM users WHERE email='$email' OR phone='$phone'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if ($phone == $row['phone'] && $email == $row['email']) {
            echo "<script>
            window.history.back();
            sessionStorage.setItem('restuserid', '" . $row['id'] . "');
        </script>";
        
          
        } else {
            echo "<script>window.location.href='/error/?code=102';</script>";
        }
    } else {
        echo "<script>window.location.href='/error/?code=101';</script>";
    }
}
$conn->close();
?>
