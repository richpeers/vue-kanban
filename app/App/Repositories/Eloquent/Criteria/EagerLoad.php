<?php

namespace App\App\Repositories\Eloquent\Criteria;

use App\Repositories\CriterionInterface;

class EagerLoad implements CriterionInterface
{
    /**
     * @var array
     */
    protected $relations;

    /**
     * EagerLoad constructor.
     * @param array $relations
     */
    public function __construct(array $relations)
    {
        $this->relations = $relations;
    }

    /**
     * @param $entity
     * @return mixed
     */
    public function apply($entity)
    {
        return $entity->with($this->relations);
    }
}