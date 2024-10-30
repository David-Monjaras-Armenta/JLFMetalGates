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
                <?php
                $href = explode("=", $contact['text']);
                if (count($href) > 1) {
                    $href = $href[0] . "=" . urldecode($href[1]);
                } else {
                    $href = $href[0];
                }
                ?>
                <a href="<?= $href ?>" target="_blank" class="item">
                    <img src="<?= $contact['image'][0] ?>" alt="">
                    <?= $contact['title'] ?>
                </a>
            <?php endforeach; ?>
        </div>
        <div id="info-collapse" class="contact-info-collapse">
            <div class="collapse-info-button" onclick="showInfoCollapse()">
                <?php if ($lan == "en"): ?>
                    <h2>Contact Us</h2>
                <?php else: ?>
                    <h2>Contactános</h2>
                <?php endif; ?>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="collapse-info">
                <?php foreach ($contacts as $contact): ?>
                    <?php
                    $href = explode("=", $contact['text']);
                    if (count($href) > 1) {
                        $href = $href[0] . "=" . urldecode($href[1]);
                    } else {
                        $href = $href[0];
                    }
                    ?>
                    <a href="<?= $href ?>" target="_blank" class="item">
                        <img src="<?= $contact['image'][0] ?>" alt="">
                        <?= $contact['title'] ?>
                    </a>
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
                        <input type="tel" name="phone" id="phone" onfocus="flotatingFocus('phone')"
                            onblur="unfocus('phone')">
                    </div>
                    <div id="input-container-email" class="flotating-input">
                        <label for="email">Your email</label>
                        <input type="email" name="email" id="email" onfocus="flotatingFocus('email')"
                            onblur="unfocus('email')">
                    </div>
                    <div id="input-container-message" class="flotating-input">
                        <label for="message">Your message</label>
                        <textarea name="message" id="message" rows="6" onfocus="flotatingFocus('message')"
                            onblur="unfocus('message')"></textarea>
                    </div>
                    <div id="input-container-terms" class="checkbox">
                        <input type="checkbox" name="terms" id="terms">
                        <label for="terms">
                            I have read and accept the <a href="/privacy-notice.php" target="_blank">Privacy Notice and
                                Terms and Conditions</a> of this website.
                        </label>
                    </div>
                    <button id="btnContact" onclick="saveContact()">
                        <i class="fa-solid fa-circle-notch fa-spin"></i> Send
                    </button>
                <?php else: ?>
                    <h2>Ponte en contacto</h2>
                    <div id="input-container-name" class="flotating-input">
                        <label for="name">Tu nombre</label>
                        <input type="text" name="name" id="name" onfocus="flotatingFocus('name')" onblur="unfocus('name')">
                    </div>
                    <div id="input-container-phone" class="flotating-input">
                        <label for="phone">Tu teléfono</label>
                        <input type="tel" name="phone" id="phone" onfocus="flotatingFocus('phone')"
                            onblur="unfocus('phone')">
                    </div>
                    <div id="input-container-email" class="flotating-input">
                        <label for="email">Tu correo electrónico</label>
                        <input type="email" name="email" id="email" onfocus="flotatingFocus('email')"
                            onblur="unfocus('email')">
                    </div>
                    <div id="input-container-message" class="flotating-input">
                        <label for="message">Tu mensaje</label>
                        <textarea name="message" id="message" rows="6" onfocus="flotatingFocus('message')"
                            onblur="unfocus('message')"></textarea>
                    </div>
                    <div id="checkbox" class="checkbox">
                        <input type="checkbox" name="terms" id="terms">
                        <label for="terms">
                            He leído y acepto el <a href="/aviso-privacidad.html" target="_blank">Aviso de Privacidad y
                                Terminos y Condiciones</a> de este sitio web.
                        </label>
                    </div>
                    <button id="btnContact" onclick="saveContact()">
                        <i class="fa-solid fa-circle-notch fa-spin"></i>Enviar
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div id="notify" class="notify">
    <p id="notify-text"></p>
</div>

<script>
    var infoCollapse = true
    var fetching = false

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

    function showNotify(type, text) {
        document.getElementById('notify-text').innerText = text
        document.getElementById('notify').classList.add(`show`)
        document.getElementById('notify').classList.add(`${type}`)

        setTimeout(() => {
            document.getElementById('notify').classList.remove(`show`)
            document.getElementById('notify').classList.remove(`${type}`)
        }, 5000)
    }

    function validateForm() {
        const name = document.getElementById("name")
        const phone = document.getElementById("phone")
        const email = document.getElementById("email")
        const message = document.getElementById("message")
        const terms = document.getElementById("terms")

        document.getElementById('input-container-name').classList.remove('invalid')
        document.getElementById('input-container-phone').classList.remove('invalid')
        document.getElementById('input-container-email').classList.remove('invalid')
        document.getElementById('input-container-message').classList.remove('invalid')
        document.getElementById('checkbox').classList.remove('invalid')

        var result = true

        if (name.value.trim() == "") {
            document.getElementById('input-container-name').classList.add('invalid')
            result = false
        }

        const phoneRegex = /^\d+$/;
        if (phone.value.trim() == "" || !phoneRegex.test(phone.value)) {
            document.getElementById('input-container-phone').classList.add('invalid')
            result = false
        }

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email.value.trim() == "" || !emailRegex.test(email.value)) {
            document.getElementById('input-container-email').classList.add('invalid')
            result = false
        }

        if (message.value.trim() == "") {
            document.getElementById('input-container-message').classList.add('invalid')
            result = false
        }

        if (!terms.checked) {
            document.getElementById('checkbox').classList.add('invalid')
            result = false
        }

        return result
    }

    function cleanForm() {
        document.getElementById("name").values = ""
        document.getElementById("phone").values = ""
        document.getElementById("email").values = ""
        document.getElementById("message").values = ""
        document.getElementById("terms").checked = false
    }

    function saveContact() {
        if (validateForm() && !fetching) {
            const data = {
                name: document.getElementById("name").value,
                phone: document.getElementById("phone").value,
                email: document.getElementById("email").value,
                message: document.getElementById("message").value
            };

            const urlEncodedData = new URLSearchParams(data).toString();

            document.getElementById('btnContact').classList.add("fetching")
            document.getElementById('btnContact').setAttribute("disable", true)
            fetching = true

            fetch('https://jlfmetalgates.com/panel/apis/contact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: urlEncodedData
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('btnContact').classList.remove("fetching")
                    document.getElementById('btnContact').removeAttribute("disable")
                    fetching = false
                    if (data.status == "success") {
                        <?php if ($lan == "en"): ?>
                            showNotify("success", "We received your message, an advisor will contact you soon.")
                        <?php else: ?>
                            showNotify("success", "Recibimos tu mensaje, pronto un asesor se pondra en contacto contigo")
                        <?php endif; ?>
                    } else {
                        <?php if ($lan == "en"): ?>
                            showNotify("error", "Something went wrong, please try again later or contact technical support.")
                        <?php else: ?>
                            showNotify("error", "Algo salió mal, intentalo de nuevo más tarde o comunicate a soporte técnico")
                        <?php endif; ?>
                    }
                })
                .catch(error => {
                    document.getElementById('btnContact').classList.remove("fetching")
                    document.getElementById('btnContact').removeAttribute("disable")
                    fetching = false
                    <?php if ($lan == "en"): ?>
                        showNotify("error", "Something went wrong, please try again later or contact technical support.")
                    <?php else: ?>
                        showNotify("error", "Algo salió mal, intentalo de nuevo más tarde o comunicate a soporte técnico")
                    <?php endif; ?>
                });
        }
    }
</script>