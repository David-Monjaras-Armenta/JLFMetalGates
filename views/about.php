<?php
include_once "./panel/cms.php";
$content = CMS::get_content(4);

$lan = "en";
if (isset($_COOKIE['lan'])) {
    $lan = $_COOKIE['lan'];
}

$features = $content[$lan];
?>

<div id="about" class="section">
    <?php if ($lan == "en"): ?>
        <h2>Key Features</h2>
    <?php else: ?>
        <h2>Valores</h2>
    <?php endif; ?>

    <div class="features">
        <?php foreach ($features as $feature): ?>
            <?php if ($feature == reset($features)): ?>
                <div id="feature_<?= $feature['id'] ?>" class="features-main active">
            <?php else: ?>
                <div id="feature_<?= $feature['id'] ?>" class="features-main">
            <?php endif; ?>
                <div class="feature-text">
                    <h3><?= $feature['title'] ?></h3>
                    <p><?= $feature['text'] ?></p>
                </div>
                <img src="<?= $feature['image'][0] ?>" alt="feature_<?= $feature['id'] ?>">
            </div>
        <?php endforeach; ?>
        <div class="features-list">
            <?php foreach ($features as $feature): ?>
                <?php if ($feature == reset($features)): ?>
                    <div id="feature_card_<?= $feature['id'] ?>" class="feature-card hide" onclick="showFeature(<?= $feature['id'] ?>)">
                <?php else: ?>
                    <div id="feature_card_<?= $feature['id'] ?>" class="feature-card" onclick="showFeature(<?= $feature['id'] ?>)">
                <?php endif; ?>
                    <h3><?= $feature['title'] ?></h3>
                    <img src="<?= $feature['image'][0] ?>" alt="feature_<?= $feature['id'] ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    function showFeature(id) {
        const features = document.querySelectorAll(".features .features-main")
        features.forEach(feature => {
            feature.classList.remove("active")
        })

        const cards = document.querySelectorAll(".features .features-list .feature-card")
        cards.forEach(card => {
            card.classList.remove("hide")
        })

        document.getElementById(`feature_card_${id}`).classList.add("hide")
        document.getElementById(`feature_${id}`).classList.add("active")
    }
</script>