window.addEventListener('load', init);

const apiUrl = 'actions.php';


function init() {

}

function fetchAPI(myUrl) {
    fetch(myUrl)
        .then(response => response.data())
        .then((data => {
            return data;
        }))
}

function loadAllData(myData) {
    for (const item of myData) {
        let myColumn = document.getElementById('content')
        let myCard = document.createElement('div')
        let myTitle = document.createElement('h1')
        myTitle.textContent = item.name;
        myColumn.appendChild(myCard)
        myCard.appendChild(myTitle)
    }

}

