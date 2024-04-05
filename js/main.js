window.addEventListener('load', init);

function init() {
    loadAllDishes()
    loadAllDrinks()
    loadAllDesserts()
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
    fetchData('getBestelling')
        .then(data => {
            displayBestelling(data);
        }).catch(error => console.error(error))
}

function displayDishes(loadData) {
    const content = document.getElementById('content');
    for (const dishes of loadData) {
        const card = document.createElement('div');
        card.classList.add('card');

        const image = document.createElement('img');
        image.src = `images/${dishes.image}`;
        card.appendChild(image);

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
    const drinksContainer = document.getElementById('drinks-container');
    for (const drinks of loadData) {
        const card = document.createElement('div');
        card.classList.add('card');

        const image = document.createElement('img');
        image.src = `images/${drinks.image}`;
        image.alt = drinks.name;
        card.appendChild(image);

        const title = document.createElement('h2');
        title.textContent = drinks.name;
        card.appendChild(title);

        drinksContainer.appendChild(card);
    }
}

function displayDesserts(loadData) {
    const dessertsContainer = document.getElementById('desserts-container');
    for (const desserts of loadData) {
        const card = document.createElement('div');
        card.classList.add('card');

        const image = document.createElement('img');
        image.src = `images/${desserts.image}`;
        image.alt = desserts.name;
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

function displayBestelling(loadData){
    for (const item of loadData) {
        console.log(loadData)
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

