<?php
 require_once('../php/configer.php');
   $conn = new mysqli($servername, $username, $password, $dbname);


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$username' OR phone='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
       
        if (password_verify($password, $row['password'])) {
            echo "<script>
    localStorage.setItem('usertype', true);
    const userdata = {
        id: " . json_encode(htmlspecialchars($row['id'])) . ",
        password: " . json_encode(htmlspecialchars($row['password'])) . ",
        photo: " . json_encode(htmlspecialchars($row['photo'])) . ",
        username: " . json_encode(htmlspecialchars($row['username'])) . ",
        email: " . json_encode(htmlspecialchars($row['email'])) . ",
        phone: " . json_encode(htmlspecialchars($row['phone'])) . ",
        bath: " . json_encode(htmlspecialchars($row['bath'])) . ",
        verifay: " . json_encode(htmlspecialchars($row['verifay'])) . ",
        create_at: " . json_encode(htmlspecialchars($row['created_at'])) . "
    };
    const userstring = JSON.stringify(userdata);
    localStorage.setItem('user', userstring);
    window.location.href='/account/?id=".$row['id']."';
</script>";

        } else {
            echo "<center><p style='background-color: red;color: #fff;padding: 13px;width: 300px;position: fixed; top: 10px;box-shadow: 0 0 20px 0 red; font-size: 15pt; border-radius: 5px;right: 20px;'>Invalid password!</p><br><br><br><br><h1><a href='/login'>Go Back</a></h1></center>";
        }
    } else {
        echo "<script>window.location.href='/error/?code=101';</script>";
    }
}
$conn->close();
  ?>