<?php

declare(strict_types=1);

namespace App\UseCases\User;

use App\Repositories\KirinBear\NotionDatabaseRepository;
use App\Repositories\KirinBear\NotionPageRepository;
use App\UseCases\User\Dto\User;

class UserInformationGetUseCase
{
    private NotionDatabaseRepository $notionDatabaseRepository;
    private NotionPageRepository $notionPageRepository;

    public function __construct(NotionDatabaseRepository $notionDatabaseRepository, NotionPageRepository $notionPageRepository)
    {
        $this->notionDatabaseRepository = $notionDatabaseRepository;
        $this->notionPageRepository = $notionPageRepository;
    }

    /**
     * @param \App\Models\KirinBear\User $user
     *
     * @return User
     */
    public function execute(\App\Models\KirinBear\User $user): User
    {
        return new User(
            $user->id,
            $user->email,
            $this->notionDatabaseRepository->getCountByUserId($user->id),
            $this->notionPageRepository->getCountByUserId($user->id),
        );
    }

}
