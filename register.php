<?php
// Start the session to manage user data across requests
session_start();
global $db, $mysql;

// Check if the registration form is submitted
if (isset($_POST['submit'])) {
    // Include the database configuration file
    require_once 'config/database.php';
    require_once 'config/settings.php';

    // Get form data from POST
    $naam = $_POST['username'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['password'];

    // Include registration logic (assuming it validates user inputs)
    require_once 'register.php';

    // Check if there are no errors from registration logic
    if (empty($errors)) {
        // Hash the password using bcrypt
        $password = password_hash($wachtwoord, PASSWORD_DEFAULT);

        // SQL query to insert user data into the 'users' table
        $sql = "INSERT INTO gebruikers (naam, email, wachtwoord) 
                VALUES ('$naam','$email', '$wachtwoord')";

        // Execute the SQL query
        $result = $mysql->query($sql);

        // Check if the account was inserted successfully
        if ($result == TRUE) {
            // Display success message and redirect to index.php
            echo "New Account created successfully.";
            header('Location: index.php');
        } else {
            // Log the error instead of displaying it directly to the user
            echo "Error occurred while making your account.";
        }
    } else {
        // Display validation errors to the user
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    // Close the database connection
    $mysql->close();
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Game update form</title>
    <style>
        body {

            background-color: #f0f0f0; /* Set your desired background color here */
        }
    </style>
</head>

<html>

<body>

<section class="section">
    <div class="container content">
        <h2 class="title">Register</h2>

        <section class="columns">
            <form class="column is-6" action="" method="post">

                <!-- gebruikersnaam -->
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="UserName">Username</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="userName" type="text" name="username" value="<?= $username ?? '' ?>" />
                                <span class="icon is-small is-left"><i class="fas fa-user-circle"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?= $errors['naam'] ?? '' ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="email">Email</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="email" type="text" name="email" value="<?= $email ?? '' ?>" />
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?= $errors['email'] ?? '' ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="password">Password</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="password" type="password" name="password"/>
                                <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?= $errors['wachtwoord'] ?? '' ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <button class="button is-link is-fullwidth" type="submit" name="submit">Registreer</button>
                    </div>
                </div>

            </form>
        </section>

    </div>
</section>



</body>

</html>
