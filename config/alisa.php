<?php

declare(strict_types=1);

return [
    'token' => env('ALISA_TOKEN'),

    'first_answer' => 'Добро пожаловать в навык Кирин-мир. Чего изволите?',
    'default_answer' => 'Не понимаю вас. Повторите пожалуйста',
    'answers' => [
        'переломать хребет' => 'всем противникам за диктатуру пролетариата',
        'настюша шадрина' => 'пиздатенькая девчонка',
    ],
    'actions' => [
        'синхронизируй мои финансы' => \App\UseCases\Notion\DatabasesSyncUseCase::class,
        'актуализируй мои финансы' => \App\UseCases\Notion\DatabasesSyncUseCase::class,
        'обнови мои финансы' => \App\UseCases\Notion\DatabasesSyncUseCase::class,
    ],
];
