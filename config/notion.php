<?php

declare(strict_types=1);

return [
    /** token in private integration  */
    'token' => env('NOTION_API_TOKEN'),

    /** uuid databases */
    'sync_databases' => [
        '3c36e26a71ff46d984193e7c22309df0', // В долг
        '844bd11a027d462b8b490df5d807e498', // Общие результаты
    ],
];
