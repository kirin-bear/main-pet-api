<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\AutoIncrement;

/**
 * @property AutoIncrement $model
 *
 * @method AutoIncrement create($properties)
 */
class AutoIncrementRepository extends AbstractRepository
{
    protected $entity = AutoIncrement::class;

    public function add(): AutoIncrement
    {
        $autoIncrement = $this->model;
        $autoIncrement->setCreatedAt(date('Y-m-d H:i:s'));
        $autoIncrement->save();

        return $autoIncrement;
    }
}