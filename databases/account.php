<?php
require_once('../php/configer.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id']; 
echo "connected and url id = $id<br>";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["photo"])) {
    
    $uploadDir = 'photos/';
    $uploadFile = $uploadDir . basename($_FILES["photo"]["name"]);
    $savesql = basename($_FILES["photo"]["name"]);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $allowedExtensions)) {
        if (is_writable($uploadDir)) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $uploadFile)) {
                echo "File upload successful<br>";
                
                $sql = "UPDATE users SET photo='$savesql' WHERE id=$id";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<script>const storedData = localStorage.getItem('user');
if (storedData) {
  const parsedData = JSON.parse(storedData);
  parsedData.photo = '$savesql';  
  localStorage.setItem('user', JSON.stringify(parsedData));
  console.log('Updated Data:', parsedData);  
} else {
  console.log('No data found in localStorage');
}
  window.location.href = `/account/?id=$id`;
  </script>";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "<h1>File move failed. Check file permissions and size limits.</h1>";
            }
        } else {
            echo "<h1>Upload directory is not writable. Check permissions for the 'photos/' folder.</h1>";
        }
    } else {
        echo "<h1>Invalid file type. Only JPG, JPEG, PNG & GIF files are allowed. Change your profile photo in the setting</h1>";
    }
} else {
    echo "<h1>No file uploaded or Server Problem <a href='mailto:nahidhk2007@gmail.com'>feedback</a> in Nahid HK.</h1>";
}

$conn->close();
?>
