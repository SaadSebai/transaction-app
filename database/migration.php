<?php

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . '/vendor/autoload.php';
require BASE_PATH . 'app/Core/Helpers/functions.php';
require BASE_PATH . '/bootstrap.php';

use App\Core\App;
use App\Core\Database;

try {
    // Get the database instance from container
    $db = App::resolve(Database::class);

    // Migrations
    $migrationsPath = BASE_PATH . 'database/migrations';
    $migrationFiles = glob($migrationsPath . '/*.php');

    sort($migrationFiles);

    foreach ($migrationFiles as $file) {
        $migration = require $file;

        if (is_callable($migration)) {
            $migration($db);
            echo "Executed: " . basename($file) . "\n";
        }
    }

    // Seeders
    $seedersPath = BASE_PATH . 'database/seeders';
    $seederFile = glob($seedersPath . '/*.php');

    foreach ($seederFile as $file) {
        $seeder = require $file;

        if (is_callable($seeder)) {
            $seeder($db);
            echo "Executed: " . basename($file) . "\n";
        }
    }


    echo "MySQL tables created or already exist.\n";

} catch (PDOException|Exception $e) {
    echo "Database error: " . $e->getMessage() . "\n";
    exit(1);
}
