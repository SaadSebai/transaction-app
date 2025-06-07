<?php

use App\Core\App;
use App\Core\Config;
use App\Core\Exceptions\ValidationException;
use App\Core\Helpers\ResponseStatus;
use App\Core\Router;
use App\Core\Session;

const BASE_PATH = __DIR__.'/../';

// Init App
require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . 'app/Core/Helpers/functions.php';
require BASE_PATH . 'bootstrap.php';
require BASE_PATH . 'app/Core/header.php';

// Router
$router = new Router();
require BASE_PATH . 'routes.php';

Session::start();

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
}
catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    redirect($router->previousUrl());
}
catch (Exception $exception) {
    $config = App::resolve(Config::class);
    if($config->getConfig('production')) abort(ResponseStatus::SERVER_ERROR);
}

register_shutdown_function(function () {
    Session::unflash();
});