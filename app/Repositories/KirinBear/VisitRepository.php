<?php

declare(strict_types=1);

namespace App\Repositories\KirinBear;

use App\Models\KirinBear\Visit;
use App\Repositories\AbstractRepository;

/**
 * @method Visit getEntity()
 */
class VisitRepository extends AbstractRepository
{
    protected $entity = Visit::class;

    /**
     * @param Visit $session
     * @return Visit
     */
    public function add(Visit $session): Visit
    {
        $session->save();
        return $session;
    }

}
