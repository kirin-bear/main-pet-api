<?php

declare(strict_types=1);

namespace App\Events\Visit;

class Created
{
    private int $id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
