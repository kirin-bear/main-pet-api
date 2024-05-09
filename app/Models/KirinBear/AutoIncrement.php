<?php

declare(strict_types=1);

namespace App\Models\KirinBear;
use App\Models\AbstractModel;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Просто таблица с автоинкрементами
 *
 * @property int $id - инкремент
 * @property Carbon $createdAt - дата создания инкремента
 * @property string $created_at
 * @method static Builder|AutoIncrement newModelQuery()
 * @method static Builder|AutoIncrement newQuery()
 * @method static Builder|AutoIncrement query()
 * @method static Builder|AutoIncrement whereCreatedAt($value)
 * @method static Builder|AutoIncrement whereId($value)
 * @mixin Eloquent
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
