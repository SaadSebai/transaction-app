<?php

use App\Core\App;
use App\Core\Config;
use App\Core\Container;
use App\Core\Database;

$container = new Container();

$container->bind(Database::class, function () {
    $config = require base_path('config/database.php');

    return new Database($config);
});

$container->bind(Config::class, function () {
    $config = require base_path('config/app.php');

    return new Config($config);
});

App::setContainer($container);
