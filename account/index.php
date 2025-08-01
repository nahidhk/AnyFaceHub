<?php
if ( isset( $_GET[ 'id' ] ) ) {
    $id = $_GET[ 'id' ];
} 

require_once('../php/configer.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM users WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); 
} else {
    echo "<script>window.location.href='/error/?code=101';</script>";
    exit;
}



?>
<!DOCTYPE html>
<html lang='en'>

<head>

    <link rel='stylesheet' href='/style/style.main.css'>
    <link rel='shortcut icon' href="//databases/photos//<?php echo $userimg?>" type='image/x-icon'>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title><?php echo $row["username"] ?> - Anyface</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <div class="nav animate__slideInDown animate__animated">
        <span class="navtext">AnyfaceHub</span>
        <button onclick="home()" title="Logout" class="navbtn mybtn center"><i class="fa-solid fa-house"></i></button>
        <button onclick="logout()" title="Logout" class="navbtn mybtn right"><i
                class="fa-solid fa-right-from-bracket"></i></button>

    </div>
    <section id='trim1'>
        <div id="listio" class='mainbox animate__slideInLeft animate__animated'>
            <div id='trim2'>
                <div>
                    <blockquote>
                        <div>
                            <form id="myform" action="/databases/account.php?id=<?php echo $row['id']; ?>" method="post"
                                enctype="multipart/form-data">
                                <label title='Change your Avatar' for="penin">
                                    <img class='myimgproo' src="/databases/photos/<?php echo $row['photo']; ?>">
                                </label>
                                <input id="penin" oninput="editimg()" class="vcc false" name="photo" type="file"
                                    accept="image/*">
                            </form>
                        </div>
                        <h1 class='nomargin'><span><?php echo $row["username"] ?></span>&nbsp;</h1>
                        <p class='nomargin'><span>Gander - <?php echo $row["gander"] ?></p>

                        <button class='btn wxl'>Edit profile</button>
                        <br><br>
                        <div class="margin vcc" id="email">
                            <span class='flex'>
                                <i class="fa-solid fa-envelope icon"></i>
                                &nbsp;&nbsp;
                                <?php echo $row["email"] ?>
                                &nbsp;
                                <i class="fa-solid fa-lock lowcas"></i>
                            </span>
                        </div>

                        <div class="margin vcc" id="phone">
                            <span class='flex'>
                                <i class="fa-solid fa-phone icon"></i>
                                &nbsp;&nbsp;
                                <?php echo $row["phone"] ?>
                                &nbsp;
                                <i class="fa-solid fa-lock lowcas"></i>
                            </span>
                        </div>

                        <div class="margin">
                            <span class='flex'>
                                <i class="fa-solid fa-cake-candles icon"></i>
                                &nbsp;&nbsp;
                                <?php echo $row["bath"] ?>

                            </span>
                        </div>

                        <div class="margin">
                            <span class='flex'>
                                <i class="fa-solid fa-address-card icon"></i>
                                &nbsp;&nbsp;
                                <?php echo $row["created_at"] ?> Joined
                            </span>
                        </div>

                        <div class="margin">
                            <span class='flex'>
                                <i class="fa-solid fa-passport icon"></i>
                                &nbsp;&nbsp;
                                <?php echo $row["id"] ?> - UID
                            </span>
                        </div>

                        <div class="margin">
                            <span class='flex'>
                                <i class="fa-solid fa-link icon"></i>
                                &nbsp;&nbsp;
                                <span>
                                    <script>
                                    var url = window.location.origin;
                                    var myurl = `${url}/uid/<?php echo $row["id"] ?>`;
                                    var atag = `<a href="${myurl}">${myurl}</a>`;
                                    document.write(atag);
                                    </script>
                                </span>
                            </span>
                        </div>
                </div>

                <div class='ifrm'>
                    <div class="">
                    <div id="model"></div>
                    <div class="photo">
                        <div onclick="accountprofile()" class="user">
                            <img id="userimgtop" class="userimg">
                            <p class="username">&nbsp;&nbsp;&nbsp;<b><span id="showthemyname"></span></b></p>
                        </div>
                        <center>
                            <div class="aptmain">
                                <a class="a" href="/upload/photo/"><i class="fa-regular fa-image"></i></a>
                                <a class="a" href="/upload/video/"><i class="fa-solid fa-video"></i></a>
                            </div>
                        </center>
                    </div>
                    <div id="app"></div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <script src='/javascript/license.js'></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>

    <script>
    var data = localStorage.getItem("user");
    var userData = JSON.parse(data);

    function checkdata() {
        var data1 = sessionStorage.getItem("user");
        var cData = JSON.parse(data1);
        const email = document.getElementById("email");
        const phone = document.getElementById("phone");
        const password = document.getElementById("password");
        const penin = document.getElementById("penin");
        if (userData.id == '<?php echo $row["id"] ?>') {
            email.style.display = "block";
            phone.style.display = "block";
            password.style.display = "block";
            penin.style.display = "block";
        } else {
            email.style.display = "none";
            phone.style.display = "none";
            password.style.display = "none";
            penin.style.display = "none";
        }
    }
    checkdata();
    </script>
    <?php
