<?php

declare(strict_types=1);

namespace App\UseCases\Storage\Dto;

class FileDto
{
    private string $name;
    private string $url = '';

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return FileDto
     */
    public function setUrl(string $url): FileDto
    {
        $this->url = $url;
        return $this;
    }

}
