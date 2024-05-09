<?php

declare(strict_types=1);

namespace App\Domains\Notion\Entities;

use App\Domains\Notion\ValueObject\DatabaseDescription;

class Database
{

    private string $uuid;

    private string $title;

    private ParentObject $parentObject;

    private DatabaseDescription $description;


    /**
     * @param string $uuid
     * @param string $title
     * @param ParentObject $parentObject
     * @param DatabaseDescription $databaseDescription
     */
    public function __construct(string $uuid, string $title, ParentObject $parentObject, DatabaseDescription $databaseDescription )
    {
        $this->uuid = $uuid;
        $this->title = $title;
        $this->parentObject = $parentObject;
        $this->description = $databaseDescription;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getParentObject(): ParentObject
    {
        return $this->parentObject;
    }

    public function getDescription(): DatabaseDescription
    {
        return $this->description;
    }

}
