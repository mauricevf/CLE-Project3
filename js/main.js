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

function displayDishes(loadData) {
    const content = document.getElementById('content')
    for (const item of loadData) {
        console.log(item.name)
// Maak hier door middel van dom manipulatie en een for of loop een card aan voor alle dishes
        const card = document.createElement('div');
        card.classList.add('card');

        // images element, afbeeldingen toevoegen

        const image = document.createElement('img');
        image.src = `images/${item.image}`;
        image.alt = item.name;
        card.appendChild(image);

        // title element toevoegen
        const title = document.createElement('h2');
        title.textContent = item.name;
        card.appendChild(title);

        // allergen toevoegen
        const allergies = document.createElement('p');
        allergies.textContent = `Allergies: ${item.allergies}`;
        card.appendChild(allergies);

        // Append the card to the content container
        content.appendChild(card);

// Maak hier door middel van dom manipulatie en een for of loop een card aan voor alle dishes
    }
}

function displayDrinks(loadData) {
    for (const item of loadData) {
        console.log(item.name)
    }
// Maak hier door middel van dom manipulatie en een for of loop een card aan voor alle drinks
}

function displayDesserts(loadData) {
    for (const item of loadData) {
        console.log(item.name)
    }
// Maak hier door middel van dom manipulatie en een for of loop een card aan voor alle drinks
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

