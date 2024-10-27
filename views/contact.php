<?php
include_once "./panel/cms.php";
$content = CMS::get_content(6);

$lan = "en";
if (isset($_COOKIE['lan'])) {
    $lan = $_COOKIE['lan'];
}

$backgrounds = $content['background'];
?>

<div id="contact" class="section">
    <h2>Contacto</h2>
</div>