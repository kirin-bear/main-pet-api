<?php

declare(strict_types=1);

namespace App\Domains\Import\Dto;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class Data implements ToCollection
{

    public function collection(Collection $collection)
    {
        dd($collection->toArray());
    }
}
