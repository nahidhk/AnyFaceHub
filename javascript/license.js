

//  Edit profile photo
function editimg() {
  var form = document.getElementById("myform");
    form.submit();
}

// addd the verifay sysem

function checkverfy() {
  var email = document.getElementById("email");
  var phone = document.getElementById("phone");
  var bate = document.getElementById("bate");
  let notverifay = `<span class="notviy">Account Not Verifay</span>`;
  const verifay = localStorage.getItem("verifay");
  const loademail = localStorage.getItem("email");
  const loadphone = localStorage.getItem("phonenum");

  if (verifay == "true") {
   
    let password = localStorage.getItem("password");
  
    document.getElementById("password").innerText = password;
    email.innerHTML = loademail;
    phone.innerHTML = loadphone; 
    document.getElementById("editprofile").classList = "vcc";
    document.getElementById(
      "vicon"
    ).innerHTML = `<i class="bi bi-patch-check-fill v"></i>`;
    document.getElementById("listio").classList = "melo";
    document.getElementById("windto").style.display = "block";
    document.getElementById("normalbox").style.display = "block";
  } else {
    email.innerHTML = notverifay;
    phone.innerHTML = notverifay;
    bate.innerHTML = notverifay;
  }
}

function logout(){
  localStorage.clear();
  sessionStorage.clear();
  window.location.href="/login/"
}

function home(){
  window.location="/"
}
function myapple(){
  window.location.href='photos/?id=$id'
}

function myexfunction(){
  const trim1 = document.getElementById("trim1");
  const trim2 = document.getElementById("trim2");
  const documentwith = window.innerWidth;
  console.log(documentwith);
  
  if (documentwith > 768) {
    trim1.classList = "flex anaround";
    trim2.classList = "flex";
  } else {
    trim1.classList = " ";
    trim2.classList = " ";
  }

}
myexfunction()