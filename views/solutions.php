<?php
include_once "./panel/cms.php";
$content = CMS::get_content(3);

$lan = "en";
if (isset($_COOKIE['lan'])) {
    $lan = $_COOKIE['lan'];
}

$solutions = $content[$lan];
$background = $content['background'];
?>

<style>
    #solutions {
        background-image: url('<?= $background[0] ?>');
        background-size: cover;
    }

    @media (max-width: 1024px) {
        #solutions {
            background-image: url('<?= $background[1] ?>');
        }
    }

    @media (max-width: 640px) {
        #solutions {
            background-image: url('<?= $background[2] ?>');
        }
    }
</style>

<div id="solutions" class="section">
    <div class="section-content">
        <div class="button-group">
            <?php foreach ($solutions as $solution): ?>
                <?php if ($solution == reset($solutions)): ?>
                    <button id="btnSolution_<?= $solution['id'] ?>" class="active" onclick="showComparator(<?= $solution['id'] ?>)"><?= $solution['title'] ?></button>
                <?php else: ?>
                    <button id="btnSolution_<?= $solution['id'] ?>" onclick="showComparator(<?= $solution['id'] ?>)"><?= $solution['title'] ?></button>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="comparator">
            <?php foreach ($solutions as $solution): ?>
                <?php if ($solution == reset($solutions)): ?>
                    <img src="<?= $solution['image'][0] ?>" alt="<?= $solution['title'] ?>_1" class="comp_<?= $solution['id'] ?> left active" >
                    <img src="<?= $solution['image'][1] ?>" alt="<?= $solution['title'] ?>_2" class="comp_<?= $solution['id'] ?> active" >
                <?php else: ?>
                    <img src="<?= $solution['image'][0] ?>" alt="<?= $solution['title'] ?>_1"  class="comp_<?= $solution['id'] ?> left">
                    <img src="<?= $solution['image'][1] ?>" alt="<?= $solution['title'] ?>_2"  class="comp_<?= $solution['id'] ?>">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
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