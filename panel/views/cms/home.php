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
        if (stripos($content['name'], $search) !== false || stripos($content['title'], $search) !== false || stripos($content['text'], $search) !== false) {
            $result["es"][] = $content;
        }
    }

    foreach ($data["section"]['en'] as $content) {
        if (stripos($content['name'], $search) !== false || stripos($content['title'], $search) !== false || stripos($content['text'], $search) !== false) {
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
        <h1 style="width: 100%; text-align: center;">Sección Inicio</h1>
        <div class="row">
            <form method="GET" class="search-bar">
                <input type="text" name="s" id="s" value="<?= htmlspecialchars($search) ?>" placeholder="Buscar...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <button onclick="showCreate()"><i class="fa-solid fa-plus"></i></button>
        </div>
        <div id="create" class="card hidden">
            <form action="" method="POST" enctype="multipart/form-data">
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
                        <label for="text_en">
                            Texto (Inglés):
                        </label>
                        <textarea id="text_en" name="text_en" rows=4 required></textarea>
                    </div>
                    <div class="column">
                        <label for="text_es">
                            Texto (Español):
                        </label>
                        <textarea id="text_es" name="text_es" rows=4 required></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <label for="image_desk">Imagen Desktop:</label>
                        <input type="file" id="image_desk" name="image_desk" accept="image/webp, image/jpeg">
                    </div>
                    <div class="column">
                        <label for="image_tab">Imagen Tablet:</label>
                        <input type="file" id="image_tab" name="image_tab" accept="image/webp, image/jpeg">
                    </div>
                    <div class="column">
                        <label for="image_mov">Imagen Móvil:</label>
                        <input type="file" id="image_mov" name="image_mov" accept="image/webp, image/jpeg">
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
            $images = explode(", ", $enContent['image']);
        ?>
            <div class="card">
                <form action="" method="POST" enctype="multipart/form-data">
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
                            <label for="text_en_<?php echo $enContent['id']; ?>">
                                Texto (Inglés):
                            </label>
                            <textarea id="text_en_<?php echo $enContent['id']; ?>" name="text_en" rows=4 required><?php echo $enContent['text']; ?></textarea>
                        </div>
                        <div class="column">
                            <label for="text_es_<?php echo $esContent['id']; ?>">
                                Texto (Español):
                            </label>
                            <textarea id="text_es_<?php echo $esContent['id']; ?>" name="text_es" rows=4 required><?php echo $esContent['text']; ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column">
                            <label for="image_desk_<?php echo $enContent['id']; ?>">Imagen Desktop:</label>
                            <img src="<?= $domain ?>/panel/images/<?= $images[0] ?>" onclick="toFocus('image_desk_<?php echo $enContent['id']; ?>')">
                            <input type="file" id="image_desk_<?php echo $enContent['id']; ?>" name="image_desk" accept="image/webp, image/jpeg" value="" hidden>
                        </div>
                        <div class="column">
                            <label for="image_tab_<?php echo $enContent['id']; ?>">Imagen Tablet:</label>
                            <img src="<?= $domain ?>/panel/images/<?= $images[1] ?>" onclick="toFocus('image_tab_<?php echo $enContent['id']; ?>')">
                            <input type="file" id="image_tab_<?php echo $enContent['id']; ?>" name="image_tab" accept="image/webp, image/jpeg" hidden>
                        </div>
                        <div class="column">
                            <label for="image_mov_<?php echo $enContent['id']; ?>">Imagen Móvil:</label>
                            <img src="<?= $domain ?>/panel/images/<?= $images[2] ?>" onclick="toFocus('image_mov_<?php echo $enContent['id']; ?>')">
                            <input type="file" id="image_mov_<?php echo $enContent['id']; ?>" name="image_mov" accept="image/webp, image/jpeg" hidden>
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

        function toFocus(id) {
            document.getElementById(id).click();
        }
    </script>
</body>

</html>