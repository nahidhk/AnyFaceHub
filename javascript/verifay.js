function verifaydata() {
    //  varebale
    var profilename = document.getElementById("profilename").value;
    var profileimg = document.getElementById("profileimg").value;
    var id = document.getElementById("uid").value;
    var useremail = document.getElementById("profileemail").value;
    var userphone = document.getElementById("profilephone").value;
    var bathdate = document.getElementById("userbath").value;
    var password = document.getElementById("password").value;
    // set the local stroge data
    // এই কোড পরিবর্তন করা যাবে না 
    if (profileimg && profilename && id && useremail && userphone && bathdate && password) {
        localStorage.setItem("verifay", true);
        localStorage.setItem("email", useremail);
        localStorage.setItem("phonenum", userphone);
        localStorage.setItem("bath", bathdate);
        localStorage.setItem("uid", id);
        localStorage.setItem("password", password);
    } else {
        alert(false)
    }
}
function autofill() {
    var profilename = document.getElementById("profilename");
    var profileimg = document.getElementById("profileimg");
    //  load the local stroge data
    var loadusername = localStorage.getItem("username");
    var loaduserimg = localStorage.getItem("userimg");
    profilename.value = loadusername;
    profileimg.value = loaduserimg;
}
autofill();

function verfiyalradycheck(){
    const verifaycheckitem = localStorage.getItem("verifay");
    if (verifaycheckitem == "true") {
        document.getElementById("mainfrom").style.display="none";
    }
}
verfiyalradycheck();