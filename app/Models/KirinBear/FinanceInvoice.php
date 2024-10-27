<?php

declare(strict_types=1);

namespace App\Models\KirinBear;

use App\Models\AbstractModel;
use Barryvdh\LaravelIdeHelper\Eloquent;
use DateTimeInterface;


/**
 * App\Models\KirinBear\FinanceInvoice
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $from
 * @property string $till
 * @property int $total
 * @property int $user_id
 * @property string $hash Для уникального ключа, внутри себя будет содержать значения из остальных колонок, чтобы не плодить 1 большой индекс
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceInvoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceInvoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceInvoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceInvoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceInvoice whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceInvoice whereHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceInvoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceInvoice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceInvoice whereTill($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceInvoice whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceInvoice whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceInvoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FinanceInvoice whereUserId($value)
 * @mixin Eloquent
 */
class FinanceInvoice extends AbstractModel
{

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

}
