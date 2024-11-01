<?php
include_once "./panel/cms.php";
$content = CMS::get_content(1);

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
                    <img src="../public/img/logo-simple-blanco.svg" alt="">
                </div>
                <div class="language">
                    <div class="dropdown">
                        <button class="dropdown-button" onclick="toggleDropdownMobile()">
                            <?php if ($lan == "en"): ?>
                                <img src="../public/img/usa.JPG" alt=""> English
                            <?php else: ?>
                                <img src="../public/img/mexico.webp" alt=""> Español
                            <?php endif; ?>
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                        <div id="dropdown-mobile" class="dropdown-content mobile">
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
        <img src="../public/img/logo-blanco.svg" alt="">
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
    const dropdownMobile = document.getElementById('dropdown-mobile');
    const linksExpand = document.querySelectorAll('.expand .menu .link a');
    const linksCollapse = document.querySelectorAll('.collapse .collapse-container .collapse-menu .menu .link a');

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

    function toggleDropdownMobile() {
        dropdownMobile.classList.toggle('show');
    }

    function updateActiveLink() {
        const sections = document.querySelectorAll('.section');
        let index = sections.length;

        while (--index && window.scrollY + 100 < sections[index].offsetTop) { }

        linksExpand.forEach((link) => link.classList.remove('active'));
        linksCollapse.forEach((link) => link.classList.remove('active'));

        linksCollapse[index].classList.add('active');
        linksExpand[index].classList.add('active');
    }

    document.getElementById("collapse-container").addEventListener("click", event => {
        if (event.target == event.currentTarget) {
            document.getElementById("collapse-container").classList.remove("show")
        }
    })

    window.onscroll = function () {
        changeNavbarColor();
        updateActiveLink();
    };

    window.addEventListener("hashchange", event => {
        document.getElementById("collapse-container").classList.remove("show")
    })
</script>