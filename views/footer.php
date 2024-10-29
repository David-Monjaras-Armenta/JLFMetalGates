<?php
$lan = "en";
if (isset($_COOKIE['lan'])) {
    $lan = $_COOKIE['lan'];
}
?>

<footer>
    <div class="info">
        <div class="brand">
            <img src="../public/img/logo-blanco.svg" alt="">
        </div>
        <div class="contact">
            <?php if ($lan == "en"): ?>
                <h6>Quick Links</h6>
            <?php else: ?>
                <h6>Enlaces Rápidos</h6>
            <?php endif; ?>
            <div class="list">
                <?php if ($lan == "en"): ?>
                    <p class="item">
                        <i class="fa-solid fa-map-location-dot"></i>
                        address
                    </p>
                    <p class="item">
                        <i class="fa-solid fa-mobile-screen-button"></i>
                        Mobile: 214 734 2383
                    </p>
                    <p class="item">
                        <i class="fa-solid fa-phone"></i>
                        Office: (813) 454 2133
                    </p>
                <?php else: ?>
                    <p class="item">
                        <i class="fa-solid fa-map-location-dot"></i>
                        address
                    </p>
                    <p class="item">
                        <i class="fa-solid fa-mobile-screen-button"></i>
                        Móvil: 214 734 2383
                    </p>
                    <p class="item">
                        <i class="fa-solid fa-phone"></i>
                        Oficina: (813) 454 2133
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <div class="social-media">
            <?php if ($lan == "en"): ?>
                <h6>Social Media</h6>
            <?php else: ?>
                <h6>Redes Sociales</h6>
            <?php endif; ?>
            <div class="links">
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
        </div>
    </div>
    <div class="rights">
        <?php if ($lan == "en"): ?>
            <h6>Copyright © 2024 JLF Metal Gates. All rights reserved</h6>
        <?php else: ?>
            <h6>Copyright © 2024 JLF Metal Gates. Todos los derechos reservados</h6>
        <?php endif; ?>
    </div>
</footer>