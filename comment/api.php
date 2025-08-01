<?php
header('Content-Type: application/json');
require_once('../php/configer.php');
$token = $_GET['token'];
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

$sql = "SELECT * FROM `$token`";
$result = $conn->query($sql);

$data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
       
        if (isset($row['post'])) {
            $row['post'] = date("j M y g:i A", strtotime($row['post']));
        }
        $data[] = $row;
    }
}

echo json_encode($data);
$conn->close();
?>
