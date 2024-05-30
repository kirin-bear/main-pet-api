<?php

declare(strict_types=1);

namespace App\Domains\Notion\Services;

use App\Domains\Notion\Entities\Properties\AbstractProperty;
use App\Domains\Notion\Enums\PropertyTypeEnum;
use App\Domains\Notion\Exceptions\MakeEntityPropertyException;
use App\Domains\Notion\Factories\EntityPropertyFactory;
use Error;
use JsonException;
use ValueError;

class Transformer
{
    private EntityPropertyFactory $entityPropertyFactory;

    public function __construct(EntityPropertyFactory $entityPropertyFactory)
    {
        $this->entityPropertyFactory = $entityPropertyFactory;
    }

    /**
     * @param string $json
     * @return AbstractProperty[]
     *
     * @throws JsonException
     */
    public function fromJsonToProperties(string $json): array
    {
        $properties = [];
        $propertiesList = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        foreach ($propertiesList as $propertyName => $property) {

            try {
                $property = $this->entityPropertyFactory->make(
                    $propertyName,
                    $property['id'] ?? '',
                    PropertyTypeEnum::from($property['type'] ?? ''),
                    // приведем передачу $params к одному виду (Notion хранит разную структуру, при разных типах)
                    is_array($property[$property['type']])
                        ? $property[$property['type']] :
                        [
                            $property['type'] => $property[$property['type']],
                            'type' => $property['type'],
                        ]
                );
            } catch (MakeEntityPropertyException|Error) {
                // типов бывает много, всех их сразу не опишешь, но для этой проходки, достаточно три
                // TODO: добавить логирование в loki
                continue;
            }

            $properties[] = $property;
        }

        return $properties;
    }

}
