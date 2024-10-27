<?php
include_once "./panel/cms.php";
$content = CMS::get_content(6);

$lan = "en";
if (isset($_COOKIE['lan'])) {
    $lan = $_COOKIE['lan'];
}

$contacts = $content[$lan];
$background = $content['background'];
?>

<style>
    #contact {
        background-image: url('<?= $background[0] ?>');
        background-size: cover;
    }

    @media (max-width: 1024px) {
        #contact {
            background-image: url('<?= $background[1] ?>');
        }
    }

    @media (max-width: 640px) {
        #contact {
            background-image: url('<?= $background[2] ?>');
        }
    }
</style>

<div id="contact" class="section contact">
    <div class="section-content">
        <div class="contact-info">
            <?php if ($lan == "en"): ?>
                <h2>Contact Us</h2>
            <?php else: ?>
                <h2>Contactános</h2>
            <?php endif; ?>
            <?php foreach ($contacts as $contact): ?>
                <div class="item">
                    <img src="<?= $contact['image'][0] ?>" alt="">
                    <p><?= $contact['text'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div id="info-collapse" class="contact-info-collapse">
            <div class="collapse-info-button" onclick="showInfoCollapse()">
                <?php if ($lan == "en"): ?>
                    <h2>Contact Us</h2>
                <?php else: ?>
                    <h2>Contactános <i class="fa-solid fa-chevron-down"></i></h2>
                <?php endif; ?>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="collapse-info">
                <?php foreach ($contacts as $contact): ?>
                    <div class="item">
                        <img src="<?= $contact['image'][0] ?>" alt="">
                        <p><?= $contact['text'] ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="contact-form">
            <div class="form">
                <?php if ($lan == "en"): ?>
                    <h2>Get in touch</h2>
                    <div id="input-container-name" class="flotating-input">
                        <label for="name">Your name</label>
                        <input type="text" name="name" id="name" onfocus="flotatingFocus('name')" onblur="unfocus('name')">
                    </div>
                    <div id="input-container-phone" class="flotating-input">
                        <label for="phone">Your phone</label>
                        <input type="tel" name="phone" id="phone" onfocus="flotatingFocus('phone')" onblur="unfocus('phone')">
                    </div>
                    <div id="input-container-email" class="flotating-input">
                        <label for="email">Your email</label>
                        <input type="email" name="email" id="email" onfocus="flotatingFocus('email')" onblur="unfocus('email')">
                    </div>
                    <div id="input-container-message" class="flotating-input">
                        <label for="message">Your message</label>
                        <textarea name="message" id="message" rows="6" onfocus="flotatingFocus('message')" onblur="unfocus('message')"></textarea>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="terms" id="terms">
                        <label for="terms">
                            I have read and accept the <a href="#">Privacy Notice</a> and the <a href="#">Terms And Conditions</a> of this website.
                        </label>
                    </div>
                    <button>Send</button>
                <?php else: ?>
                    <h2>Ponte en contacto</h2>
                    <div id="input-container-name" class="flotating-input">
                        <label for="name">Tu nombre</label>
                        <input type="text" name="name" id="name" onfocus="flotatingFocus('name')" onblur="unfocus('name')">
                    </div>
                    <div id="input-container-phone" class="flotating-input">
                        <label for="phone">Tu teléfono</label>
                        <input type="tel" name="phone" id="phone" onfocus="flotatingFocus('phone')" onblur="unfocus('phone')">
                    </div>
                    <div id="input-container-email" class="flotating-input">
                        <label for="email">Tu correo electrónico</label>
                        <input type="email" name="email" id="email" onfocus="flotatingFocus('email')" onblur="unfocus('email')">
                    </div>
                    <div id="input-container-message" class="flotating-input">
                        <label for="message">Tu mensaje</label>
                        <textarea name="message" id="message" rows="6" onfocus="flotatingFocus('message')" onblur="unfocus('message')"></textarea>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" name="terms" id="terms">
                        <label for="terms">
                            He leído y acepto el <a href="#">Aviso de Privacidad</a> y los <a href="#">Terminos y Condiciones</a> de este sitio web.
                        </label>
                    </div>
                    <button>Enviar</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    var infoCollapse = true

    function flotatingFocus(id) {
        document.getElementById(`input-container-${id}`).classList.add("focus")
    }

    function unfocus(id) {
        if (document.getElementById(id).value.trim() == "") {
            document.getElementById(`input-container-${id}`).classList.remove("focus")
        }
    }

    function showInfoCollapse() {
        if (infoCollapse) {
            document.getElementById("info-collapse").classList.add('show')
        } else {
            document.getElementById("info-collapse").classList.remove('show')
        }

        infoCollapse = !infoCollapse
    }
</script>