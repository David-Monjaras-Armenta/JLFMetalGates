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
        if (stripos($content['name'], $search) !== false) {
            $result["es"][] = $content;
        }
    }

    foreach ($data["section"]['en'] as $content) {
        if (stripos($content['name'], $search) !== false) {
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
        <h1 style="width: 100%; text-align: center;">Sección Galería</h1>
        <div class="row">
            <form method="GET" class="search-bar">
                <input type="text" name="s" id="s" value="<?= htmlspecialchars($search) ?>" placeholder="Buscar...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <button onclick="showCreate()"><i class="fa-solid fa-plus"></i></button>
        </div>
        <div id="create" class="card hidden" style="gap: 12px;">
            <div class="group">
                <label for="type">Tipo:</label>
                <select name="type" id="type" onchange="showForm()">
                    <option value="-1" disabled selected>Selecciona una opcipon</option>
                    <option value="text">Texto</option>
                    <option value="image">Imagen</option>
                </select>
            </div>

            <form id="form-text" action="" method="POST" style="display: none;" >
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

                <input type="submit" value="Enviar">
            </form>
            <form id="form-image" action="" method="POST" style="display: none;" enctype="multipart/form-data">
                <div class="group">
                    <label for="name">Nombre:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="group">
                    <label for="image">Imagen:</label>
                    <input type="file" id="image" name="image" accept="image/webp, image/jpeg">
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
        ?>
            <div class="card">
                <?php if ($enContent["title"] != ""): ?>
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

                    <input type="submit" value="Enviar">
                </form>
                <?php else: ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_en" value="<?php echo $enContent['id']; ?>">
                    <input type="hidden" name="id_es" value="<?php echo $esContent['id']; ?>">

                    <div class="group">
                        <label for="name_<?php echo $enContent['id']; ?>">Nombre:</label>
                        <input type="text" id="name_<?php echo $enContent['id']; ?>" name="name_en" value="<?php echo $enContent['name']; ?>" required>
                    </div>

                    <div class="group">
                        <label for="image<?php echo $enContent['id']; ?>">Imagen:</label>
                        <img src="<?= $enContent['image'][0] ?>" onclick="toFocus('image_<?php echo $enContent['id']; ?>')">
                        <input type="file" id="image_<?php echo $enContent['id']; ?>" name="image" hidden accept="image/webp, image/jpeg">
                    </div>

                    <input type="submit" value="Enviar">
                </form>
                <?php endif; ?>
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

        function showForm() {
            const type = document.getElementById("type").value

            document.getElementById("form-text").style.display = "none"
            document.getElementById("form-image").style.display = "none"

            switch (type) {
                case "text":
                    document.getElementById("form-text").style.display = "flex"
                    break;
                case "image":
                    document.getElementById("form-image").style.display = "flex"
                    break;
                default:
                    break;
            }
        }

        function toFocus(id) {
            document.getElementById(id).click();
        }
    </script>
</body>

</html>