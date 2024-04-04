<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    require_once 'config/settings.php';
    require_once 'config/database.php';
    require_once 'includes/Image.php';

    $host = DB_HOST;
    $dbname = DB_NAME;
    $username = DB_USER;
    $password = DB_PASS;

    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    ?>

    <!--form-->
    <section class="columns">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" field-body">
                <label for="name">Menu-Item</label>
                <input type="text" class="input" id="name" name="name">
            </div>
            <div class="field-body">
                <label for="allergies">Allergies</label>
                <input type="text" class="input" id="allergies" name="allergies">
            </div>
            <div class="field-body">
                <label for="type">type</label>
                <select name="type" id="type">
                    <option value="Dishes">Dishes</option>
                    <option value="Drinks">Drinks</option>
                    <option value="Desserts">Desserts</option>
                </select>
            </div>
        <div class="field-body">
            <label for="prijs">Prijs</label>
            <input type="text" class="input" id="prijs" name="prijs">
        </div>
            <div class="field-body">
                <label for="image">Image</label>
                <input type="file" class="input" id="image" name="image">
            </div>
            <div class="field-body">
                <input class="button is-info" type="submit" name="submit">
            </div>
        </form>
    </section>

    <?php
    $name = "";
    $allergies = "";
    $type = "";
    $prijs = "";
    $image = "";
    $images = new \cle3\includes\Image();

    if (!empty($_FILES['image'])) {
        $image = $images->save($_FILES['image']);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['name']) && !empty ($_POST['allergies']) && !empty($_POST['type']) && !empty($_POST['prijs'])){
            $name = $_POST['name'];
            $allergies = $_POST['allergies'];
            $type = $_POST['type'];
            $prijs = $_POST['prijs'];

            $query = "INSERT INTO menu (name, image, allergies, type, prijs) VALUES ('$name','$image', '$allergies', '$type', '$prijs')";
            $stmt = $db->query($query);

            if (!$stmt) {
                echo 'Something went wrong!';

            } else {
                header("location: succes.php");
            }
        } else {
            echo 'contact system admin';
        }
    }
}else{
    header('location: login.php');
}
?>