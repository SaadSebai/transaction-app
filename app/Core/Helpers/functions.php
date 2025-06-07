<?php

use App\Core\Helpers\ResponseStatus;
use App\Core\Session;
use JetBrains\PhpStorm\NoReturn;

#[NoReturn]
function dd(mixed $value): void
{
    $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1] ?? null;

    echo "<pre style='background:#f5f5f5;padding:10px;border-left:5px solid #ccc;'>";

    if ($backtrace) {
        $class = $backtrace['class'] ?? '';
        $line = $backtrace['line'] ?? '';

        echo "$class line $line\n\n";
    }

    var_dump($value);
    echo "</pre>";

    die();
}

function base_path(string $path): string
{
    return BASE_PATH . $path;
}

#[NoReturn]
function redirect(string $path): void
{
    header("location: {$path}");
    exit();
}

function view(string $path, array $attributes = [], ?string $layout = null): bool
{
    extract($attributes);

    if ($layout)
    {
        ob_start();
        require base_path("views/{$path}.view.php");
        $slot = ob_get_clean();

        require base_path("views/layouts/$layout.php");
    }
    else
    {
        require base_path("views/{$path}.view.php");
    }

    return true;
}

function partial(string $path): void
{
    require base_path("views/$path.php");
}

function old(string $key, ?string $default = ''): string
{
    $value = Session::get('old')[$key] ?? $default;
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

#[NoReturn]
function abort($code = ResponseStatus::NOT_FOUND): void
{
    http_response_code($code);

    view(path: "default/{$code}");

    die();
}