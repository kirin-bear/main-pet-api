<?php

declare(strict_types=1);

namespace App\Models\KirinBear;

use App\Models\AbstractModel;
use Barryvdh\LaravelIdeHelper\Eloquent;
use DateTimeInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\KirinBear\NotionPage
 *
 * @property string $uuid
 * @property string $title
 * @property int $user_id
 * @property string $parent_uuid
 * @property string $parent_type
 * @property string $url
 * @property mixed $properties
 * @property mixed $raw_data
 * @property int $in_trash
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage whereInTrash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage whereParentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage whereParentUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage whereRawData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotionPage whereUuid($value)
 * @mixin Eloquent
 */
class NotionPage extends AbstractModel
{
    use SoftDeletes;

    public const FIELD_NAME_UUID = 'uuid';

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
