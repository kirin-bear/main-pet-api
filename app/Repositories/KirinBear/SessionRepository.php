<?php

declare(strict_types=1);

namespace App\Repositories\KirinBear;

use App\Models\KirinBear\Session;
use App\Repositories\AbstractRepository;

/**
 * @method Session getEntity()
 */
class SessionRepository extends AbstractRepository
{
    protected $entity = Session::class;

    /**
     * @param Session $session
     * @return Session
     */
    public function add(Session $session): Session
    {
        $session->save();
        return $session;
    }

}
