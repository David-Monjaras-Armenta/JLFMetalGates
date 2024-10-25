<?php
include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));
$dotenv->load();

$domain = $_ENV["DOMAIN"];

$search = isset($_GET['s']) ? $_GET['s'] : '';
$result = [];
if (!empty($search)) {
    foreach ($data["section"]['es'] as $content) {
        if (stripos($content['name'], $search) !== false || stripos($content['title'], $search) !== false) {
            $result["es"][] = $content;
        }
    }

    foreach ($data["section"]['en'] as $content) {
        if (stripos($content['name'], $search) !== false || stripos($content['title'], $search) !== false) {
            $result["en"][] = $content;
        }
    }
} else {
    $result = $data["section"];
}
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
        <h1 style="width: 100%; text-align: center;">Sección Soluciones</h1>
        <div class="row">
            <form method="GET" class="search-bar">
                <input type="text" name="s" id="s" value="<?= htmlspecialchars($search) ?>" placeholder="Buscar...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <button onclick="showCreate()"><i class="fa-solid fa-plus"></i></button>
        </div>
        <div id="create" class="card hidden">
            <form action="" method="POST">
                <div class="group">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="row">
                    <div class="column">
                        <label for="title_en">Título (Inglés):</label>
                        <input type="text" id="title_en" name="title_en" required>
                    </div>

                    <div class="column">
                        <label for="title_">Título (Español):</label>
                        <input type="text" id="title_es" name="title_es" required>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <label for="image_before">Imagen Antes:</label>
                        <input type="text" value="Selecciona una imagen" readonly>
                        <input type="file" id="image_before" name="image_desk" hidden>
                    </div>
                    <div class="column">
                        <label for="image_after">Imagen Después:</label>
                        <input type="text" value="Selecciona una imagen" readonly>
                        <input type="file" id="image_after" name="image_tab" hidden>
                    </div>
                </div>

                <input type="submit" value="Enviar">
            </form>
        </div>
        <?php
        // Iteramos sobre los contenidos en inglés y español
        $enItems = $result['en'];
        $esItems = $result['es'];

        for ($i = 0; $i < count($enItems); $i++) {
            $enContent = $enItems[$i];
            $esContent = $esItems[$i];
            $images = explode(",", $enContent['image']);
        ?>
            <div class="card">
                <form action="" method="POST">
                    <input type="hidden" name="id_en" value="<?php echo $enContent['id']; ?>">
                    <input type="hidden" name="id_es" value="<?php echo $esContent['id']; ?>">

                    <div class="group">
                        <label for="name_<?php echo $enContent['id']; ?>">Nombre:</label>
                        <input type="text" id="name_<?php echo $enContent['id']; ?>" name="name_en" value="<?php echo $enContent['name']; ?>" required>
                    </div>

                    <div class="row">
                        <div class="column">
                            <label for="title_en_<?php echo $enContent['id']; ?>">Título (Inglés):</label>
                            <input type="text" id="title_en_<?php echo $enContent['id']; ?>" name="title_en" value="<?php echo $enContent['title']; ?>" required>
                        </div>

                        <div class="column">
                            <label for="title_es_<?php echo $esContent['id']; ?>">Título (Español):</label>
                            <input type="text" id="title_es_<?php echo $esContent['id']; ?>" name="title_es" value="<?php echo $esContent['title']; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column">
                            <label for="image_before_<?php echo $enContent['id']; ?>">Imagen Antes:</label>
                            <input type="text" value="<?php echo $images[0]; ?>" readonly>
                            <input type="file" id="image_before_<?php echo $enContent['id']; ?>" name="image_desk" hidden>
                        </div>
                        <div class="column">
                            <label for="image_after_<?php echo $enContent['id']; ?>">Imagen Después:</label>
                            <input type="text" value="<?php echo $images[1]; ?>" readonly>
                            <input type="file" id="image_after_<?php echo $enContent['id']; ?>" name="image_tab" hidden>
                        </div>
                    </div>

                    <input type="submit" value="Enviar">
                </form>
            </div>
        <?php } ?>
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

    <script>
        function showCreate() {
            document.getElementById("create").classList.remove("hidden")
        }
    </script>
</body>

</html>