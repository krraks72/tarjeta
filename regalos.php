<?php
require_once __DIR__ . '/content_repository.php';
$content = fetch_page_content($mysqli, 'regalos');
$giftItems = content_json($content, 'gift_items', [
    ['id' => '1', 'name' => 'Licuadora'],
    ['id' => '2', 'name' => 'Juego de vajilla'],
]);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= htmlspecialchars(content_value($content, 'meta_title', 'Regalos')) ?></title>
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
    <h1 class="mb-32"><?= htmlspecialchars(content_value($content, 'title', 'Selección de obsequios')) ?></h1>
    <p class="mb-32"><?= htmlspecialchars(content_value($content, 'delivery_address', 'Dirección de entrega: AK 50 # 39A - 38 SUR')) ?></p>
    <form action="#" method="post">
        <input type="text" class="form-control mb-24" name="guest_name" placeholder="Nombre Invitado" required>
        <select class="form-control mb-24" name="gift_item" required>
            <?php foreach ($giftItems as $gift): ?>
                <option value="<?= htmlspecialchars((string) ($gift['id'] ?? '')) ?>"><?= htmlspecialchars((string) ($gift['name'] ?? '')) ?></option>
            <?php endforeach; ?>
        </select>
        <button class="cus-btn dark" type="submit">Guardar</button>
    </form>
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
