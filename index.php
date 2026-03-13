<?php
require_once __DIR__ . '/content_repository.php';

$content = fetch_page_content($mysqli, 'index');

$storyItems = content_json($content, 'story_items', [
    ['date' => 'Mayo, 2013', 'title' => '¿Cómo nos conocimos?', 'description' => 'Nuestros caminos se cruzaron al trabajar juntos en el hospital de Gachetá.', 'image' => 'assets/media/story/s-1.png'],
    ['date' => 'Nov, 2017', 'title' => '¡No era el momento!', 'description' => 'Dios nos puso a prueba y moldeó nuestro corazón por separado.', 'image' => 'assets/media/story/s-2.png'],
    ['date' => 'Junio, 2021', 'title' => '¡Nos volvimos a encontrar!', 'description' => 'En medio de la pandemia comenzó una nueva historia con propósito.', 'image' => 'assets/media/story/s-3.png'],
    ['date' => 'Mayo, 2022', 'title' => 'Él propuso, ella aceptó', 'description' => 'Con nuestras familias vivimos uno de los días más especiales.', 'image' => 'assets/media/story/s-4.png'],
]);

$events = content_json($content, 'events_items', [
    ['title' => 'Ceremonia', 'date' => 'Sábado 14 de dic, 2024', 'time' => '11:00 AM', 'place' => 'Finca Villa Isa, Chinauta', 'address' => 'km 65 vía a melgar'],
    ['title' => 'Recepción', 'date' => 'Sábado 14 de dic, 2024', 'time' => '3:00 PM - 9:00 PM', 'place' => 'Finca Villa Isa, Chinauta', 'address' => 'km 65 vía a melgar'],
]);

