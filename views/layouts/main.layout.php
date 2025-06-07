<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<?php partial('layouts/partials/auth/navbar.layout') ?>

<main class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <?php partial('layouts/partials/auth/flash-message.layout') ?>
        <?php partial('layouts/partials/auth/errors.layout') ?>

        <div class="bg-white p-6 rounded shadow">
            <?= $slot ?>
        </div>
    </div>
</main>

</body>
</html>
