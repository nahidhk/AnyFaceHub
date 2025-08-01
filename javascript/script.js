
async function displayData(searchInput = "") {
 
  try {
    const response = await fetch("/server/json/photos");
    const data = await response.json();
    const dataContainer = document.getElementById("app");
    if (!dataContainer) {
      throw new Error("Element with id 'app' not found.");
    }

    dataContainer.innerHTML = "";

    let previousData = JSON.parse(localStorage.getItem("previousData")) || [];

    const newEntries = data.filter(
      (item) =>
        !previousData.some((prevItem) => prevItem.username === item.username)
    );

    localStorage.setItem("previousData", JSON.stringify(data));

    const filteredData = data.filter(
      (item) =>
        item.username.toLowerCase().includes(searchInput.toLowerCase()) ||
        item.title.toLowerCase().includes(searchInput.toLowerCase())
    );

    newEntries.forEach((item) => {
      showNotification(item.username);
    });
    var myusrdata = localStorage.getItem("user");
    var thsiidData = JSON.parse(myusrdata);
  
    filteredData.forEach((item) => {
      
      const itemElement = document.createElement("div");
      itemElement.innerHTML = `
                <div class="photo" id="${item.username}">
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
                    
                    <img onload="loadmyphoto(this)" onerror="loadError(this)" src="/databases/photos/${item.photo}" alt="${item.username}" class="imgdata">
                    <img src="/img/load.gif" class="loadimg"  />
                    <div class="sherarsystem">              
                        <div class="aptmain">
                            <a href="/comment/?id=${item.id}&userid=${thsiidData.id}#${item.photoid}" class="shearicon"><i class="fa-regular fa-heart"></i></a>
                            <a href="/comment/?id=${item.id}&userid=${thsiidData.id}#${item.photoid}" class="shearicon"><i class="fa-solid fa-comments"></i></a>
                            <a href="/share/?id=${item.id}&uss=${thsiidData.username}#${item.photoid}" class="shearicon"><i class="fa-regular fa-share-from-square"></i></a>
                        </div>
                        </div>
                </div>
            `;

      dataContainer.appendChild(itemElement);
    });
  } catch (error) {
    console.error("data error", error);
  }
}

function loadmyphoto(imgElement) {
  const loadingImage = imgElement.nextElementSibling;
  if (loadingImage && loadingImage.classList.contains("loadimg")) {
    loadingImage.style.display = "none";
  }
}

function loadError(imgElement) {
  const loadingImage = imgElement.nextElementSibling;
  if (loadingImage && loadingImage.classList.contains("loadimg")) {
    loadingImage.style.display = "none";
    imgElement.style.display = "none";
  }
}

function searchData() {
  const searchInput1 = document.querySelector("#search1").value;
  const searchInput2 = document.querySelector("#search2").value;
  displayData(searchInput1 + searchInput2);
  window.location.href ="#" + searchInput1 + searchInput2;
}

function requestNotification() {
  if (Notification.permission === "granted") {
    showNotification();
  } else if (Notification.permission !== "denied") {
    Notification.requestPermission().then((permission) => {
      if (permission === "granted") {
        showNotification();
      }
    });
  }
}

function showNotification(username) {
  const notification = new Notification("AnyFace", {
    body: `(${username}) Upload A New Photo!`,
    icon: "/img/icon.png",
  });

  notification.onclick = function () {
    window.open("https://anyface.vercel.app/");
  };
}

displayData();

function opencopycodebox() {
  document.getElementById("codecopybox").classList = "codecopybox";
}


function upimg() {
  const photo = document.getElementById("photo").files[0];

  if (photo) {
    var reader = new FileReader();
    reader.onload = function (e) {
      document.getElementById("showprofile").style.display = "block";
      document.getElementById("showprofile").src = e.target.result;
    };
    reader.readAsDataURL(photo);
    const filePath = photo.name;
    localStorage.setItem("userimg", filePath);
  } else {
    alert("Please select an image.");
  }
}

