
function loginchick(){
    const verifay = localStorage.getItem("verifay");
    if (verifay == "true") {
     window.location.href="/";
    } else {
      window.location.href="/login";
    }
  }
console.log("javascript check");



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




$(document).ready(function () {
    $("#username").on("blur", function () {
        var username = $(this).val();
        $.ajax({
            url: 'data.php', // Same file
            type: 'POST',
            data: { check_username: true, username: username },
            success: function (response) {
                $("#username-check").html(response);
            }
        });
    });

    $("#email").on("blur", function () {
        var email = $(this).val();
        $.ajax({
            url: 'data.php', // Same file
            type: 'POST',
            data: { check_email: true, email: email },
            success: function (response) {
                $("#email-check").html(response);
            }
        });
    });

    $("#phone").on("blur", function () {
        var phone = $(this).val();
        $.ajax({
            url: 'data.php', // Same file
            type: 'POST',
            data: { check_phone: true, phone: phone },
            success: function (response) {
                $("#phone-check").html(response);
            }
        });
    });
});