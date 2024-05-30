<?php

declare(strict_types=1);

namespace App\Domains\Notion\Entities\Properties;

abstract class AbstractProperty
{
    /**
     * @return string
     */
    abstract public function getId(): string;

    /**
     * @return string
     */
    abstract public function getType(): string;
    /**
     * @return mixed
     */
    abstract public function getValue(): mixed;

    abstract public function getName(): string;
}
