window.addEventListener('load', init);

const apiUrl = 'actions.php';


function init() {

}

function fetchData(action, id = null) {
    let url = `./includes/get_data.php?action=${action}`;
    if (id !== null) {
        url += '&id=' + id;
    }
    return fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .catch(error => console.error('Error fetching data:', error));
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

