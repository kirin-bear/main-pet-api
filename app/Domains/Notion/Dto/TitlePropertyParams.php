<?php

declare(strict_types=1);

namespace App\Domains\Notion\Dto;

class TitlePropertyParams
{

    private string $plainText;
    private string $content;
    private string $color;

    public function __construct(string $plainText, string $content, string $color)
    {
        $this->plainText = $plainText;
        $this->content = $content;
        $this->color = $color;
    }

    public static function fromArray(array $array): self
    {
        return new self(
            $array['plain_text'] ?? '',
                $array['text']['content'] ?? '',
                $array['annotations']['color'] ?? ''
        );
    }

    public function getPlainText(): string
    {
        return $this->plainText;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getColor(): string
    {
        return $this->color;
    }

}
