<?php

namespace App\Repositories;

use App\Core\App;
use App\Core\Database;
use App\Core\Helpers\Str;
use Exception;

class Repository
{
    protected Database $db;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    protected function toModel(array $data, string $model): object
    {
        $object = new $model();

        foreach ($data as $field => $value) {
            $object->{"set" . Str::toCamelCase($field)}($value);
        }

        return $object;
    }

    protected function arrayToModels(array $data, string $model): array
    {
        $result = [];

        foreach ($data as $element) {
            $result[] = $this->toModel($element, $model);
        }

        return $result;
    }
}