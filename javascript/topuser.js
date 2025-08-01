async function topuser() {
    try {
        const response = await fetch("/server/json/photos");
        const topuser = await response.json();
        const dataContainerontopuser = document.querySelectorAll('.topuser, .topuser2');

        if (dataContainerontopuser.length === 0) {
            throw new Error("Elements with classes 'topuser' or 'topuser2' not found.");
        }

        let shownUsers = [];

        topuser.forEach(item => {
            // Check if this user ID is already shown
            if (!shownUsers.includes(item.userid)) {
                shownUsers.push(item.userid);  // Add the user ID to shownUsers

                const itemElementtopuser = document.createElement('div');
                itemElementtopuser.innerHTML = `
                <div onclick="window.location.href='/account?id=${item.userid}'" class="user" onclick="apicall()">
                    <img src="/databases/photos/${item.userimg}" alt="${item.username}" class="userimg">
                    <p class="username">&nbsp;&nbsp;&nbsp;<b><span>${item.username}</span></b> ${item.verifay}</p>
                </div>  
                `;

                dataContainerontopuser.forEach(container => {
                    container.appendChild(itemElementtopuser.cloneNode(true));
                });
            }
        });
    } catch (error) {
        console.error('data error', error);
    }
}

topuser();

function userlistopensystemtop() {
    var menuappshowdiv = document.getElementById("myappjstoopenuserlist");
    menuappshowdiv.classList = "mbtopuser animate__jackInTheBox animate__animated";
}
function colesthemenulist() {
    var menuappshowdiv = document.getElementById("myappjstoopenuserlist");
    menuappshowdiv.classList = "animate__backOutUp animate__animated vcc";
}

function apicall() {
    alert("Please search this name. And see all photos and videos of this profile.")
}



