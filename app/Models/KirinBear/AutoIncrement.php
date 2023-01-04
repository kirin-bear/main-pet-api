<?php

declare(strict_types=1);

namespace App\Models\KirinBear;
use App\Models\AbstractModel;
use Carbon\Carbon;

/**
 * Просто таблица с автоинкрементами
 *
 * @property int $id - инкремент
 * @property Carbon $createdAt - дата создания инкремента
 */
class AutoIncrement extends AbstractModel
{
    protected $connection = 'mysql';

    protected $table = 'auto_increments';

    public $timestamps = false;

    public function getCreatedAt(): Carbon
    {
        return Carbon::createFromTimeString($this->getCreatedAtColumn());
    }
}