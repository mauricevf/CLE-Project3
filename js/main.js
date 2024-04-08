window.addEventListener('load', init);

function init() {
    let gerechten = [];
    gerechten = localStorage.getItem('gerechten')
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

function loadAllDishes() {
    fetchData('getDishes')
        .then(data => {
            displayDishes(data);
        }).catch(error => console.error(error))
}

function loadAllDrinks() {
    fetchData('getDrinks')
        .then(data => {
            displayDrinks(data);
        }).catch(error => console.error(error))
}

function loadAllDesserts() {
    fetchData('getDesserts')
        .then(data => {
            displayDesserts(data);
        }).catch(error => console.error(error))
}

function loadBestelling() {
        const selectedIDs = JSON.parse(localStorage.getItem('gerechten'));
        if (selectedIDs) {
            fetchData('getBestelling')
                .then(data => {
                    displayBestelling(data, selectedIDs);
                }).catch(error => console.error(error));
        } else {
            console.log("No selected IDs found in localStorage.");
        }
}

function displayDishes(loadData) {
    const content = document.getElementById('content');
    for (const dishes of loadData) {
        const card = document.createElement('div');
        card.classList.add('card');

        const image = document.createElement('img');
        image.src = `images/${dishes.image}`;
        card.appendChild(image);
        image.addEventListener('click', addToStorage)
        image.dataset.Gerechtid = dishes.id;

        const title = document.createElement('h3');
        title.textContent = dishes.name;
        card.appendChild(title);

        const allergies = document.createElement('p');
        allergies.textContent = `Allergies: ${dishes.allergies}`;
        card.appendChild(allergies);

        content.appendChild(card);
    }
}

function displayDrinks(loadData) {
    const drinksContainer = document.getElementById('content');
    for (const drinks of loadData) {
        const card = document.createElement('div');
        card.classList.add('card');

        const image = document.createElement('img');
        image.src = `images/${drinks.image}`;
        image.alt = drinks.name;
        image.addEventListener('click', addToStorage)
        image.dataset.Gerechtid = drinks.id;
        card.appendChild(image);


        const title = document.createElement('h2');
        title.textContent = drinks.name;
        card.appendChild(title);

        drinksContainer.appendChild(card);
    }
}

function displayDesserts(loadData) {
    const dessertsContainer = document.getElementById('content');
    for (const desserts of loadData) {
        const card = document.createElement('div');
        card.classList.add('card');


        const image = document.createElement('img');
        image.src = `images/${desserts.image}`;
        image.alt = desserts.name;
        image.addEventListener('click', addToStorage)
        image.dataset.Gerechtid = desserts.id;
        card.appendChild(image);

        const title = document.createElement('h2');
        title.textContent = desserts.name;
        card.appendChild(title);

        const allergies = document.createElement('p');
        allergies.textContent = `Allergies: ${desserts.allergies}`;
        card.appendChild(allergies);

        dessertsContainer.appendChild(card);
    }
}

function displayBestelling(loadData, myID) {
    const bestellingContainer = document.getElementById('content');
    console.log(myID)
    for (const item of loadData) {
        if (myID.includes(item.id.toString())) {
            const card = document.createElement('div');
            card.classList.add('card');

            const image = document.createElement('img');
            image.src = `images/${item.image}`;
            card.appendChild(image);
            image.dataset.Gerechtid = item.id;

            const title = document.createElement('h3');
            title.textContent = item.name;
            card.appendChild(title);

            const allergies = document.createElement('p');
            allergies.textContent = `Allergies: ${item.allergies}`;
            card.appendChild(allergies);

            bestellingContainer.appendChild(card);
        }
    }
}

function loadDessertDetails(id) {
    return fetchData('getDessertDetails', id)
        .then(data => {
            console.log(`Details loaded for ${id}`)
            return data;
        })
}

function loadDishDetails(id) {
    return fetchData('getDishDetails', id)
        .then(data => {
            console.log(`Details loaded for ${id}`)
            return data;
        })
}

function loadDrinkDetails(id) {
    return fetchData('getDrinkDetails', id)
        .then(data => {
            console.log(`Details loaded for ${id}`)
            return data;
        })
}

function scrollToElement(id) {
    const element = document.getElementById(id);
    element.scrollIntoView({behavior: 'smooth'});
}

// menu

//Localstorage addon

function addToStorage(e) {
    let clickedItem = e.target;
    console.log('Clicked Item:', clickedItem);
    let gerechten = JSON.parse(localStorage.getItem('gerechten')) || [];
    console.log('Parsed localStorage:', gerechten);
    gerechten.push(clickedItem.dataset.Gerechtid);
    console.log('Updated gerechten:', gerechten);
    localStorage.setItem('gerechten', JSON.stringify(gerechten));
    console.log('Stored in localStorage');
}


document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('btn-food').addEventListener('click', showFood);
    document.getElementById('btn-drink').addEventListener('click', showDrink);
    document.getElementById('btn-dessert').addEventListener('click', showDessert);
    document.getElementById('btn-bestelling').addEventListener('click', showBestelling);

    function showFood() {
        hideAll();
        loadAllDishes();
    }

    function showDrink() {
        hideAll();
        loadAllDrinks();
    }

    function showDessert() {
        hideAll();
        loadAllDesserts()
    }
    function showBestelling() {
        hideAll();
        loadBestelling()
    }

    function hideAll() {
        const content = document.getElementById('content')
        content.innerHTML = '';
    }
});