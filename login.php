<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'config/settings.php';
require_once 'config/database.php';

$host = DB_HOST;
$dbname = DB_NAME;
$username = DB_USER;
$password = DB_PASS;

try {
    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div class="field_body">
            <label for="username">Gebruikersnaam</label>
            <input type="text" name="username">
        </div>
        <div class="field_body">
            <label for="password">Wachtwoord</label>
            <input type="password" name="password">
        </div>
        <div class="field-body">
            <input class="button is-info" type="submit" name="submit">
        </div>
    </form>

<?php
if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT wachtwoord FROM gebruikers WHERE naam = :username AND wachtwoord = :password";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($results) && password_verify($password, (string)$results)) {
            header('Location: loginSucces.php');
            exit();
        } else {
            echo '<script>alert("Login Failed")</script>';
        }
    } else {
        echo 'Contact system admin';
    }
}
?>