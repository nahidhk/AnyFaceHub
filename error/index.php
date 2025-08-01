<?php 
session_start(); 
$code = $_GET['code'];
require_once('../php/configer.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM error WHERE code = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $code); 
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['code'] = $user['code'];
} else {
    echo "<script>window.location.href='/error/?code=103';</script>";
    exit;

}
$stmt->close();
$conn->close();
$randomColor = '#' . sprintf('%06X', mt_rand(0, 0xFFFFFF));

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <link rel="stylesheet" href="/style/style.main.css"> -->
    <link rel="shortcut icon" href="/data/error_img/<?php echo htmlspecialchars($user['img']); ?>" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($user['title']); ?> - Anyface</title> 
    <style>
        body{
            font-family: sans-serif;
        }
button {
  background-color: #e1ecf4;
  border-radius: 3px;
  border: 1px solid #7aa7c7;
  box-shadow: rgba(255, 255, 255, .7) 0 1px 0 0 inset;
  box-sizing: border-box;
  color: #39739d;
  cursor: pointer;
  display: inline-block;
  font-family: -apple-system,system-ui,"Segoe UI","Liberation Sans",sans-serif;
  font-size: 13px;
  font-weight: 400;
  line-height: 1.15385;
  margin: 0;
  outline: none;
  padding: 8px .8em;
  position: relative;
  text-align: center;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: baseline;
  white-space: nowrap;
}

button:hover,
button:focus {
  background-color: #b3d3ea;
  color: #2c5777;
}

button:focus {
  box-shadow: 0 0 0 4px rgba(0, 149, 255, .15);
}

button:active {
  background-color: #a0c7e4;
  box-shadow: none;
  color: #2c5777;
}
    </style>
</head>
<body>
    <blockquote>
        <h1 style="color: #ff0037;"><?php echo htmlspecialchars($user['title']); ?></h1>
    </blockquote>
    <center>
        <img style="height: 200px" src="/data/error_img/<?php echo htmlspecialchars($user['img']); ?>" alt="">
        <br>
        <h1 style="color:<?php echo $randomColor ?>">
        <?php echo htmlspecialchars($user['code']); ?>
        </h1>
        <h2 style="color:<?php echo $randomColor ?>">
        <?php echo htmlspecialchars($user['message']); ?>
        </h2>
        <button onclick="window.history.back();">Go Back</button> <button onclick="<?php echo htmlspecialchars($user['script']); ?>"><?php echo htmlspecialchars($user['btn']); ?></button>
    </center>
</body>
</html>
