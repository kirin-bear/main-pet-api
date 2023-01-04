<?php

declare(strict_types=1);

namespace App\Models\KirinBear;

use App\Models\AbstractModel;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\KirinBear\Session
 *
 * @property int $id
 * @property string $page
 * @property string $referer
 * @property string $device
 * @property string $device_name
 * @property string $platform
 * @property string $platform_version
 * @property string $browser
 * @property string $browser_version
 * @property string $robot
 * @property string $user_agent
 * @property Carbon $created_at
 * @method static Builder|Visit newModelQuery()
 * @method static Builder|Visit newQuery()
 * @method static Builder|Visit query()
 * @method static Builder|Visit whereBrowser($value)
 * @method static Builder|Visit whereBrowserVersion($value)
 * @method static Builder|Visit whereCreatedAt($value)
 * @method static Builder|Visit whereDevice($value)
 * @method static Builder|Visit whereDeviceName($value)
 * @method static Builder|Visit whereId($value)
 * @method static Builder|Visit wherePage($value)
 * @method static Builder|Visit wherePlatform($value)
 * @method static Builder|Visit wherePlatformVersion($value)
 * @method static Builder|Visit whereReferer($value)
 * @method static Builder|Visit whereRobot($value)
 * @method static Builder|Visit whereUserAgent($value)
 *
 * @mixin Eloquent
 */
class Visit extends AbstractModel
{
    protected $connection = 'mysql';

    protected $table = 'visits';

    public const UPDATED_AT = null;

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
