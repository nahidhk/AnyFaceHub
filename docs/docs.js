console.log("Hello Word!")
function loadmyapp(){
fetch('docs.json')
    .then(response => response.json())
    .then(data => {
        const headerLinksContainer = document.getElementById('headerLinks');
        const mainContentContainer = document.getElementById('mainContent');
        data[0].hadersLink.forEach(link => {
            const content = data[0].main[link]; 
            const listItem = document.createElement('li');
            listItem.innerHTML = `<a href="#${link}">${content.value}</a>`;
            headerLinksContainer.appendChild(listItem);
            mainContentContainer.innerHTML += `<p id='${link}'><br><br><br><h2 >${content.title}</h2>${content.htmlcode}`;
        });
    })
    .catch(error => console.error("Error fetching data:", error));
}
function gobackio(){
    window.history.back();
}


