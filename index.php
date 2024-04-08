<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Bestelling</title>
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/7acb2867d6.js" crossorigin="anonymous"></script>
    <link
            rel="icon"
            href="https://image.cdn2.seaart.ai/static/80e888e0e8706954e2b97ebc980a172e/20230214/e5050630503855069f1da2bc03365233_high.webp"
    />
</head>
<body>
<img src="images/Header Grand Cafe diner_1600x700.jpg" alt="table">
<button id="start-button">Start Bestelling</button>
<p id="error"></p>

<script>
    document.getElementById('start-button').addEventListener('click', function () {
        fetch('includes/newBestelling.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Alle tafels zijn bezet');
                }
                return response.json();
            })
            .then(data => {
                fetch('includes/getBestelling.php?id=' + data.newId)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Er trad een fout op bij het aanmaken van een id');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Successfully fetched data, send ID to bestel file
                        window.location.href = 'bestel.php?id=' + data.id;
                    })
                    .catch(error => {
                        console.error(error.message);
                    });
            })
            .catch(error => {
                console.error(error.message);
                let myError = document.getElementById('error');
                myError.textContent = error.message;
            });
    });
</script>
</body>
</html>