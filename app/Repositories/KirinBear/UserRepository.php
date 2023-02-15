<?php

declare(strict_types=1);

namespace App\Repositories\KirinBear;

use App\Models\KirinBear\User;
use App\Repositories\AbstractRepository;

/**
 * @method User getWhereFirst
 */
class UserRepository extends AbstractRepository
{
    protected $entity = User::class;


    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return $this->getWhereFirst('email', $email);
    }
}
