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
                    <a href="https://wa.me/2147342383?text=Hello%21%20I%27m%20contacting%20you%20from%20your%20website%20and%20I%27m%20interested%20in%20more%20information%20about%20your%20services.%20Thank%20you"
                        target="_blank" class="item">
                        <i class="fa-solid fa-mobile-screen-button"></i>
                        Whatsapp: +1 (214) 734-2383
                    </a>
                    <a href="tel:+12147342383" class="item">
                        <i class="fa-solid fa-phone"></i>
                        Office: +1 (813) 454-2133
                    </a>
                <?php else: ?>
                    <a href="https://wa.me/2147342383?text=%C2%A1Hola%21%20Me%20pongo%20en%20contacto%20desde%20su%20sitio%20web%20y%20estoy%20interesado%2Fa%20en%20m%C3%A1s%20informaci%C3%B3n%20sobre%20sus%20servicios.%20Gracias"
                        target="_blank" class="item">
                        <i class="fa-solid fa-mobile-screen-button"></i>
                        Whatsapp: +1 (214) 734-2383
                    </a>
                    <a href="tel:+12147342383" class="item">
                        <i class="fa-solid fa-phone"></i>
                        Oficina: +1 (813) 454-2133
                    </a>
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