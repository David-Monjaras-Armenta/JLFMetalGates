<?php
include_once "./panel/cms.php";
$content = CMS::get_content(5);

$lan = "en";
if (isset($_COOKIE['lan'])) {
    $lan = $_COOKIE['lan'];
}

$gallery = $content[$lan];
$background = $content['background'];
?>

<style>
    #gallery {
        background-image: url('<?= $background[0] ?>');
        background-size: cover;
    }

    @media (max-width: 1024px) {
        #gallery {
            background-image: url('<?= $background[1] ?>');
        }
    }

    @media (max-width: 640px) {
        #gallery {
            background-image: url('<?= $background[2] ?>');
        }
    }
</style>

<div id="gallery" class="section">
    <div class="section-content">
        <?php if ($lan == "en"): ?>
            <h2>Gallery</h2>
        <?php else: ?>
            <h2>Galería</h2>
        <?php endif; ?>

        <div class="grid">
            <?php foreach ($gallery as $item): ?>
                <?php if (trim($item['title']) == ""): ?>
                    <img src="<?= $item['image'][0] ?>" alt="<?= $item['name'] ?>">
                <?php else: ?>
                    <div class="text">
                        <h6><?= $item['title'] ?></h6>
                        <p><?= $item['text'] ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>