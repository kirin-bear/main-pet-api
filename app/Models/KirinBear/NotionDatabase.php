<?php

declare(strict_types=1);

namespace App\Models\KirinBear;

use App\Models\AbstractModel;
use DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\KirinBear\NotionDatabase
 *
 * @property string $uuid
 * @property string $title
 * @property int $user_id
 * @property string $parent_uuid
 * @property string $parent_type
 * @property string $url
 * @property mixed $raw_data
 * @property int $in_trash
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NotionDatabase newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotionDatabase newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotionDatabase query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotionDatabase whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionDatabase whereInTrash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionDatabase whereParentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionDatabase whereParentUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionDatabase whereRawData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionDatabase whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionDatabase whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionDatabase whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionDatabase whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionDatabase whereUuid($value)
 * @mixin \Eloquent
 */
class NotionDatabase extends AbstractModel
{
    use SoftDeletes;

    public const FIELD_NAME_UUID = 'uuid';

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

}
