<?php
session_start(); // Start the session

if (isset($_GET['id']) && isset($_GET['userid'])) {
    $id = intval($_GET['id']);
    $userid = intval($_GET['userid']);
} else {
    echo "ID or User ID not set.";
    exit;
}

require_once('../php/configer.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepared statement to prevent SQL injection
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid); // 'i' means the database expects an integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['userid'] = $user['id']; // Store user ID in session
} else {
    echo "<script>window.location.href='/error/?code=101';</script>";
    exit;
}

$sql = "SELECT * FROM photos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    echo "<script>window.location.href='/error/?code=104';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message'])) {
    $postlike = "";
    $message = $_POST["message"];
    $table = $data['photoid']; 
    $stmt = $conn->prepare("INSERT INTO `$table` (userid, username, userimg, comment, `like`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user['id'], $user['username'], $user['photo'], $message, $postlike);
    $stmt->execute();
    // Optionally return the newly added comment data as JSON
    echo json_encode([
        'userimg' => $user['photo'],
        'username' => $user['username'],
        'comment' => $message,
        'post' => $data['title'],
    ]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/style/style.main.css" />
    <link rel="shortcut icon" href="/icon.png" type="image/x-icon" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Comment <?php echo htmlspecialchars($data['username']) ?> - AnyFace</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div id="error" class="errornow">
        <center>
            <br><br><br><br><br>
            <h1 id="hacker"></h1>
        </center>
    </div>
    <div class="nav animate__slideInDown animate__animated">
        <span class="navtext"> Anyface</span>
        <button onclick="exaitmyapp()" title="Go Back" class="navbtn mybtn center">
            <i class="fa-solid fa-less-than"></i>
        </button>
    </div>

    <section class="maincontect">
        <div class="main">
            <div class="photo">
                <div onclick="window.location.href='/account?id=<?php echo $data['userid'] ?>'" class="user">
                    <img src="/databases/photos/<?php echo htmlspecialchars($data['userimg']) ?>" alt="<?php echo htmlspecialchars($data['username']) ?>" class="userimg" />
                    <p class="username">&nbsp;&nbsp;&nbsp;<b><span><?php echo htmlspecialchars($data['username']) ?></span></b></p>
                </div>
                <blockquote><span title="This is a Post Time" class="dateshow"><?php echo htmlspecialchars($data['mydate']) ?></span></blockquote>
                <blockquote><?php echo htmlspecialchars($data['title']) ?></blockquote>
                <img src="/databases/photos/<?php echo htmlspecialchars($data['photo']) ?>" alt="<?php echo htmlspecialchars($data['username']) ?>" class="imgdata" />
                <div class="sherarsystem">
                    <div class="aptmain"></div>
                </div>
                <div class="messege" id="chatBox">
                    <div id="app"></div>
                </div>
            </div>
            <br><br><br>
            <p id="<?php echo htmlspecialchars($data['photoid']) ?>"></p>
        </div>
        <div class="sendbox">
            <div class="sendfile">
                <div class="div1 mydiv">
                    <img src="/databases/photos/<?php echo htmlspecialchars($user['photo']) ?>" alt="" class="userimg">
                </div>
                <div class="div2 mydiv">
                    <form id="sendnet" action="" method="post" onsubmit="sendmymessege()">
                        <input class="sendin" type="text" name="message" required placeholder="Comment as <?php echo htmlspecialchars($user['username']) ?>" minlength="1" maxlength="255">
                </div>
                <div class="div3 mydiv">
                    <center>
                        <button onclick="callthewindow()" type="submit" class="sendbtn"><i class="fa-solid fa-paper-plane"></i></button>
                    </center>
                </div>
                </form>
            </div>
        </div>
    </section>
    <script src="app.js"></script>
    <script>
        async function displayData() {
            try {
                const token = "<?php echo $data['photoid']; ?>"; 
                const response = await fetch(`/comment/api.php?token=${token}`);
                const data = await response.json();
                const dataContainer = document.getElementById("app");

                dataContainer.innerHTML = ''; // Clear existing comments

                data.forEach((item) => { 
                    const itemElement = document.createElement("div");
                    itemElement.innerHTML = `
                        <div class="chatuser">
                            <div class="user">
                                <img src="/databases/photos/${item.userimg}" alt="" class="userimg">
                                <p><strong>&nbsp;&nbsp;${item.username}</strong> <br> &nbsp;&nbsp;  <small style="color:gray">${item.post}</small></p>
                            </div>
                            <div>
                                <blockquote>
                                    <span class="lx"> ${item.comment}</span>
                                </blockquote>
                            </div>
                        </div>`;
                    dataContainer.appendChild(itemElement);
                });
            } catch (error) {
                console.error("Data error:", error);
            }
        }

        displayData();

        const chatForm = document.getElementById("sendnet");
        chatForm.onsubmit = async (e) => {
            e.preventDefault();
            const formData = new FormData(chatForm);
            try {
                const response = await fetch(window.location.href, { method: "POST", body: formData });
                if (response.ok) {
                    const newComment = await response.json(); // Get the new comment data
                    // Update the UI with the new comment without reloading
                    const dataContainer = document.getElementById("app");
                    const itemElement = document.createElement("div");
                    itemElement.innerHTML = `
                        <div class="chatuser">
                            <div class="user">
                                <img src="/databases/photos/${newComment.userimg}" alt="" class="userimg">
                                <p><strong>&nbsp;&nbsp;${newComment.username}</strong> <br> &nbsp;&nbsp;  <small style="color:gray">${newComment.post}</small></p>
                            </div>
                            <div>
                                <blockquote>
                                    <span class="lx"> ${newComment.comment}</span>
                                </blockquote>
                            </div>
                        </div>`;
                    dataContainer.appendChild(itemElement);
                    chatForm.reset();
                } else {
                    console.error("Failed to add comment");
                }
            } catch (error) {
                console.error("Error:", error);
            }
        }

        var myUserData = localStorage.getItem("user");
        var userData = JSON.parse(myUserData);

        if (<?php echo $userid ?> == userData.id) {
            document.getElementById("error").style.display = "none";
        } else {
            myFunction();
            document.getElementById("error").style.display = "block"; 
            document.getElementById("hacker").innerHTML = `
                What you are doing is not correct, please enter your login ID.
                Don't do too much tricks otherwise the ID will be locked.
                <br>
                <button class='btn' onclick="myFunction()">Try it</button>
            `;
        }

        function myFunction() {
            let text = "What you are doing is not correct,\n please enter your login ID.\n Don't do too much tricks otherwise the ID will be locked!";
            
            if (confirm(text) == true) {
                const url = new URL(window.location.href);
                url.searchParams.set('userid', userData.id); 
                window.location.href = url.toString();
            } else {
                window.location.href = '/';
            }
        }

        function exaitmyapp() {
            window.history.back();
        }
       
    </script>
</body>

</html>
