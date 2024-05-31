<?php

declare(strict_types=1);

namespace App\Models\KirinBear;

use App\Models\AbstractModel;
use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\KirinBear\AlisaWebhook
 *
 * @property int $id
 * @property string $session_id
 * @property string $skill_id
 * @property string $user_id
 * @property string $application_id
 * @property mixed $request
 * @property mixed $response
 * @property Carbon $created_at
 * @method static Builder|AlisaWebhook newModelQuery()
 * @method static Builder|AlisaWebhook newQuery()
 * @method static Builder|AlisaWebhook query()
 * @method static Builder|AlisaWebhook whereResponse($value)
 * @method static Builder|AlisaWebhook whereApplicationId($value)
 * @method static Builder|AlisaWebhook whereCreatedAt($value)
 * @method static Builder|AlisaWebhook whereId($value)
 * @method static Builder|AlisaWebhook whereRequest($value)
 * @method static Builder|AlisaWebhook whereSessionId($value)
 * @method static Builder|AlisaWebhook whereSkillId($value)
 * @method static Builder|AlisaWebhook whereUserId($value)
 * @mixin Eloquent
 */
class AlisaWebhook extends AbstractModel
{
    public const UPDATED_AT = null;
}
