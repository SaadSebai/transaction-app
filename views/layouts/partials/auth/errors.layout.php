<?php use App\Core\Session;

if (Session::has('errors')) {
    foreach (Session::get('errors') as $error) {
        echo '<p class="text-sm text-red-600 mb-2">' . htmlspecialchars($error) . '</p>';
    }
}