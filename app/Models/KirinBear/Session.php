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
 * @method static Builder|Session newModelQuery()
 * @method static Builder|Session newQuery()
 * @method static Builder|Session query()
 * @method static Builder|Session whereBrowser($value)
 * @method static Builder|Session whereBrowserVersion($value)
 * @method static Builder|Session whereCreatedAt($value)
 * @method static Builder|Session whereDevice($value)
 * @method static Builder|Session whereDeviceName($value)
 * @method static Builder|Session whereId($value)
 * @method static Builder|Session wherePage($value)
 * @method static Builder|Session wherePlatform($value)
 * @method static Builder|Session wherePlatformVersion($value)
 * @method static Builder|Session whereReferer($value)
 * @method static Builder|Session whereRobot($value)
 * @method static Builder|Session whereUserAgent($value)
 *
 * @mixin Eloquent
 */
class Session extends AbstractModel
{
    protected $connection = 'mysql';

    protected $table = 'sessions';

    public const UPDATED_AT = false;
}
