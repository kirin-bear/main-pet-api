<?php

declare(strict_types=1);

namespace App\Domains\Notion\Factories;

use App\Domains\Notion\Entities\Properties\AbstractProperty;
use App\Domains\Notion\Entities\Properties\FormulaProperty;
use App\Domains\Notion\Entities\Properties\RelationProperty;
use App\Domains\Notion\Entities\Properties\RollupProperty;
use App\Domains\Notion\Entities\Properties\TitleProperty;
use App\Domains\Notion\Enums\PropertyTypeEnum;
use App\Domains\Notion\Exceptions\MakeEntityPropertyException;

class EntityPropertyFactory
{
    /**
     * @param string $id
     * @param string $name
     * @param PropertyTypeEnum $type
     * @param array $params
     *
     * @return AbstractProperty
     * @throws MakeEntityPropertyException
     */
    public function make(string $id, string $name, PropertyTypeEnum $type, array $params): AbstractProperty
    {
        return match ($type) {
            PropertyTypeEnum::Title => new TitleProperty($id, $name, $type->value, $params),
            PropertyTypeEnum::Relation => new RelationProperty($id, $name, $type->value, $params),
            PropertyTypeEnum::Rollup => new RollupProperty($id, $name, $type->value, $params),
            PropertyTypeEnum::Formula => new FormulaProperty($id, $name, $type->value, $params),
            default => throw new MakeEntityPropertyException("Undefined ".$type->value. " for make entity property")
        };
    }

}