$galleryImages = gallery_images_from_repository($content);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= htmlspecialchars(content_value($content, 'meta_title', 'BENDECIDO')) ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/media/favicon-light.png">
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/slick.css">
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="assets/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body class="ui-smooth-scroll">
<div id="preloader"><div class="contain"><div class="loader"><span></span><span></span><span></span></div><div class="shadow"></div></div></div>
<a title="subir" href="#main-wrapper" id="backto-top" class="back-to-top"><i class="fas fa-angle-up"></i></a>
<div id="main-wrapper" class="main-wrapper overflow-hidden">
    <div id="scroll-container">
    <header class="large-screens">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg">
                <div class="collapse navbar-collapse justify-content-between" id="mynavbar-3">
                    <div class="col-lg-5"><ul class="navbar-nav mainmenu"><li class="menu-item"><a href="#about">NOSOTROS</a></li><li class="menu-item"><a href="#story">HISTORIA</a></li><li class="menu-item"><a href="#gallery">GALERÍA</a></li></ul></div>
                    <div class="col-lg-2"><div class="text-center"><a class="navbar-brand" href="index.php"><img alt="logo" src="<?= htmlspecialchars(content_value($content, 'logo_image', 'assets/media/logo.png')) ?>"></a></div></div>
                    <div class="col-lg-5"><ul class="navbar-nav mainmenu justify-content-end"><li class="menu-item"><a href="#rspv">RESERVACIÓN</a></li><li class="menu-item"><a href="#events">EVENTOS</a></li><li class="menu-item"><a href="invitation.php">INVITACIÓN</a></li></ul></div>
                </div>
            </nav>
        </div>
    </header>

    <section class="hero-banner">
        <div class="main">
            <div class="circle-img left"><img src="assets/media/banner/banner-img-1.png" alt=""></div>
            <h1 class="title"><?= nl2br(htmlspecialchars(content_value($content, 'hero_title', '"Dios, Tú y Yo, Por Siempre"'))) ?></h1>
            <div class="circle-img right"><img src="assets/media/banner/banner-img-2.png" alt=""></div>
        </div>
        <div class="detail-block"><h3><?= htmlspecialchars(content_value($content, 'hero_subtitle', 'Nuestra Boda')) ?></h3><p><?= htmlspecialchars(content_value($content, 'hero_description', 'Con la bendición de Dios y nuestras familias.')) ?></p></div>
        <div class="date"><h3><?= htmlspecialchars(content_value($content, 'hero_date_label', 'El día esperado')) ?></h3><h3><?= htmlspecialchars(content_value($content, 'hero_date_value', 'Dic 14, 2024')) ?></h3></div>
    </section>

    <section id="about" class="pb-80"><div class="container-fluid"><div class="heading-block"><div class="content-block"><h4>Acerca de</h4><h3>Nosotros</h3></div></div><div class="content"><img src="<?= htmlspecialchars(content_value($content, 'about_groom_image', 'assets/media/about/grrom.png')) ?>" alt="" class="groom-img"><div class="text"><div class="groom-text"><h3><?= htmlspecialchars(content_value($content, 'groom_name', 'Iván Dario')) ?></h3><p><?= htmlspecialchars(content_value($content, 'groom_description', 'Nació en Bogotá el 28/09/1983.')) ?></p></div><div class="bride-text"><h3><?= htmlspecialchars(content_value($content, 'bride_name', 'Diana Milena')) ?></h3><p><?= htmlspecialchars(content_value($content, 'bride_description', 'Nació en Bogotá el 10/11/1990.')) ?></p></div></div><img src="<?= htmlspecialchars(content_value($content, 'about_bride_image', 'assets/media/about/bride.png')) ?>" alt="" class="bride-img"></div></div></section>

    <section id="story"><div class="container-fluid"><div class="heading-block"><div class="content-block"><h4>NUESTRA</h4><h3>HISTORIA</h3></div></div><div class="story"><div class="content">
    <?php foreach ($storyItems as $idx => $item): ?>
        <div class="block <?= $idx % 2 === 1 ? 'st-2' : '' ?>">
            <img src="assets/media/icons/heart.png" alt="" class="heart-icon">
            <div class="row">
                <div class="col-md-6 <?= $idx % 2 === 1 ? 'order-md-2' : '' ?>"><img src="<?= htmlspecialchars($item['image'] ?? '') ?>" alt="" class="block-img"></div>
                <div class="col-md-6 <?= $idx % 2 === 1 ? 'order-md-1' : '' ?>"><div class="text-block"><h6><?= htmlspecialchars($item['date'] ?? '') ?></h6><h4><?= htmlspecialchars($item['title'] ?? '') ?></h4><p><?= htmlspecialchars($item['description'] ?? '') ?></p></div></div>
            </div>
        </div>
    <?php endforeach; ?>
    </div></div></div></section>

    <section class="gallery p-80" id="gallery"><div class="container-fluid"><div id="carouselExample" class="carousel slide" data-bs-ride="carousel"><div class="carousel-inner">
    <?php foreach ($galleryImages as $index => $image): ?>
        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>"><img src="<?= htmlspecialchars($image) ?>" class="d-block w-100" alt="Imagen <?= $index + 1 ?>" style="object-fit:cover;height:500px"></div>
    <?php endforeach; ?>
    </div><button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev"><span class="carousel-control-prev-icon"></span></button><button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next"><span class="carousel-control-next-icon"></span></button></div></div></section>

    <section id="rspv" class="reservation"><div class="content-block"><h3 class="mb-8"><?= htmlspecialchars(content_value($content, 'rsvp_heading', '¿Asistirás?')) ?></h3><p class="mb-32"><?= htmlspecialchars(content_value($content, 'rsvp_description', 'Por favor confirmar.')) ?></p><form action="reservar.php" method="POST"><input class="mb-24 form-control" type="text" name="name" required placeholder="Nombre"><input class="mb-24 form-control" type="text" name="phone" required placeholder="Teléfono"><input class="mb-24 form-control" type="number" name="Number_Of_Guests" min="1" value="1" required><select class="mb-24 form-control" name="Meal_Preferences" required><option value="No">No requiere hospedaje</option><option value="Sí">Sí requiere hospedaje</option></select><select class="mb-24 form-control" name="attendance" required><option value="1">Confirmo asistencia</option><option value="0">No podré asistir</option></select><button class="cus-btn dark" type="submit">Enviar</button></form></div></section>

    <section id="events" class="events-slider">
        <?php foreach ($events as $event): ?>
            <div class="item"><div class="container-fluid"><div class="row"><div class="col-xl-4 col-lg-5 col-md-6 col-sm-8"><div class="slide-content-block"><h4 class="mb-48"><?= htmlspecialchars($event['title'] ?? '') ?></h4><h6 class="mb-16"><?= htmlspecialchars($event['date'] ?? '') ?></h6><h6 class="mb-24"><?= htmlspecialchars($event['time'] ?? '') ?></h6><h6 class="mb-24"><?= htmlspecialchars($event['place'] ?? '') ?></h6><h6 class="mb-48"><?= htmlspecialchars($event['address'] ?? '') ?></h6></div></div></div></div></div>
        <?php endforeach; ?>
    </section>

    <section class="footer"><div class="container-fluid"><a href="index.php"><img src="<?= htmlspecialchars(content_value($content, 'logo_image', 'assets/media/logo.png')) ?>" alt="" class="logo"></a><h2><?= htmlspecialchars(content_value($content, 'footer_text', 'Thank You')) ?></h2></div></section>
    </div>
</div>
<script src="assets/js/vendor/jquery-3.6.3.min.js"></script>
<script src="assets/js/vendor/bootstrap.min.js"></script>
<script src="assets/js/vendor/jquery.countdown.min.js"></script>
<script src="assets/js/vendor/slick.min.js"></script>
<script src="assets/js/vendor/smoothscroll.js"></script>
<script src="assets/js/vendor/jquery-appear.js"></script>
<script src="assets/js/vendor/smooth-scrollbar.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
