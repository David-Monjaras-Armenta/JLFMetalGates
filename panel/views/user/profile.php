<?php
include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));
$dotenv->load();

$domain = $_ENV["DOMAIN"];
$userData = $data['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel JLF Metal Gates</title>

    <link rel="stylesheet" href="<?= $domain ?>/panel/assets/css/panel.css">
    <script src="https://kit.fontawesome.com/93df2c41f8.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include_once dirname(__DIR__, 1) . "/nav/navbar.php" ?>
    <div class="container" style="gap: 32px; overflow-y: auto;">
        <h1 style="width: 100%; text-align: center;">Perfil</h1>
        <div id="create" class="card" style="gap: 12px;">
            <form action="" method="POST" >
                <input type="hidden" name="id" value="<?= $userData['id'] ?>">
                <div class="group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" value="<?= $userData['email'] ?>" required>
                </div>
                <div class="group">
                    <label for="old-password">Antigua Contraseña:</label>
                    <input type="password" id="old-password" name="old-password">
                </div>
                <div class="group">
                    <label for="new-password">Nueva Contraseña:</label>
                    <input type="password" id="new-password" name="new-password">
                </div>
                <input type="submit" value="Enviar">
            </form>
        </div>
    </div>

    <?php if (isset($data["notify"])): ?>
        <div id="notify" class="notify <?= $data["notify"]["type"] ?>">
            <h5><?= $data["notify"]["message"] ?></h5>
        </div>
        <script>
            setTimeout(() => {
                document.getElementById("notify").classList.add("hide")
            }, 2000);

            setTimeout(() => {
                document.getElementById("notify").style.display = "none"
            }, 6000);
        </script>
    <?php endif; ?>
</body>

</html>