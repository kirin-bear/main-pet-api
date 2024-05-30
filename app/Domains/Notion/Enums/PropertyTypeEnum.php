<?php

namespace App\Domains\Notion\Enums;

enum PropertyTypeEnum: string
{
    case Rollup = 'rollup';
    case Relation = 'relation';
    case Title = 'title';
    case Select = 'select';
    case CreatedTime = 'created_time';
    case Formula = 'formula';
    case Number = 'number';

}
