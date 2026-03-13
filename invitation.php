<?php
require_once __DIR__ . '/content_repository.php';
$content = fetch_page_content($mysqli, 'invitation');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= htmlspecialchars(content_value($content, 'meta_title', 'Invitación')) ?></title>
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/slick.css">
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="assets/css/vendor/slick-theme.css">
    <link rel="stylesheet" href="assets/css/app.css">
</head>
<body class="ui-smooth-scroll">
<div id="preloader"><div class="contain"><div class="loader"><span></span><span></span><span></span></div><div class="shadow"></div></div></div>
<a href="#main-wrapper" id="backto-top" class="back-to-top"><i class="fas fa-angle-up"></i></a>
<div id="main-wrapper" class="main-wrapper overflow-hidden"><div id="scroll-container">
<section class="invitation"><div class="content-block">
    <h1 class="mb-32"><?= htmlspecialchars(content_value($content, 'couple_names', 'Iván y Diana')) ?></h1>
    <h6 class="mb-24"><?= htmlspecialchars(content_value($content, 'line_1', 'Tenemos el placer de invitarle(s)')) ?></h6>
    <h5 class="mb-24 text"><?= htmlspecialchars(content_value($content, 'line_2', 'A la celebración de nuestra Boda')) ?></h5>
    <h3 class="mb-24"><?= htmlspecialchars(content_value($content, 'event_date', 'Dic, 14 de 2024')) ?></h3>
    <h6 class="mb-32 address"><?= htmlspecialchars(content_value($content, 'event_address', 'Finca Villa Isa, Chinauta, km 65 vía a melgar')) ?></h6>
    <a href="index.php#rspv" class="cus-btn light">Reservación</a>
</div></section>
</div></div>
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
