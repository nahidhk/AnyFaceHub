<?php
$servername = "localhost";  
$username = "root";         
$password = "Nahid@!2345s$!";            
$dbname = "anyfacehub"; 
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("poblem: " . mysqli_connect_error());
}
    $conn->set_charset("utf8");
?>