if ( isset( $_GET[ 'id' ] ) ) {
    $id = $_GET[ 'id' ];
} 
require_once('../php/configer.php');
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM photos WHERE userid = $id";
$result = $conn->query($sql);
$photos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $photos[] = $row; 
    }  
}
?>
    <script>
    const photos = <?php echo json_encode($photos); ?>;

    function displayData() {
        var data = localStorage.getItem("user");
        var userData = JSON.parse(data);
        const myimg = document.getElementById("userimgtop");
        const myname = document.getElementById("showthemyname");
        myname.innerHTML = userData.username;
        myimg.src = `/databases/photos/${userData.photo}`;
        if (userData.id == "<?php echo $id ?>") {
            var dis = "flex";
        } else {
            var dis = "none";
        }
        const dataContainer = document.getElementById("app");
        if (!dataContainer) {
            console.error("Element with id 'app' not found.");
            return;
        }
        dataContainer.innerHTML = "";
        photos.forEach((item) => {
            const itemElement = document.createElement("div");
            itemElement.innerHTML = `
                    <div class="photo" id="${item.userimg}">
                        <div onclick="window.location.href='/account?id=${item.userid}'" class="user">
                            <img src="/databases/photos/${item.userimg}" alt="${item.username}" class="userimg">
                            <p class="username">&nbsp;&nbsp;&nbsp;<b><span>${item.username}</span></b>  ${item.verifay}</p>
                        </div>
                        <blockquote>
                            <span title="This is a Post Time" class="dateshow">${item.mydate}</span>
                        </blockquote>
                        <blockquote>
                            ${item.title}
                        </blockquote>
                        
                        <img  src="/databases/photos/${item.photo}" alt="${item.username}" class="imgdata">
         <div style="display: ${dis};" class="aptmain"> 
            <a class="a" href="/comment/?id=${item.id}&userid=<?php echo $id ?>#${item.photoid}"><i class="fa-solid fa-comments"></i></a>
            <a class="rr"onclick="myfun()" href="/account/photos/drop/?id=${item.id}" ><i class="fa-solid fa-trash-can"></i></a>
          </div>
                      
                    </div>
                `;

            dataContainer.appendChild(itemElement);
        });
    }

    displayData();

    function myfun() {
        document.getElementById("model").innerHTML =
            `<p class="animate__animated animate__bounceIn" style='background-color: green;color: #fff;padding: 13px;width: 300px;position: fixed; top: 10px;box-shadow: 0 0 20px 0 green; font-size: 15pt; border-radius: 5px;right: 20px;z-index:300;'>Deleted Successfully!</p>`;
        setTimeout(stim, 1000);
        window.location.reload();
    }
    </script>


</body>

</html>
<?php 

?>