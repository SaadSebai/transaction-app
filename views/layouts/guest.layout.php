<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-200 min-h-screen flex items-center justify-center">

<div class="bg-gray-100 p-8 rounded-lg shadow-md w-full max-w-md">
    <?= $slot ?>
</div>

</body>
</html>
