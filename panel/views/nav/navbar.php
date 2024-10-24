<?php

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 3));
$dotenv->load();

$domain = $_ENV["DOMAIN"];
?>

<nav>
    <div class="brand">
        <h2>JLF Metal Gates</h2>
    </div>
    <ul>
        <li><a href="/panel/contact">Contactos</a></li>
        <li>
            <div class="dropdown">
                <button>CMS <i class="fa-solid fa-caret-down"></i></button>
                <div class="dropdown-content">
                    <a href="<?= $domain ?>/panel/cms/home">Inicio</a>
                    <a href="<?= $domain ?>/panel/cms/solutions">Soluciones</a>
                    <a href="<?= $domain ?>/panel/cms/about">Sobre Nosotros</a>
                    <a href="<?= $domain ?>/panel/cms/gallery">Galería</a>
                    <a href="<?= $domain ?>/panel/cms/contact">Contacto</a>
                </div>
            </div>
        </li>
    </ul>
    <div class="user">
        <div class="dropdown">
            <button>
                <i class="fa-solid fa-user"></i> <i class="fa-solid fa-caret-down"></i>
            </button>
            <div class="dropdown-content left">
                <a href="<?= $domain ?>/panel/user/profile">Perfil</a>
                <a href="<?= $domain ?>/panel/user/logout">Cerrar Sesión</a>
            </div>
        </div>
    </div>
    <button class="collapse-menu-button">
        <i class="fa-solid fa-bars"></i>
    </button>
</nav>