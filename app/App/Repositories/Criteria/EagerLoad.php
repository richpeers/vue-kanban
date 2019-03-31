<?php

namespace App\App\Repositories\Criteria;

class EagerLoad
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