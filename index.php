<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['lan'])) {
        session_start();
        setcookie(
            'lan',
            $_POST['lan'],
            time() + (86400 * 30),
            '/',
            '',
            false, #cambiar a true cuando haya https
            true
        );
        $_SESSION['username'] = "guest";
        header("Location: /#home");
    }
} else {
    $lan = "en";
    if (isset($_COOKIE['lan'])) {
        $lan = $_COOKIE['lan'];
    }
}
?>

<!DOCTYPE html>
<html lang="<?= $lan ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JLF Metal Gates</title>

    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="icon" href="favicon.png" type="./public/img/logo-simple-blanco.svg">
    <script src="https://kit.fontawesome.com/6f07658194.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include_once "./views/navbar.php"
        ?>
    <main>
        <?php
        include_once "./views/home.php";
        include_once "./views/solutions.php";
        include_once "./views/about.php";
        include_once "./views/gallery.php";
        include_once "./views/contact.php";
        ?>
    </main>
    <?php
    include_once "./views/footer.php"
        ?>
    <script>
    </script>
</body>

</html>