async function videoshow() {
  try {
    const response1 = await fetch("");
    const data1 = await response1.json();
    const dataContainer1 = document.getElementById("videoapp");

    if (!dataContainer1) {
      throw new Error("Element with id 'videoapp' not found.");
    }

    data1.forEach((item) => {
      const itemElement1 = document.createElement("div");
      itemElement1.innerHTML = `
         <div class="photo">
                    <div class="user">
                        <img src="//databases/photos//${item.userimg}" alt="${item.username}" class="userimg">
                        <p style="font-size: large;">&nbsp;&nbsp;&nbsp;<b><span>${item.username}</span></b></p>
                    </div>
                    <blockquote>
                       ${item.title}
                    </blockquote>
                  <video class="imgdata" controls>
                    <source src="php/video/${item.video}">
                  </video>
                </div>
            `;

      dataContainer1.appendChild(itemElement1);
    });
  } catch (error) {
    console.error("data error", error);
  }
}
// videoshow();

//  video contol room
function ckvideo() {
  const ckvideo = localStorage.getItem("ckvideo");
  if (ckvideo == "true") {
    document.getElementById("cverifay").style.display="none";
  } else {
    function checkavideoverifay() {
      const chtext = document.getElementById("chtext");
      const verifaycheck = localStorage.getItem("verifay");
      function ifcheck() {
        if (verifaycheck == "true") {
          document.getElementById('fonticon').innerHTML=`<i class="fa-regular fa-circle-check fa-beat-fade proicon v "></i>`
          localStorage.setItem("ckvideo", true);
          chtext.innerHTML = "<h1>You Allowed the Video upload opstion !</h1>";
          function testok() {
          window.location="/upload/video/"
          }
          setTimeout(testok, 3000);
        } else {
         document.getElementById('fonticon').innerHTML=`<i class="fa-regular fa-circle-xmark fa-shake proicon vr"></i>`;
          chtext.innerHTML = "<h1>You Not Verifayed !</h1>";
        }
      }
      setTimeout(ifcheck, 5000);
      
    }
    checkavideoverifay();
  }
  
}



