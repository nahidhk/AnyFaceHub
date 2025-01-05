const url = window.location.href; 
const match = url.match(/\/uid\/(\d+)/);
if (match) {
    const uid = match[1];
    console.log("UID:", uid); 
} else {
    console.log("UID not found in the URL.");
}

