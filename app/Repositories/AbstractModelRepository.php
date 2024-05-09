<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\AbstractModel;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractModelRepository
{
    /**
     * Returns the class name of the object managed by the repository.
     *
     * @return class-string<AbstractModel>
     */
    abstract public function getClassName(): string;

    /**
     * @return AbstractModel Создаём новую модельку
     */
    public function newModel(): AbstractModel
    {
        /** @var class-string<AbstractModel>&(AbstractModel) $className */
        $className = $this->getClassName();

        return new $className();
    }

    /**
     * Создаём объект query builder-а для модели.
     * Метод можно переопределять только если требуется специальная
     * логика при инстанцировании модели для запросов к БД.
     *
     * @return Builder построитель запросов
     */
    public function createQueryBuilder(): Builder
    {
        /** @var class-string<AbstractModel>&AbstractModel $className */
        $className = $this->getClassName();

        return $className::query();
    }
}
