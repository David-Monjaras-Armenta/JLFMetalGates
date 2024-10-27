<?php
$lan = "en";
if (isset($_COOKIE['lan'])) {
    $lan = $_COOKIE['lan'];
}
?>

<!DOCTYPE html>
<html lang="<?= $lan ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JLF Metal Gates</title>

    <link rel="stylesheet" href="./public/css/style.css">
    <script src="https://kit.fontawesome.com/93df2c41f8.js" crossorigin="anonymous"></script>
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

    <script>
    </script>
</body>

</html>