<?php
include_once "./panel/cms.php";
$content = CMS::get_content(1);

var_dump($_COOKIE["lan"]);

$lan = "en";
if (isset($_COOKIE['lan'])) {
    $lan = $_COOKIE['lan'];
}

$links = $content[$lan];
?>

<nav>
    <div class="collapse">
        <button class="collapse-button" onclick="showMenu()">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div id="collapse-container" class="collapse-container">
            <div class="collapse-menu">
                <div class="brand">
                    <h1>JLF</h1>
                </div>
                <div class="language">
                    <button>
                        <?php if ($lan == "en"): ?>
                            <img src="../public/img/usa.JPG" alt="">
                            English
                        <?php else: ?>
                            <img src="../public/img/mexico.webp" alt="">
                            Español
                        <?php endif; ?>
                        <i class="fa-solid fa-caret-down"></i>
                    </button>
                </div>
                <ul class="menu">
                    <?php foreach ($links as $link): ?>
                        <li class="link">
                            <?php if ($link['name'] == "Link Inicio"): ?>
                                <a class="active" href="<?= $link['text'] ?>"><?= $link['title'] ?></a>
                            <?php else: ?>
                                <a href="<?= $link['text'] ?>"><?= $link['title'] ?></a>
                            <?php endif; ?>

                        </li>
                    <?php endforeach; ?>
                    <hr>
                    <div class="social-media">
                        <a href="#">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="#">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="#">
                            <i class="fa-brands fa-google"></i>
                        </a>
                    </div>
                </ul>
                <div class="footer">
                    <h6>Copyright © 2024 JLF Metal Gates. All rights reserved</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="brand">
        <h1>JLF Metal Gates</h1>
    </div>
    <div class="expand">
        <ul class="menu">
            <?php foreach ($links as $link): ?>
                <li class="link">
                    <?php if ($link['name'] == "Link Inicio"): ?>
                        <a class="active" href="<?= $link['text'] ?>"><?= $link['title'] ?></a>
                    <?php else: ?>
                        <a href="<?= $link['text'] ?>"><?= $link['title'] ?></a>
                    <?php endif; ?>

                </li>
            <?php endforeach; ?>
        </ul>
        <div class="language">
            <div class="dropdown">
                <button class="dropdown-button" onclick="toggleDropdownDesktop()">
                    <?php if ($lan == "en"): ?>
                        <img src="../public/img/usa.JPG" alt="">
                    <?php else: ?>
                        <img src="../public/img/mexico.webp" alt="">
                    <?php endif; ?>
                    <i class="fa-solid fa-caret-down"></i>
                </button>
                <div id="dropdown-desktop" class="dropdown-content">
                    <form action="" method="POST">
                        <input type="hidden" name="lan" value="en">
                        <button type="submit">
                            <img src="../public/img/usa.JPG" alt=""> English
                        </button>
                    </form>
                    <form action="" method="POST">
                        <input type="hidden" name="lan" value="es">
                        <button type="submit">
                            <img src="../public/img/mexico.webp" alt=""> Español
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    const dropdownDesktop = document.getElementById('dropdown-desktop');

    function handleAnchorChange(params) {
        var anchor = window.location.hash
        if (anchor) {
            const links = document.querySelectorAll('.link a');
            links.forEach(link => {
                link.classList.remove('active');
            });

            const anchorLinks = document.querySelectorAll(`a[href="${anchor}"]`);
            if (anchorLinks) {
                anchorLinks.forEach(link => {
                    link.classList.add('active');
                })
            }
        }

        document.getElementById("collapse-container").classList.remove("show")
    }

    function changeNavbarColor() {
        const navbar = document.querySelector('nav');
        const scrollPosition = window.scrollY;

        if (scrollPosition > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }

    function showMenu() {
        document.getElementById("collapse-container").classList.add("show")
    }

    function toggleDropdownDesktop() {
        dropdownDesktop.classList.toggle('show');
    }

    document.getElementById("collapse-container").addEventListener("click", event => {
        if (event.target == event.currentTarget) {
            document.getElementById("collapse-container").classList.remove("show")
        }
    })

    window.onscroll = function() {
        changeNavbarColor();
    };

    window.onhashchange = function() {
        handleAnchorChange()
    }
</script>