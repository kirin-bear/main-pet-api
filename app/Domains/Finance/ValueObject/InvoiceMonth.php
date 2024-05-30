<?php

declare(strict_types=1);

namespace App\Domains\Finance\ValueObject;

class InvoiceMonth
{

    private string $name;
    private string $month;
    private int $count;

    public function __construct(string $name, string $month, int $count)
    {
        $this->name = $name;
        $this->month = $month;
        $this->count = $count;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMonth(): string
    {
        return $this->month;
    }

    public function getCount(): int
    {
        return $this->count;
    }

}
