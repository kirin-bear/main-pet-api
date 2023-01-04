<?php

declare(strict_types=1);

namespace App\Repositories\KirinBear;

use App\Models\KirinBear\AutoIncrement;
use App\Repositories\AbstractRepository;

/**
 * @property AutoIncrement $model
 *
 * @method AutoIncrement create($properties)
 */
class AutoIncrementRepository extends AbstractRepository
{
    protected $entity = AutoIncrement::class;

    /**
     * @return AutoIncrement
     */
    public function add(): AutoIncrement
    {
        $autoIncrement = $this->model;
        $autoIncrement->setCreatedAt(date('Y-m-d H:i:s'));
        $autoIncrement->save();

        return $autoIncrement;
    }
}