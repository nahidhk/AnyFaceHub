function getCookie(name) {
    let cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i].trim();
        if (cookie.indexOf(name + "=") == 0) {
            return cookie.substring(name.length + 1);
        }
    }
    return "";
}



function darkside() {
    document.getElementById("darkside").style.display = "none";
}
let os = "web";
let icon = '<i class="fa-solid fa-desktop"></i>';
if (navigator.userAgent.indexOf("Android") !== -1) {
    os = 'Android';
    icon = '<i class="fa-brands fa-google-play"></i>';
} else if (navigator.userAgent.indexOf("Windows") !== -1) {
    os = 'Windows';
    icon = '<i class="fa-brands fa-windows"></i>';
} else if (navigator.userAgent.indexOf("Mac") !== -1) {
    os = 'macOS';
    icon = '<i class="fa-brands fa-apple"></i>';
} else if (navigator.userAgent.indexOf("Linux") !== -1) {
    os = 'Linux';
    icon = '<i class="fa-brands fa-linux"></i>';
} else if (navigator.userAgent.indexOf("iPhone") !== -1 || navigator.userAgent.indexOf("iPad") !== -1) {
    os = 'iOS';
    icon = '<i class="fa-brands fa-apple"></i>';
}
if (getCookie("install") == "true") {

} else {
    document.getElementById("rooting").innerHTML = `
        <section id="darkside" class="darkside">
            <div class="popup">
                <button onclick="darkside()" class="rr"><i class="fa-solid fa-xmark"></i></button>
                <center>
                    <h3>Download PAW</h3>
                    <hr>
                   <span style="font-size:5rem;">${icon}</span> <br> <span style="font-size:15pt;">Install the app on your ${os} device to launch it easily. <span>
                    <button class="systembtn v" id="installBtn">Install ${os} App</button>
                </center>
            </div>
        </section>`;
}
let deferredPrompt;
window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    document.getElementById('installBtn').style.display = 'block';
    document.getElementById('installBtn').addEventListener('click', () => {
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
                function setCookie(name, value, days) {
                    let date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    let expires = "expires=" + date.toUTCString();
                    document.cookie = name + "=" + value + "; " + expires + "; path=/";
                }
                setCookie('install', 'true', 365);
                window.location.href = "/"
            } else {
                console.log('User dismissed the install prompt');
                setCookie("install", flase);
            }
            deferredPrompt = null;
        });
    });
});


