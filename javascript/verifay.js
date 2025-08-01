function verifaydata() {
    //  varebale
    var profilename = document.getElementById("profilename").value;
    var profileimg = document.getElementById("profileimg").value;
    var useremail = document.getElementById("profileemail").value;
    var userphone = document.getElementById("profilephone").value;
    var password = document.getElementById("password").value;
    // set the local stroge data
    // এই কোড পরিবর্তন করা যাবে না 
    if (profileimg && profilename && useremail && userphone && password) {
        localStorage.setItem("verifay", true);
        localStorage.setItem("email", useremail);
        localStorage.setItem("phonenum", userphone);
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
        document.getElementById("checkontheviy").style.display="block";

    }else{
    }
}
verfiyalradycheck();


