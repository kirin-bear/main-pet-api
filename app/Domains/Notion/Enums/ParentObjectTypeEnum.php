<?php

declare(strict_types=1);

namespace App\Domains\Notion\Enums;

enum ParentObjectTypeEnum: string
{
    case DatabaseId = 'database_id';
    case PageId = 'page_id';
    case BlockId = 'block_id';
}
