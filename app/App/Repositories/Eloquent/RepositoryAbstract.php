<?php

namespace App\App\Repositories\Eloquent;

use App\App\Repositories\Exceptions\NoEntityDefined;
use App\App\Repositories\RepositoryInterface;
use App\Repositories\CriteriaInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Vinkla\Hashids\Facades\Hashids;

abstract class RepositoryAbstract implements RepositoryInterface, CriteriaInterface
{
    /**
     * @var mixed
     */
    protected $entity;

    /**
     * RepositoryAbstract constructor.
     * @throws NoEntityDefined
     */
    public function __construct()
    {
        $this->entity = $this->resolveEntity();
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->entity->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $model = $this->entity->find($id)->first();

        if (!$model) {
            throw (new ModelNotFoundException)->setModel(
                get_class($this->entity->getModel()), $id
            );
        }

        return $model;
    }

    /**
     * @param $hashId
     * @return mixed
     */
    public function findByHashId($hashId)
    {
        return $this->find(Hashids::decode($hashId));
    }

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function findWhere($column, $value)
    {
        return $this->entity->where($column, $value)->get();
    }

    /**
     * @param $column
     * @param $value
     * @return mixed
     */
    public function findWhereFirst($column, $value)
    {
        $model = $this->entity->where($column, $value)->first();

        if (!$model) {
            throw (new ModelNotFoundException)->setModel(
                get_class($this->entity->getModel())
            );
        }

        return $model;
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public function paginate($perPage = 10)
    {
        return $this->entity->paginate($perPage);
    }

    /**
     * @param array $properties
     * @return mixed
     */
    public function create(array $properties)
    {
        return $this->entity->create($properties);
    }

    /**
     * @param $id
     * @param array $properties
     * @return mixed
     */
    public function update($id, array $properties)
    {
        return $this->entity->find($id)->update($properties);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * @param mixed ...$criteria
     */
    public function withCriteria(...$criteria)
    {
        $criteria = array_flatten($criteria);

        foreach ($criteria as $criterion) {
            $this->entity = $criterion->apply($this->entity);
        }
    }

    /**
     * @return mixed
     * @throws NoEntityDefined
     */
    protected function resolveEntity()
    {
        if (!method_exists($this, 'entity')) {
            throw new NoEntityDefined();
        }

        return app()->make($this->entity());
    }
}