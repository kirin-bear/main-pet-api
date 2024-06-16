<?php

declare(strict_types=1);

namespace App\Helpers;

class DateHelper
{
    /**
     * Определяет номер месяца по русскому названию
     *
     * @param string $month
     *
     * @return int
     */
    public static function convertMonthFromRusToInt(string $month): int
    {
        $mapping = [
            'январь' => 1,
            'февраль' => 2,
            'март' => 3,
            'апрель' => 4,
            'май' => 5,
            'июнь' => 6,
            'июль' => 7,
            'август' => 8,
            'сентябрь' => 9,
            'октябрь' => 10,
            'ноябрь' => 11,
            'декабрь' => 12,
        ];
        return $mapping[mb_strtolower($month)] ?? 0;
    }

}
