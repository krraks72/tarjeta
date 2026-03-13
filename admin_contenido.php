<?php
require_once __DIR__ . '/content_repository.php';

$mensaje = '';
$selectedPage = trim($_POST['page_name'] ?? '');
$selectedKey = trim($_POST['content_key'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['save_content'])) {
        $page = trim($_POST['page_name'] ?? '');
        $key = trim($_POST['content_key'] ?? '');
        $customKey = trim($_POST['content_key_custom'] ?? '');
        $value = trim($_POST['content_value'] ?? '');

        if ($key === '__new__') {
            $key = $customKey;
        }

        if ($page !== '' && $key !== '') {
            $stmt = $mysqli->prepare('INSERT INTO site_content(page_name, content_key, content_value) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE content_value = VALUES(content_value)');
            $stmt->bind_param('sss', $page, $key, $value);
            $stmt->execute();
            $stmt->close();
            $mensaje = 'Contenido guardado correctamente.';
            $selectedPage = $page;
            $selectedKey = $key;
        } else {
            $mensaje = 'Seleccione una página y una clave válida.';
        }
    }

    if (isset($_POST['upload_image']) && isset($_FILES['gallery_image'])) {
        $uploadDir = __DIR__ . '/assets/media/gallery/fotos/';
        $name = basename($_FILES['gallery_image']['name']);
        if ($name !== '') {
            move_uploaded_file($_FILES['gallery_image']['tmp_name'], $uploadDir . $name);
            $mensaje = 'Imagen cargada en el repositorio local.';
        }
    }
}

$allPairsResult = $mysqli->query('SELECT page_name, content_key FROM site_content ORDER BY page_name, content_key');
$pageMap = [];
while ($pair = $allPairsResult->fetch_assoc()) {
    $pageName = $pair['page_name'];
    $keyName = $pair['content_key'];
    if (!isset($pageMap[$pageName])) {
        $pageMap[$pageName] = [];
    }
    $pageMap[$pageName][] = $keyName;
}

if ($selectedPage === '' && !empty($pageMap)) {
    $selectedPage = array_key_first($pageMap);
}

$rows = $mysqli->query('SELECT id, page_name, content_key, content_value, updated_at FROM site_content ORDER BY page_name, content_key');
$images = glob(__DIR__ . '/assets/media/gallery/fotos/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE) ?: [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración de Contenido</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-bold mb-6">Administración dinámica del sitio</h1>
    <a class="text-blue-700 underline" href="admin.php">← Volver a RSVP</a>

    <?php if ($mensaje !== ''): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4 mb-4"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-6">
        <form method="post" class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Editar textos e imágenes (BD)</h2>

            <label class="block text-sm font-medium mb-1" for="page_name">page_name</label>
            <select id="page_name" name="page_name" class="w-full border p-2 mb-3" required>
                <?php foreach ($pageMap as $pageName => $keys): ?>
                    <option value="<?= htmlspecialchars($pageName) ?>" <?= $selectedPage === $pageName ? 'selected' : '' ?>><?= htmlspecialchars($pageName) ?></option>
                <?php endforeach; ?>
            </select>

            <label class="block text-sm font-medium mb-1" for="content_key">content_key</label>
            <select id="content_key" name="content_key" class="w-full border p-2 mb-3" required></select>

            <div id="new-key-wrapper" class="hidden">
                <label class="block text-sm font-medium mb-1" for="content_key_custom">Nueva clave</label>
                <input id="content_key_custom" class="w-full border p-2 mb-3" name="content_key_custom" placeholder="ej: hero_title">
            </div>

            <textarea class="w-full border p-2 mb-3" name="content_value" rows="5" placeholder="Nuevo valor"></textarea>
            <button class="bg-blue-600 text-white px-4 py-2 rounded" name="save_content" value="1">Guardar contenido</button>
        </form>

        <form method="post" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Subir imagen al repositorio</h2>
            <input class="w-full border p-2 mb-3" type="file" name="gallery_image" accept="image/*" required>
            <button class="bg-purple-600 text-white px-4 py-2 rounded" name="upload_image" value="1">Subir imagen</button>
        </form>
    </div>

    <div class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-4">Contenido actual (site_content)</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead><tr class="text-left border-b"><th class="p-2">Página</th><th class="p-2">Clave</th><th class="p-2">Valor</th><th class="p-2">Actualizado</th></tr></thead>
                <tbody>
                <?php while ($row = $rows->fetch_assoc()): ?>
                    <tr class="border-b align-top"><td class="p-2"><?= htmlspecialchars($row['page_name']) ?></td><td class="p-2"><?= htmlspecialchars($row['content_key']) ?></td><td class="p-2 break-all"><?= htmlspecialchars($row['content_value']) ?></td><td class="p-2"><?= htmlspecialchars($row['updated_at']) ?></td></tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Repositorio de imágenes</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
            <?php foreach ($images as $img): $public = 'assets/media/gallery/fotos/' . basename($img); ?>
                <img src="<?= htmlspecialchars($public) ?>" class="w-full h-24 object-cover rounded" alt="img">
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
const pageMap = <?= json_encode($pageMap, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
const selectedPage = <?= json_encode($selectedPage, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
const selectedKey = <?= json_encode($selectedKey, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;

const pageSelect = document.getElementById('page_name');
const keySelect = document.getElementById('content_key');
const newKeyWrapper = document.getElementById('new-key-wrapper');
const newKeyInput = document.getElementById('content_key_custom');

function toggleNewKeyInput() {
    const isNew = keySelect.value === '__new__';
    newKeyWrapper.classList.toggle('hidden', !isNew);
    newKeyInput.required = isNew;
}

function renderKeyOptions(page, preferredKey = '') {
    keySelect.innerHTML = '';
    const keys = pageMap[page] || [];

    keys.forEach((keyName) => {
        const option = document.createElement('option');
        option.value = keyName;
        option.textContent = keyName;
        if (preferredKey && preferredKey === keyName) {
            option.selected = true;
        }
        keySelect.appendChild(option);
    });

    const newOption = document.createElement('option');
    newOption.value = '__new__';
    newOption.textContent = '➕ Crear nueva clave';
    if (preferredKey && !keys.includes(preferredKey)) {
        newOption.selected = true;
        newKeyInput.value = preferredKey;
    }
    keySelect.appendChild(newOption);

    toggleNewKeyInput();
}

if (selectedPage && pageMap[selectedPage]) {
    pageSelect.value = selectedPage;
}

renderKeyOptions(pageSelect.value, selectedKey);

pageSelect.addEventListener('change', () => {
    renderKeyOptions(pageSelect.value);
});

keySelect.addEventListener('change', toggleNewKeyInput);
</script>
</body>
</html>
