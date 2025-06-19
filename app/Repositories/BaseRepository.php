<?php

declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Eloquent\BaseRepository as Repository;

/**
 * @template TModel of \Illuminate\Database\Eloquent\Model
 * @property TModel $model
 */
abstract class BaseRepository extends Repository
{
    /**
     * Get model query builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder<TModel>
     */
    public function getQuery(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * @param                       $field
     * @param string|int|float|null $value
     * @param array                 $columns
     * @param bool                  $firstOrFail
     *
     * @return TModel|null
     */
    public function findOneByField(
        $field,
        string|int|float $value = null,
        array $columns = ['*'],
        bool $firstOrFail = true
    ) {
        $query = $this->getQuery()->where($field, $value);

        if ($firstOrFail) {
            return $query->firstOrFail($columns);
        }

        return $query->first($columns);
    }

    /**
     * Find data by field and value
     *
     * @param array $where
     * @param array $columns
     *
     * @return TModel|null
     */
    public function findOneWhere(array $where, array $columns = ['*'])
    {
        return $this->getQuery()->where($where)->first($columns);
    }

    /**
     * @return TModel
     */
    public function getModel()
    {
        return parent::getModel();
    }

    /**
     * @return TModel
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function makeModel()
    {
        return parent::makeModel();
    }
}
