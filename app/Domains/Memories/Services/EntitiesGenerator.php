<?php

declare(strict_types=1);

namespace App\Domains\Memories\Services;

use App\Domains\Memories\Entities\Memory;
use App\Domains\Memories\Entities\MemoryLink;

class EntitiesGenerator
{
    /**
     * @param int $firstId
     * @param int $lastId
     *
     * @return Memory[]
     */
    public function memories(int $firstId, int $lastId): array
    {
        $memories = [];

        for ($i = $firstId; $i <= $lastId; $i++) {
            $memories[] = new Memory($i);
        }

        return $memories;
    }

    /**
     * @param int $firstId
     * @param int $lastId
     * @param int $maxLinks
     *
     * @return MemoryLink[]
     */
    public function memoriesLinks(int $firstId, int $lastId, int $maxLinks): array
    {
        $memoriesLinks = [];

        for ($i = $firstId; $i <= $lastId; $i++) {

            // добавим случайность связки
            if(rand(0, 1)) {
                // случайное количество связок
                $countLinks = rand(1, $maxLinks);

                for ($j = 1; $j <= $countLinks; $j++) {
                    $targetId = rand($firstId, $lastId);
                    if ($targetId != $i) {
                        $memoriesLinks[] = new MemoryLink($i, $targetId);
                    }
                }
            }
        }

        return $memoriesLinks;
    }

}
