<?php
include_once "./panel/cms.php";
$content = CMS::get_content(2);

$lan = "en";
if (isset($_COOKIE['lan'])) {
    $lan = $_COOKIE['lan'];
}

$slides = $content[$lan];
?>

<div id="home" class="section home">
    <?php foreach ($slides as $slide): ?>
        <?php if ($slide == reset($slides)): ?>
            <div id="home-bg-<?= $slide["id"]?>" class="home-bg active">
        <?php else: ?>
            <div id="home-bg-<?= $slide["id"]?>" class="home-bg">
        <?php endif; ?>
            <picture>
                <source media="(max-width: 600px)" srcset="<?= $slide["image"][2]?>">
                <source media="(max-width: 1200px)" srcset="<?= $slide["image"][1]?>">
                <img src="<?= $slide["image"][0]?>" alt="Slide <?= $slide["name"]?>">
            </picture>
        </div>
    <?php endforeach; ?>
    <div class="slides">
        <div class="slides-content">
            <?php foreach ($slides as $slide): ?>
                <?php if ($slide == reset($slides)): ?>
                    <div id="slide-content-<?= $slide["id"]?>" class="slide-main active">
                <?php else: ?>
                    <div id="slide-content-<?= $slide["id"]?>" class="slide-main">
                <?php endif; ?>
                    <h2><?= $slide['title'] ?></h2>
                    <p><?= $slide['text'] ?></p>

                    <?php if ($lan == "en"): ?>
                        <a href="#contact">Contact Us</a>
                    <?php else: ?>
                        <a href="#contact">Contáctanos</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <div class="slides-carusel">
                <?php foreach ($slides as $slide): ?>
                    <?php if ($slide == reset($slides)): ?>
                        <img id="slide-carusel-<?= $slide["id"]?>" src="<?= $slide["image"][2]?>" alt="Slide <?= $slide["name"]?>" class="active" onclick="changeSlide(<?= $slide['id']?>)">
                    <?php else: ?>
                        <img id="slide-carusel-<?= $slide["id"]?>" src="<?= $slide["image"][2]?>" alt="Slide <?= $slide["name"]?>" onclick="changeSlide(<?= $slide['id']?>)">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="slides-controls">
            <button onclick="nextSlide()">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button onclick="prevSlide()">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>

<script>
    const indexes = [
        <?php foreach ($slides as $slide): ?>
            <?= $slide['id']?>,
        <?php endforeach; ?>
    ]
    var currentIndex = 0

    function changeSlide(id) {
        const backgrounds = document.querySelectorAll(".home-bg")
        backgrounds.forEach(bg => {
            bg.classList.remove("active")
        })

        const contents = document.querySelectorAll(".slide-main")
        contents.forEach(content => {
            content.classList.remove("active")
        })

        const carusel = document.querySelectorAll(".slides-carusel img")
        carusel.forEach(item => {
            item.classList.remove("active")
        })

        document.getElementById(`home-bg-${id}`).classList.add("active")
        document.getElementById(`slide-content-${id}`).classList.add("active")
        document.getElementById(`slide-carusel-${id}`).classList.add("active")

        currentIndex = indexes.indexOf(id)
    }

    function nextSlide() {
        if (currentIndex == (indexes.length - 1)) {
            currentIndex = 0
        } else {
            currentIndex++
        }

        changeSlide(indexes[currentIndex])
    }

    function prevSlide() {
        if (currentIndex == 0) {
            currentIndex = indexes.length - 1
        } else {
            currentIndex--
        }

        changeSlide(indexes[currentIndex])
    }
</script>