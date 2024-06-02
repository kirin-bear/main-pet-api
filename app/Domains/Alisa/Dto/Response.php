<?php

declare(strict_types=1);

namespace App\Domains\Alisa\Dto;

/**
 * https://yandex.ru/dev/dialogs/alice/doc/response.html
 */
class Response
{
    private string $version = '1.0';
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function toArray(): array
    {
        return [
            'version' => $this->version,
            'response' => [
                'text' => $this->text,
                'tts' => $this->text,
            ],
        ];

    }

}
