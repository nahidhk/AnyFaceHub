
function singupmod() {
    const newpass = document.getElementById('newpass').value;
    const conpass = document.getElementById('conpass').value;
    if (newpass == conpass) {
        blockbtn();
        document.getElementById('newpass').style.border = "2px solid green";
        document.getElementById('conpass').style.border = "2px solid green";
        document.getElementById('passck').style.display = "none";
    } else {
        nonebtn();
        document.getElementById('newpass').style.border = "2px solid red";
        document.getElementById('conpass').style.border = "2px solid red";
        document.getElementById('passck').innerHTML = "Password Don't match";
    }
}

function blockbtn() {
    document.getElementById("singbtn").style.display = "block";
}

function nonebtn() {
    document.getElementById("singbtn").style.display = "none";
}


function showpass() {
    const newpass = document.getElementById('pass');
    if (newpass.type == "password") {
        newpass.type = "text";
    } else {
        newpass.type = "password";
    }
}

function exetio() {
    document.getElementById("darkside").style.display = "none";
}
function helllo() {
    document.getElementById("one").style.display = "none";
    document.getElementById("tow").style.display = "block";
}
function hello() {
    var form = document.getElementById("tow");
    document.getElementById("one").style.display = "none";
    form.style.display = "none";
    document.getElementById("three").style.display = "block";
    const myid = sessionStorage.getItem("restuserid");
    form.action = `/login/setpass.php?id=${myid}`;
    form.submit()
}
function three(){
    window.location.href="/";
}
function fore(){
document.getElementById("darkside").style.display="block";
}
