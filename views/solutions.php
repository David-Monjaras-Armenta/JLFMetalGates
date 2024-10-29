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
                    <button id="btnSolution_<?= $solution['id'] ?>" class="active"
                        onclick="showComparator(<?= $solution['id'] ?>)"><?= $solution['title'] ?></button>
                <?php else: ?>
                    <button id="btnSolution_<?= $solution['id'] ?>"
                        onclick="showComparator(<?= $solution['id'] ?>)"><?= $solution['title'] ?></button>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div id="comparator" class="comparator">
            <?php foreach ($solutions as $solution): ?>
                <?php if ($solution == reset($solutions)): ?>
                    <div class="comp_<?= $solution['id'] ?> comparator-img-overflow active">
                        <img src="<?= $solution['image'][0] ?>" alt="<?= $solution['title'] ?>_2" />
                    </div>
                    <div class="comp_<?= $solution['id'] ?> comparator-img active">
                        <img src="<?= $solution['image'][1] ?>" alt="<?= $solution['title'] ?>_1" />
                    </div>
                <?php else: ?>
                    <div class="comp_<?= $solution['id'] ?> comparator-img-overflow">
                        <img src="<?= $solution['image'][0] ?>" alt="<?= $solution['title'] ?>_2" />
                    </div>
                    <div class="comp_<?= $solution['id'] ?> comparator-img">
                        <img src="<?= $solution['image'][1] ?>" alt="<?= $solution['title'] ?>_1" />
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <div id="comparator-slider" class="comparator-slider">
                <i class="fa-solid fa-caret-left"></i>
                <i class="fa-solid fa-caret-right"></i>
            </div>
        </div>
    </div>
</div>

<script>
    var currentOverflow = 0
    const comparatorSlider = document.getElementById('comparator-slider')
    const comparator = document.getElementById('comparator')
    let startX, isGrabbing = false;

    function showComparator(id) {
        currentOverflow = id
        comparatorSlider.style.left = "50%"
        document.querySelector(`.comp_${currentOverflow}.comparator-img-overflow`).style.width = "50%"

        const buttons = document.querySelectorAll("#solutions .button-group button")
        buttons.forEach(button => {
            button.classList.remove("active")
        })

        document.getElementById(`btnSolution_${id}`).classList.add("active")

        const imagesOverflow = document.querySelectorAll(".comparator-img-overflow")
        imagesOverflow.forEach(image => {
            image.classList.remove("active")
        })

        const images = document.querySelectorAll(".comparator-img")
        images.forEach(image => {
            image.classList.remove("active")
        })

        const activeImages = document.querySelectorAll(`.comp_${id}`)
        activeImages.forEach(image => {
            image.classList.add("active")
        })
    }

    function resize(event) {
        if (isGrabbing) {
            const imagesOverflow = document.querySelector(`.comp_${currentOverflow}.comparator-img-overflow.active`)
            deltaX = event.clientX - startX

            if (deltaX > 0) {
                if ((imagesOverflow.clientWidth + deltaX) <= (comparator.clientWidth - 35)) {
                    imagesOverflow.style.width = imagesOverflow.offsetWidth + deltaX + 'px';
                } else {
                    imagesOverflow.style.width = (comparator.clientWidth - 35) + 'px';
                }
            } else if (deltaX < 0) {
                if ((imagesOverflow.clientWidth + deltaX) >= 35) {
                    imagesOverflow.style.width = imagesOverflow.offsetWidth + deltaX + 'px';
                } else {
                    imagesOverflow.style.width = 35 + 'px';
                }
            }

            comparatorSlider.style.left = imagesOverflow.clientWidth + "px"
            startX = event.clientX
        }
    }

    function resizeTouch(event) {
        if (isGrabbing) {
            const imagesOverflow = document.querySelector(`.comp_${currentOverflow}.comparator-img-overflow.active`)
            deltaX = event.touches[0].clientX - startX

            if (deltaX > 0) {
                if ((imagesOverflow.clientWidth + deltaX) <= (comparator.clientWidth - 20)) {
                    imagesOverflow.style.width = imagesOverflow.offsetWidth + deltaX + 'px';
                } else {
                    imagesOverflow.style.width = (comparator.clientWidth - 20) + 'px';
                }
            } else if (deltaX < 0) {
                if ((imagesOverflow.clientWidth + deltaX) >= 20) {
                    imagesOverflow.style.width = imagesOverflow.offsetWidth + deltaX + 'px';
                } else {
                    imagesOverflow.style.width = 20 + 'px';
                }
            }

            comparatorSlider.style.left = imagesOverflow.clientWidth + "px"
            startX = event.touches[0].clientX
        }
    }

    function stopResize(event) {
        comparatorSlider.style.cursor = "grab"
        isGrabbing = false

        window.removeEventListener("mousemove", resize)
        window.removeEventListener("mouseup", stopResize)
        window.removeEventListener("touchmove", resizeTouch)
        window.removeEventListener("touchend", stopResize)
    }

    comparatorSlider.addEventListener("mousedown", event => {
        event.preventDefault();

        startX = event.clientX;
        isGrabbing = true

        comparatorSlider.style.cursor = "grabbing"
        window.addEventListener("mousemove", resize)
        window.addEventListener("mouseup", stopResize)
    })

    comparatorSlider.addEventListener("touchstart", event => {
        event.preventDefault();

        startX = event.touches[0].clientX;
        isGrabbing = true

        window.addEventListener("touchmove", resizeTouch)
        window.addEventListener("touched", stopResize)
    })
    
    document.querySelector(`.button-group button.active`).click()
</script>