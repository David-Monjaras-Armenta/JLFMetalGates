<?php
include_once "./panel/cms.php";
$content = CMS::get_content(3);

$lan = "en";
if (isset($_COOKIE['lan'])) {
    $lan = $_COOKIE['lan'];
}

$content = $content[$lan];
?>

<div id="solutions" class="section">
    <div class="button-group">
        <?php foreach ($content as $solution): ?>
            <?php if ($solution == reset($content)): ?>
                <button id="btnSolution_<?= $solution['id'] ?>" class="active" onclick="showComparator(<?= $solution['id'] ?>)"><?= $solution['title'] ?></button>
            <?php else: ?>
                <button id="btnSolution_<?= $solution['id'] ?>" onclick="showComparator(<?= $solution['id'] ?>)"><?= $solution['title'] ?></button>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="comparator">
        <?php foreach ($content as $solution): ?>
            <?php if ($solution == reset($content)): ?>
                <img src="<?= $solution['image'][0] ?>" alt="<?= $solution['title'] ?>_1" class="comp_<?= $solution['id'] ?> left active" >
                <img src="<?= $solution['image'][1] ?>" alt="<?= $solution['title'] ?>_2" class="comp_<?= $solution['id'] ?> active" >
            <?php else: ?>
                <img src="<?= $solution['image'][0] ?>" alt="<?= $solution['title'] ?>_1"  class="comp_<?= $solution['id'] ?> left">
                <img src="<?= $solution['image'][1] ?>" alt="<?= $solution['title'] ?>_2"  class="comp_<?= $solution['id'] ?>">
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function showComparator(id) {
        const buttons = document.querySelectorAll("#solutions .button-group button")
        buttons.forEach(button => {
            button.classList.remove("active")
        })

        document.getElementById(`btnSolution_${id}`).classList.add("active")

        const images = document.querySelectorAll(".comparator img")
        images.forEach(image => {
            image.classList.remove("active")
        })

        const activeImages = document.querySelectorAll(`.comp_${id}`)
        activeImages.forEach(image => {
            image.classList.add("active")
        })
    }
</script>