function uploadphoto() {
  window.location.href = "/upload/photo/";
}
function openthephotobox() {
  document.getElementById("app").style.display = "block";
  document.getElementById("videoapp").style.display = "none";
  document.getElementById("photobtn").classList = "systembtn active";
  document.getElementById("videobtn").classList = "systembtn noactive";
  document.getElementById("photoicon1").classList = "fa-regular fa-images fa-fade iconmain";
  document.getElementById("photoicon2").classList = "fa-regular fa-images fa-fade iconmain";
  document.getElementById("videoicon1").classList = "fa-solid fa-video iconmain";
  document.getElementById("videoicon2").classList = "fa-solid fa-video iconmain";
  localStorage.setItem("butttontype", "photo");
}
function linkclick(){
  window.location="/"
}
function openthevideobox() {
  document.getElementById("app").style.display = "none";
  document.getElementById("videoapp").style.display = "block";
  document.getElementById("photobtn").classList = "systembtn noactive";
  document.getElementById("videobtn").classList = "systembtn active";
  document.getElementById("videoicon1").classList = "fa-solid fa-video fa-fade iconmain";
  document.getElementById("videoicon2").classList = "fa-solid fa-video fa-fade iconmain";
  document.getElementById("photoicon1").classList = "fa-regular fa-images iconmain";
  document.getElementById("photoicon2").classList = "fa-regular fa-images iconmain";
  localStorage.setItem("butttontype", "video");

}
function autobuttonset() {
  const autobtn = localStorage.getItem("butttontype");
  if (autobtn == "video") {
    openthevideobox();
  }
  if (autobtn == "photo") {
    openthephotobox();
  }
}
autobuttonset();
function accessbtn() {
  alert("You Have Allow The Server Access");
  window.location.href = "https://github.com/nahidhk/anyphoto";
}

function systemserch() {
  document.getElementById("search2").classList =
    "search animate__bounceIn animate__animated ";
}

function closepopup() {
  var menuappshowdiv = document.getElementById("myappjstoopenuserlist");
  menuappshowdiv.classList = "animate__backOutUp animate__animated vcc";
}
function closetop() {
  document.getElementById("codecopybox").classList = "vcc";
}
function copycode() {
  setTimeout(closetop, 500);
  var copyText = document.getElementById("mycode");
  if (!copyText) {
    alert("Element not found.");
    return;
  }
  if (copyText.tagName === "INPUT" || copyText.tagName === "TEXTAREA") {
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard
      .writeText(copyText.value)
      .then(function () {
        document.getElementById("copybtn").innerHTML =
          '<i class="bi bi-clipboard-check" style="font-size: large;"></i>';
      })
      .catch(function (err) {
        alert("Failed to copy code: " + err);
      });
  } else {
    alert("This code is not copy");
  }
}

//  add the The Live Server
function loadCSSJS() {
  var cssFile = document.createElement("link");
  cssFile.rel = "stylesheet";
  cssFile.href = "/style/style.main.css?v=" + new Date().getTime(); 
  document.head.appendChild(cssFile);

  var jsFile = document.createElement("script");
  jsFile.src = "/javascript/script.js?v=" + new Date().getTime(); 
  document.body.appendChild(jsFile);
}

// loadCSSJS();
function accountprofile() {
  var data = localStorage.getItem("user");
var userData = JSON.parse(data);
  window.location.href = `account/?id=${userData.id}`;
}
function verifay() {
  window.location.href = "account/verifay";
}

const date = new Date();
const day = String(date.getDate()).padStart(2, '0');
const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "June", 
                    "July", "Augu", "Sep", "Oct", "Nov", "Dec"];
const month = monthNames[date.getMonth()];
const year = date.getFullYear();


let hours = date.getHours();
const minutes = String(date.getMinutes()).padStart(2, '0');
const seconds = String(date.getSeconds()).padStart(2, '0');
const ampm = hours >= 12 ? 'PM' : 'AM';

hours = hours % 12;  
hours = hours ? hours : 12;  

const todaymydate = `${day} ${month} ${year} - ${hours}:${minutes}:${seconds} ${ampm}`;

function loginchick(){
  const userlogin = localStorage.getItem("usertype");
  if (userlogin == "true") {
  
  }else{
    window.location.href="/login"
  }
}
loginchick()

function showtopuserthevideo(){
  var data = localStorage.getItem("user");
var userData = JSON.parse(data);
const myimg = document.getElementById("userimgtop");
const myname = document.getElementById("showthemyname");
myname.innerHTML=userData.username;
myimg.src=`/databases/photos/${userData.photo}`;

}
showtopuserthevideo();




function runthemenu(){
  const code = `
          <button onclick="accountprofile()" class="systembtn accbtn">
            <i class="bi bi-person-circle"></i> &nbsp; 
             Account
          </button>
          <!-- Documents Btn -->
          <button onclick="documentopen()" class="systembtn accbtn">
            <i class="fa-solid fa-circle-question"></i>
              &nbsp; Documents 
          </button>  
  `
 document.getElementById("menushow1").innerHTML=code;
 document.getElementById("menushow2").innerHTML=code;
 
}
runthemenu();
function documentopen(){
  window.location.href="/docs/"
}

