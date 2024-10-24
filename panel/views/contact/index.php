<?php
include_once dirname(__DIR__, 3) . '/vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));
$dotenv->load();

$domain = $_ENV["DOMAIN"];

$search = isset($_GET['s']) ? $_GET['s'] : '';
$result = [];
if (!empty($search)) {
    foreach ($data["contacts"] as $contact) {
        if (stripos($contact['name'], $search) !== false || stripos($contact['email'], $search) !== false || stripos($contact['phone'], $search) !== false || stripos($contact['message'], $search) !== false) {
            $result[] = $contact;
        }
    }
} else {
    $result = $data["contacts"];
}

$dataNum = 5;
$totalData = count($result);
$pags = ceil($totalData / $dataNum);

$currentPage = isset($_GET['p']) ? (int) $_GET['p'] : 1;
if ($currentPage < 1) {
    $currentPage = 1;
} elseif ($currentPage > $pags) {
    $currentPage = $pags;
}

$index = ($currentPage - 1) * $dataNum;

$paginatedData = array_slice($result, $index, $dataNum);
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

    <div class="container" style="align-items: center;">
        <form method="GET" class="search-bar">
            <input type="text" name="s" id="s" value="<?= htmlspecialchars($search) ?>" placeholder="Buscar...">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
        <div class="table">
            <table>
                <thead>
                    <tr style="background-color: var(--info-light)">
                        <th style="text-align: center;">Opciones</th>
                        <th>Nombre</th>
                        <th>Correo Electrónico</th>
                        <th>Teléfono</th>
                        <th>Mensaje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($paginatedData)): ?>
                        <?php foreach ($paginatedData as $contact): ?>
                            <tr>
                                <td style="text-align: center;">
                                    <form action="" method="POST">
                                        <input type="hidden" name="id" value="<?= $contact['id'] ?>">
                                        <button class="icon-button">
                                            <i class="fa-solid fa-square-check"></i>
                                        </button>
                                    </form>
                                </td>
                                <td><?= htmlspecialchars($contact['name']) ?></td>
                                <td><?= htmlspecialchars($contact['email']) ?></td>
                                <td><?= htmlspecialchars($contact['phone']) ?></td>
                                <td><?= htmlspecialchars($contact['message']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No hay datos para mostrar.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <?php if ($currentPage > 1): ?>
                <a href="?p=<?= $currentPage - 1 ?>"><i class="fa-solid fa-chevron-left"></i></a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $pags; $i++): ?>
                <a href="?p=<?= $i ?>" <?= $i === $currentPage ? 'style="font-weight: bold;"' : '' ?>>
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($currentPage < $pags): ?>
                <a href="?p=<?= $currentPage + 1 ?>"><i class="fa-solid fa-chevron-right"></i></a>
            <?php endif; ?>
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