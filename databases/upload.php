<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["photo"])) {
    $uploadDir = "photos/";
    $photoid = uniqid();
    $uniqueName = $photoid . '.' . strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION));
    $uploadFile = $uploadDir . $uniqueName;
    $title = $_POST["title"];
    $mydate = $_POST["date"];
    $device = $_POST["dvc"];
    $ip = $_POST["ip"];
    $location = $_POST["location"];
    $userid = intval($_POST["userid"]); 
    $maxFileSize = 50 * 1024 * 1024;  
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $allowedExtensions = array("jpg", "jpeg", "png", "gif", "bmp", "webp", "svg", "tiff","avif");

    if (in_array($imageFileType, $allowedExtensions)) {
        if ($_FILES["photo"]["size"] > $maxFileSize) {
            echo "<h1>Photo size exceeds the limit of 50 MB. <a href='mailto:nahidhk2007@gmail.com'>feedback</a> Nahid HK.</h1>";
            exit;
        }

        if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
            echo "<h1><script>window.location.href='/error/?code=107';</script></h1>";
            exit;
        }

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $uploadFile)) {
            require_once('../php/configer.php');
            $conn = new mysqli($servername, $username, $password, $dbname);
        
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT * FROM users WHERE id = $userid";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc(); 
            }
         
            $stmt = $conn->prepare("INSERT INTO photos (title, username, userimg, mydate, photo, device, ip, location, userid, verifay, photoid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssssss", $title, $row['username'], $row['photo'], $mydate, $uniqueName, $device, $ip, $location, $row['id'], $row['verifay'], $photoid);
            
            if ($stmt->execute()) {
                // Create a new table for comments and likes specific to this photo
                $createTableSql = "CREATE TABLE `$photoid` (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    userid INT NOT NULL,
                    username VARCHAR(30),
                    userimg VARCHAR(100),
                    comment TEXT NOT NULL,
                    `like` VARCHAR(20) NOT NULL,
                    post TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";
                
                
                if ($conn->query($createTableSql) === TRUE) {
                    echo "<script>window.location.href='/';</script>";
                    echo $photoid;
                } else {
                    echo "<h1>Error creating comment table for photo.</h1>";
                }
            } else {
                echo "<h1>Error uploading photo to database. <a href='mailto:nahidhk2007@gmail.com'>feedback</a> Nahid HK.</h1>";
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "<h1>Error moving uploaded file.</h1>";
        }
    } else {
        echo "<h1>Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.</h1>";
    }
} else {
    echo "<h1><script>window.location.href='/error/?code=106';</script></h1>";
}
?>
