let userData = [];
fetch("/signup/modelapi.php")
  .then((response) => response.json())
  .then((data) => {
    userData = data;
    document.getElementById("email").disabled = false;
    document.getElementById("phone").disabled = false;
    document.getElementById("username").disabled = false;
  })
  .catch((error) => {
    console.error("Error fetching data:", error);
  });

function emailck() {
  if (userData.length === 0) {
    console.log("Data not yet loaded");
    return;
  }
  const myemail = document.getElementById("email").value;
  const userExists = userData.some((user) => user.email === myemail);

  if (userExists) {
    document.getElementById(
      "email-check"
    ).innerHTML = `<span style='color:red'><i class="fa-regular fa-circle-xmark fa-shake"></i> This Email is already taken.</span>`;
    nonebtn();
  } else {
    document.getElementById(
      "email-check"
    ).innerHTML = `<span style='color:green'><i class="fa-regular fa-circle-check fa-beat"></i> This Email is available.</span>`;
    blockbtn();
  }
}

function phoneck() {
  if (userData.length === 0) {
    console.log("Data not yet loaded");
    return;
  }
  const myphone = document.getElementById("phone").value;
  const userExists = userData.some((user) => user.phone === myphone);

  if (userExists) {
    document.getElementById(
      "phone-check"
    ).innerHTML = `<span style='color:red'><i class="fa-regular fa-circle-xmark fa-shake"></i> This Phone is already taken.</span>`;
    nonebtn();
  } else {
    document.getElementById(
      "phone-check"
    ).innerHTML = `<span style='color:green'><i class="fa-regular fa-circle-check fa-beat"></i> This Phone is available.</span>`;
    blockbtn();
  }
}

function usernameck() {
  if (userData.length === 0) {
    console.log("Data not yet loaded");
    return;
  }
  const myusername = document.getElementById("username").value;
  const userExists = userData.some((user) => user.username === myusername);

  if (userExists) {
    document.getElementById(
      "username-check"
    ).innerHTML = `<span style='color:red'><i class="fa-regular fa-circle-xmark fa-shake"></i> This Username is already taken.</span>`;
    nonebtn();
  } else {
    document.getElementById(
      "username-check"
    ).innerHTML = `<span style='color:green'><i class="fa-regular fa-circle-check fa-beat"></i> This Username is available.</span>`;
    blockbtn();
  }
}

function blockbtn() {
  document.getElementById("singbtn").style.display = "block";
}

function nonebtn() {
  document.getElementById("singbtn").style.display = "none";
}
