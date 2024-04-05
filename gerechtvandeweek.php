<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toto Bestelservice</title>
    <script src="https://kit.fontawesome.com/7acb2867d6.js" crossorigin="anonymous"></script>
    <script src="https://codepen.io/shshaw/pen/QmZYMG.js"></script>
    <link rel="stylesheet" href="css/gerechtVanDeWeek.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-nrjV3czq/KEKnlvq0Uzdb5yho21XL8MCM7AaVv0bwM0x/Uq8Ma6R3esPU6rP++QlAAZTD6TsF1oL9q28BZ/z9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        window.addEventListener('load', init);

        function init() {
            loadDishOfTheWeek();
        }

        function loadDishOfTheWeek(){
            const image= document.createElement('img');
            const dishOfTheWeekContainer = document.getElementById('dishOfTheWeekContainer');
            image.src =
                image.alt = 'dishOfTheWeekImage';
            dishOfTheWeekContainer.appendChild(image);

            const moreInfoButton = document.createElement('button');
            dishOfTheWeekContainer.appendChild(moreInfoButton);
            moreInfoButton.textContent = 'Klik voor meer informatie';
            moreInfoButton.addEventListener();
        }
    </script>
    <link
            rel="icon"
            href="https://image.cdn2.seaart.ai/static/80e888e0e8706954e2b97ebc980a172e/20230214/e5050630503855069f1da2bc03365233_high.webp"
    />
</head>

<header>
    <h1>Gerecht van de Week:</h1>
</header>
<body>
<div id="dishOfTheWeekContainer"></div>
<div id="searchBarContainer">
    <form action="/zoek" method="GET">
        <input type="text" name="query" placeholder="Voer uw zoekterm in">
        <button type="submit">Zoeken</button>
    </form> </div>
<nav class="btn-group">
    <button><i class="fas fa-utensils"></i> Eten</button>
    <button><i class="fas fa-cocktail"></i> Drinken</button>
    <button><i class="fas fa-birthday-cake"></i> Dessert</button>
    <button><i class="fas fa-shopping-cart"></i> Bestelling</button>
</nav>
</body>
</html>