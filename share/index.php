<?php
 $uss = $_GET[ 'uss' ];
if ( isset( $_GET[ 'id' ] ) ) {
    $id = $_GET[ 'id' ];
    
} 
require_once('../php/configer.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM photos WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); 
} else {
    echo "<script>window.location.href='/error/?code=101';</script>";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/style/style.main.css">
    <link rel="shortcut icon" href="/databases/photos/<?php echo $row['photo']?>" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['username']?></title>
</head>
<body>
<section class="maincontect">
        <div class="main">
            <div class="photo">
                <h3>Share : <a href=""><?php $uss ?></a></h3>
                <div onclick="window.location.href='/account?id=<?php echo $row['userid'] ?>'" class="user">
                    <img src="/databases/photos/<?php echo htmlspecialchars($row['userimg']) ?>" alt="<?php echo htmlspecialchars($row['username']) ?>" class="userimg" />
                    <p class="username">&nbsp;&nbsp;&nbsp;<b><span><?php echo htmlspecialchars($row['username']) ?></span></b></p>
                </div>
                <blockquote><span title="This is a Post Time" class="dateshow"><?php echo htmlspecialchars($row['mydate']) ?></span></blockquote>
                <blockquote><?php echo htmlspecialchars($row['title']) ?></blockquote>
                <img src="/databases/photos/<?php echo htmlspecialchars($row['photo']) ?>" alt="<?php echo htmlspecialchars($row['username']) ?>" class="imgdata" />
               
            </div>
           
    </section>
</body>
</html>