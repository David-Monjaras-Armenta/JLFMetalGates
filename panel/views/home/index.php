<?php
include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));
$dotenv->load();

$domain = $_ENV["DOMAIN"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel JLF Metal Gates</title>

    <link rel="stylesheet" href="<?= $domain ?>/panel/assets/css/panel.css">
</head>

<body>
    <div class="container-centered">
        <h1>Panel JLF Metal Gate</h1>
        <form class="form-login" action="" method="POST">
            <h4>Iniciar Sesión</h4>
            <hr>
            <input type="email" name="email" id="email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <input id="btnLogin" type="submit" value="Entrar">
            <?php
            if (isset($data["error"])) {
                echo "<div class='message'>
                        <h5>Acceso Denegado</h5>
                        <p>{$data["error"]}</p>
                    </div>";
            }
            ?>
        </form>
    </div>
</body>

</html>