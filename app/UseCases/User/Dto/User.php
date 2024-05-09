<?php

declare(strict_types=1);

namespace App\UseCases\User\Dto;

class User
{
    private int $id;
    private string $email;
    private int $countNotionDatabases;
    private int $countNotionPages;

    public function __construct(int $id, string $email, int $countNotionDatabases, int $countNotionPages)
    {
        $this->id = $id;
        $this->email = $email;
        $this->countNotionDatabases = $countNotionDatabases;
        $this->countNotionPages = $countNotionPages;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getCountNotionDatabases(): int
    {
        return $this->countNotionDatabases;
    }

    /**
     * @return int
     */
    public function getCountNotionPages(): int
    {
        return $this->countNotionPages;
    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}
